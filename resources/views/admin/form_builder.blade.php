@extends('layouts.main')

@section('main')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12">
        <div class="container mx-auto px-4">
            <!-- Header Section -->
            <div class="mb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">
                    <span class="text-indigo-600">{{ $fest->title }}</span> | {{ $event->title }} Form Builder
                </h1>
                <div class="w-20 h-1 bg-indigo-500 mb-6 rounded-full"></div>
                <p class="text-gray-600 max-w-2xl">
                    Basic user information will be collected automatically. Use this form builder to add additional questions for your participants.
                </p>
            </div>
            
            <!-- Form Builder & Preview Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <!-- Form Builder Card -->
                <div class="bg-white rounded-xl shadow-xl overflow-hidden transform transition hover:scale-[1.01] duration-300">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-5">Add New Question</h2>
                        <form action="/admin/questions/add" method="POST" id="form-builder-form">
                            @csrf
                            <div class="mb-5">
                                <label for="question" class="block text-sm font-medium text-gray-700 mb-1">Question</label>
                                <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" id="question" name="question" required>
                            </div>
                            <div class="mb-5">
                                <label class="block text-sm font-medium text-gray-700 mb-3">Question Type</label>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="type-card cursor-pointer border-2 border-gray-200 rounded-lg p-4 text-center transition-all hover:shadow-md" data-type="text">
                                        <div class="text-indigo-500 mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </div>
                                        <div class="font-medium">Text Input</div>
                                    </div>
                                    <div class="type-card cursor-pointer border-2 border-gray-200 rounded-lg p-4 text-center transition-all hover:shadow-md" data-type="radio">
                                        <div class="text-indigo-500 mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div class="font-medium">Multiple Choice</div>
                                    </div>
                                </div>
                                <input type="hidden" id="type" name="type" required>
                            </div>
                            <div class="mb-5" id="options-container" style="display: none;">
                                <label for="options" class="block text-sm font-medium text-gray-700 mb-1">Options (comma separated)</label>
                                <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" id="options" name="options" placeholder="Option 1, Option 2, Option 3">
                            </div>
                            <input hidden type="text" name="event_id" value="{{$event->id}}">
                            <input hidden type="text" name="fest_id" value="{{$fest->id}}">
                            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 px-6 rounded-lg transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                Add Question
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Preview Card -->
                <div class="bg-white rounded-xl shadow-xl overflow-hidden transform transition hover:scale-[1.01] duration-300">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-5">Preview</h2>
                        <div id="preview" class="border border-gray-200 rounded-lg p-6 bg-gray-50">
                            <h6 id="preview-question" class="text-lg font-medium text-gray-800 mb-4">Question will appear here</h6>
                            <div id="preview-options" class="space-y-2"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Existing Questions Section -->
            <div class="bg-white rounded-xl shadow-xl overflow-hidden mb-8">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-5">Existing Questions</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Question</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Options</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($questions as $question)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $question->question }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $question->type == 'text' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                            {{ $question->type }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $question->options }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="/admin/questions/delete/{{$question->id}}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add click handler for type cards
            $('.type-card').click(function() {
                // Remove active class from all cards
                $('.type-card').removeClass('border-indigo-500 bg-indigo-50');
                // Add active class to clicked card
                $(this).addClass('border-indigo-500 bg-indigo-50');
                // Set the value of hidden type input
                $('#type').val($(this).data('type'));
                // Trigger change event to show/hide options
                $('#type').trigger('change');
            });
            
            $('#type').change(function() {
                if ($(this).val() == 'radio') {
                    $('#options-container').show();
                } else {
                    $('#options-container').hide();
                }
            });

            $('#question, #type, #options').on('input change', function() {
                var question = $('#question').val() || 'Question will appear here';
                var type = $('#type').val();
                var options = $('#options').val() ? $('#options').val().split(',') : [];

                $('#preview-question').text(question);

                if (type == 'radio') {
                    $('#preview-options').empty();
                    options.forEach(function(option) {
                        if(option.trim()) {
                            $('#preview-options').append(
                                '<div class="flex items-center">' +
                                    '<input class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" type="radio" name="preview-radio" value="' + option.trim() + '" id="option-' + option.trim() + '">' +
                                    '<label class="ml-2 text-gray-700" for="option-' + option.trim() + '">' + option.trim() + '</label>' +
                                '</div>'
                            );
                        }
                    });
                } else {
                    $('#preview-options').empty();
                    if(type == 'text') {
                        $('#preview-options').append('<input type="text" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Text answer" disabled>');
                    }
                }
            });
        });
    </script>
@endsection