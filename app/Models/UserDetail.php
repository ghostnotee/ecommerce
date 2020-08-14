<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserDetail
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $other_phone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserDetail whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserDetail whereOtherPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserDetail wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserDetail whereUserId($value)
 * @mixin \Eloquent
 */
class UserDetail extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
