<?php
//use Illuminate\Support\Facades\Artisan;
//use Illuminate\Support\Facades\Schedule;
//use Carbon\Carbon;
//use App\Models\User;
//use App\Models\CaseReminder;
//use App\Models\CaseFile;
//
//// Define the function only once
//function handleRecurringReminders(string $type): void
//{
//$now = Carbon::now();
//
//// Fetch users with pending reminders of the given type
//$users = User::whereHas('caseReminders', function ($query) use ($type) {
//$query->where('recurring', $type)->where('status', 'pending');
//})->get();
//
//foreach ($users as $user) {
//$reminders = $user->caseReminders()
//->where('recurring', $type)
//->where('status', 'pending')
//->orderBy('id')
//->get();
//
//foreach ($reminders as $reminder) {
//if ($reminder->case_id) {
//$case = CaseFile::find($reminder->case_id);
//
//if (!$case || Carbon::parse($case->case_hearing_date)->lessThanOrEqualTo($now)) {
//continue;
//}
//
//$nextReminderDate = calculateNextReminderDate($reminder->reminder_date, $type);
//
//if ($nextReminderDate->lessThanOrEqualTo(Carbon::parse($case->case_hearing_date))) {
//$existingReminder = CaseReminder::where('user_id', $user->id)
//->where('case_id', $reminder->case_id)
//->whereBetween('reminder_date', [$nextReminderDate->copy()->subMinute(), $nextReminderDate->copy()->addMinute()])
//->exists();
//
//if (!$existingReminder) {
//CaseReminder::create([
//'user_id' => $user->id,
//'title' => $reminder->title,
//'description' => $reminder->description,
//'reminder_date' => $nextReminderDate,
//'recurring' => $type,
//'status' => 'pending',
//'case_id' => $reminder->case_id
//]);
//}
//}
//}
//}
//}
//}
//
///**
//* Calculate the next reminder date based on recurrence type.
//*
//* @param string $currentDate The current reminder date.
//* @param string $type The recurrence type.
//* @return Carbon The calculated next reminder date.
//*/
//function calculateNextReminderDate(string $currentDate, string $type): Carbon
//{
//return match ($type) {
//'minute' => Carbon::parse($currentDate)->addMinute(),
//'five_minutes' => Carbon::parse($currentDate)->addMinutes(5),
//'daily' => Carbon::parse($currentDate)->addDay(),
//'weekly' => Carbon::parse($currentDate)->addWeek(),
//'monthly' => Carbon::parse($currentDate)->addMonth(),
//default => Carbon::parse($currentDate),
//};
//}
//
//// Define recurring schedules
//Schedule::call(fn() => handleRecurringReminders('minute'))->everyMinute();
//Schedule::call(fn() => handleRecurringReminders('five_minutes'))->everyFiveMinutes();
//Schedule::call(fn() => handleRecurringReminders('daily'))->daily();
//Schedule::call(fn() => handleRecurringReminders('weekly'))->weekly();
//Schedule::call(fn() => handleRecurringReminders('monthly'))->monthly();
//
//// Artisan command to display an inspiring quote
//Artisan::command('inspire', function () {
//$this->comment(\Illuminate\Foundation\Inspiring::quote());
//})->purpose('Display an inspiring quote');
