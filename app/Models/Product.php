<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vin',
        'colour',
        'make',
        'model',
        'price'
    ];

    protected $hidden = ['created_at', 'updated_at'];

     /* 
    * Local scope add constraint to query based
    * on the search bar input.
    */

    public function scopeSearch($q, $search)
    {
        $products = empty($search) ? $q : $q->addSelect(['id', 'make', 'model'])->where('make', 'like', '%'.$search.'%')->orWhere('model', 'like', '%'.$search.'%');
       
        return $products;
    }

}
