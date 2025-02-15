<?php

namespace App\Http\Controllers;

use App\Models\CaseFile;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $cases = CaseFile::where('lawyer_id',$user_id)->get();
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
            'case_hearing_date' => 'required|date',
        ]);

        // Store the case in the database
        CaseFile::create([
            'lawyer_id' => Auth::user()->id,
            'case_title' => $request->case_title,
            'client_name' => $request->client_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'case_brief' => $request->case_brief,
            'case_hearing_date' => $request->case_hearing_date,
        ]);

        // Retrieve all cases for this lawyer
        $cases = CaseFile::where('lawyer_id', Auth::user()->id)->get();

        // Redirect to index page with cases
        return redirect()->back()->with(['success' => 'Case added successfully!', 'cases' => $cases]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
