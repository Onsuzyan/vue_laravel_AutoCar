<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\User;
use App\Http\Requests\User\Register;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\User\Verify;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * @param Register $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Register $req)
    {
        $ver_token = Str::random(128);
        if($req->get('role')){
            unset($req['role']);
        }
        if ($req->hasFile('avatar')) {
            $file = $req->file('avatar');
            $fileName = time() . '.' . $file->extension();
            $file->storeAs('public/avatar', $fileName);
            $fileUrl = env("APP_URL", 'http://backpart.loc') . Storage::url('avatar/' . $fileName);
            $newUser = User::query()->create([
                'name' => $req->get('name'),
                'phone' => $req->get('phone'),
                'address' => $req->get('address'),
                'email' => $req->get('email'),
                'password' => Hash::make($req->get('password')),
                "verification_token" => $ver_token
            ]);
            if ($newUser) {
                Avatar::query()->create([
                    'avatar' => $fileName,
                    'avatar_link' => $fileUrl,
                    'user_id' => $newUser->id
                ]);
                $this->emailVerification($newUser, $ver_token);
            }
            return response()->json([
                'success' => true,
                'message' => 'User successfully registered'
            ],200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Error occurred while registering'
        ],400);
    }

    public function emailVerification(User $user, $token){
        Mail::send('mail.verify', ['user' => $user, 'token'=> $token], function($m) use ($user){
            $m->to($user->email, $user->name)->subject('Please Verify your Email');
        });
    }

    public function verify(Verify $req) {

        $user = DB::table('users')
                ->where('email', $req->get('email'))
                ->where('verification_token', $req->get('token'));

        if($user){
            $user->update([
                'verification_token' => null,
                'email_verified_at'=> Carbon::now()->toDateTimeString()
            ]);
            return response()->json([
                'success'=> true,
                'message'=> 'User Successfully Verified'
            ]);
        }
        return response()->json([
            'success'=> false,
            'message'=> 'Verification Failed'
        ], 401);
    }
}
