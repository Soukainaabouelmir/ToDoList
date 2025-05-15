<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'position',
        'due_date',
        'status'
    ];
   public $timestamps = false;
    protected $casts = [
        'due_date' => 'date',
    ];
}
