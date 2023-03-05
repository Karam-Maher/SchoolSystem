<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Teacher extends Model
{
    use HasFactory, HasTranslations;
    public $translatable = ['name'];
    protected $guarded = [];


    public function specializations()
    {
        return $this->belongsTo(Specializations::class, 'id')->withDefault([
            'name' => '-'
        ]);
    }

    public function genders()
    {
        return $this->belongsTo(Gender::class, 'id')->withDefault([
            'name' => '-'
        ]);
    }


    public function sections()
    {
        return $this->belongsToMany(Section::class, 'teacher_section');
    }
}
