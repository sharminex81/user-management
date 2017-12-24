<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Besofty\Web\Accounts\Models\UsersModel;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login(Request $request)
    {
        try {
            $queryParams = $request->query();

            if (!empty($queryParams)) {
                $usersModel = new UsersModel();
                $userDetails = $usersModel->details($queryParams['uuid']);

                if (!empty($userDetails)) {
                    $accountVerified = (int)$userDetails['account_verified'];
                    $status = (int)$userDetails['status'];

                    if ($accountVerified == 0 && $status == 0) {
                        $postData['account_verified'] = 1;
                        $postData['status'] = 1;
                        $userAccountVerifed = $usersModel->where('uuid', $userDetails['uuid'])->update($postData);
                        if ($userAccountVerifed) {
                            \Session::flash('success', "Please, login to our site");
                            Log::info('User account has verified', ['user_uuid' => $userDetails['uuid']]);
                        }
                    }
                }
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::debug($exception->getTraceAsString());
        }

        return view('auth.login');
    }

    /**
     * @param Request $request
     */
    public function loginProcess(Request $request)
    {
        try {
            $postData = $request->all();
            $postData['email_address'] = filter_var($postData['email_address'], FILTER_SANITIZE_EMAIL);
            $usersModel = new UsersModel();
            $user = $usersModel->authValidation($postData['email_address'], $postData['password']);
            var_dump($user); die();

            /*if ($user) {
                Log::info('User has successfully logged in ');
                return redirect('/dashboard');
            } else {
                Log::error('User\'s credential doesn\'t match');
                return Redirect::back()->with('error', 'Sorry, credential doesn\'t match');
            }*/
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::debug($exception->getTraceAsString());
        }
    }
}
