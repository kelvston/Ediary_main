<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['case_id', 'user_id', 'reminder_text', 'reminder_date', 'status'];

    public function case()
    {
        return $this->belongsTo(CaseFile::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
