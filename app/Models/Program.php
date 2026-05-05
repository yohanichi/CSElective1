<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'program';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'program_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'title',
        'years',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    public $timestamps = false;

    protected $casts = [
        'years' => 'integer',
    ];

    /**
     * Validation rules for creating/updating programs
     */
    public static function rules($id = null)
    {
        $rules = [
            'code' => 'required|string|max:20|unique:program,code' . ($id ? ",{$id},program_id" : ''),
            'title' => 'required|string|max:100|unique:program,title' . ($id ? ",{$id},program_id" : ''),
            'years' => 'required|integer|min:1',
        ];
        return $rules;
    }

    /**
     * Check if code exists
     */
    public static function codeExists($code, $excludeId = null)
    {
        $query = self::where('code', $code);
        if ($excludeId) {
            $query->where('program_id', '!=', $excludeId);
        }
        return $query->exists();
    }

    /**
     * Check if title exists
     */
    public static function titleExists($title, $excludeId = null)
    {
        $query = self::where('title', $title);
        if ($excludeId) {
            $query->where('program_id', '!=', $excludeId);
        }
        return $query->exists();
    }
}
