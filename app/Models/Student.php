<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Student extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name'];
    protected $guarded = [];

    public function gender()
    {
        return $this->belongsTo(Gender::class,'gender_id')->withDefault([
            'name' => '-'
        ]);
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class,'grade_id')->withDefault([
            'name' => '-'
        ]);
    }
    public function classroom()
    {
        return $this->belongsTo(Classroom::class,'classroom_id')->withDefault([
            'name' => '-'
        ]);
    }
    public function section()
    {
        return $this->belongsTo(Section::class,'section_id')->withDefault([
            'name' => '-'
        ]);
    }
}
