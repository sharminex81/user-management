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
 * Class ProfileModel
 * @package Besofty\Web\Accounts\Models
 */
class ProfileModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'users_profile';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'family_name',
        'nick_name',
        'title',
        'gender',
        'picture',
        'timezone',
        'language',
        'country',
        'company_name',
        'security_questions_one',
        'security_questions_one_answer',
        'security_questions_two',
        'security_questions_two_answer',
        'created',
        'modified'
    ];

    /**
     * @var array
     */
    public static $securityQuestions = [
        'What is your pet’s name?' => 'What is your pet’s name?',
        'In what year was your father born?' => 'In what year was your father born?',
        'What is your favorite color?' => 'What is your favorite color?',
        'What is your favorite game?' => 'What is your favorite game?'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User()
    {
        return $this->belongsTo(UsersModel::class, "user_id");
    }
}