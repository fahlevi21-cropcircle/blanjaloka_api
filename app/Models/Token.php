<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    //
    public $timestamps = true;

    protected $fillable = [
        'token', 'ip_address', 'status', 'created_at', 'updated_at'
    ];


    /**
     * Get a user's token or create it, intended for login
     * 
     * @param int $userId       user id to find the token
     * @param array $data       model's data to be created
     * @param bool $updateToken decide whether the token needs to be updated
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public static function getUsersTokenOrCreate($userId, $data, $updateToken = true)
    {
        # code...
        $token = Token::query()
            ->leftJoin('users_tokens', 'users_tokens.token_id', '=', 'tokens.id')
            ->leftJoin('users', 'users_tokens.user_id', '=', 'users.id')
            ->select('tokens.*')
            ->where('user_id', $userId)
            ->get()->first();

        if ($token == null) {
            // create if not exist
            $token = Token::query()->create($data);
        } else {
            if ($updateToken) {
                // update the token
                $token->update(['token' => $data['token']]);
            }

            // notice ip address changed
            if ($token->ip_address != $data['ip_address']) {
                # do something...
            }
        }


        return $token;
    }

    /**
     * Get a user's token only
     * 
     * @param int $userId user id to find the token
     * 
     * @return string|null token
     */
    public static function getUsersToken($userId)
    {
        # code...
        return Token::query()
            ->leftJoin('users_tokens', 'users_tokens.token_id', '=', 'tokens.id')
            ->leftJoin('users', 'users_tokens.user_id', '=', 'users.id')
            ->select('tokens.token')
            ->where('user_id', $userId)
            ->get()->first();
    }
}
