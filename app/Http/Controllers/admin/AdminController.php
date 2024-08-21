<?php

namespace App\Http\Controllers\admin;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminController
{
    public function showLoginForm(): Factory|View|Application
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('login', 'password');

        if ($credentials['login'] === env('ADMIN_LOGIN') && $credentials['password'] === env('ADMIN_PASSWORD')) {
            $request->session()->put('admin_logged_in', true);
            return Redirect::route('admin.index');
        }

        return Redirect::route('admin.login')->withErrors(['error' => 'Invalid credentials']);
    }

    public function index(): Factory|View|Application
    {
        return view('admin.index');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget('admin_logged_in');
        return Redirect::route('admin.login')->with('message', 'You have been logged out');
    }
}
