<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NewUserPasswordToken;
use Illuminate\Support\Facades\Hash;

class NewUserResetPasswordController extends Controller
{
    public function create(string $token, string $email){

        $user = User::firstWhere('email', $email);
        if(!$user)
            abort(401, 'Unauthorized');

        $userToken = $user->newUserToken;

        if(!$userToken || $userToken->token != $token){
            abort(401, 'Unauthorized');
        }

        return view('auth.new-user-password.reset-password', compact('token', 'email'));
    }
    public function updatePassword(Request $request){
        $credentials = $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required|confirmed',
            'token' => 'required|exists:new_user_password_tokens,token'
        ]);

        $user = User::firstWhere('email', $credentials['email']);
        $user->password = Hash::make($credentials['password']);
        $user->save();

        $token = NewUserPasswordToken::firstWhere('email', $credentials['email']);
        
        $token->deleteByToken($credentials['token']);

        $alert = [
            'message'   => 'Password has been reset. Try to login your account!',
            'type'      => 'success'
        ];
        return redirect()->route('login')->with(['alert' => $alert]);
    }
}
