<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model {
    use HasFactory;

    //just mass assign title, excerpt and body
    //protected $fillable = ['title', 'excerpt', 'body'];

    //mass asign everything
    protected $guarded = [];

    //use with commented functions on routes
    //protected $with = ['category', 'author'];
    //can also use Post::without('category', 'author');

    //user instead of 'posts/{post:slug}'
    public function getRouteKeyName() {
        return 'slug';
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function author() { //user
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function scopeFilter($query, array $filters) {
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where(fn($query) =>
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%')
            )
        );

        $query->when($filters['category'] ?? false, fn($query, $category) =>
            $query->whereHas('category', fn($query) =>
                $query->where('slug', $category)
            )
        );

        $query->when($filters['author'] ?? false, fn($query, $author) =>
            $query->whereHas('author', fn($query) =>
                $query->where('username', $author)
            )
        );
    }

    public function setSlugAttribute($value) {
        $this->attributes['slug'] = Str::replace(' ', '-', strtolower($value));
    }
}
