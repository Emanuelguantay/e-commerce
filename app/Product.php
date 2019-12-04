<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Products
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Products newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Products newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Products query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $marca_id
 * @property int $indumentaria_id
 * @property int $genero_id
 * @property string $name
 * @property string $description
 * @property string $slug
 * @property string|null $picture
 * @property float $price
 * @property string|null $image
 * @property string $status
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Products whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Products whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Products whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Products whereGeneroId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Products whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Products whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereIndumentariaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Products whereMarcaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Products whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Products wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Products wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Products whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Products whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Products whereUpdatedAt($value)
 */
class Product extends Model
{
    use SoftDeletes;
   
    protected $fillable = ['name', 'description', 'picture','marca_id' ,'indumentaria_id','genero_id','price' ,'status'];

    const PUBLISHED = 1;
    const PENDING = 2;
    const REJECTED = 3;
    //Eloquent es inteligente y definimios en el modelo para utilizar la propiedad protegida withCOunt me devuelve el conteo de las relaciones!, podria poner ordelr lines 
    protected $withCount =['reviews','talles'];

    public static function boot () {
        parent::boot();

        static::saving(function(Product $product) {
            if(! \App::runningInConsole()) {
                $product->slug = str_slug($product->name, "-");
            }
        });
        //cargar talles!!!
    }


    public function pathAttachment(){
        return "/images/products/". $this->picture;
    }

    //nombre de la clave que vamos a utilizar para las rutas
    public function getRouteKeyName(){
        return 'slug';
    }


    public function marca(){
    	return $this->belongsTo(Marca::class)->select('id','name');
    }

    public function indumentaria(){
    	return $this->belongsTo(Indumentaria::class)->select('id','name');
    }

    public function genero(){
    	return $this->belongsTo(Genero::class)->select('id','name');
    }

    public function promotion () {
        return $this->hasOne(Promotion::class);
    }

    //nose si mostrar name del talle
    //public function productTalle () {
    //    return $this->hasMany(Product_talle::class);
    //}
    //creo que es asi
    public function talles(){
        return $this->belongsToMany(Talle::class,'product_talles')->withPivot('stock','id');
    }

    public function reviews(){
        return $this->hasMany(Review::class)->select('id','user_id','product_id','rating','comment','created_at');
    }

    //sac el promedio con avg de las estrellas
    public function getCustomRatingAttribute(){
        return $this->reviews->avg('rating');
    }


    //Productos relacionado que tengan las misma categorias
    public function relatedProducts (){
        #reviews...
        return Product::with('reviews')
            ->whereIndumentariaId($this->indumentaria->id)
            ->where('id', '!=', $this->id)
            ->latest()
            ->limit(6)
            ->get();
    }
}
