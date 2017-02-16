<?php

namespace Avem\Repositories;

use Avem\User;
use Auth0\Login\Contract\Auth0UserRepository;

class UserRepository implements Auth0UserRepository
{
	/* This class is used on api authN to fetch the user based on the jwt.*/
	public function getUserByDecodedJWT($jwt)
	{
		/*
		 * The `sub` claim in the token represents the subject of the token
		 * and it is always the `user_id`
		 */
		$jwt->user_id = $jwt->sub;

		return $this->upsertUser($jwt);
	}

	public function getUserByUserInfo($userInfo)
	{
		return $this->upsertUser($userInfo['profile']);
	}

	protected function upsertUser($profile)
	{
		$user = User::where('auth0_id', $profile['user_id'])->first();

		if ($user === null) {
			// If not, create one
			$user = new User;
			$user->email = $profile['email'];
			$user->auth0_id = $profile['user_id'];
			$user->name = $profile['given_name'];
			$user->surname = $profile['family_name'];
			$user->save();
		}

		return $user;
	}

	public function getUserByIdentifier($identifier)
	{
		// Get the user info of the user logged in (probably in session)
		$user = \App::make('auth0')->getUser();
		if ($user === null) return null;

		// build the user
		$user = $this->getUserByUserInfo($user);

		// it is not the same user as logged in, it is not valid
		if ($user && $user->id == $identifier) {
			return $user;
		}
	}

}
