<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSales extends Model
{
    use HasFactory;

    protected $table = "home_sales";

    protected $fillable = [
        'sale_date', 'status'
    ];
}
