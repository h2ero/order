<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 */
class Order extends Model
{
    protected $table = 'orders';

    public $timestamps = true;

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne('\App\Models\User', 'id', 'user_id');
    }

    public function product()
    {
        return $this->hasOne('\App\Models\Product', 'id', 'product_id');
    }

}
