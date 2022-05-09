<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;

/**
 * @group Authentication Api's
 *
 * APIs to manage the user Authentication.
 * */
class AuthController extends Controller
{

   /**
    * User Login
    *
    * @bodyParam email string required
    * @bodyParam password string required user password.
    * @response 200{
         "message": "Hi User Name, welcome",
         "access_token": "254|33icFsR8uIOF1KsOeaJ114ntrU8adIX7gitwAveK",
         "token_type": "Bearer"
      }
   **/
   public function userLogin(Request $request)
   {
      if(!Auth::attempt($request->only('email', 'password')))
      {
         return response()
               ->json(['message' => 'Unauthorized'], 401);
      }

      $user = User::where('email', $request['email'])->firstOrFail();

      $token = $user->createToken('auth_token')->plainTextToken;

      return response()->json([
         "success" => true,
         "token_type" => 'Bearer',
         "message" => "User Logged in",
         "access_token" => $token,
         "user" => $user
      ]);
   }

   /**
    * User details
    * @param  string $email
    * @response 200{
                  "success": true,
                  "message": "Restaurants menu items",
                  "data": {
                        "id": .....,
                        "name": "Albert Einstein",
                        "email": "einstein@email.com",
                  }
      }
   **/
   public function user_details($email){
      $user = User::where('email',$email)->first();
      return response()->json([
         "success" => true,
         "message" => "User Details",
         "data" => $user
      ]);
   }


   /**
    * Logout and delete token
    *
    *
   **/
   public function logout()
   {
      auth()->user()->tokens()->delete();

      return [
         'message' => 'You have successfully logged out'
      ];
   }
}
