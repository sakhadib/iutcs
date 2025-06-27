@extends('layouts.main')

@section('main')

@if ($errors->any())
	<div class="alert alert-danger">
		<ul class="mb-0">
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif



<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-3">
                Register for <span class="text-indigo-600">{{$fest->title}}</span>'s
                <span class="text-indigo-600">{{$event->title}}</span>
            </h1>
            <p class="text-lg text-gray-500">Please complete the registration form below</p>
        </div>

        <form action="/fest/{{$fest->id}}/event/{{$event->id}}/register" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

			<!-- Team Selection Section -->
			@if($my_teams->isEmpty())
				<div class="bg-white rounded-xl shadow-sm p-6 sm:p-8 border border-gray-100">
					<div class="space-y-6">
						<p class="text-lg text-gray-500">You don't have any teams. Or may be you are not the owner. Please create a team to register.</p>
						<a href="/team/create" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition-all transform hover:-translate-y-0.5 shadow-md hover:shadow-lg">
							Create Team
						</a>
					</div>
				</div>
			@else
				<div class="bg-white rounded-xl shadow-sm p-6 sm:p-8 border border-gray-100">
					<div class="space-y-6">
						<div class="pb-4 border-b border-gray-100">
							<h2 class="text-xl font-semibold text-gray-900">Select Your Team</h2>
							<p class="mt-1 text-sm text-gray-500">Choose the team you'll be participating with</p>
						</div>
						
						<div class="team-selection-container mt-4">
							@foreach ($my_teams as $team)
							<div class="team-option">
								<input type="radio" name="team_id" id="team_{{$team->id}}" value="{{$team->id}}" 
									class="peer hidden" {{ $loop->first ? 'checked' : '' }} required>
									
								<label for="team_{{$team->id}}" 
									class="team-card flex flex-col  rounded-xl border-2 cursor-pointer transition-all overflow-hidden"
									style="--team-color: {{$team->color}};">
									
									<!-- Team color banner -->
									<div class="h-2 w-full" style="background-color: {{$team->color}};"></div>
									
									<div class="p-5 flex-grow flex flex-col">
										<!-- Team details -->
										<div class="space-y-1 mt-auto">
											<h3 class="font-medium text-gray-900 text-lg line-clamp-1" title="{{$team->name}}">
												{{$team->name}}
											</h3>
											<div class="flex items-center text-sm text-gray-500">
												<span class="w-2.5 h-2.5 rounded-full mr-2" style="background-color: {{$team->color}};"></span>
												<span class="truncate">Team #{{$team->id}}</span>
											</div>
										</div>
									</div>
								</label>
							</div>
							@endforeach
						</div>
					</div>
				</div>

				<style>
					.team-selection-container {
						display: grid;
						grid-template-columns: repeat(1, 1fr);
						gap: 1rem;
					}
					
					@media (min-width: 640px) {
						.team-selection-container {
							grid-template-columns: repeat(2, 1fr);
						}
					}
					
					.team-card {
						border-color: #e5e7eb;
						transition: all 0.2s ease;
					}
					
					.team-card:hover {
						border-color: #d1d5db;
						transform: translateY(-3px);
						box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
					}
					
					.peer:checked + .team-card {
						border-color: var(--team-color);
						background-color: #f9fafb;
					}
					
					.select-icon {
						opacity: 0;
						transform: scale(0.8);
						transition: all 0.2s ease;
					}
					
					.peer:checked + .team-card .select-icon {
						opacity: 1;
						transform: scale(1);
					}
					
					/* Text truncation */
					.line-clamp-1 {
						display: -webkit-box;
						-webkit-line-clamp: 1;
						-webkit-box-orient: vertical;
						overflow: hidden;
					}
				</style>
			@endif

            <!-- Questions Section -->
            <div class="space-y-8">
                @foreach ($questions as $question)
                    @php $options = explode(',', $question->options); @endphp
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <div class="space-y-4">
                            <div class="pb-2 border-b border-gray-100">
                                <h3 class="text-lg font-medium text-gray-900">{{$question->question}}</h3>
                                @if($question->description)
                                <p class="mt-1 text-sm text-gray-500">{{$question->description}}</p>
                                @endif
                            </div>
                            
                            @if ($question->type == 'text')
                                <input type="text" 
                                       name="question_{{$question->id}}" 
                                       placeholder="Type your answer here"
                                       class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" required>
                            
                            @elseif ($question->type == 'radio')
                                <div class="space-y-3">
                                    @foreach ($options as $option)
                                    <label class="flex items-center space-x-4 p-3 rounded-lg border border-gray-100 hover:bg-gray-50 cursor-pointer">
                                        <input type="radio" 
                                               name="question_{{$question->id}}" 
                                               value="{{$option}}"
                                               class="h-5 w-5 text-indigo-600 border-gray-300 focus:ring-indigo-500" required>
                                        <span class="text-gray-700">{{$option}}</span>
                                    </label>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Submission Section -->
            <div class="bg-white rounded-xl shadow-sm p-8 border border-gray-100">
                <div class="space-y-6 text-center">
                    <div class="space-y-2">
                        <h2 class="text-2xl font-bold text-gray-900">Ready to Submit?</h2>
                        <p class="text-gray-500">
                            By submitting, you agree to our terms and conditions. Please verify all information before final submission.
                        </p>
                    </div>
                    <button type="submit" class="inline-flex items-center px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition-all transform hover:-translate-y-0.5 shadow-md hover:shadow-lg">
                        Submit Registration
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection