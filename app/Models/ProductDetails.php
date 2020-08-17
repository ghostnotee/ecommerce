<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductDetails
 *
 * @property int $id
 * @property int $product_id
 * @property int $show_slider
 * @property int $show_opportunity_of_the_day
 * @property int $show_featured
 * @property int $show_most_selling
 * @property int $show_damp
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductDetails newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductDetails newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductDetails query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductDetails whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductDetails whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductDetails whereShowDamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductDetails whereShowFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductDetails whereShowMostSelling($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductDetails whereShowOpportunityOfTheDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductDetails whereShowSlider($value)
 * @mixin \Eloquent
 */
class ProductDetails extends Model
{
    public $timestamps = false;
    public $guarded = [];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
