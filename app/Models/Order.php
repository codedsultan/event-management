<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=['customer_id','vendor_id','order_number','sub_total','quantity','delivery_charge','status','total_amount','first_name','last_name','country','post_code','address1','address2','phone','email','payment_method','payment_status'];
    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
