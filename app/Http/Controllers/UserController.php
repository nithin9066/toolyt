<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    public function googleService()
    {
        return Socialite::driver('google')->redirect();
    }
    public function googleCallback(Request $request)
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Throwable $th) {
            return redirect('/');
        }
        $userData = User::updateOrCreate(
            ['email' => $user->email],
            [
                "name" => $user->name,
                'email' => $user->email,
                'google_id' => $user->id
            ]
        );

        $request->session()->put('user', $userData);
        return redirect('/home');

    }

    public function linkedinService()
    {
        return Socialite::driver('linkedin')->redirect();
    }
    public function linkedinCallback(Request $request)
    {
        try {
            $user = Socialite::driver('linkedin')->user();
        } catch (\Throwable $th) {
            return redirect('/');
        }

        $userData = User::updateOrCreate(
            ['email' => $user->email],
            [
                "name" => $user->name,
                'email' => $user->email,
                'linkedin_id' => $user->id
            ]
        );

        $request->session()->put('user', $userData);
        return redirect('/home');

    }

    public function create(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        User::create([
            'name' => $request->firstname . ' ' . $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/sign-in');
    }

    public function index(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->get()->first();

        if (Hash::check($request->password, $user->password)) {
            $request->session()->put('user', $user);
            return redirect('/home');
        } else {
            return redirect()->back()->withErrors(['error' => "Invalid Password"]);
        }
    }
}