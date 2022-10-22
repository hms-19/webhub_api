<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = "blogs";

    public $fillable = [
        'title',
        'author',
        'description',
        'image',
        'category_id'
    ];

    public function category(){
        return $this->hasOne(Category::class,'id');
    }
}
