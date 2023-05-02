<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function createAccount(Request $data)
    {
        $data->validate([
            'name' => ['required', 'string', 'max:55','unique:users,name'],
            'role' => 'required|in:Admin,User',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => 'required', 'string', 'min:4', 'confirmed',
        ]);

    $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
        ]);

        if ($user) {

            return redirect()->route('login')->with('message','Registration successful! Login to continue');

        }
    }
}
