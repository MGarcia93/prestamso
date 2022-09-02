<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'phone', 'address', 'document', 'date_birthday'];
    public function lenginds()
    {
        return $this->hasMany(Lending::class);
    }
}
