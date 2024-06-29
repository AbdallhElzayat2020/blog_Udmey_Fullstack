<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;

    // scope reuseble Query for ActiveEntryis
    public function scopeActiveEntryis($query)
    {
        return $query->where([
            'status' => 1,
            'is_approved' => 1,
        ]);
    }
    // reuseble Query for Localize
    public function scopeWithLocalize($query)
    {
        return $query->where([
            'language' => getLanguage(),
        ]);
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_tags');
    }

    // Reliation Ship With Author
    public function author()
    {
        return $this->belongsTo(Admin::class);
    }
}
