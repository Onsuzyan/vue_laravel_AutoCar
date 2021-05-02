<?php

namespace App\Http\Controllers;

use App\Models\CarMake;
use App\Models\CarModel;
use Illuminate\Http\Request;

class MakeModelController extends Controller
{
    public function getModels($id){
        $allModel = CarModel::query()->where('make_id', $id)->pluck('name', 'id')->unique();
        return response()->json([
            'data' => $allModel
        ], 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMake(){
        $allMake = CarMake::query()->pluck('name', 'id');
        return response()->json([
            'data' => $allMake
        ], 200);
    }

    public function getYear($name){
        $allYear = CarModel::query()->where('name',$name)->pluck('year');
        return response()->json([
            'data'=> $allYear
        ],200);

    }
}
