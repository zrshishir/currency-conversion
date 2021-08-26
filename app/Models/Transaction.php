<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "transactions";

    protected $fillable = [
        'sender',
        'amount',
        'rate',
        'converted_amount',
        'receiver',
    ];

    public function sender(){
        return $this->belongsTo(User::class, 'sender', 'id');
    }

    public function receiver(){
        return $this->belongsTo(User::class, 'receiver', 'id');
    }
}
