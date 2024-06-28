<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyHead extends Model
{
    protected $fillable = [
        'name', 'surname', 'birthdate', 'mobile', 'address',
        'state', 'city', 'pincode', 'marital_status', 'wedding_date',
        'hobbies', 'photo',
    ];

    public function familyMember()
    {
        return $this->hasMany(FamilyMember::class);    }
}
