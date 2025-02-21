<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'name', 'slug', 'cover', 'price', 'about', 
        'path_file', 'category_id', 'creator_id'
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function logos(){
        return $this->hasMany(ProductLogo::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'product_tags');
    }
}
