<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class PasswordController extends Controller {
	/*
		    |--------------------------------------------------------------------------
		    | Password Reset Controller
		    |--------------------------------------------------------------------------
		    |
		    | This controller is responsible for handling password reset requests
		    | and uses a simple trait to include this behavior. You're free to
		    | explore this trait and override any methods you wish to tweak.
		    |
	*/

	use ResetsPasswords;

	/**
	 * Create a new password controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware($this->guestMiddleware());
	}

	/**
	 * Validate the request of sending reset link.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return void
	 */
	protected function validateSendResetLinkEmail(Request $request) {
		$this->validate($request, ['email' => 'required|email'], [
			'email.required' => 'Email không được để trống',
			'email.email'    => 'Không đúng định dạng email.',
		]);
	}
	/**
	 * Get the post register / login redirect path.
	 *
	 * @return string
	 */
	public function redirectPath() {
		if (property_exists($this, 'redirectPath')) {
			return $this->redirectPath;
		}

		return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
	}
}
