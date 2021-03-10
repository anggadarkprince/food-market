<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    /**
     * Custom accessor to get formatted price from price field.
     *
     * @return string
     */
    public function getFormattedTotalPriceAttribute()
    {
        return sprintf('Rp. %s', number_format($this->attributes['total_price'], 0, ',', '.'));
    }

    /**
     * Custom accessor to get formatted price from price field.
     *
     * @return string
     */
    public function getFormattedPriceAttribute()
    {
        return sprintf('Rp. %s', number_format($this->attributes['price'], 0, ',', '.'));
    }

    /**
     * Custom accessor to get formatted price from price field.
     *
     * @return string
     */
    public function getFormattedDiscountAmountAttribute()
    {
        return sprintf('Rp. %s', number_format($this->attributes['discount_amount'], 0, ',', '.'));
    }

    /**
     * Get the food that owns the transaction transaction.
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
