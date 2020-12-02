<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $userModel = User::where('email', $user->email)->first();
            if ($userModel) {
                Auth::login($userModel);
                return redirect('/dashboard');
            }

            $newUser = new User;
            $newUser->first_name    = explode(' ', $user)[0];
            $newUser->last_name     = explode(' ', $user)[1] ?? '';
            $newUser->email         = $user->email;
            $newUser->save();

            Auth::login($newUser);
            return redirect('/dashboard');

        } catch (Exception $e) {
            Log::error($e->getMessage(), [
                'file'  => $e->getFile(),
                'line'  => $e->getLine(),
            ]);
            return redirect()->to('/login')->with('authentication', 'Something went wrong during logging-in via google. Please try again after sometime.');
        }
    }
}
