<?php

namespace App\Http\Controllers\Auth;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\resetPassword;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use app\Models\Token;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Psy\Command\WhereamiCommand;

class AuthController extends Controller
{




    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required|confirmed',
            'phone' => 'required',
            'd_o_b' => 'required',
            'city_id' => 'required',
            'pin_code' => 'required',
            'blood_type_id' => 'required',
            'last_donation_date' => 'required',
            'email' => 'required | unique:clients',
        ]);

        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($request->all());
        $client->api_token = Str::random(60);
        $client->save();

        return responseJson(1, "new client added", [
            'api_token' => $client->api_token,
            'client' => $client,

        ]);
    }



    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }


        $client = Client::where('phone', $request->phone)->first();
        if ($client) {
            if (Hash::check($request->password, $client->password)) { //compare
                return responseJson(1, "successfully logged in", [


                    'api_token' => $client->api_token,
                    'client' => $client,

                ]);
            } else {
                return responseJson(0, "No such user",);
            }
        } else {
            return responseJson(0, "No such user",);
        };
    }



    public function forget(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',

        ]);

        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }


        $client = Client::where('phone', $request->phone)->first();
        if ($client) {

            $code = rand(1111, 9999);
            $update = $client->update(['pin_code' => $code]);
            if ($update) {
               // smsMisr($request->name, $code);
                Mail::to($client->email)
                    //->bcc()
                    ->send(new resetPassword($code));

                return responseJson(1, "successfully sent pin code", ['pin_code' => $code]);
            } else {
                return responseJson(0, "try again",);
            }
        } else {
            return responseJson(0, "No such user",);
        };
    }
    public function setNewPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pin_code' => 'required',
            'phone' => 'required',
            'password' => 'required|confirmed',

        ]);

        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }


        $client = Client::where('pin_code', $request->pin_code)->Where('pin_code' , '!=' , 0)
        ->where('phone', $request->phone)->first();
        if ($client) {

            $client->password=bcrypt($request->password);
            $client->pin_code=null;

            if ($client->save()) {
                return responseJson(1, "successfully changed password");
            } else {
                return responseJson(0, "try again",);
            }
        } else {
            return responseJson(0, "No such user",);
        };
    }
    public function registerToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'type' => 'required|in:android,ios',

        ]);

        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        Token::where('token',$request->token)->delete();
        $request->user()->tokens()->create($request->all());
        return responseJson(1, "successfully registerd token");
    }
    public function removeToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',

        ]);

        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        Token::where('token',$request->token)->delete();

        return responseJson(1, "successfully deleted token");
    }
}
