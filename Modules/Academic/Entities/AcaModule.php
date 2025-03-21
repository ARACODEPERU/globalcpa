<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AcaModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'position',
        'description',
        'teacher_id'
    ];

    protected static function newFactory()
    {
        return \Modules\Academic\Database\factories\AcaModuleFactory::new();
    }
    public function course(): BelongsTo
    {
        return $this->belongsTo(AcaCourse::class, 'course_id');
    }

    public function themes(): HasMany
    {
        return $this->hasMany(AcaTheme::class, 'module_id');
    }
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(AcaTeacher::class, 'teacher_id');
    }
}
