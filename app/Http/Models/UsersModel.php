<?php
/**
 * Write something about the purpose of this file
 *
 * @author Sharmin Shanta <shantaex81@gmail.com>
 * @url http://www.sharminshanta.com
 */

namespace Besofty\Web\Accounts\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use SharminShanta\PHPUtilities\Unique\UUID;

/**
 * Class UsersModel
 * @package Besofty\Web\Accounts\Models
 */
class UsersModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'username',
        'email_address',
        'password',
        'is_internal',
        'is_visible',
        'status',
        'last_seen',
        'created',
        'modified',
    ];

    /**
     * @var string
     */
    protected $table = "users";

    /**
     * @var bool
     */
    public $timestamps = false;

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
        'is_internal' => 'string',
        'is_visible' => 'string',
        'status' => 'string',
        'last_seen' => 'datetime',
        'created' => 'datetime',
        'modified' => 'datetime',
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
    public function createNewUser($data = [])
    {
        if (array_key_exists('user', $data) === false) {
            Log::error('User Inforfation Required');
        }

        if (array_key_exists('profile', $data) === false) {
            Log::error('Profile Inforfation Required');
        }

        $fullData = $data;

        //Check required fields for user
        $userDataRequiredFields = ['email_address', 'password'];
        $missingField = [];

        foreach ($userDataRequiredFields as $key => $value) {
            if (array_key_exists($value, $fullData['user']) === false) {
                $missingField[] = $value;
            }
        }

        //Check required fields for user's profile
        $profileRequiredFields = ['first_name', 'last_name'];
        $missingField = [];

        foreach ($profileRequiredFields as $key => $value) {
            if (array_key_exists($value, $fullData['profile']) === false) {
                $missingField[] = $value;
            }
        }

        if (sizeof($missingField) > 0) {
            Log::error('Missing required fields', ['Missing_field' => $missingField]);
        }

        try {
            $user = $this->prepareNewUserData($fullData['user']);
            $profile = $this->prepareNewUserProfileData($fullData['profile']);
            $defaultRole = RolesModel::where('slug', 'general-user')->get();

        } catch (\Exception $exception) {
            throw $exception;
        } catch (\Exception $exception) {
            throw $exception;
        }

        try {
            //create user
            $this->setRawAttributes($user);
            $this->saveOrFail();

            //Create profile for this user
            $this->profile()->save(new ProfileModel($profile));

            //Assign default role for this user
            $this->role()->saveMany($defaultRole);

            //User Details
            $newUserDetails = $this->details($this->uuid);

            return $newUserDetails;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param array $data
     * @return array
     */
    protected function prepareNewUserData($data = [])
    {
        $message = [];

        //Validate and sanitize email address
        if (filter_var($data['email_address'], FILTER_VALIDATE_EMAIL) != false) {
            $data['email_address'] = filter_var($data['email_address'], FILTER_SANITIZE_EMAIL);
            $data['username'] = $data['email_address'];
        } else {
            Log::error('Invalid Email');
        }

        //Check whether this email address already exists
        $isEmailAlreadyExists = $this->where('username', $data['email_address'])
            ->orWhere('email_address', $data['email_address'])
            ->select('email_address')
            ->first();

        if ($isEmailAlreadyExists) {
            Log::error('Email Already Registered');
        }

        //Encrypt password and verify encryption
        $encryptedPassword = password_hash($data['password'], PASSWORD_BCRYPT);

        if (password_verify($data['password'], $encryptedPassword) != true) {
            Log::error('Invalid Password');
        }

        $data['password'] = $encryptedPassword;

        //If no UUID provided, generate one UUID
        if (array_key_exists('uuid', $data) === false) {
            $data['uuid'] = UUID::generateUUID();
        }

        //Few default field value prepared
        //$data['email_address_verified'] = 0;

        //$data['email_address_verification_token'] = md5(md5(UUID::generateUUID()) . md5(serialize($data)));

        if (array_key_exists('status', $data) === true) {
            if ($data['status'] === 1 || $data['status'] === 0) {
                $data['status'] = intval($data['status']);
            }
        } else {
            $data['status'] = 1;
        }

        if (array_key_exists('is_visible', $data) === true) {
            if ($data['is_visible'] === 1 || $data['is_visible'] === 0) {
                $data['is_visible'] = intval($data['is_visible']);
            }
        } else {
            $data['is_visible'] = 1;
        }

        /* if (array_key_exists('is_internal', $data) === true) {
             unset($data['is_internal']);
         }*/

        if (array_key_exists('is_internal', $data) === false) {
            $data['is_internal'] = 0;
        }

        if (array_key_exists('created', $data) === false) {
            $data['created'] = date('Y-m-d H:i:s');
        }

        if (array_key_exists('modified', $data) === false) {
            $data['modified'] = $data['created'];
        }

        if (array_key_exists('last_seen', $data) === false) {
            $data['last_seen'] = $data['created'];
        }

        //$data['is_internal'] = 0;
        //$data['created'] = date('Y-m-d H:i:s');
        //$data['modified'] = $data['created'];
        //$data['last_seen'] = $data['created'];

        $user = [];

        foreach ($this->fillable as $item => $value) {
            if (array_key_exists($value, $data) === true) {
                $user[$value] = $data[$value];
            }
        }

        return $user;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function prepareNewUserProfileData($data = [])
    {
        $profile = [];
        if (array_key_exists('account_id', $data) === false) {
            unset($data['account_id']);
        }

        if (array_key_exists('created', $data) === false) {
            $data['created'] = date('Y-m-d H:i:s');
        }

        $profileModel = new ProfileModel();

        /*$profileModel->profileFieldsValidation($data);*/
        foreach ($profileModel->getfillable() as $item => $value) {
            if (array_key_exists($value, $data) === true) {
                $profile[$value] = $data[$value];
            }
        }

        return $profile;
    }

    /**
     * @param $uuid
     * @return null
     */
    public function getDetails($uuid)
    {
        $details = null;
        $details = $this->where('uuid', $uuid)
            ->first();
        return $details;
    }

    /**
     * @param $uuid
     * @param bool $forceCacheRegeneration
     * @return array
     */
    public function details($uuid, $forceCacheRegeneration = false)
    {
        $user = $this->where('uuid', $uuid)
            ->with('profile')
            ->first();

        if (!$user) {
            return [];
        }

        $details = $user->toArray();

        return $details;
    }
}