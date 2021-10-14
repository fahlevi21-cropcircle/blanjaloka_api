<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'first_name', 'last_name', 'token_id', 'deleted_at', 'created_at', 'updated_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Set the User's token
     * 
     * @param int $userId the user's id
     * @param int $tokenId the created tokenId
     * 
     * @return null|bool
     */
    public static function setUserToken($userId, $tokenId)
    {
        # code...
        return DB::table('users_tokens')
            ->upsert([
                'user_id' => $userId,
                'token_id' => $tokenId
            ], ['user_id', 'token_id']);
    }
}
