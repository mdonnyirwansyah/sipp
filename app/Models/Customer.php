<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $guarded = [];

    /**
     * Get the order associated with the customer.
     */
    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
