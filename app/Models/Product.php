<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'quantity', 'warehouse_id'];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
    