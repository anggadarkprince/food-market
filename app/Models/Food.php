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
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'foods';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'restaurant_id', 'food_name', 'description', 'ingredients',
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
        return $this->attributes['image']
            ? url(Storage::url($this->attributes['image']))
            : 'https://ui-avatars.com/api/?name='.urlencode($this->attributes['food_name']).'&color=7F9CF5&background=EBF4FF';
    }

    /**
     * Custom accessor to get formatted price from price field.
     *
     * @return string
     */
    public function getFormattedPriceAttribute()
    {
        return $this->attributes['price'] = sprintf('Rp. %s', number_format($this->attributes['price'], 0, ',', '.'));
    }

    /**
     * Get the transactions for the food.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get the restaurant that owns the food.
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
