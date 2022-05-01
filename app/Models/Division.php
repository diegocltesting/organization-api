<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'ambassador', 'collaborators', 'level', 'parent_id'];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->with('children');
    }
}
