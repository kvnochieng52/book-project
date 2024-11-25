<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookStatus extends Model
{
    use HasFactory;

    const PENDING_PICKUP_APPROVAL = 1;
    const APPROVED = 2;
    const PENDING_DELIVERY = 3;
    const DELIVERED = 4;
    const CANCELLED = 5;
}
