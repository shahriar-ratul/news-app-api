<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\SubscribeRequest;
use App\Mail\ActiveAccountMail;
use App\Mail\SubscribeMail;
use App\Models\SubscribeGroup;
use App\Models\Subscriber;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserAuthController extends Controller
{
    use ApiResponser;
    public function userLogin(LoginRequest $request)
    {

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password ])) {

            return $this->error('Credentials not match',
               'Credentials not match'
            ,401);
        }

        $user = User::where('email',$request->email)->first();

        return $this->success(['token' => auth()->user()->createToken('AAA-Print')->accessToken,],'Login Success');
    }

    // userRegister
    public function userRegister(RegisterUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'token' => str()->random(30).time(),
        ]);



        if($user){
            return $this->success(['user' => $user], 'User Register successfully.Please check your email.To Active your Account',200);
        }else{
            return $this->error( 'Something went Wrong.','Something went wrong',200);
        }

    }





}
