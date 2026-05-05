<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subject';
    protected $primaryKey = 'subject_id';
    public $timestamps = false;

    protected $fillable = [
        'code',
        'title',
        'unit',
    ];

    protected $casts = [
        'unit' => 'integer',
    ];

    public static function rules($id = null)
    {
        $rules = [
            'code' => 'required|string|max:20|unique:subject,code' . ($id ? ",{$id},subject_id" : ''),
            'title' => 'required|string|max:100|unique:subject,title' . ($id ? ",{$id},subject_id" : ''),
            'unit' => 'required|integer|min:1',
        ];
        return $rules;
    }
}
