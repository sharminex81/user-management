<?php
/**
 * Write something about the purpose of this file
 *
 * @author Sharmin Shanta <shantaex81@gmail.com>
 * @url http://www.sharminshanta.com
 */

namespace Besofty\Web\Accounts\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UsersModel
 * @package Besofty\Web\Accounts\Models
 */
class UsersModel extends Model
{
    /**
     * @var string
     */
    protected $table = "users";

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'username', 'email_address', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'password_token',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'uuid' => 'string',
        'username' => 'string',
        'email_address' => 'string',
        'password' => 'string',
        'created' => 'datetime',
    ];

    protected static $extendedRelations = [
        "profile",
        "role",
        "addresses",
    ];

    /**
     * @var string
     */
    protected $with = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(ProfileModel::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function role()
    {
        return $this->belongsToMany(RolesModel::class, 'users_roles', 'user_id', 'role_id');
    }

    /**
     * @return \Illuminate\Database\Query\Builder|static
     */
    public function addresses()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->hasMany(AddressesModel::class, 'user_id')->take(10);
    }

    /**
     * @param $postdata
     */
    public function createNewUser($postdata)
    {
        return $postdata;
    }
}