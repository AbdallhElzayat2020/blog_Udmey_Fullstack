<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * News model
 */
class News extends Model
{
    use HasFactory;

    /**
     * Scope a query to only include active entries.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     *
     * @example
     * $activeNews = News::activeEntryis()->get();
     */
    public function scopeActiveEntryis($query)
    {
        return $query->where([
            'status' => 1,
            'is_approved' => 1,
        ]);
    }

    /**
     * Scope a query to only include localized entries.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     *
     * @example
     * $localizedNews = News::withLocalize()->get();
     */
    public function scopeWithLocalize($query)
    {
        return $query->where([
            'language' => getLanguage(),
        ]);
    }

    /**
     * Get the category that owns the news.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @example
     * $news = News::find(1);
     * $category = $news->category;
     */


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the tags associated with the news.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     * @example
     * $news = News::find(1);
     * $tags = $news->tags;
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_tags');
    }

    /**
     * Get the author that owns the news.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @example
     * $news = News::find(1);
     * $author = $news->author;
     */
    public function author()
    {
        return $this->belongsTo(Admin::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
