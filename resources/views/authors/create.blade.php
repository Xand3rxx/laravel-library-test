@extends('layouts.app')
@section('title', 'Create Author')
@section('content')
    <div class="flex justify-center w-2/3 mx-auto p-6 rounded-lg shadow-lg bg-white mt-10 bg-no-repeat bg-cover">

        <form class="flex flex-col items-center" method="POST" action="{{ route('authors.store') }}">
            @csrf
            <div class="pt-4">
                <input type="text" name="name"
                    class="form-control border border-solid border-gray-300  rounded px-4 py-2 w-64 @error('name') is-invalid @enderror"
                    placeholder="Enter author name" value="{{ old('name') }}" />
                @error('name')
                    <x-alert :message="$message" />
                @enderror
            </div>

            <div class="pt-4">
                <input type="text" name="country"
                    class="form-control border border-solid border-gray-300 rounded px-4 py-2 w-64 @error('country') is-invalid @enderror "
                    placeholder="Enter country of origin" value="{{ old('country') }}" />
                @error('country')
                    <x-alert :message="$message" />
                @enderror
            </div>

            <div class="pt-4">
                <input type="date" name="dob"
                    class="form-control border border-solid border-gray-300 rounded px-4 py-2 w-64 @error('dob') is-invalid @enderror"
                    value="{{ old('dob') }}" />
                @error('dob')
                    <x-alert :message="$message" />
                @enderror
            </div>

            <div class="pt-4">
                <button
                    class="relative flex-none rounded-md text-sm font-semibold leading-6 py-1.5 px-3 bg-sky-500/40 bg-gray-800 text-white shadow-sm transition duration-150 ease-in-out">Create</button>
            </div>
        </form>
    </div>
@endsection
