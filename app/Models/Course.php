<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = "courses";

    public $fillable = [
        'title',
        'outline',
        'price',
        'image',
        'duration',
        "student",
        "comment_count"
    ];

    public function category(){
        return $this->hasOne(Category::class,'id');
    }
}
