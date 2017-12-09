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
     * Tesing purpose
     */
    public function test()
    {
        var_dump(3333);
        die();
    }

    /**
     * @param $postdata
     */
    public function createNewUser($postdata)
    {
        return $postdata;
    }
}