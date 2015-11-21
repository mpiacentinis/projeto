<?php
/**
 * Created by PhpStorm.
 * User: mpiacentinis
 * Date: 20/11/15
 * Time: 20:38
 */

namespace Project\OAuth;

use Auth;

class Verifier
{
    public function verify($username, $password)
    {
        $credentials = [
            'email'    => $username,
            'password' => $password,
        ];

        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }
}