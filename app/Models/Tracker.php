<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function items() {
        return $this->hasMany(Timer::class);
    }
}
