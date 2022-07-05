<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider',
        'reference',
        'status',
        'user_register',
        'user_edit',
        'branchoffice_id',
        'pay_status',
    ];

    //Relaciones

    public function details()
    {
        return $this->hasMany(PurchaseDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function provider(){
        return $this->belongsTo(Provider::class);
    }
}
