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
        'id_province',
        'id_regency',
        'id_owner',
        'bonus'
    ];

    protected $casts = [
        'bonus' => 'array',
    ];

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function bookmarkedByUsers()
    {
        return $this->belongsToMany(User::class, 'bookmarks', 'item_list_id', 'user_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'id_owner');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'id_province');
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class, 'id_regency');
    }
}
