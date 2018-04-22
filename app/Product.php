<?php
/**
 *  Product Model.
 *
 * @author     German Gonzalez Rodriguez <ger@gergonzalez.com>
 * @copyright  German Gonzalez Rodriguez
 *
 * @version    1.0
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'img', 'url', 'price'
    ];

    /**
     * Get the wishlists related to some product 
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function wishlists()
    {
        return $this->belongsToMany(Wishlist::class)->withTimestamps();
    }

}
