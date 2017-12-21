<?php
/**
 * Write something about the purpose of this file
 *
 * @author Sharmin Shanta <shantaex81@gmail.com>
 * @url http://www.sharminshanta.com
 */

namespace App\Http\Controllers;

use Besofty\Web\Accounts\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Mockery\Exception;

/**
 * Class AccessController
 * @package App\Http\Controllers
 */
class AccessController extends Controller
{
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function signup()
    {
        return view('auth.signup');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function signupProcess(Request $request)
    {
        $userData = $request->all()['user'];
        $profileData = $request->all()['profile'];
        $postData = array_merge($profileData, $userData);

        //Set rules for the post data
        $dataRules = [
            'first_name' => 'required|max:15',
            'last_name' => 'required|max:15',
            'email_address' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
        ];

        //Check the valid post data
        $validator = $this->userValidation($postData, $dataRules);

        if ($validator->fails()) {
            \Session::flash('error', 'Sorry, you\'ve provided invalid data');
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(
                    $validator->messages()
                );
        }

        try {
            $userModel = new UsersModel();
            $newUserCreated = $userModel->createNewUser($request->all());
            if ($newUserCreated) {
                \Session::flash('success', "A email has been send to your inbox. Check your inbox.");
                Log::info('User has Created Successfully', ['new_user' => $newUserCreated]);
                return redirect('/');
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::debug($exception->getTraceAsString());
        }

        return Redirect::back()->with('error', 'Sorry, Something went wrong');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param array $data
     * @param array $rules
     * @return \Illuminate\Validation\Validator
     */
    private function userValidation(array $data, array $rules)
    {
        $messages = [
            'first_name.required' => 'First name is required',
            'first_name.max' => 'First name cannot be more than 15 characters',
            'last_name.required' => 'Last name is required',
            'last_name.max' => 'Last name cannot be more than 15 characters',
            'email_address.required' => 'Email is required',
            'email_address.email' => 'Invalid email adderss',
            'email_address.unique' => 'This email address already taken',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters',
            'password_confirmation.required' => 'Confirm password is required',
            'password_confirmation.same' => 'Confirm password and password does not match',
            'password_confirmation.min' => 'Password must be at least 6 characters',
        ];

        return \Validator::make($data, $rules, $messages);
    }
}
