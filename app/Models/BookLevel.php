<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookLevel extends Model
{
    use HasFactory;


    public static function getBookLevels()
    {
        return self::where('is_active', 1)->pluck('level_name', 'id');
    }
}
