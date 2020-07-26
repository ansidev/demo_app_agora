<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\BaseController as BaseController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class ApiAuthController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // return "hai";
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        /** @var User $user */
        $default_role = Role::findByName("User", "api");
        $user = User::create($input);
        $user->assignRole($default_role);
        $user->save();

        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;
        $success['roles'] = $user->getRoleNames();

        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['name'] = $user->name;
            $success['roles'] = $user->getRoleNames();

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised'], 401);
        }
    }


    // /**
    //  * @param Request $request
    //  * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
    //  */
    // public function register (Request $request) {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required',
    //         'c_password' => 'required|same:password',

    //     ]);
    //     if ($validator->fails())
    //     {
    //         return response(['errors'=>$validator->errors()->all()], 422);
    //     }
    //     $request['password']=Hash::make($request['password']);
    //     $request['remember_token'] = Str::random(10);
    //     $user = User::create($request->toArray());
    //     // $user->assignRole('User');
    //     $token = $user->createToken('Token Name')->accessToken;
    //     $response = ['token' => $token];
    //     return response($response, 200);
    // }


    // /**
    //  * @param Request $request
    //  * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
    //  */
    // public function login (Request $request) {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|string|email|max:255',
    //         'password' => 'required|string|min:6|confirmed',
    //     ]);
    //     if ($validator->fails())
    //     {
    //         return response(['errors'=>$validator->errors()->all()], 422);
    //     }
    //     $user = User::where('email', $request->email)->first();
    //     if ($user) {
    //         $role = $user->roles->pluck('name');
    //         if (Hash::check($request->password, $user->password)) {
    //             $token = $user->createToken('Token Name')->accessToken;
    //             $response = ['token' => $token, 'role' => $role];

    //             return response($response, 200);
    //         } else {
    //             $response = ["message" => "Password mismatch"];
    //             return response($response, 422);
    //         }
    //     } else {
    //         $response = ["message" =>'User does not exist'];
    //         return response($response, 422);
    //     }
    // }

    // /**
    //  * @param Request $request
    //  * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
    //  */
    // public function logout (Request $request) {
    //     $token = $request->user()->token();
    //     $token->revoke();
    //     $response = ['message' => 'You have been successfully logged out!'];
    //     return response($response, 200);
    // }


}
