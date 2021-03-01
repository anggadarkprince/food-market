<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Food extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'food_name', 'description', 'ingredients',
        'price', 'rating', 'category', 'image'
    ];

    /**
     * Accessor to get epoc unix time from created at field.
     *
     * @param $value
     * @return float|int|string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }

    /**
     * Accessor to get epoc unix time from created at field.
     *
     * @param $value
     * @return float|int|string
     */
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }

    /**
     * Custom accessor to get url image from image field.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        return url(Storage::url($this->attributes['image']));
    }
}
