<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Talle
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Talle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Talle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Talle query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Talle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Talle whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Talle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Talle whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Talle whereUpdatedAt($value)
 */
class Talle extends Model
{
    public function products(){
    	return $this->belongsToMany(Product::class,'product_talles')->withPivot('id','stock');
    }
}
