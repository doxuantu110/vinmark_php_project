<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with('role')->paginate(9);
        return view('admin.pages.users', compact('users'));
    }
}
