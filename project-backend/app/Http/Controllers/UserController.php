<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\Create;
use App\Http\Requests\User\Update;
use App\Models\Avatar;
use App\Models\Product;
use App\Models\ProductImage;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function getOneUserData($id)
    {
        if($id) {
            $selected = User::query()->where('id', $id)->get();
            return response()->json([
                'data' => $selected,
            ], 200);
        }
        return response()->json([
            'error' => 'Данный пользоваетль не найден'
        ],400);
    }

    public function getOneUserProducts($id)
    {
        $products = Product::query()->where('user_id', $id)->get();
        if ($products) {
            return response()->json([
                'data' => $products
            ], 200);
        }
        return response()->json([
            'error' => "The user doesn't have products"
        ], 400);
    }


    public function updateUserInformation(Update $req)
    {
        $user = Auth::user();

        if ($user->avatar) {
            Storage::delete('/public/avatar/' . $user->avatar->avatar);
        }

        if ($req->hasFile('avatar')) {
            $file = $req->file('avatar');
            $fileName = time() . '.' . $file->extension();
            $file->storeAs('public/avatar', $fileName);
            $fileUrl = env("APP_URL", 'http://backpart.loc') . Storage::url('avatar/' . $fileName);
            if ($user->avatar) {
                $user->avatar->update([
                    'avatar' => $fileName,
                    'avatar_link' => $fileUrl,
                ]);
            } else {
                Avatar::query()->create([
                    'avatar' => $fileName,
                    'avatar_link' => $fileUrl,
                    'user_id' => $user->id,
                ]);
            }
        } else {
            Auth::user()->update([
                'name' => $req->get('name'),
                'phone' => $req->get('phone'),
                'address' => $req->get('address'),
            ]);

            return response()->json([
                'success' => 'Information Updated Successfully',
                'user' => auth()->user()
            ], 200);
        }

        Auth::user()->update([
            'name' => $req->get('name'),
            'phone' => $req->get('phone'),
            'address' => $req->get('address'),
        ]);


        return response()->json([
            'success' => 'Information Updated Successfully',
            'user' => auth()->user()
        ], 200);
    }
    public function oldPhoto($id){
        $image = ProductImage::query()->where('id', $id)->delete();
        if($image){
            return response()->json([
                "msg" => 'Successfully Deleted'
            ], 200);
        }
        return response()->json([
            "msg" => 'There was an error'
        ], 400);
    }

    public function changeStatus($id){
        $user = User::where('id',$id)->first();
        if( $user->status === 1){
            $user->status = 0;
            $user->save();
            return response()->json([
                'message' => "User is blocked"
            ], 200);
        }else{
            $user->status = 1;
            $user->save();
            return response()->json([
                'message' => "User is active"
            ], 200);
        }
    }
}






