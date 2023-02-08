<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name_class'];
    protected $guarded = [];

    public function grades()
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id')->withDefault([
            'name' => trans('classroom.List_classes')
        ]);
    }
}
