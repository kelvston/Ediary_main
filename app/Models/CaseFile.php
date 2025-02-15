<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseFile extends Model
{
    use HasFactory;
    protected $table = 'cases';

    protected $fillable = [
        'case_title',
        'client_name',
        'email',
        'phone',
        'case_brief',
        'case_hearing_date',
        'lawyer_id'
    ];
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function lawyer()
    {
        return $this->belongsTo(User::class, 'lawyer_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function documents()
    {
        return $this->hasMany(CaseDocument::class);
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }

}
