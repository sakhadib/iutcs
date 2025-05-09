@extends('layouts.main')

@section('main')
    <div class="vh-100">
        <div class="container">
            <div class="row mt-5">
                <div class="col-12">
                    <h1 class="display-6">Form Builder for {{$fest->title}} 's {{$event->title}}</h1>
                    <hr>
                    <p class="lead">
                        Basic user information such as name, email, phone number, university, gender, student ID, batch, and team details will be collected automatically. Use this form builder to add additional questions as needed.
                    </p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <form action="/admin/questions/add" method="POST" id="form-builder-form">
                                @csrf
                                <div class="mb-3">
                                    <label for="question" class="form-label">Question</label>
                                    <input type="text" class="form-control" id="question" name="question" required>
                                </div>
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type</label>
                                    <select class="form-select" id="type" name="type" required>
                                        <option value="" disabled selected>Select type</option>
                                        <option value="text">Text</option>
                                        <option value="radio">Radio</option>
                                    </select>
                                </div>
                                <div class="mb-3" id="options-container" style="display: none;">
                                    <label for="options" class="form-label">Options (comma separated)</label>
                                    <input type="text" class="form-control" id="options" name="options">
                                </div>
                                <input hidden type="text" name="event_id" value="{{$event->id}}">
                                <input hidden type="text" name="fest_id" value="{{$fest->id}}">
                                <button type="submit" class="btn btn-primary mt-3">Add Question</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                   <div class="card shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title">Preview</h5>
                            <div id="preview" class="border p-3">
                                <h6 id="preview-question">Question will appear here</h6>
                                <div id="preview-options"></div>
                            </div>
                        </div>
                   </div>
                </div>
            </div>


            <div class="row mt-5">
                <div class="col-12">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title">Existing Questions</h5>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Question</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Options</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($questions as $question)
                                        <tr>
                                            <td>{{ $question->question }}</td>
                                            <td>{{ $question->type }}</td>
                                            <td>{{ $question->options }}</td>
                                            <td><a href="/admin/questions/delete/{{$question->id}}" class="btn btn-danger btn-sm">Delete</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#type').change(function() {
                if ($(this).val() == 'radio') {
                    $('#options-container').show();
                } else {
                    $('#options-container').hide();
                }
            });

            $('#question, #type, #options').on('input change', function() {
                var question = $('#question').val();
                var type = $('#type').val();
                var options = $('#options').val().split(',');

                $('#preview-question').text(question);

                if (type == 'radio') {
                    $('#preview-options').empty();
                    options.forEach(function(option) {
                        $('#preview-options').append('<div class="form-check"><input class="form-check-input" type="radio" name="preview-radio" value="' + option.trim() + '" id="option-' + option.trim() + '"><label class="form-check-label" for="option-' + option.trim() + '">' + option.trim() + '</label></div>');
                    });
                } else {
                    $('#preview-options').empty();
                }
            });
        });
    </script>

@endsection