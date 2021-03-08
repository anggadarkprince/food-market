<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['restaurant_name', 'address', 'description'];

    /**
     * Get the foods for the restaurant.
     */
    public function foods()
    {
        return $this->hasMany(Food::class);
    }
}
