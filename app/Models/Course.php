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
        "comment_count",
        "category_id"
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
