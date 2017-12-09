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
 * Class AddressesModel
 * @package Besofty\Web\Accounts\Models
 */
class AddressesModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'users_addresses';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['type', 'user_id'];

    /**
     * @var array
     */
    protected $hidden = ['id', 'user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(UsersModel::class, "user_id");
    }

}