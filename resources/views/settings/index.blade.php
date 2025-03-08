{{--<div class="container">--}}
{{--    <h3>Customize Your Settings</h3>--}}

{{--    <form action="{{ route('settings.save') }}" method="POST">--}}
{{--        @csrf--}}
{{--        <!-- Notification Settings -->--}}
{{--        <div class="form-group">--}}
{{--            <label for="email_notifications">Email Notifications</label>--}}
{{--            <select class="form-control" id="email_notifications" name="email_notifications">--}}
{{--                <option value="1" {{ old('email_notifications', $settings->email_notifications) == 1 ? 'selected' : '' }}>Enabled</option>--}}
{{--                <option value="0" {{ old('email_notifications', $settings->email_notifications) == 0 ? 'selected' : '' }}>Disabled</option>--}}
{{--            </select>--}}
{{--        </div>--}}

{{--        <!-- Language Settings -->--}}
{{--        <div class="form-group">--}}
{{--            <label for="language">Preferred Language</label>--}}
{{--            <select class="form-control" id="language" name="language">--}}
{{--                <option value="en" {{ old('language', $settings->language) == 'en' ? 'selected' : '' }}>English</option>--}}
{{--                <option value="fr" {{ old('language', $settings->language) == 'fr' ? 'selected' : '' }}>French</option>--}}
{{--                <option value="es" {{ old('language', $settings->language) == 'es' ? 'selected' : '' }}>Spanish</option>--}}
{{--            </select>--}}
{{--        </div>--}}

{{--        <!-- Date Format Settings -->--}}
{{--        <div class="form-group">--}}
{{--            <label for="date_format">Date Format</label>--}}
{{--            <select class="form-control" id="date_format" name="date_format">--}}
{{--                <option value="Y-m-d" {{ old('date_format', $settings->date_format) == 'Y-m-d' ? 'selected' : '' }}>YYYY-MM-DD</option>--}}
{{--                <option value="d-m-Y" {{ old('date_format', $settings->date_format) == 'd-m-Y' ? 'selected' : '' }}>DD-MM-YYYY</option>--}}
{{--                <option value="m/d/Y" {{ old('date_format', $settings->date_format) == 'm/d/Y' ? 'selected' : '' }}>MM/DD/YYYY</option>--}}
{{--            </select>--}}
{{--        </div>--}}

{{--        <!-- Time Format Settings -->--}}
{{--        <div class="form-group">--}}
{{--            <label for="time_format">Time Format</label>--}}
{{--            <select class="form-control" id="time_format" name="time_format">--}}
{{--                <option value="24" {{ old('time_format', $settings->time_format) == '24' ? 'selected' : '' }}>24-Hour</option>--}}
{{--                <option value="12" {{ old('time_format', $settings->time_format) == '12' ? 'selected' : '' }}>12-Hour</option>--}}
{{--            </select>--}}
{{--        </div>--}}

{{--        <!-- Theme Settings -->--}}
{{--        <div class="form-group">--}}
{{--            <label for="theme">Select Theme</label>--}}
{{--            <select class="form-control" id="theme" name="theme">--}}
{{--                <option value="light" {{ old('theme', $settings->theme) == 'light' ? 'selected' : '' }}>Light</option>--}}
{{--                <option value="dark" {{ old('theme', $settings->theme) == 'dark' ? 'selected' : '' }}>Dark</option>--}}
{{--            </select>--}}
{{--        </div>--}}

{{--        <!-- Font Size Settings -->--}}
{{--        <div class="form-group">--}}
{{--            <label for="font_size">Font Size</label>--}}
{{--            <select class="form-control" id="font_size" name="font_size">--}}
{{--                <option value="small" {{ old('font_size', $settings->font_size) == 'small' ? 'selected' : '' }}>Small</option>--}}
{{--                <option value="medium" {{ old('font_size', $settings->font_size) == 'medium' ? 'selected' : '' }}>Medium</option>--}}
{{--                <option value="large" {{ old('font_size', $settings->font_size) == 'large' ? 'selected' : '' }}>Large</option>--}}
{{--            </select>--}}
{{--        </div>--}}

{{--        <!-- Custom Background Image -->--}}
{{--        <div class="form-group">--}}
{{--            <label for="background_image">Upload Background Image</label>--}}
{{--            <input type="file" class="form-control" id="background_image" name="background_image">--}}
{{--        </div>--}}

{{--        <!-- Privacy Settings -->--}}
{{--        <div class="form-group">--}}
{{--            <label for="privacy">Diary Privacy</label>--}}
{{--            <select class="form-control" id="privacy" name="privacy">--}}
{{--                <option value="private" {{ old('privacy', $settings->privacy) == 'private' ? 'selected' : '' }}>Private</option>--}}
{{--                <option value="friends" {{ old('privacy', $settings->privacy) == 'friends' ? 'selected' : '' }}>Friends</option>--}}
{{--                <option value="public" {{ old('privacy', $settings->privacy) == 'public' ? 'selected' : '' }}>Public</option>--}}
{{--            </select>--}}
{{--        </div>--}}

{{--        <!-- Text Formatting Settings -->--}}
{{--        <div class="form-group">--}}
{{--            <label for="text_formatting">Default Text Formatting</label>--}}
{{--            <select class="form-control" id="text_formatting" name="text_formatting">--}}
{{--                <option value="normal" {{ old('text_formatting', $settings->text_formatting) == 'normal' ? 'selected' : '' }}>Normal</option>--}}
{{--                <option value="bold" {{ old('text_formatting', $settings->text_formatting) == 'bold' ? 'selected' : '' }}>Bold</option>--}}
{{--                <option value="italic" {{ old('text_formatting', $settings->text_formatting) == 'italic' ? 'selected' : '' }}>Italic</option>--}}
{{--            </select>--}}
{{--        </div>--}}

{{--        <!-- Reminder Settings -->--}}
{{--        <div class="form-group">--}}
{{--            <label for="reminders">Enable Reminders</label>--}}
{{--            <select class="form-control" id="reminders" name="reminders">--}}
{{--                <option value="1" {{ old('reminders', $settings->reminders) == 1 ? 'selected' : '' }}>Enabled</option>--}}
{{--                <option value="0" {{ old('reminders', $settings->reminders) == 0 ? 'selected' : '' }}>Disabled</option>--}}
{{--            </select>--}}
{{--        </div>--}}

{{--        <!-- Export Settings -->--}}
{{--        <div class="form-group">--}}
{{--            <label for="export_enabled">Enable Export</label>--}}
{{--            <select class="form-control" id="export_enabled" name="export_enabled">--}}
{{--                <option value="1" {{ old('export_enabled', $settings->export_enabled) == 1 ? 'selected' : '' }}>Enabled</option>--}}
{{--                <option value="0" {{ old('export_enabled', $settings->export_enabled) == 0 ? 'selected' : '' }}>Disabled</option>--}}
{{--            </select>--}}
{{--        </div>--}}

{{--        <!-- Multiple Diaries Settings -->--}}
{{--        <div class="form-group">--}}
{{--            <label for="multiple_diaries">Allow Multiple Diaries</label>--}}
{{--            <select class="form-control" id="multiple_diaries" name="multiple_diaries">--}}
{{--                <option value="1" {{ old('multiple_diaries', $settings->multiple_diaries) == 1 ? 'selected' : '' }}>Enabled</option>--}}
{{--                <option value="0" {{ old('multiple_diaries', $settings->multiple_diaries) == 0 ? 'selected' : '' }}>Disabled</option>--}}
{{--            </select>--}}
{{--        </div>--}}

{{--        <!-- Cloud Backup Settings -->--}}
{{--        <div class="form-group">--}}
{{--            <label for="cloud_backup">Enable Cloud Backup</label>--}}
{{--            <select class="form-control" id="cloud_backup" name="cloud_backup">--}}
{{--                <option value="google_drive" {{ old('cloud_backup', $settings->cloud_backup) == 'google_drive' ? 'selected' : '' }}>Google Drive</option>--}}
{{--                <option value="dropbox" {{ old('cloud_backup', $settings->cloud_backup) == 'dropbox' ? 'selected' : '' }}>Dropbox</option>--}}
{{--                <option value="none" {{ old('cloud_backup', $settings->cloud_backup) == 'none' ? 'selected' : '' }}>None</option>--}}
{{--            </select>--}}
{{--        </div>--}}

{{--        <!-- Save Button -->--}}
{{--        <button type="submit" class="btn btn-primary">Save Settings</button>--}}
{{--    </form>--}}
{{--</div>--}}

<div class="container mt-5">
    <h3 class="mb-4">Customize Your Settings</h3>

    <form action="{{ route('settings.save') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Notification Settings -->
        <div class="form-group">
            <label for="email_notifications">Email Notifications</label>
            <select class="form-control" id="email_notifications" name="email_notifications">
                <option value="1" {{ old('email_notifications', $settings->email_notifications) == 1 ? 'selected' : '' }}>Enabled</option>
                <option value="0" {{ old('email_notifications', $settings->email_notifications) == 0 ? 'selected' : '' }}>Disabled</option>
            </select>
        </div>

        <!-- Language Settings -->
        <div class="form-group">
            <label for="language">Preferred Language</label>
            <select class="form-control" id="language" name="language">
                <option value="en" {{ old('language', $settings->language) == 'en' ? 'selected' : '' }}>English</option>
                <option value="fr" {{ old('language', $settings->language) == 'fr' ? 'selected' : '' }}>French</option>
                <option value="es" {{ old('language', $settings->language) == 'es' ? 'selected' : '' }}>Spanish</option>
            </select>
        </div>

        <!-- Date Format Settings -->
        <div class="form-group">
            <label for="date_format">Date Format</label>
            <select class="form-control" id="date_format" name="date_format">
                <option value="Y-m-d" {{ old('date_format', $settings->date_format) == 'Y-m-d' ? 'selected' : '' }}>YYYY-MM-DD</option>
                <option value="d-m-Y" {{ old('date_format', $settings->date_format) == 'd-m-Y' ? 'selected' : '' }}>DD-MM-YYYY</option>
                <option value="m/d/Y" {{ old('date_format', $settings->date_format) == 'm/d/Y' ? 'selected' : '' }}>MM/DD/YYYY</option>
            </select>
        </div>

        <!-- Time Format Settings -->
        <div class="form-group">
            <label for="time_format">Time Format</label>
            <select class="form-control" id="time_format" name="time_format">
                <option value="24" {{ old('time_format', $settings->time_format) == '24' ? 'selected' : '' }}>24-Hour</option>
                <option value="12" {{ old('time_format', $settings->time_format) == '12' ? 'selected' : '' }}>12-Hour</option>
            </select>
        </div>

        <!-- Theme Settings -->
        <div class="form-group">
            <label for="theme">Select Theme</label>
            <select class="form-control" id="theme" name="theme">
                <option value="light" {{ old('theme', $settings->theme) == 'light' ? 'selected' : '' }}>Light</option>
                <option value="dark" {{ old('theme', $settings->theme) == 'dark' ? 'selected' : '' }}>Dark</option>
            </select>
        </div>

        <!-- Font Size Settings -->
        <div class="form-group">
            <label for="font_size">Font Size</label>
            <select class="form-control" id="font_size" name="font_size">
                <option value="small" {{ old('font_size', $settings->font_size) == 'small' ? 'selected' : '' }}>Small</option>
                <option value="medium" {{ old('font_size', $settings->font_size) == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="large" {{ old('font_size', $settings->font_size) == 'large' ? 'selected' : '' }}>Large</option>
            </select>
        </div>

        <!-- Custom Background Image -->
        <div class="form-group">
            <label for="background_image">Upload Background Image</label>
            <input type="file" class="form-control" id="background_image" name="background_image">
        </div>

        <!-- Privacy Settings -->
        <div class="form-group">
            <label for="privacy">Diary Privacy</label>
            <select class="form-control" id="privacy" name="privacy">
                <option value="private" {{ old('privacy', $settings->privacy) == 'private' ? 'selected' : '' }}>Private</option>
                <option value="friends" {{ old('privacy', $settings->privacy) == 'friends' ? 'selected' : '' }}>Friends</option>
                <option value="public" {{ old('privacy', $settings->privacy) == 'public' ? 'selected' : '' }}>Public</option>
            </select>
        </div>

        <!-- Text Formatting Settings -->
        <div class="form-group">
            <label for="text_formatting">Default Text Formatting</label>
            <select class="form-control" id="text_formatting" name="text_formatting">
                <option value="normal" {{ old('text_formatting', $settings->text_formatting) == 'normal' ? 'selected' : '' }}>Normal</option>
                <option value="bold" {{ old('text_formatting', $settings->text_formatting) == 'bold' ? 'selected' : '' }}>Bold</option>
                <option value="italic" {{ old('text_formatting', $settings->text_formatting) == 'italic' ? 'selected' : '' }}>Italic</option>
            </select>
        </div>

        <!-- Reminder Settings -->
        <div class="form-group">
            <label for="reminders">Enable Reminders</label>
            <select class="form-control" id="reminders" name="reminders">
                <option value="1" {{ old('reminders', $settings->reminders) == 1 ? 'selected' : '' }}>Enabled</option>
                <option value="0" {{ old('reminders', $settings->reminders) == 0 ? 'selected' : '' }}>Disabled</option>
            </select>
        </div>

        <!-- Export Settings -->
        <div class="form-group">
            <label for="export_enabled">Enable Export</label>
            <select class="form-control" id="export_enabled" name="export_enabled">
                <option value="1" {{ old('export_enabled', $settings->export_enabled) == 1 ? 'selected' : '' }}>Enabled</option>
                <option value="0" {{ old('export_enabled', $settings->export_enabled) == 0 ? 'selected' : '' }}>Disabled</option>
            </select>
        </div>

        <!-- Multiple Diaries Settings -->
        <div class="form-group">
            <label for="multiple_diaries">Allow Multiple Diaries</label>
            <select class="form-control" id="multiple_diaries" name="multiple_diaries">
                <option value="1" {{ old('multiple_diaries', $settings->multiple_diaries) == 1 ? 'selected' : '' }}>Enabled</option>
                <option value="0" {{ old('multiple_diaries', $settings->multiple_diaries) == 0 ? 'selected' : '' }}>Disabled</option>
            </select>
        </div>

        <!-- Cloud Backup Settings -->
        <div class="form-group">
            <label for="cloud_backup">Enable Cloud Backup</label>
            <select class="form-control" id="cloud_backup" name="cloud_backup">
                <option value="google_drive" {{ old('cloud_backup', $settings->cloud_backup) == 'google_drive' ? 'selected' : '' }}>Google Drive</option>
                <option value="dropbox" {{ old('cloud_backup', $settings->cloud_backup) == 'dropbox' ? 'selected' : '' }}>Dropbox</option>
                <option value="none" {{ old('cloud_backup', $settings->cloud_backup) == 'none' ? 'selected' : '' }}>None</option>
            </select>
        </div>

        <!-- Save Button -->
        <button type="submit" class="btn btn-primary mt-3">Save Settings</button>
    </form>
</div>

<style>
    .container {
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h3 {
        font-size: 1.5rem;
        color: #343a40;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .form-group label {
        font-weight: bold;
        color: #495057;
    }

    .form-control {
        border-radius: 4px;
        padding: 10px;
        border: 1px solid #ced4da;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 10px 20px;
        font-size: 1rem;
        cursor: pointer;
        width: 100%;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }
</style>
