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

        @php
            $team_count = count($teams);
            $participant_count = 0;
            $approved_count = 0;
            $pending_count = 0;
            $rejected_count = 0;
            foreach ($teams as $team) {
                $participant_count += count($team->members);
                $status = $team->registration_log->status ?? 'pending';
                if ($status === 'approved') $approved_count++;
                elseif ($status === 'pending') $pending_count++;
                elseif ($status === 'rejected') $rejected_count++;
            }
        @endphp

        <!-- Info Card -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-3 bg-light">
                    <div class="card-body d-flex flex-wrap gap-4 align-items-center justify-content-between">
                        <div>
                            <span class="fs-5 fw-semibold text-dark">
                                <i class="bi bi-people-fill me-2"></i>{{ $team_count }}
                            </span>
                            <span class="text-muted">Teams</span>
                        </div>
                        <div>
                            <span class="fs-5 fw-semibold text-dark">
                                <i class="bi bi-person-lines-fill me-2"></i>{{ $participant_count }}
                            </span>
                            <span class="text-muted">Participants</span>
                        </div>
                        <div>
                            <span class="badge bg-success fs-6 px-3 py-2">
                                <i class="bi bi-check-circle me-1"></i>{{ $approved_count }} Approved
                            </span>
                        </div>
                        <div>
                            <span class="badge bg-warning text-dark fs-6 px-3 py-2">
                                <i class="bi bi-hourglass-split me-1"></i>{{ $pending_count }} Pending
                            </span>
                        </div>
                        <div>
                            <span class="badge bg-danger fs-6 px-3 py-2">
                                <i class="bi bi-x-circle me-1"></i>{{ $rejected_count }} Rejected
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Info Card -->

        <div class="row mt-2 g-3">
            <div class="col-auto">
                <a href="/admin/event/{{$event->id}}/report" class="btn btn-outline-dark shadow-sm">
                    <i class="bi bi-printer me-2"></i>Print Report
                </a>
            </div>
            <div class="col-auto">
                <a href="/admin/event/{{$event->id}}/summary" class="btn btn-outline-danger shadow-sm">
                    <i class="bi bi-file-earmark-pdf me-2"></i>PDF Summary
                </a>
            </div>
            <div class="col-auto">
                <a href="/admin/event/{{$event->id}}/participants" class="btn btn-outline-secondary shadow-sm">
                    <i class="bi bi-people-fill me-2"></i>Participants Report
                </a>
            </div>
            <div class="col-auto">
                <a href="/admin/event/{{$event->id}}/csv" class="btn btn-outline-success shadow-sm">
                    <i class="bi bi-file-earmark-spreadsheet me-2"></i>Export CSV
                </a>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                    <div class="table-responsive">
                        <table id="teams-table" class="table table-hover align-middle mb-0">
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
                                        <a href="/admin/fest/{{ $fest->id }}/event/{{ $event->id }}/team/{{ $team->id }}" 
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
                                            $status = $team->registration_log->status ?? 'pending';
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
                                                      action="/admin/fest/{{ $fest->id }}/event/{{ $event->id }}/team/{{ $team->id }}/approve">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-outline-success rounded-pill px-3">
                                                        <i class="bi bi-check-circle me-1"></i>Approve
                                                    </button>
                                                </form>
                                                
                                                <form method="POST" 
                                                      action="/admin/fest/{{ $fest->id }}/event/{{ $event->id }}/team/{{ $team->id }}/reject">
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
<script>
    $(document).ready(function() {
        $('#teams-table').DataTable({
            "order": [],
            "pageLength": 50,
            "language": {
                "search": "Search teams:",
                "lengthMenu": "Show _MENU_ entries",
                "info": "Showing _START_ to _END_ of _TOTAL_ teams",
                "paginate": {
                    "previous": "&laquo;",
                    "next": "&raquo;"
                }
            }
        });
    });
</script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DataTables CDN -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"/>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#teams-table').DataTable({
            "order": [],
            "language": {
                "search": "Search teams:",
                "lengthMenu": "Show _MENU_ entries",
                "info": "Showing _START_ to _END_ of _TOTAL_ teams",
                "paginate": {
                    "previous": "&laquo;",
                    "next": "&raquo;"
                }
            }
        });
    });
</script>
@endsection