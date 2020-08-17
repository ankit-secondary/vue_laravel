<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Hash;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller {

	//New user registration


	use SendsPasswordResetEmails, ResetsPasswords {
        SendsPasswordResetEmails::broker insteadof ResetsPasswords;
        ResetsPasswords::credentials insteadof SendsPasswordResetEmails;
    }
	

	public function register(Request $request) {
		$v = Validator::make($request->all(), [
				'email'    => 'required|email|unique:users',
				'password' => 'required|min:3|confirmed',
			]);
		if ($v            ->fails()) {
			return response()->json([
					'status' => 'error',
					'errors' => $v->errors()
				], 422);
		}
		$user           = new User;
		$user->email    = $request->email;
		$user->password = bcrypt($request->password);
		$user->save();
		return response()->json(['status' => 'success'], 200);
	}

	//User Login

	public function login(Request $request) {
		$credentials = $request->only('email', 'password');
		if ($token = $this->guard()->attempt($credentials)) {
			$user = Auth::user();
			return response()->json(['status' => 'success', 'user' => $user], 200)->header('Authorization', $token);
		}

		return response()->json(['error' => 'login_error'], 401);
	}

	//User  Logout

	public function logout() {
		$this->guard()->logout();
		return response()->json([
				'status' => 'success',
				'msg'    => 'Logged out Successfully.'
			], 200);
	}

	//Logged in user detail

	public function user(Request $request) {
		$user = User::find(Auth::user()->id);
		return response()->json([
				'status' => 'success',
				'data'   => $user
			]);
	}

	//Refresh token

	public function refresh() {
		if ($token = $this->guard()->refresh()) {
			return response()
				->json(['status' => 'successs'], 200)
				->header('Authorization', $token);
		}
		return response()->json(['error' => 'refresh_token_error'], 401);
	}


public function sendPasswordResetLink(Request $request)
{
    if($request->input('email')) {
		
		return $this->sendResetLinkEmail($request);
		
	}
}

protected function sendResetLinkResponse(Request $request, $response)
{
    return response()->json([
        'message' => 'Password reset email sent.',
        'data' => $response
    ]);
}

protected function sendResetLinkFailedResponse(Request $request, $response)
{
    return response()->json(['message' => 'Email could not be sent to this email address.']);
}

/**
 * Handle reset password 
 */
public function callResetPassword(Request $request)
{
    return $this->reset($request);
}

protected function resetPassword($user, $password)
{
    $user->password = Hash::make($password);
    $user->save();
    event(new PasswordReset($user));
}

protected function sendResetResponse(Request $request, $response)
{
    return response()->json(['message' => 'Password reset successfully.']);
}

protected function sendResetFailedResponse(Request $request, $response)
{
    return response()->json(['message' => 'Failed, Invalid Token.']);
}

	private function guard() {
		return Auth::guard();
	}
}
