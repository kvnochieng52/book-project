<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SwapStatus extends Model
{
    use HasFactory;

    const NOT_YET_SWAPPED = 1;
    const SWAPPED = 2;
}
