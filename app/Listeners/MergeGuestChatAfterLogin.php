<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\ChatMessage;

class MergeGuestChatAfterLogin
{
    /**
     * Create the event listener.
     */

    /** Merge guest chat messages into the user's chat history after they log in.
     * @param Login $event
     * @return void
     */
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $guestToken = request()->cookie('chat_token');

    if ($guestToken) {
        ChatMessage::where('guest_token', $guestToken)
            ->update([
                'user_id' => $event->user->id,
                'guest_token' => null
            ]);

        cookie()->queue(cookie()->forget('chat_token'));
    }
    }
}
