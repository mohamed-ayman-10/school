<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grade extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'notes',
    ];

    public $translatable = ['name'];

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
}
