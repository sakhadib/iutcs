<?php

namespace App\Http\Controllers\roughEvent;

use App\Http\Controllers\Controller;
use App\Models\iiupcReg;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class iiutpcRegistrationAndViewController extends Controller
{
    public $eventName;
    public $eventSlug;
    public $registrationStarts;
    public $registrationEnds;
    public $competitionDate;

    public function __construct()
    {
        $this->eventName = 'Abid Hasan Intra University Programming Contest';
        $this->eventSlug = 'ahiupc';
        // $this->registrationStarts = Carbon::create(2025, 7, 25, 18, 0, 0);
        $this->registrationStarts = Carbon::create(2025, 7, 25, 18, 0, 0);
        $this->registrationEnds = Carbon::create(2025, 8, 12, 23, 59, 0);
        $this->competitionDate = Carbon::create(2025, 8, 16, 9, 0, 0);
    }

    public function home(){
        // Get registration statistics
        $registrations = iiupcReg::orderBy('created_at', 'desc')->paginate(20);
        $totalTeams = iiupcReg::count();
        $verifiedTeams = iiupcReg::where('registration_status', 'verified')->count();
        $pendingTeams = iiupcReg::where('registration_status', 'pending')->count();
        
        return view('rough.iiutpc.home', [
            'eventName' => $this->eventName,
            'eventSlug' => $this->eventSlug,
            'registrationStarts' => $this->registrationStarts,
            'registrationEnds' => $this->registrationEnds,
            'competitionDate' => $this->competitionDate,
            'registrations' => $registrations,
            'totalTeams' => $totalTeams,
            'verifiedTeams' => $verifiedTeams,
            'pendingTeams' => $pendingTeams,
        ]);
    }

    public function register(){
        return view('rough.iiutpc.register', [
            'eventName' => $this->eventName,
            'eventSlug' => $this->eventSlug,
            'registrationStarts' => $this->registrationStarts,
            'registrationEnds' => $this->registrationEnds,
            'competitionDate' => $this->competitionDate,
        ]);
    }

    public function submitRegistration(Request $request)
    {
        // Check if registration is open
        $now = Carbon::now();
        if (!$now->between($this->registrationStarts, $this->registrationEnds)) {
            return back()->with('error', 'Registration is currently closed.');
        }

        // Validation rules
        $validator = Validator::make($request->all(), [
            'team_name' => 'required|string|max:255|unique:iiupc_regs,team_name',
            
            // Member 1 (Team Lead) - Required
            'member1_name' => 'required|string|max:255',
            'member1_email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('iiupc_regs')->where(function ($query) {
                    return $query->whereIn('registration_status', ['pending', 'verified']);
                })
            ],
            'member1_student_id' => [
                'required',
                'string',
                'max:255',
                Rule::unique('iiupc_regs')->where(function ($query) {
                    return $query->whereIn('registration_status', ['pending', 'verified']);
                })
            ],
            'member1_department' => 'required|string|max:255',
            'member1_program' => 'required|string|max:255',
            'member1_batch' => 'nullable|string|max:10',
            'member1_phone' => 'nullable|string|max:20',
            
            // Member 2 - Required
            'member2_name' => 'required|string|max:255',
            'member2_email' => [
                'required',
                'email',
                'max:255',
                'different:member1_email',
                Rule::unique('iiupc_regs')->where(function ($query) {
                    return $query->whereIn('registration_status', ['pending', 'verified']);
                })
            ],
            'member2_student_id' => [
                'required',
                'string',
                'max:255',
                'different:member1_student_id',
                Rule::unique('iiupc_regs')->where(function ($query) {
                    return $query->whereIn('registration_status', ['pending', 'verified']);
                })
            ],
            'member2_department' => 'required|string|max:255',
            'member2_program' => 'required|string|max:255',
            'member2_batch' => 'nullable|string|max:10',
            'member2_phone' => 'nullable|string|max:20',
            
            // Member 3 - Required
            'member3_name' => 'required|string|max:255',
            'member3_email' => [
                'required',
                'email',
                'max:255',
                'different:member1_email',
                'different:member2_email',
                Rule::unique('iiupc_regs')->where(function ($query) {
                    return $query->whereIn('registration_status', ['pending', 'verified']);
                })
            ],
            'member3_student_id' => [
                'required',
                'string',
                'max:255',
                'different:member1_student_id',
                'different:member2_student_id',
                Rule::unique('iiupc_regs')->where(function ($query) {
                    return $query->whereIn('registration_status', ['pending', 'verified']);
                })
            ],
            'member3_department' => 'required|string|max:255',
            'member3_program' => 'required|string|max:255',
            'member3_batch' => 'nullable|string|max:10',
            'member3_phone' => 'nullable|string|max:20',
            
            // Payment Information
            'transaction_id' => [
                'required',
                'string',
                'max:255',
                Rule::unique('iiupc_regs')->where(function ($query) {
                    return $query->whereIn('registration_status', ['pending', 'verified']);
                })
            ],
            
            // Terms acceptance
            'terms_accepted' => 'required|accepted',
        ], [
            // Custom error messages
            'team_name.unique' => 'This team name is already taken. Please choose a different name.',
            'member1_email.unique' => 'Member 1 email is already registered.',
            'member2_email.unique' => 'Member 2 email is already registered.',
            'member3_email.unique' => 'Member 3 email is already registered.',
            'member1_student_id.unique' => 'Member 1 student ID is already registered.',
            'member2_student_id.unique' => 'Member 2 student ID is already registered.',
            'member3_student_id.unique' => 'Member 3 student ID is already registered.',
            'member2_email.different' => 'Member 2 email must be different from Member 1.',
            'member3_email.different' => 'Member 3 email must be different from other members.',
            'member2_student_id.different' => 'Member 2 student ID must be different from Member 1.',
            'member3_student_id.different' => 'Member 3 student ID must be different from other members.',
            'transaction_id.unique' => 'This transaction ID has already been used.',
            'terms_accepted.required' => 'You must accept the terms and conditions.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            // Create registration
            $registration = iiupcReg::create([
                'team_name' => $request->team_name,
                
                // Member 1
                'member1_name' => $request->member1_name,
                'member1_email' => $request->member1_email,
                'member1_student_id' => $request->member1_student_id,
                'member1_department' => $request->member1_department,
                'member1_program' => $request->member1_program,
                'member1_batch' => $request->member1_batch,
                'member1_phone' => $request->member1_phone,
                
                // Member 2
                'member2_name' => $request->member2_name,
                'member2_email' => $request->member2_email,
                'member2_student_id' => $request->member2_student_id,
                'member2_department' => $request->member2_department,
                'member2_program' => $request->member2_program,
                'member2_batch' => $request->member2_batch,
                'member2_phone' => $request->member2_phone,
                
                // Member 3
                'member3_name' => $request->member3_name,
                'member3_email' => $request->member3_email,
                'member3_student_id' => $request->member3_student_id,
                'member3_department' => $request->member3_department,
                'member3_program' => $request->member3_program,
                'member3_batch' => $request->member3_batch,
                'member3_phone' => $request->member3_phone,
                
                // Payment & Registration
                'transaction_id' => $request->transaction_id,
                'registration_token' => iiupcReg::generateRegistrationToken(),
                'registration_status' => 'pending'
            ]);

            return redirect()->route('iiutpc.registration.success', ['token' => $registration->registration_token])
                           ->with('success', 'Registration submitted successfully! Your registration token is: ' . $registration->registration_token);

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again later.')->withInput();
        }
    }

    public function registrationSuccess($token)
    {
        $registration = iiupcReg::where('registration_token', $token)->first();
        
        if (!$registration) {
            return redirect()->route('iiutpc.register')->with('error', 'Invalid registration token.');
        }

        return view('rough.iiutpc.registration-success', [
            'eventName' => $this->eventName,
            'registration' => $registration,
        ]);
    }

    public function checkRegistration(Request $request)
    {
        // If it's a GET request, show the form
        if ($request->isMethod('get')) {
            return view('rough.iiutpc.check-registration', [
                'eventName' => $this->eventName,
            ]);
        }

        // If it's a POST request, process the form
        $validator = Validator::make($request->all(), [
            'token' => 'required|string|size:6'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $registration = iiupcReg::where('registration_token', $request->token)->first();

        if (!$registration) {
            return back()->with('error', 'Registration not found with this token.');
        }

        return view('rough.iiutpc.check-registration', [
            'eventName' => $this->eventName,
            'registration' => $registration,
        ]);
    }

    // Admin Functions
    public function adminDashboard()
    {
        // Check if user is admin
        if (!session()->has('user_id') || session('role') !== 'admin') {
            return redirect()->route('iiutpc.home')->with('error', 'Access denied. Admin privileges required.');
        }

        // Get all registrations with pagination
        $registrations = iiupcReg::orderBy('created_at', 'desc')->paginate(30);
        $totalTeams = iiupcReg::count();
        $verifiedTeams = iiupcReg::where('registration_status', 'verified')->count();
        $pendingTeams = iiupcReg::where('registration_status', 'pending')->count();
        $rejectedTeams = iiupcReg::where('registration_status', 'rejected')->count();

        return view('rough.iiutpc.admin-dashboard', [
            'eventName' => $this->eventName,
            'registrations' => $registrations,
            'totalTeams' => $totalTeams,
            'verifiedTeams' => $verifiedTeams,
            'pendingTeams' => $pendingTeams,
            'rejectedTeams' => $rejectedTeams,
        ]);
    }

    public function updateTeamStatus(Request $request, $id)
    {
        // Check if user is admin
        if (!session()->has('user_id') || session('role') !== 'admin') {
            return response()->json(['error' => 'Access denied'], 403);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,verified,rejected'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid status'], 400);
        }

        $registration = iiupcReg::find($id);
        if (!$registration) {
            return response()->json(['error' => 'Registration not found'], 404);
        }

        $registration->registration_status = $request->status;
        $registration->save();

        return response()->json([
            'success' => true,
            'message' => 'Team status updated successfully',
            'new_status' => $request->status
        ]);
    }

    public function viewTeamDetails($id)
    {
        // Check if user is admin
        if (!session()->has('user_id') || session('role') !== 'admin') {
            return redirect()->route('iiutpc.home')->with('error', 'Access denied. Admin privileges required.');
        }

        $registration = iiupcReg::find($id);
        if (!$registration) {
            return redirect()->route('iiutpc.admin')->with('error', 'Registration not found.');
        }

        return view('rough.iiutpc.admin-team-details', [
            'eventName' => $this->eventName,
            'registration' => $registration,
        ]);
    }
}
