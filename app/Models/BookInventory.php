<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookInventory extends Model
{
    use HasFactory;


    public static function query()
    {

        return BookInventory::select([
            'book_inventories.*',
            'book_levels.level_name',
            'book_statuses.status_name',
            'book_editions.edition_name',

        ])
            ->leftJoin('book_levels', 'book_inventories.level_id', 'book_levels.id')
            ->leftJoin('book_editions', 'book_inventories.edition_id', 'book_editions.id')
            ->leftJoin('book_statuses', 'book_inventories.status_id', 'book_statuses.id');
    }

    public static function getInventoryBySuggestion($suggestion)
    {
        BookInventory::where('active', 1)->get();
    }
}
