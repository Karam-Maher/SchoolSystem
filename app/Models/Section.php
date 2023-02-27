<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Section extends Model
{
    use HasFactory;
    use HasTranslations;


    public $translatable = ['name_section'];
    protected $fillable = ['name_section', 'grade_id', 'class_id'];

    protected $table = 'sections';
    public $timestamps = true;



    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'class_id', 'id');
    }
}
