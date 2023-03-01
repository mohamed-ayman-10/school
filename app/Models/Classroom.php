<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classroom extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'class_name',
        'grade_id',
    ];

    public $translatable = ['class_name'];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
