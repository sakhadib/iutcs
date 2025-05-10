@extends('layouts.main')

@section('main')
<div class="vh-100">
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <h1 class="display-6 fw-bold text-dark">
                    Participant Teams for {{ $fest->title}}'s {{ $event->title }}
                </h1>
                <hr class="border-dark opacity-50 my-4">
                <p class="lead text-muted">
                    This is the list of teams that have registered for the event. You may click on the teams to view details.
                </p>
            </div>
        </div>

        <div class="row mt-4 g-3">
            <div class="col-auto">
                <a href="#" class="btn btn-outline-dark shadow-sm">
                    <i class="bi bi-printer me-2"></i>Print Report
                </a>
            </div>
            <div class="col-auto">
                <a href="#" class="btn btn-outline-danger shadow-sm">
                    <i class="bi bi-file-earmark-pdf me-2"></i>PDF Summary
                </a>
            </div>
            <div class="col-auto">
                <a href="#" class="btn btn-outline-success shadow-sm">
                    <i class="bi bi-file-earmark-spreadsheet me-2"></i>Export CSV
                </a>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="fw-semibold px-4">Team Name</th>
                                    <th class="fw-semibold">Team Lead</th>
                                    <th class="fw-semibold">Members</th>
                                    <th class="fw-semibold">Status</th>
                                    <th class="fw-semibold text-end px-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($teams as $team)
                                <tr class="border-top">
                                    <td class="px-4">
                                        <a href="/admin/fests/{{ $fest->id }}/events/{{ $event->id }}/teams/{{ $team->id }}" 
                                           class="text-decoration-none text-dark fw-semibold">
                                            {{ $team->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/profile/{{ $team->leader->id }}" 
                                           class="text-decoration-none text-primary">
                                            {{ $team->leader->name }}
                                            
                                        </a>
                                    </td>
                                    <td>
                                        <ul class="list-unstyled mb-0">
                                            @foreach($team->members as $member)
                                            <li>
                                                <a href="/profile/{{ $member['id'] }}"
                                                   class="text-decoration-none text-muted">
                                                    {{ $member['name'] }}                                                    
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        @php
                                            $status = $team->registration_log->status;
                                            $badgeStyles = [
                                                'approved' => 'bg-success',
                                                'pending' => 'bg-warning',
                                                'rejected' => 'bg-danger'
                                            ];
                                        @endphp
                                        <span class="badge {{ $badgeStyles[$status] ?? 'bg-secondary' }} text-white rounded-pill">
                                            {{ ucfirst($status) }}
                                        </span>
                                    </td>
                                    <td class="text-end px-4">
                                        @if($team->registration_log->status !== 'approved')
                                            <div class="d-flex justify-content-end gap-2">
                                                <form method="POST" 
                                                      action="/admin/fests/{{ $fest->id }}/events/{{ $event->id }}/teams/{{ $team->id }}/approve">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-outline-success rounded-pill px-3">
                                                        <i class="bi bi-check-circle me-1"></i>Approve
                                                    </button>
                                                </form>
                                                
                                                <form method="POST" 
                                                      action="/admin/fests/{{ $fest->id }}/events/{{ $event->id }}/teams/{{ $team->id }}/reject">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                        <i class="bi bi-x-circle me-1"></i>Reject
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        No teams have registered yet
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection