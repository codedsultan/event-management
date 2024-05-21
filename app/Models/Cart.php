<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id','session_id'];
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
}
