<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemList extends Model
{
    use HasFactory;

    // public $preventsLazyLoading = true;

    protected $fillable = [
        'nama',
        'harga',
        'detail_info',
        'ukuran',
        'deskripsi',
        'lokasi',
        'id_owner',
    ];

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function bookmarkedByUsers()
    {
        return $this->belongsToMany(User::class, 'bookmarks', 'item_list_id', 'user_id');
    }
}
