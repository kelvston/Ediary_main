<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiarySetting extends Model
{
    protected $fillable = [
        'email_notifications',
        'language',
        'date_format',
        'time_format',
        'theme',
        'font_size',
        'background_image',
        'privacy',
        'text_formatting',
        'reminders',
        'export_enabled',
        'multiple_diaries',
        'cloud_backup',
    ];
}
