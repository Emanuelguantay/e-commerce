<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Marca
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marca newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marca newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marca query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marca whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marca whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marca whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marca whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marca whereUpdatedAt($value)
 */
class Marca extends Model
{
    //
}
