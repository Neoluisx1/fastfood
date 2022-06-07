<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mockery\Matcher\Type;

class Customer extends Model
{
    use HasFactory;

    protected $fillable=['name','phone','city','mail'];

    public function orders(){
        return $this->hasMany((Order::class));
    }
}
