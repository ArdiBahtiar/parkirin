<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\PostDec;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_list_id'
    ]; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(ItemList::class);
    }
}
