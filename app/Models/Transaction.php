<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'food_id', 'quantity',
        'total', 'status', 'payment_url'
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
     * Custom accessor to get formatted price from price field.
     *
     * @return string
     */
    public function getFormattedTotalAttribute()
    {
        return sprintf('Rp. %s', number_format($this->attributes['total'], 0, ',', '.'));
    }

    /**
     * Get the user that owns the transaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the food that owns the transaction.
     */
    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    /**
     * Get the details for the transaction.
     */
    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
