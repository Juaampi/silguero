<?php namespace Laravel\Socialite\Two;

use Laravel\Socialite\AbstractUser;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends AbstractUser {

	/**
	 * The user's access token.
	 *
	 * @var string
	 */
	public $token;

	/**
	 * Set the token on the user.
	 *
	 * @param  string  $token
	 * @return $this
	 */
	public function setToken($token)
	{
		$this->token = $token;

		return $this;
	}

}
