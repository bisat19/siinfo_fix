<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailDinas extends Model
{
    protected $guarded = ['id'];
    protected $with = ['user'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
