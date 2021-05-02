<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $table = 'model';

    public function make() {
        return $this->hasOne(CarMake::class, 'id', 'make_id');

    }
}
