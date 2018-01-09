<?php
/**
 * Write something about the purpose of this file
 *
 * @author Sharmin Shanta <shantaex81@gmail.com>
 * @url http://www.sharminshanta.com
 */

namespace App\Http\Controllers\Profiles;


use Illuminate\Routing\Controller;
use Besofty\Web\Accounts\Models\UsersModel;
use Illuminate\Support\Facades\Session;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Profiles
 */
class ProfileController extends Controller
{
    /**
     * User's full profile
     */
    public function home()
    {
        $usersModel = new UsersModel();
        $usersDetails = $usersModel->getProfile(Session::get('authinfo'));
        return view('profiles.home', [
            'userDetails' => $usersDetails
        ]);

    }
}