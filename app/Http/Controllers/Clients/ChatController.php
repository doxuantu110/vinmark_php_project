<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function fetchMessages(Request $request)
    {
        if (Auth::check()) {
            $msgs = ChatMessage::where('user_id', Auth::id())->orderBy('created_at')->get();
        } else {
            $token = $request->cookie('chat_token');
            $msgs = $token ? ChatMessage::where('guest_token', $token)->orderBy('created_at')->get() : collect();
        }
        return response()->json($msgs);
    }

    public function sendMessage(Request $request): JsonResponse
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $userId = Auth::id();
        $guestToken = null;

        // 1. Xử lý Token
        if (!$userId) {
            $guestToken = $request->cookie('chat_token');
            if (!$guestToken) {
                $guestToken = 'guest_' . Str::random(32);
                cookie()->queue(cookie('chat_token', $guestToken, 60 * 24 * 180));
            }
        }

        // 2. Lưu User Message
        $userMsg = ChatMessage::create([
            'user_id' => $userId,
            'guest_token' => $userId ? null : $guestToken,
            'sender' => 'user',
            'message' => $request->message,
        ]);

        // 3. Prompt & History
        $products = Product::where('stock', '>', 0)
            ->get(['name', 'price', 'unit'])
            ->map(function ($p) {
                return "- {$p->name}: " . number_format($p->price) . "đ / {$p->unit}";
            })->toArray();
        $productList = implode("S\n", $products);

        $prompt = "Bạn là trợ lý ảo Vinmark. Trả lời ngắn gọn, thân thiện bằng tiếng Việt.\nSản phẩm:\n$productList";

        $history = ChatMessage::query()
            ->where(function (Builder $q) use ($userId, $guestToken) {
                if ($userId) $q->where('user_id', $userId);
                else $q->where('guest_token', $guestToken);
            })
            ->latest()->limit(10)->get()->reverse()->values();

        // 4. Chuẩn hóa History (Gộp tin nhắn trùng role)
        $contents = [];
        foreach ($history as $msg) {
            $role = $msg->sender === 'user' ? "user" : "model";
            $text = $msg->message;
            if (!empty($contents) && end($contents)['role'] === $role) {
                $lastIndex = array_key_last($contents);
                $contents[$lastIndex]['parts'][0]['text'] .= "\n" . $text;
            } else {
                $contents[] = [
                    "role" => $role,
                    "parts" => [["text" => $text]]
                ];
            }
        }
        if (!empty($contents) && $contents[0]['role'] === 'model') array_shift($contents);

        // 5. GỌI API (SỬA LẠI ĐÚNG MODEL CÓ TRONG DANH SÁCH CỦA BẠN)
        $aiReplyText = "Xin lỗi, tôi đang bận.";

        if (env('GOOGLE_GEMINI_API_KEY')) {
            try {
                // --- QUAN TRỌNG NHẤT: Dùng gemini-2.0-flash ---
                // Tìm dòng $url cũ và thay bằng dòng này:
                $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent?key=' . env('GOOGLE_GEMINI_API_KEY');

                $payload = [
                    "systemInstruction" => ["parts" => [["text" => $prompt]]],
                    "contents" => $contents
                ];

                // Thêm verify => false cho Localhost
                $response = Http::withOptions(['verify' => false])
                    ->withHeaders(['Content-Type' => 'application/json'])
                    ->post($url, $payload);

                if ($response->successful()) {
                    $aiReplyText = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? "Lỗi phản hồi.";
                } else {
                    Log::error('Gemini Error', ['body' => $response->json()]);
                    $aiReplyText = "Lỗi kết nối AI (Code: " . $response->status() . ")";
                }
            } catch (\Throwable $e) {
                Log::error('AI Exception: ' . $e->getMessage());
                $aiReplyText = "Lỗi hệ thống.";
            }
        }

        // 6. Lưu Bot Reply
        $botMsg = ChatMessage::create([
            'user_id' => $userId,
            'guest_token' => $userId ? null : $guestToken,
            'sender' => 'bot',
            'message' => $aiReplyText,
        ]);

        return response()->json(['user' => $userMsg, 'bot' => $botMsg]);
    }
}
