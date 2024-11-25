<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    const PENDING = 1;
    const DELIVERED = 2;
    const CANCELLED = 3;
}
