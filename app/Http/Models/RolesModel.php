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
 * Class RolesModel
 * @package Besofty\Web\Accounts\Models
 */
class RolesModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'roles';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    /*public function permission()
    {
        return $this->belongsToMany(Permission::class, 'myaccount_roles_permissions', 'role_id', 'permission_id');
    }*/

}