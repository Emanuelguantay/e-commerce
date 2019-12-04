<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $role_id
 * @property string $name
 * @property string|null $last_name
 * @property string $slug
 * @property string $email
 * @property string|null $email_verified_at
 * @property string|null $password
 * @property string|null $picture
 * @property string|null $stripe_id
 * @property string|null $card_brand
 * @property string|null $card_last_four
 * @property string|null $trial_ends_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCardBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCardLastFour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 */
class User extends Authenticatable
{
    use Notifiable;

    //https://laravel.com/docs/5.7/eloquent
    //eventos mientras se esta creando
    protected static function boot(){
        parent::boot();
        static::creating(function (User $user){
            //Si no se esta ejecutandose desde la terminal
            if (! \App::runningInConsole()) {
                $user->slug= str_slug($user->name." ". $user->last_name,"-");
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function navigation (){
        //retorna si esta autenticado? si esta devuelve admin sino guest
        return auth()->check() ? auth()->user()->role->name: 'guest';
    }

        //acceder al role del usuario
    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function socialAccount(){
        return $this->hasOne(UserSocialAccount::class);
    }

    //carrito de compras
    //obtener todas las ordenes hasta los pedidos
    public function orders(){
        return $this->hasMany(Order::class);
    }

    //obtener el carrito de comopra activo
    public function getOrderAttribute(){
        $cart = $this->orders()->where('status','PENDING')->first();
        if ($cart)
            return $cart;
        //else
        $cart = new Order();
        $cart->user_id = $this->id;
        $cart->total =  0;
        $cart->save();
        return $cart;
    }
}
