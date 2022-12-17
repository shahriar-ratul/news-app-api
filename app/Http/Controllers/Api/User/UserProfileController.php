<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    use ApiResponser;
    public function logout(Request $request)
    {

        $request->user()->token()->revoke();
        return $this->success([],'Logout Success');
    }

    public function verifyUser(Request $request)
    {
        return $this->success(null,'Verify Success');
    }

    public function getUser(Request $request)
    {

        $user = $request->user();
        // $user = Admin::find($user->id);

        if($user){
            return $this->success(['user' => $user], 'User found successfully.',200);
        }else{
            return $this->error( 'Something went Wrong.','Something went wrong',200);
        }
    }
}
