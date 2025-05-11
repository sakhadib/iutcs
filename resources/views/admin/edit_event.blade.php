@extends('layouts.main')

@section('main')
<div class="container py-8 mx-auto max-w-4xl">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Form Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-4">
            <h1 class="text-2xl font-bold text-white">Edit {{$event->title}} Event for {{$fest->title}}</h1>
            <p class="text-blue-100">Fill out the form below to add a new event to the festival</p>
        </div>

        <!-- Main Form -->
        <form action="/admin/fest/{{$fest->id}}/event/{{$event->id}}/edit" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            <input type="hidden" name="fest_id" value="{{ $fest_id ?? '' }}">
            <input type="hidden" name="event_id" value="{{ $event->id ?? '' }}">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Event Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Event Title *</label>
                        <input type="text" id="title" name="title" required
                            value="{{ $event->title ?? '' }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Enter event title">
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description *</label>
                        <textarea id="description" name="description" rows="4" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Describe the event in detail">
                            {{ $event->description ?? '' }}
                        </textarea>
                    </div>

                    <!-- Rules -->
                    <div>
                        <label for="rules" class="block text-sm font-medium text-gray-700 mb-1">Rules</label>
                        <textarea id="rules" name="rules" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="List the event rules (markdown supported)">{{ $event->rules ?? '' }}</textarea>
                    </div>

                    <!-- Rulebook Link -->
                    <div>
                        <label for="rulebook-link" class="block text-sm font-medium text-gray-700 mb-1">Rulebook Link</label>
                        <input type="url" id="rulebook-link" name="rulebook_link"
                            value="{{ $event->rulebook_link ?? '' }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="https://example.com/rulebook.pdf">
                    </div>

                    <!-- Prizes -->
                    <div>
                        <label for="prizes" class="block text-sm font-medium text-gray-700 mb-1">Prizes</label>
                        <textarea id="prizes" name="prizes" rows="2"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Describe prizes for winners (markdown supported)">
                            {{ $event->prizes ?? '' }}
                        </textarea>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Event Image -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Event Image</label>
                        <div class="mt-1">
                            <input id="image" name="image" type="file" accept="image/*" 
                                class="hidden" onchange="previewImage(event)">
                            <div id="image-preview-container" class="{{ $event->image ? '' : 'hidden' }} relative">
                                <img id="image-preview" class="w-full h-auto rounded-lg" 
                                    src="{{ $event->image ? asset($event->image) : '' }}" 
                                    alt="Event Image Preview">
                                <button type="button" onclick="removeImage()" 
                                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                                    &times;
                                </button>
                            </div>
                            <button type="button" onclick="document.getElementById('image').click()" 
                                class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                {{ $event->image ? 'Change Image' : 'Upload Image' }}
                            </button>
                        </div>
                    </div>

                    <script>
                        function previewImage(event) {
                            const file = event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    const previewContainer = document.getElementById('image-preview-container');
                                    const previewImage = document.getElementById('image-preview');
                                    previewImage.src = e.target.result;
                                    previewContainer.classList.remove('hidden');
                                };
                                reader.readAsDataURL(file);
                            }
                        }

                        function removeImage() {
                            const imageInput = document.getElementById('image');
                            const previewContainer = document.getElementById('image-preview-container');
                            const previewImage = document.getElementById('image-preview');
                            imageInput.value = '';
                            previewImage.src = '';
                            previewContainer.classList.add('hidden');
                        }
                    </script>

                    <!-- Date & Time -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date *</label>
                            <input type="datetime-local" id="start_date" name="start_date" required
                                value="{{ $event->start_date ? date('Y-m-d\TH:i', strtotime($event->start_date)) : '' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                            <input type="datetime-local" id="end_date" name="end_date"
                                value="{{ $event->end_date ? date('Y-m-d\TH:i', strtotime($event->end_date)) : '' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        </div>
                    </div>

                    <!-- Registration Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="registration_closing_date" class="block text-sm font-medium text-gray-700 mb-1">Registration Deadline</label>
                            <input type="datetime-local" id="registration_closing_date" name="registration_closing_date"
                                value="{{ $event->registration_closing_date ? date('Y-m-d\TH:i', strtotime($event->registration_closing_date)) : '' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        </div>
                        <div>
                            <label for="registration_fee" class="block text-sm font-medium text-gray-700 mb-1">Registration Fee</label>
                            <input type="text" id="registration_fee" name="registration_fee"
                                value="{{ $event->registration_fee ?? '' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="number only (in BDT)">
                        </div>
                    </div>

                    <!-- Team Size -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="min_team_size" class="block text-sm font-medium text-gray-700 mb-1">Min Team Size</label>
                            <input type="number" id="min_team_size" name="min_team_size" min="1"
                                value="{{ $event->min_team_size ?? '' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="e.g. 1">
                        </div>
                        <div>
                            <label for="max_team_size" class="block text-sm font-medium text-gray-700 mb-1">Max Team Size</label>
                            <input type="number" id="max_team_size" name="max_team_size" min="1"
                                value="{{ $event->max_team_size ?? '' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="e.g. 5">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Section - Full Width -->
            <div class="mt-6 space-y-6">
                <!-- Location -->
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                    <input type="text" id="location" name="location"
                        value="{{ $event->location ?? '' }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        placeholder="Venue or online platform">
                </div>

                <!-- Medium -->
                <div>
                    <label for="medium" class="block text-sm font-medium text-gray-700 mb-1">Medium</label>
                    <input type="text" id="medium" name="medium"
                        value="{{ $event->medium ?? '' }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        placeholder="e.g. Online, Offline, Hybrid">
                </div>

                <!-- Judges -->
                <div>
                    <label for="judges" class="block text-sm font-medium text-gray-700 mb-1">Judges</label>
                    <textarea id="judges" name="judges" rows="2"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        placeholder="List of judges (if any)">
                        {{ $event->judges ?? '' }}
                    </textarea>
                </div>

                <!-- Registration Link -->
                <div>
                    <label for="registration_link" class="block text-sm font-medium text-gray-700 mb-1">Registration Link (optional)</label>
                    <input type="url" id="registration_link" name="registration_link"
                        value="{{ $event->registration_link ?? '' }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        placeholder="https://example.com/register">
                </div>

                <!-- Contact Info -->
                <div>
                    <label for="contact" class="block text-sm font-medium text-gray-700 mb-1">Contact Information</label>
                    <textarea id="contact" name="contact" rows="2"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        placeholder="Contact person details or helpline">
                        {{ $event->contact ?? '' }}
                    </textarea>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="mt-8 flex justify-end space-x-3">
                <a href="fest/{{$festId}}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 border border-transparent rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                    Update {{ $event->title ?? 'Event' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection