<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CodeSprint25Registration;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CodeSprintRegistrationController extends Controller
{
    /**
     * Show the registration form
     */
    public function showRegistrationForm()
    {
        // Check if registration is still open
        $registrationDeadline = Carbon::create(2025, 7, 22, 18, 0, 0);
        if (now() > $registrationDeadline) {
            return redirect()->route('codesprint.rulebook')
                ->with('error', 'Registration deadline has passed.');
        }

        return view('rough.codesprint.register');
    }

    /**
     * Handle registration submission
     */
    public function submitRegistration(Request $request)
    {
        // Check if registration is still open
        $registrationDeadline = Carbon::create(2025, 7, 22, 18, 0, 0);
        if (now() > $registrationDeadline) {
            return back()->with('error', 'Registration deadline has passed.');
        }

        $validator = Validator::make($request->all(), [
            'team_name' => 'required|string|max:255|unique:code_sprint25_registrations,team_name',
            'team_size' => 'required|integer|min:1|max:3',
            'contact_phone' => 'nullable|string|max:20',
            
            // Member 1 (Required - Team Leader)
            'member1_name' => 'required|string|max:255',
            'member1_email' => 'required|email|unique:code_sprint25_registrations,member1_email',
            'member1_student_id' => 'required|string|max:50|unique:code_sprint25_registrations,member1_student_id',
            'member1_department' => 'required|string|max:255',
            'member1_year' => 'required|in:1st,2nd',
            
            // Member 2 (Optional)
            'member2_name' => 'nullable|string|max:255',
            'member2_email' => 'nullable|email|unique:code_sprint25_registrations,member2_email',
            'member2_student_id' => 'nullable|string|max:50|unique:code_sprint25_registrations,member2_student_id',
            'member2_department' => 'nullable|string|max:255',
            'member2_year' => 'nullable|in:1st,2nd',
            
            // Member 3 (Optional)
            'member3_name' => 'nullable|string|max:255',
            'member3_email' => 'nullable|email|unique:code_sprint25_registrations,member3_email',
            'member3_student_id' => 'nullable|string|max:50|unique:code_sprint25_registrations,member3_student_id',
            'member3_department' => 'nullable|string|max:255',
            'member3_year' => 'nullable|in:1st,2nd',
            
            // Payment Information
            'transaction_id' => 'required|string|max:255|unique:code_sprint25_registrations,transaction_id',
        ]);

        // Custom validation for team members based on team size
        $validator->after(function ($validator) use ($request) {
            $teamSize = $request->team_size;
            
            // Validate member 2 if team size is 2 or more
            if ($teamSize >= 2) {
                $member2Fields = ['member2_name', 'member2_email', 'member2_student_id', 'member2_department', 'member2_year'];
                foreach ($member2Fields as $field) {
                    if (empty($request->$field)) {
                        $validator->errors()->add($field, 'This field is required for team size of ' . $teamSize);
                    }
                }
            }
            
            // Validate member 3 if team size is 3
            if ($teamSize >= 3) {
                $member3Fields = ['member3_name', 'member3_email', 'member3_student_id', 'member3_department', 'member3_year'];
                foreach ($member3Fields as $field) {
                    if (empty($request->$field)) {
                        $validator->errors()->add($field, 'This field is required for team size of ' . $teamSize);
                    }
                }
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $registration = CodeSprint25Registration::create([
                'team_name' => $request->team_name,
                'team_size' => $request->team_size,
                'contact_phone' => $request->contact_phone,
                
                // Member 1
                'member1_name' => $request->member1_name,
                'member1_email' => $request->member1_email,
                'member1_student_id' => $request->member1_student_id,
                'member1_department' => $request->member1_department,
                'member1_year' => $request->member1_year,
                
                // Member 2
                'member2_name' => $request->member2_name,
                'member2_email' => $request->member2_email,
                'member2_student_id' => $request->member2_student_id,
                'member2_department' => $request->member2_department,
                'member2_year' => $request->member2_year,
                
                // Member 3
                'member3_name' => $request->member3_name,
                'member3_email' => $request->member3_email,
                'member3_student_id' => $request->member3_student_id,
                'member3_department' => $request->member3_department,
                'member3_year' => $request->member3_year,
                
                // Payment
                'transaction_id' => $request->transaction_id,
                'payment_amount' => 150.00,
                'payment_date' => now(),
            ]);

            return redirect()->route('codesprint.registration.success', $registration->registration_token);
                
        } catch (\Exception $e) {
            return back()->with('error', 'Registration failed. Please try again.')->withInput();
        }
    }

    /**
     * Show registration success page with token
     */
    public function showRegistrationSuccess($token)
    {
        try {
            $registration = CodeSprint25Registration::where('registration_token', $token)->firstOrFail();
            
            return view('rough.codesprint.registration-success', compact('registration'));
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('codesprint.rulebook')
                ->with('error', 'Invalid registration token.');
        }
    }

    /**
     * Show registration status
     */
    public function showStatus($token)
    {
        try {
            $registration = CodeSprint25Registration::where('registration_token', $token)->firstOrFail();
            
            return view('rough.codesprint.status', compact('registration'));
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('codesprint.status.lookup')
                ->with('error', 'Invalid registration token.');
        }
    }

    /**
     * Show status lookup form
     */
    public function showStatusLookup()
    {
        return view('rough.codesprint.status-lookup');
    }

    /**
     * Lookup registration status by token
     */
    public function lookupStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'registration_token' => 'required|string|size:6|exists:code_sprint25_registrations,registration_token',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        return redirect()->route('codesprint.status', $request->registration_token);
    }

    /**
     * Show public statistics page for the competition
     */
    public function getPublicStats()
    {
        $stats = [
            'total' => CodeSprint25Registration::count(),
            'verified' => CodeSprint25Registration::where('payment_status', 'verified')->count(),
            'github_submitted' => CodeSprint25Registration::whereNotNull('github_submitted_at')->count(),
            'project_submitted' => CodeSprint25Registration::whereNotNull('project_submitted_at')->count(),
        ];

        return view('rough.codesprint.stats', compact('stats'));
    }

    /**
     * Get public statistics as JSON for AJAX requests
     */
    public function getPublicStatsJson()
    {
        $stats = [
            'total' => CodeSprint25Registration::count(),
            'verified' => CodeSprint25Registration::where('payment_status', 'verified')->count(),
            'github_submitted' => CodeSprint25Registration::whereNotNull('github_submitted_at')->count(),
            'project_submitted' => CodeSprint25Registration::whereNotNull('project_submitted_at')->count(),
        ];

        return response()->json($stats);
    }

    /**
     * Submit GitHub repository
     */
    public function submitGitHub(Request $request)
    {
        // Check if GitHub submission is still open
        $githubDeadline = Carbon::create(2025, 7, 22, 18, 0, 0);
        if (now() > $githubDeadline) {
            return back()->with('error', 'GitHub submission deadline has passed.');
        }

        $validator = Validator::make($request->all(), [
            'registration_token' => 'required|string|exists:code_sprint25_registrations,registration_token',
            'github_repo_url' => 'required|url|regex:/^https:\/\/github\.com\/.*/',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $registration = CodeSprint25Registration::where('registration_token', $request->registration_token)->first();
            
            // Check if payment is verified
            if ($registration->payment_status !== 'verified') {
                return back()->with('error', 'Your payment must be verified before submitting GitHub repository.');
            }

            // Check if registration is active
            if ($registration->registration_status !== 'active') {
                return back()->with('error', 'Your registration is not active.');
            }

            $registration->update([
                'github_repo_url' => $request->github_repo_url,
                'github_submitted_at' => now(),
            ]);

            return back()->with('success', 'GitHub repository submitted successfully!');
            
        } catch (\Exception $e) {
            return back()->with('error', 'GitHub submission failed. Please try again.');
        }
    }

    /**
     * Submit final project
     */
    public function submitProject(Request $request)
    {
        // Check if project submission is still open
        $projectDeadline = Carbon::create(2025, 7, 30, 23, 59, 0);
        if (now() > $projectDeadline) {
            return back()->with('error', 'Project submission deadline has passed.');
        }

        $validator = Validator::make($request->all(), [
            'registration_token' => 'required|string|exists:code_sprint25_registrations,registration_token',
            'project_zip_url' => 'required|url',
            'video_submission_url' => 'required|url',
            'project_description' => 'required|string|max:2000',
            'uses_ai_ml' => 'boolean',
            'technologies_used' => 'required|string|max:1000',
            'deployment_url' => 'nullable|url',
            'team_notes' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $registration = CodeSprint25Registration::where('registration_token', $request->registration_token)->first();
            
            // Check if payment is verified
            if ($registration->payment_status !== 'verified') {
                return back()->with('error', 'Your payment must be verified before submitting final project.');
            }

            // Check if registration is active
            if ($registration->registration_status !== 'active') {
                return back()->with('error', 'Your registration is not active.');
            }

            // Check if GitHub was submitted
            if (empty($registration->github_repo_url)) {
                return back()->with('error', 'You must submit your GitHub repository before final project submission.');
            }

            $registration->update([
                'project_zip_path' => $request->project_zip_url,
                'video_submission_url' => $request->video_submission_url,
                'project_description' => $request->project_description,
                'uses_ai_ml' => $request->boolean('uses_ai_ml'),
                'technologies_used' => $request->technologies_used,
                'deployment_url' => $request->deployment_url,
                'team_notes' => $request->team_notes,
                'project_submitted_at' => now(),
            ]);

            return back()->with('success', 'Final project submitted successfully!');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Project submission failed. Please try again.');
        }
    }
}
