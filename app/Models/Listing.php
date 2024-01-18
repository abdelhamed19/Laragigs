<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function ScopeFilter($query, array $filters)
    {
        if ($filters['tags'] ?? false)
        {
            $query->where('tags','like','%'.request('tags').'%');
        }
        if ($filters['search'] ?? false)
        {
            $query->where('title','like','%'.request('search').'%')->
            orwhere(
                'description','like','%'.request('search').'%')->
            orwhere(
                'tags','like','%'.request('search').'%');
        }

    }
    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }
}
