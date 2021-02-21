<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'forename',
        'surname',
        'contact_number',
        'postcode'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    /* 
    * Local scope add constraint to query based
    * on the search bar input.
    */

    public function scopeSearch($q, $search)
    {
        
        $customers = empty($search) ? $q : $q->addSelect(['id', 'email'])->where('email', 'like', '%'.$search.'%');
       
        return $customers;

    }
}
