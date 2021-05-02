<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarMake extends Model
{
    protected $table = 'make';
    protected $with = [
        'model'
    ];
    public function model() {
        return $this->hasMany(CarModel::class, 'make_id', 'id');
    }
}
