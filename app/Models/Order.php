<?php

namespace App\Models;

use App\Models\Orderitems;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable =[
 
        'firstname',
        'lastname',
        'phone',
        'email',
        'address',
        'payment_id',
        'payment_mode',
        'tracking_no',
        'status',
        'remark',
    ];

    public function orderitems()
    {
        return $this->hasMany(Orderitems::class, 'order_id', 'id');
    }
}
