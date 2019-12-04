<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Order_line
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order_line newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order_line newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order_line query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property float $product_price
 * @property int $qty
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order_line whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order_line whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order_line whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order_line whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order_line whereProductPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order_line whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order_line whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order_line whereUpdatedAt($value)
 */
class Order_line extends Model
{
	protected $fillable = [
        'order_id','product_talle_id','product_price','qty',
    ];
    
    public function product () {
    	//un detalle pertenece a un producto determinado
        return $this->belongsTo(Product::class);
    }
}
