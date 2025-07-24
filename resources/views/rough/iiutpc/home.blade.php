@include('rough.iiutpc.header', ['eventName' => $eventName])

<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-12 px-4">
    <div class="container mx-auto max-w-6xl">
        <!-- Event Hero Section -->
        <div class="text-center mb-12 animate-fade-in">
            <h1 class="text-5xl md:text-6xl font-bold header-gradient mb-10">
                {{ $eventName }}
            </h1>
            <p class="text-gray-300 text-xl mb-8 max-w-3xl mx-auto">
                {{$eventName}} - Showcase your coding skills and compete with the best minds of IUT
            </p>
            
            <!-- Event Details -->
            <div class="grid md:grid-cols-2 gap-6 mb-8">
                <div class="card p-6">
                    <i class="bi bi-calendar3 text-3xl text-primary mb-3"></i>
                    <h3 class="text-lg font-semibold text-white mb-2">Competition Date</h3>
                    <p class="text-gray-300">{{ $competitionDate->format('F j, Y') }}</p>
                    <p class="text-gray-400 text-sm">{{ $competitionDate->format('l, g:i A') }}</p>
                </div>
                
                <div class="card p-6">
                    <i class="bi bi-calendar-check text-3xl text-secondary mb-3"></i>
                    <h3 class="text-lg font-semibold text-white mb-2">Registration Deadline</h3>
                    <p class="text-gray-300">{{ $registrationEnds->format('F j, Y') }}</p>
                    <p class="text-gray-400 text-sm">{{ $registrationEnds->format('l, g:i A') }}</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col md:flex-row gap-4 justify-center mb-12">
            <a href="{{ route('iiutpc.register') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-person-plus me-2"></i>
                Register Your Team
            </a>
            
            <a href="{{ route('iiutpc.check') }}" class="btn btn-secondary btn-lg">
                <i class="bi bi-search me-2"></i>
                Check Registration
            </a>
            
            <a href="https://docs.google.com/document/d/1dJbUsOPNTEWBk669yNT5BsSKDcIXtBmgKM_2RAAgCNs/edit?usp=sharing" class="btn btn-success btn-lg" onclick="alert('Rulebook will be available soon!')">
                <i class="bi bi-book me-2"></i>
                View Rulebook
            </a>
            
            @if(session()->has('user_id') && session('role') === 'admin')
            <a href="{{ route('iiutpc.admin') }}" class="btn btn-warning btn-lg">
                <i class="bi bi-gear me-2"></i>
                Admin Dashboard
            </a>
            @endif
        </div>

        <!-- Registered Teams Table -->
        <div class="card p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-semibold text-white">Registered Teams</h3>
                <span class="badge badge-primary">{{ $totalTeams }} Teams</span>
            </div>
            
            @if($registrations->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="text-left py-3 px-4 text-gray-300 font-medium">#</th>
                            <th class="text-left py-3 px-4 text-gray-300 font-medium">Team Name</th>
                            <th class="text-left py-3 px-4 text-gray-300 font-medium">Registration Time</th>
                            <th class="text-left py-3 px-4 text-gray-300 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registrations as $index => $registration)
                        <tr class="border-b border-gray-800 hover:bg-gray-800/30 transition-colors">
                            <td class="py-4 px-4 text-gray-400">{{ $index + 1 }}</td>
                            <td class="py-4 px-4">
                                <div class="font-semibold text-white">{{ $registration->team_name }}</div>
                            </td>
                            <td class="py-4 px-4 text-gray-300">
                                {{ $registration->created_at->format('M j, Y') }}
                                <div class="text-sm text-gray-400">{{ $registration->created_at->format('g:i A') }}</div>
                            </td>
                            <td class="py-4 px-4">
                                @if($registration->registration_status === 'verified')
                                    <span class="badge badge-success">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Verified
                                    </span>
                                @elseif($registration->registration_status === 'pending')
                                    <span class="badge badge-warning">
                                        <i class="bi bi-clock me-1"></i>
                                        Pending
                                    </span>
                                @else
                                    <span class="badge badge-danger">
                                        <i class="bi bi-x-circle me-1"></i>
                                        {{ ucfirst($registration->registration_status) }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if($registrations->hasPages())
            <div class="mt-6">
                {{ $registrations->links() }}
            </div>
            @endif
            
            @else
            <div class="text-center py-12">
                <i class="bi bi-people text-6xl text-gray-600 mb-4"></i>
                <h4 class="text-xl font-semibold text-gray-400 mb-2">No teams registered yet</h4>
                <p class="text-gray-500 mb-6">Be the first team to register for this exciting contest!</p>
                <a href="{{ route('iiutpc.register') }}" class="btn btn-primary">
                    <i class="bi bi-person-plus me-2"></i>
                    Register Now
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

@include('layouts.footer')