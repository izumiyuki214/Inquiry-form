<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name'     => 'required|max:255',
                'email'    => 'required|email|max:255|unique:users,email',
                'password' => 'required|max:255',
            ],
            [
                'name.required' => 'お名前を入力してください',
                'email.required' => 'メールアドレスを入力してください',
                'email.email'    => 'メールアドレスはメール形式で入力してください',
                'email.unique'   => 'このメールアドレスは既に登録されています',
                'password.required' => 'パスワードを入力してください',
            ]
        );

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
        ]);

        Auth::login($user);
        return redirect('/admin');
    }

    public function authenticate(Request $request)
    {
        //入力チェック
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'メールアドレスを入力してください',
                'email.email'    => 'メールアドレスはメール形式で入力してください',
                'password.required' => 'パスワードを入力してください',
            ]
        );

        // 認証チェック
        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors([
                'login' => 'ログイン情報が登録されていません',
            ]);
        }

        $request->session()->regenerate();

        return redirect('/admin');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

