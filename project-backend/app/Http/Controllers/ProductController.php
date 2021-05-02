<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\Create;
use App\Http\Requests\User\Update;
use App\Models\Product;
use App\Models\ProductImage;
use App\User;
use http\Env\Response;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class  ProductController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $blockUsers = User::select('id')->where('status', 0)->get()->toArray();
        $blockedUsersIds = array_column($blockUsers, 'id');

        $products = Product::query()->whereNotIn('user_id', $blockedUsersIds)->get();
        return response()->json([
            'data' => $products,
            'blocked' => $blockedUsersIds
        ], 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * @param Create $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Create $request)
    {
       $user = Auth::user();
        $product = Product::query()->create([
            'name' => $request->get('name'),
            'make' => $request->get('make'),
            'model' => $request->get('model'),
            'year' => $request->get('year'),
            'part_number' => $request->get('part_number'),
            'user_id' => $user['id']
        ]);
        $product->save();

        if ($request->hasFile('image')) {

            $files = $request->file('image');
            $this->storeImages($files, false, $product['id']);
        }

        return response()->json([
            'success' => true,
            'message' => $product
        ], 200);
    }


    /**
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($product, Request $request)
    {
        $show = Product::query()->where('id', $product)->first();
        $user = User::query()->where('id',$show->user_id)->get();


        return response()->json([
            'product' => $show,
            'user' => $user
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }


    /**
     * @param Create $request
     * @param Create $product
     * @return \Illuminate\Http\JsonResponse
     */

    public function update(Request $request)
    {

            $updateData = [
                'name' => $request->get('name'),
                'make' => $request->get('make'),
                'model' => $request->get('model'),
                'year' => $request->get('year'),
                'part_number' => $request->get('part_number'),
            ];

            Product::query()->where('id', $request->get('id'))->update($updateData);

            if ($request->hasFile('image')) {
                $files = $request->file('image');

                $this->storeImages($files, $request->get('id'), false);
                return response()->json([
                    'success' => true,
                    'message' => 'Successfully updated product'
                ], 200);
            }
            return response()->json([
                'error' => 'There was an Error converting the given data'
            ], 400);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        if ($id) {
            $selected = Product::query()->where('id', $id)->first();
            if ($selected['user_id'] === Auth::id()) {
                $selected->delete();
                return response()->json(["success" => "Permission given"], 200);
            }
            return response()->json(["error" => "Permission denied"], 409);
        }
        return response()->json(["error" => "There was an error"], 400);
    }


    /**
     * @param $files
     * @param $id
     * @param $newId
     * @return bool
     */
    protected function storeImages($files, $id, $newId)
    {
        $preAnswer = false;
        if ($files && count($files) > 0) {
            foreach ($files as $file) {
                $fileName = time() . '-' . $file->getClientOriginalName();
                $fileUrl = env("APP_URL", 'http://backpart.loc') . Storage::url('images/' . $fileName);
                $file->storeAs('public/images', $fileName);

                if ($id) {
                    DB::table('products_images')->insert([
                        'image' => $fileName,
                        'image_link' => $fileUrl,
                        'product_id' => $id
                    ]);
                } else {
                    DB::table('products_images')->insert([
                        'image' => $fileName,
                        'image_link' => $fileUrl,
                        'product_id' => $newId
                    ]);
                }
            }
            return $preAnswer = true;
        }
        return $preAnswer;
    }
}
