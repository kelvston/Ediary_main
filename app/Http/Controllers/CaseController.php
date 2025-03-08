<?php

namespace App\Http\Controllers;

use App\Mail\CaseRegisteredMail;
use App\Models\CaseFile;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//    public function index()
//    {
//        $response = Http::withBasicAuth('kelvin2026', 'Kelvin@2025')
//            ->withHeaders([
//                'Content-Type' => 'application/json',
//            ])
//            ->post('https://messaging-service.co.tz/api/sms/v1/text/single', [
//                'phone' => "255784252900",
//                'message' => "Hello your case has been registered",
//            ]);
//
//        if ($response->successful()) {
//            return redirect()->back()->with(['success' => 'Case added successfully! SMS sent.', 'cases' => CaseFile::where('lawyer_id', Auth::user()->id)->get()]);
//        } else {
//            return redirect()->back()->with(['error' => 'Case added, but SMS sending failed.', 'cases' => CaseFile::where('lawyer_id', Auth::user()->id)->get()]);
//        }
//        $user_id = Auth::user()->id;
//        $cases = CaseFile::where('lawyer_id',$user_id)->get();
//        return view('case.index', compact('cases'));
//    }

    public function index()
    {
        $user_id = Auth::user()->id;
        $cases = CaseFile::where('lawyer_id', $user_id)->get();
        return view('case.index', compact('cases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createCase(Request $request)
    {
        // Validate the request
        $request->validate([
            'case_title' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'case_brief' => 'required|string',
            'judge' => 'required|string',
            'recurring' => 'required|string',
            'case_hearing_date' => 'required|date_format:Y-m-d\TH:i',
        ]);

        // Store the case in the database
        $case = CaseFile::create([
            'lawyer_id' => Auth::user()->id,
            'case_title' => $request->case_title,
            'client_name' => $request->client_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'case_brief' => $request->case_brief,
            'judge' => $request->judge,
            'recurring' => $request->recurring,
            'case_hearing_date' => $request->case_hearing_date,
        ]);
        Mail::to($case->email)->send(new CaseRegisteredMail($case->toArray()));
        // Retrieve all cases for this lawyer
        $cases = CaseFile::where('lawyer_id', Auth::user()->id)->get();

        // Redirect to index page with cases
        return redirect()->back()->with(['success' => 'Case added successfully!', 'cases' => $cases]);
    }

    public function notify($id)
    {
        $case = CaseFile::findOrFail($id);

        if ($case->notification) {
            return back()->with('error', 'This client has already been notified.');
        }

        $username = 'kelvin2026';
        $password = 'Kelvin@2025';
        $credentials = base64_encode("$username:$password");
        $textMessage = "Dear {$case->client_name}, your case ({$case->case_title}) has been successfully registered. Hearing Date: {$case->case_hearing_date}. Assigned Judge: {$case->judge}. We will keep you updated. Thank you. - Wakili Mtandao";
        $response = Http::withHeaders([
            'Authorization' => "Basic $credentials",
            'Accept' => 'application/json'
        ])->post('https://messaging-service.co.tz/api/sms/v1/text/single', [
            'from' => 'REMINDER',
            'to' => '255784252900',
            'text' => $textMessage
        ]);

        Log::info('SMS API Response:', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        if ($response->successful()) {
            $case->notification = true;
            $case->save();
            return back()->with('success', 'Notification sent successfully!');
        } else {
            return back()->with('error', 'Failed to send notification.');
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $case = CaseFile::findOrFail($id);
        return view('case.show', compact('case'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $case = CaseFile::findOrFail($id);
        return view('case.edit', compact('case'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'case_title' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'case_brief' => 'required|string',
            'judge' => 'required|string|max:255',
            'case_hearing_date' => 'required|date',
            'recurring' => 'required|string',
        ]);

        $case = CaseFile::findOrFail($id);
    $case->update($request->all());

    return redirect()->route('cases.index')->with('success', 'Case updated successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $case = CaseFile::findOrFail($id);
        $case->delete();

        return redirect()->back()->with('success', 'Case deleted successfully.');
    }

}
