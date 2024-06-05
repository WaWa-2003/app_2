<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillables =[
        'user_id',
        'opportunity_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function opportunity(){
        return $this->belongsTo(Opportunity::class);
    }
}
