<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description', 'photo'];

    public function categories()
    {
    	return $this->belongsToMany(Category::class);
    }

    public function order()
    {
    	return $this->belongsToMany(Order::class);
    }
}
