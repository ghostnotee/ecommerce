<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductDetail
 *
 * @property int $id
 * @property int $product_id
 * @property int $show_slider
 * @property int $show_opportunity_of_the_day
 * @property int $show_featured
 * @property int $show_most_selling
 * @property int $show_damp
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductDetail whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductDetail whereShowDamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductDetail whereShowFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductDetail whereShowMostSelling($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductDetail whereShowOpportunityOfTheDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductDetail whereShowSlider($value)
 * @mixin \Eloquent
 */
class ProductDetail extends Model
{
    public $timestamps = false;
    public $guarded = [];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
