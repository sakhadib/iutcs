@extends('layouts.main')

@section('main')
<div class="container py-5">
    <!-- Header Section -->
    <div class="mb-5">
        <div style="border-left: 4px solid {{ $team->color }}; padding-left: 1rem;">
            <h1 class="display-5 fw-bold text-dark">{{ $team->name }}</h1>
            <p class="text-muted mb-0">{{ $fest->title }} - {{ $event->title }}</p>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="d-flex gap-2 mb-5">
        @if($team->registration_log->status !== 'approved')
            <form method="POST" action="/admin/fest/{{ $fest->id }}/event/{{ $event->id }}/team/{{ $team->id }}/approve">
                @csrf
                <button type="submit" class="btn btn-success px-4">
                    <i class="bi bi-check-circle me-2"></i>Approve Team
                </button>
            </form>
            <form method="POST" action="/admin/fest/{{ $fest->id }}/event/{{ $event->id }}/team/{{ $team->id }}/reject">
                @csrf
                <button type="submit" class="btn btn-danger px-4">
                    <i class="bi bi-x-circle me-2"></i>Reject Team
                </button>
            </form>
        @else
            <button type="submit" class="btn btn-success px-4 disabled">
                <i class="bi bi-check-circle me-2"></i>Team Approved
            </button>
        @endif
    </div>

    <!-- Team Info Section -->
    <div class="row g-4">
        <!-- Leader & Members -->
        <div class="col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-header" style="border-bottom: 2px solid {{ $team->color }}">
                    <h5 class="card-title mb-0">Team Structure</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="text-muted mb-3">Team Leader</h6>
                        <div class="d-flex align-items-center gap-3">
                            <div class="avatar" style="background: {{ $team->color }}; width: 40px; height: 40px; border-radius: 50%"></div>
                            <div>
                                <p class="mb-0 fw-bold">{{ $team->leader->name }}</p>
                                <small class="text-muted">{{ $team->leader->university }}</small>
                            </div>
                        </div>
                    </div>

                    <h6 class="text-muted mb-3">Team Members</h6>
                    @foreach($team->members as $member)
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="avatar" style="background: {{ $team->color }}; width: 40px; height: 40px; border-radius: 50%"></div>
                            <div>
                                <p class="mb-0">{{ $member->user->name }}</p>
                                <small class="text-muted">{{ $member->user->email }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Team Description -->
        <div class="col-lg-8">
            <div class="card shadow-sm h-100">
                <div class="card-header" style="border-bottom: 2px solid {{ $team->color }}">
                    <h5 class="card-title mb-0">Team Description</h5>
                </div>
                <div class="card-body markdown-body" style="overflow: auto; max-height: 400px;">
                    {!! Str::markdown($team->description) !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Registration Questions -->
    <div class="card shadow-sm mt-4">
        <div class="card-header" style="border-bottom: 2px solid {{ $team->color }}">
            <h5 class="card-title mb-0">Registration Answers</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                @foreach($questions as $question)
                    <div class="col-md-6">
                        <div class="p-3 border rounded">
                            <small class="text-muted d-block mb-1">Question {{ $loop->iteration }}</small>
                            <p class="fw-bold mb-2">{{ $question['question']->question }}</p>
                            <div class="answer-box p-2 rounded" style="background: {{ $team->color }}10; border: 1px solid {{ $team->color }}30">
                                {{ $question['answer'] ?? 'No answer provided' }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
    .markdown-body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif;
        line-height: 1.6;
    }
    .markdown-body h1, .markdown-body h2, .markdown-body h3 {
        border-bottom: 1px solid #eaecef;
        padding-bottom: 0.3em;
    }
    .markdown-body code {
        background-color: rgba(175,184,193,0.2);
        padding: 0.2em 0.4em;
        border-radius: 6px;
    }
    .markdown-body pre {
        background-color: #f6f8fa;
        padding: 1em;
        border-radius: 6px;
        overflow: auto;
    }
    .markdown-body blockquote {
        color: #6a737d;
        border-left: 4px solid #dfe2e5;
        margin: 0;
        padding-left: 1em;
    }
</style>
@endsection