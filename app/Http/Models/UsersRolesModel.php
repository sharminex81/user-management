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
 * Class UsersRolesModel
 * @package Besofty\Web\Accounts\Models
 */
class UsersRolesModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'users_roles';

    /**
     * @var bool
     */
    public $timestamps = false;


    /**
     * @var array
     */
    protected $fillable = ['user_id', 'role_id', 'is_active', 'created', 'modified'];
}