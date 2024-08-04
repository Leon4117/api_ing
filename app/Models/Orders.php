<?php

namespace App\Models;

use App\Models\Orders;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'folio',
        'customer_name',
        'customer_surname',
        'email',
        'phone',
        'address',
        'aditional',
        'city',
        'country',
        'total'
    ];

    public function order_products()
    {
        return $this->belongsToMany(Product::class,'order_products')->withPivot('qty');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function products(){
        return $this->belongsToMany(Orders::class, 'order_products', 'orders_id', 'product_id')
        ->withPivot(Product::class,'qty');
    }
}
