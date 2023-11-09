<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'user_id', 'company', 'logo', 'location', 'email', 'website', 'description', 'tags'];

    public function scopeFilter($query, array $filters) {
        if($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . $filters['tag'] . '%'); //where tags like %$tag%
        }

        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . $filters['search'] . '%')
            ->orWhere('description', 'like', '%' . $filters['search'] . '%') //where title like %$search%
            ->orWhere('tags', 'like', '%' . $filters['search'] . '%'); //where title like %$search%
        }
    }

    //relationship to user
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
