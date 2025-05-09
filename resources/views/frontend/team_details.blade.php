@extends('layouts.main')

@section('main')
@php
    $team = $objects['team'];
    $team_members = $objects['team_members'];
    $user_emails = $objects['user_emails'];
    $isTeamLead = session('user_id') == $team->team_lead;
@endphp

<!-- Edit Team Modal -->
<div class="modal fade" id="editTeamModal" tabindex="-1" aria-labelledby="editTeamModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="/team/edit" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editTeamModalLabel">Edit Team Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="team_id" value="{{ $team->id }}">
                    
                    <div class="mb-3">
                        <label class="form-label">Team Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $team->name }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="5" required>{{ $team->description }}</textarea>
                        <small class="text-muted">Markdown supported</small>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Team Color</label>
                        <input type="color" name="color" class="form-control form-control-color" value="{{ $team->color }}" title="Choose team color">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container py-12">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            @php
                function getComplementaryColor($hexColor) {
                    $hexColor = ltrim($hexColor, '#');
                    $r = 255 - hexdec(substr($hexColor, 0, 2));
                    $g = 255 - hexdec(substr($hexColor, 2, 2));
                    $b = 255 - hexdec(substr($hexColor, 4, 2));
                    return sprintf('#%02x%02x%02x', $r, $g, $b);
                }
                $complementaryColor = getComplementaryColor($team->color);
            @endphp

            <div class="team-header rounded-3 p-6 mb-6 position-relative overflow-hidden" 
                 style="background: {{ $team->color }}; --team-color: {{ $team->color }}">
                <div class="position-relative z-10">
                    <h1 class="display-5 fw-bold mb-3 team-header-text" 
                        style="color: {{ $complementaryColor }}">{{ $team->name }}</h1>
                    <div class="d-flex align-items-center gap-2">
                        <div class="badge bg-white/20 team-header-text">{{ $team->color }}</div>
                        <div class="text-white/80 team-header-text">{{ $team_members->count() }} members</div>
                    </div>
                </div>
            </div>

            <div class="row g-5">
                <!-- Main Content -->
                <div class="col-md-8">
                    <div class="mb-6">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-body p-5">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h2 class="h4 mb-0">Team Description</h2>
                                    @if($isTeamLead)
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editTeamModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                        </svg>
                                    </button>
                                    @endif
                                </div>
                                <div class="prose text-muted">
                                    {!!  Str::markdown($team->description) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-5">
                            <h2 class="h3 mb-4">Team Members</h2>
                            <div class="row g-3">
                                @foreach ($team_members as $member)
                                <div class="col-12">
                                    <div class="d-flex align-items-center gap-3 p-3 rounded-2 bg-light position-relative">
                                        @if($isTeamLead && $member->role !== 'team-lead')
                                        <form action="/team/remove/member" method="POST" class="position-absolute end-0 top-50 translate-middle-y me-3">
                                            @csrf
                                            <input type="hidden" name="team_id" value="{{ $team->id }}">
                                            <input type="hidden" name="team_member_id" value="{{ $member->id }}">
                                            <button type="submit" class="btn btn-link text-danger p-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                </svg>
                                            </button>
                                        </form>
                                        @endif
                                        
                                        <div class="avatar avatar-lg" style="background-color: {{ $team->color }}20">
                                            <span class="avatar-text" style="color: {{ $team->color }}">
                                                {{ strtoupper(substr($member->user->name, 0, 1)) }}
                                            </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="mb-0">{{ $member->user->name }}</h5>
                                            <small class="text-muted">{{ $member->user->email }}</small>
                                        </div>
                                        <div class="badge rounded-pill py-2 px-4 mr-8" 
                                             style="background-color: {{ $team->color }}10; color: {{ $team->color }}">
                                            {{ $member->role === 'team-lead' ? 'Team Lead' : ucfirst($member->role) }}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Sidebar -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-3 sticky-top" style="top: 2rem">
                        <div class="card-body p-4">
                            @if ($isTeamLead)
                            <h3 class="h5 mb-4">Invite Members</h3>
                            <form action="/team/add/member" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Email address</label>
                                    <input type="email" 
                                           id="email"
                                           name="email" 
                                           class="form-control"
                                           placeholder="team@member.com"
                                           autocomplete="off">
                                    <div id="email-suggestions" class="suggestion-list"></div>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Role</label>
                                    <input type="text" 
                                           name="role" 
                                           class="form-control" 
                                           placeholder="Enter role (e.g., member)">
                                </div>

                                <input type="hidden" name="team_id" value="{{ $team->id }}">
                                
                                <button type="submit" 
                                        class="btn w-100 d-flex align-items-center justify-content-center gap-2"
                                        style="background: {{ $team->color }}; color: white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                                        <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
                                    </svg>
                                    Add Member
                                </button>
                            </form>
                            @else
                            <div class="text-center p-4">
                                <div class="mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-people text-muted" viewBox="0 0 16 16">
                                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                                    </svg>
                                </div>
                                <p class="text-muted mb-0">Contact the team lead to add new members:</p>
                                <div class="mt-2 fw-bold text-primary">{{ $team_members->firstWhere('role', 'team-lead')->user->name }}</div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .avatar {
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }
    .avatar-lg { width: 48px; height: 48px }
    .avatar-text { font-weight: 500; line-height: 1 }
    
    .prose {
        max-width: 60ch;
        line-height: 1.6;
        color: #525252;
    }
    
    .suggestion-list {
        position: absolute;
        background: white;
        width: calc(100% - 2rem);
        max-height: 200px;
        overflow-y: auto;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        border-radius: 8px;
        z-index: 10;
    }
    
    .suggestion-list div {
        padding: 8px 16px;
        cursor: pointer;
        transition: background 0.2s;
    }
    
    .suggestion-list div:hover {
        background: #f8f9fa;
    }
    
    .team-header::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(45deg, transparent 70%, rgba(255,255,255,0.15));
    }

    .bi-trash {
        transition: transform 0.2s ease;
    }
    .bi-trash:hover {
        transform: scale(1.2);
    }
    .position-absolute form {
        z-index: 1;
    }
</style>

<script>
    // Keep existing color contrast logic
    const emailInput = document.getElementById('email');
    const suggestionsContainer = document.getElementById('email-suggestions');
    const allUserEmails = @json($user_emails->pluck('email'));

    emailInput.addEventListener('input', function() {
        const inputText = this.value.toLowerCase();
        suggestionsContainer.innerHTML = '';

        if (inputText.length > 0) {
            const matchingEmails = allUserEmails.filter(email => 
                email.toLowerCase().includes(inputText)
            );

            matchingEmails.forEach(email => {
                const suggestion = document.createElement('div');
                suggestion.textContent = email;
                suggestion.addEventListener('click', () => {
                    emailInput.value = email;
                    suggestionsContainer.innerHTML = '';
                });
                suggestionsContainer.appendChild(suggestion);
            });
        }
    });

    document.addEventListener('click', (e) => {
        if (!emailInput.contains(e.target)) {
            suggestionsContainer.innerHTML = '';
        }
    });
</script>
@endsection