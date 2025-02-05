<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Captcha;


class RegistrationController extends Controller
{
    public function register(Request $request)
    {
        // Validate incoming request
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string|max:255',
        //     'username' => 'required|string|max:255|unique:users',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|string|min:6|confirmed',
        //     'profile_image' => 'nullable|image|max:2048', // Max size 2MB
        // ]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'string',
                'min:10',
                'regex:/[0-9]/',          // Must include at least one number
                'regex:/[@$!%*?&#]/',     // Must include at least one special character
                'regex:/[A-Z]/',          // Must include at least one uppercase letter
                'regex:/[a-z]/',          // Must include at least one lowercase letter
                'confirmed',
            ],
            'role' => 'required|in:admin,user',
            // 'captcha' => 'required|captcha',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Handle file upload
        $profileImagePath = null;
        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
        }

        $verificationCode = rand(100000, 999999);

        // Send verification email
        Mail::send('emails.verify-email', ['code' => $verificationCode], function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Email Verification Code');
        });

        // Save verification code in session
        Session::put('email_verification_code', $verificationCode);
        Session::put('email', $request->email);



        // Create user
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_image' => $profileImagePath,
            'role' => $validator['role'],
        ]);

        $token = $user->createToken('API Token')->plainTextToken; 
        return response()->json([
        'message' => 'User registered successfully!', 
        'user' => $user,
        'token' => $token
        ]
        , 201);
    }


    public function verifyEmail(Request $request)
    {
        // Validate the verification code
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'verification_code' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (
            Session::get('email_verification_code') == $request->verification_code &&
            Session::get('email') == $request->email
        ) {
            // Email verified successfully
            Session::forget('email_verification_code');
            Session::forget('email');

            return response()->json([
                'message' => 'Email verified successfully!',
            ], 200);
        }

        return response()->json([
            'errors' => ['verification_code' => 'Invalid verification code.'],
        ], 422);
    }

}


