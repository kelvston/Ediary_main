<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseReminder extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'reminder_date',
        'recurring', 'status', 'case_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function case()
    {
        return $this->belongsTo(CaseFile::class, 'case_id');
    }
}
