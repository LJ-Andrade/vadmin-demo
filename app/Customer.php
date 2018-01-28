<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Scope;
use App\CatalogFav;
use App\Cart;

class Customer extends Authenticatable
{
    protected $guard = 'customer';

    protected $table = 'customers';

    protected $fillable = [
        'name', 'surname', 'username', 'email', 'address', 'province_id', 'location_id', 'cp', 'phone', 'phone2', 'password', 'group', 'avatar'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    //Relations
    public function catalogFavs()
    {
    	return $this->hasMany(CatalogFav::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function getCartAttribute()
    {
        $cart = $this->carts()->where('status', 'Active')->where('customer_id', $this->id)->first();
        if($cart){
            return $cart;
        } else {
            $cart = new Cart();
            $cart->status = 'Active';
            $cart->customer_id = $this->id;
            $cart->save(); 
            return $cart;
        }
    }

    // Search Scopes 
    public function scopeSearchname($query, $name)
    {
        $query->where('name', 'LIKE', "%$name%")
            ->orWhere('username', 'LIKE', "%$name%")
            ->orWhere('email', 'LIKE', "%$name%");
    }

    public function scopeSearchrole($query, $role)
    {
        $query->where('role', $role);
    }   

}
