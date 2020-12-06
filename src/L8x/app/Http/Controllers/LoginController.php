<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }

    public function login() {
        return view('login.login');
    }

    public function loginSubmit(Request $request) {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('home'));
        }

        return redirect()->route('login')->withErrors(['Wrong username or password']);
    }

    public function register() {
        return view('login.register');
    }

    public function registerSubmit(Request $request) {
        $request->validate([
            'username' => 'required|regex:/^[a-z0-9]+$/u|unique:users|min:3|max:20',
            'password' => 'required|max:100',
            'password2' => [
                'required',
                'max:100',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value !== $request->input('password')) {
                        $fail($attribute.' is different.');
                    }
                },
            ],
            'profile_link' => 'required|max:190',
        ]);

        $form = $request->all();
        $form['password'] = Hash::make($request->input('password'));
        $form['role'] = 'user';

        $user = User::create($form);
        Auth::login($user);

        return redirect()->route('home');
    }
}
