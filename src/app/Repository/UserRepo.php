<?php

namespace App\Repository;

use App\Models\User;
use App\Models\UserLoginLog;

class UserRepo
{
    public static function create(array $user)
    {
        return User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => bcrypt($user['password'])
        ]);
    }

    public static function social_create(array $user)
    {
        return User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'type' => $user['type'],
            'password' => bcrypt(time())
        ]);
    }

    public static function log($user_id)
    {
        UserLoginLog::create([
            'user_id' => $user_id,
            'account_type' => 'localhost'
        ]);
    }

    public static function social_log($user_id,$type)
    {
        UserLoginLog::create([
            'user_id' => $user_id,
            'account_type' => $type
        ]);
    }

    public static function user($email,$type = null)
    {
        if ($type)
            return User::where('email',$email)
                ->where('type',$type)->first();
        return User::where('email',$email)->first();
    }
}
