<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CodeSprint25Registration;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RoughEventController extends Controller
{
    public function codeSprint2025Rulebook()
    {
        return view('rough.codesprint.rulebook');
    }


    public function codeSprint2025RegistrationSubmission(Request $request)
    {
        // Check if registration is still open (until July 22, 2025 6:00 PM)
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

            return redirect()->route('codesprint.status', $registration->registration_token)
                ->with('success', 'Registration submitted successfully! Please save this URL to check your status.');
                
        } catch (\Exception $e) {
            return back()->with('error', 'Registration failed. Please try again.')->withInput();
        }
    }

    public function codeSprint2025GitHubSubmission(Request $request)
    {
        // Check if GitHub submission is still open (until July 22, 2025 6:00 PM)
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

    public function codeSprint2025ProjectSubmission(Request $request)
    {
        // Check if project submission is still open (until July 30, 2025 11:59 PM)
        $projectDeadline = Carbon::create(2025, 7, 30, 23, 59, 0);
        if (now() > $projectDeadline) {
            return back()->with('error', 'Project submission deadline has passed.');
        }

        $validator = Validator::make($request->all(), [
            'registration_token' => 'required|string|exists:code_sprint25_registrations,registration_token',
            'project_zip_url' => 'required|url', // Google Drive link for project zip
            'video_submission_url' => 'required|url', // Google Drive link for video
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
                'project_zip_path' => $request->project_zip_url, // Using as URL since it's Google Drive
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

    public function codeSprint2025RegistrationStatus($token)
    {
        try {
            $registration = CodeSprint25Registration::where('registration_token', $token)->firstOrFail();
            
            return view('rough.codesprint.status', compact('registration'));
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('codesprint.rulebook')
                ->with('error', 'Invalid registration token.');
        }
    }

    public function AdminViewCodeSprint2025Registrations()
    {
        $registrations = CodeSprint25Registration::orderBy('created_at', 'desc')->paginate(20);
        
        // Statistics
        $stats = [
            'total' => CodeSprint25Registration::count(),
            'verified' => CodeSprint25Registration::where('payment_status', 'verified')->count(),
            'pending' => CodeSprint25Registration::where('payment_status', 'pending')->count(),
            'rejected' => CodeSprint25Registration::where('payment_status', 'rejected')->count(),
            'github_submitted' => CodeSprint25Registration::whereNotNull('github_submitted_at')->count(),
            'project_submitted' => CodeSprint25Registration::whereNotNull('project_submitted_at')->count(),
            'selected_for_presentation' => CodeSprint25Registration::where('selected_for_presentation', true)->count(),
        ];
        
        return view('admin.codesprint.registrations', compact('registrations', 'stats'));
    }

    public function AdminViewCodeSprint2025RegistrationDetails($id)
    {
        try {
            $registration = CodeSprint25Registration::findOrFail($id);
            
            return view('admin.codesprint.registration-details', compact('registration'));
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.codesprint.registrations')
                ->with('error', 'Registration not found.');
        }
    }

    public function AdminUpdateCodeSprint2025RegistrationStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'payment_status' => 'nullable|in:pending,verified,rejected',
            'registration_status' => 'nullable|in:active,disqualified,withdrawn',
            'selected_for_presentation' => 'boolean',
            'admin_notes' => 'nullable|string|max:2000',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        try {
            $registration = CodeSprint25Registration::findOrFail($id);
            
            $updateData = [];
            
            if ($request->has('payment_status')) {
                $updateData['payment_status'] = $request->payment_status;
            }
            
            if ($request->has('registration_status')) {
                $updateData['registration_status'] = $request->registration_status;
            }
            
            if ($request->has('selected_for_presentation')) {
                $updateData['selected_for_presentation'] = $request->boolean('selected_for_presentation');
            }
            
            if ($request->has('admin_notes')) {
                $updateData['admin_notes'] = $request->admin_notes;
            }

            $registration->update($updateData);

            return back()->with('success', 'Registration status updated successfully!');
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return back()->with('error', 'Registration not found.');
        } catch (\Exception $e) {
            return back()->with('error', 'Update failed. Please try again.');
        }
    }

    public function AdminDeleteCodeSprint2025Registration($id)
    {
        try {
            $registration = CodeSprint25Registration::findOrFail($id);
            
            // Store team name for confirmation message
            $teamName = $registration->team_name;
            
            $registration->delete();

            return redirect()->route('admin.codesprint.registrations')
                ->with('success', "Registration for team '{$teamName}' deleted successfully!");
                
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return back()->with('error', 'Registration not found.');
        } catch (\Exception $e) {
            return back()->with('error', 'Delete failed. Please try again.');
        }
    }

    /**
     * Additional helper methods for admin
     */
    public function AdminExportCodeSprint2025Registrations()
    {
        $registrations = CodeSprint25Registration::all();
        
        $csvData = [];
        $csvData[] = [
            'ID', 'Team Name', 'Team Size', 'Leader Name', 'Leader Email', 'Leader Student ID', 
            'Leader Department', 'Leader Year', 'Contact Phone', 'Transaction ID', 
            'Payment Status', 'Registration Status', 'GitHub URL', 'Project Description',
            'Uses AI/ML', 'Technologies Used', 'Deployment URL', 'Selected for Presentation',
            'Created At'
        ];

        foreach ($registrations as $reg) {
            $csvData[] = [
                $reg->id,
                $reg->team_name,
                $reg->team_size,
                $reg->member1_name,
                $reg->member1_email,
                $reg->member1_student_id,
                $reg->member1_department,
                $reg->member1_year,
                $reg->contact_phone,
                $reg->transaction_id,
                $reg->payment_status,
                $reg->registration_status,
                $reg->github_repo_url,
                $reg->project_description,
                $reg->uses_ai_ml ? 'Yes' : 'No',
                $reg->technologies_used,
                $reg->deployment_url,
                $reg->selected_for_presentation ? 'Yes' : 'No',
                $reg->created_at->format('Y-m-d H:i:s'),
            ];
        }

        $filename = 'codesprint2025_registrations_' . now()->format('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($csvData) {
            $file = fopen('php://output', 'w');
            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    

    
}
