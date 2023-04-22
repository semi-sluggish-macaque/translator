<?php

namespace App\Http\Controllers;

use App\Models\modules;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Usercontroller extends Controller
{
    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
//        для email уникальность ищется по таблице users
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        //записвыание пользователя в базу данных
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        $text = 'мой первый модуль';

        $userId = $user->id;

        modules::create([
            'module' => $text,
            'user_id' => $userId,
        ]);
        Auth::login($user);
        session()->flash('success', 'successful registration');
//сразу же авторизируем пользователя
        return redirect()->route('show.module');
    }

    public function loginFrom()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

//        аудентификация
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return redirect()->route('show.module');
        }
        //редирект на страницу previous и доавбление ошибок во flash сообщениеы
        return redirect()->back()->with('error', 'incorrect login or password');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.create');
    }
}
