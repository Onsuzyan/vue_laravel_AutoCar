<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    protected $table = 'avatars';
    protected $fillable = ['avatar', 'user_id', 'avatar_link'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
