@extends('layouts.main')

@section('main')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white py-4 px-6 rounded-t-lg">
                    <h4 class="mb-0 text-xl font-semibold">Create New Team</h4>
                </div>
                <div class="p-6">
                    <form action="/teams/store" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Team Name</label>
                            <input type="text" class="appearance-none border rounded-full w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" value="{{ old('name') }}" placeholder="Enter team name">
                            @error('name')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="color" class="block text-gray-700 text-sm font-bold mb-2">Team Color</label>
                            <input type="color" class="form-control form-control-color w-full h-12 rounded-full border-gray-300  focus:ring focus:ring-indigo-200 focus:border-indigo-300" id="color" name="color" value="{{ old('color', '#cccccc') }}">
                            @error('color')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                            <textarea class="appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" rows="5" placeholder="Enter team description (Markdown supported)">{{ old('description') }}</textarea>
                            <p class="text-gray-500 text-xs italic">You can use <a href="https://www.markdownguide.org/basic-syntax/" target="_blank" class="text-blue-500 hover:underline">Markdown syntax</a> for formatting.</p>
                            @error('description')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-full focus:outline-none focus:shadow-outline">
                                Create Team
                            </button>
                            <a href="/teams" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection