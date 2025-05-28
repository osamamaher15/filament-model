<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone',
        'address',
        'zip_code',
        'image',
        'date_of_birth',
        'date_hired',
        'country_id',
        'state_id',
        'city_id',
        'department_id',
    ];


    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

     public function state()
    {
        return $this->belongsTo(City::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

}
