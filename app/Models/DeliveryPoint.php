<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryPoint extends Model
{
    protected $fillable = ['name', 'city', 'contact_person', 'contact_number'];

    public $table = 'delivery_points';
}
