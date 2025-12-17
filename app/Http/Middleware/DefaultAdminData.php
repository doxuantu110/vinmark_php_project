<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use Illuminate\Support\Facades\View;
use App\Models\Notification;

class DefaultAdminData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        $user = Auth::guard('admin')->user();
        
        if($user){
            $messages = Contact::where('is_replyed', 0)->latest()->get();
            $notification = Notification::where('is_read', 0)->latest('created_at')->get();
        }else{
            $messages = [];
            $notification = [];
        }
        View::share([
            'messages' => $messages,
            'user' => $user,
            'notifications' => $notification,
        ]);
        return $next($request);
    }
}
