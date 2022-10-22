<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = "services";

    public $fillable = [
        "name",
        "description",
        "logo",
        'image',
        "category_id"
    ];

    public function category(){
        return $this->hasOne(Category::class,'id');
    }
}
