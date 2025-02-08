<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'latitude', 'longitude'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
