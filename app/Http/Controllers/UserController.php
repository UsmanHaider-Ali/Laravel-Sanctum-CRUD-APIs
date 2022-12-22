<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Nexmo\Laravel\Facade\Nexmo;

class UserController extends Controller
{
    public function register_user(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email|required',
            'password' => 'required|confirmed',
        ]);

        $findUser = User::where('email', $request->email)->get();

        if ($findUser && count($findUser) > 0) {
            return response()->json([
                'message' => 'This email is already registered',
                'success' => false,
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User registered successfylly',
            'success' => true,
            'data' => $user
        ]);
    }

    public function login_user(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {

            if (Hash::check($request->password, $user->password)) {

                $token = $user->createToken($user->name)->plainTextToken;

                return response()->json(
                    [
                        'message' => 'User login successfylly',
                        'success' => true,
                        'token' => $token,
                        'data' => $user
                    ]
                );
            }

            return response()->json(
                [
                    'message' => 'Password not matched',
                    'success' => false,
                ]
            );
        }

        return response()->json(
            [
                'message' => 'User not found',
                'success' => false,
            ]
        );
    }

    public function logout_user(Request $request)
    {
        // $request->validate([
        //     'id' => 'required',
        // ]);

        auth()->user()->tokens()->delete();

        return response()->json(
            [
                'message' => 'User logout successfully',
                'success' => true,
            ]
        );
    }

    public function send_phone_otp(Request $request)
    {


        // $basic  = new \Nexmo\Client\Credentials\Basic('key', 'secret');
        // $client = new \Nexmo\Client($basic);

        // $message = $client->message()->send([
        //     'to' => '9181600*****',
        //     'from' => 'Nexmo',
        //     'text' => 'A text message sent using the Nexmo SMS API'
        // ]);

        // dd('message send successfully');

        return response()->json(
            [
                'message' => 'User logout successfully',
                'success' => true,
            ]
        );
    }
}
