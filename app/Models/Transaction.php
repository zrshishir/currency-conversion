<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "transactions";

    protected $fillable = [
        'from',
        'amount',
        'credit_or_debit',
        'to',
    ];

    public function sender(){
        $this->belongsTo(User::class, 'from', 'id');
    }

    public function receiver(){
        $this->belongsTo(User::class, 'to', 'id');
    }
}
