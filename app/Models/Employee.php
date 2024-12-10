<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Employee extends Model
{
    use HasFactory, Notifiable;

    public function getRouteKeyName()
    {
        return 'name';
    }

    protected $table = 'employees';
    protected $fillable = ['name', 'email', 'pin_code'];
    protected $hidden = ['pin_code', 'remember_token'];

    public function check(){
        return $this->hasMany(Check::class);
    }
}
