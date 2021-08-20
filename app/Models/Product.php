<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'user_id',
        'price',
        'composition',
        'code'
       
    ];

    public function user(){

        return $this->belongsTo(User::class);

    }

    public function category(){

        return $this->belongsTo(Category::class);
    }

    public function images(){

        return $this->hasMany(Image::class);
    }
}
