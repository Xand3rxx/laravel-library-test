@extends('layouts.app')
@section('title', 'Authors Page')
@section('content')

    <div class="flex justify-center mt-10">
        <div class="rounded-lg shadow-lg bg-white max-w-sm">
            <img class="rounded-t-lg"
                src="https://mdbootstrap.com/img/new/standard/nature/182.jpg" alt="" />
            <div class="p-6 flex flex-col justify-start">
                <h3 class="text-gray-900 text-2xl font-medium mb-2">
                    {{ !empty($author['name']) ? Str::title($author['name']) : '-' }}</h3>
                <h5 class="text-gray-600 text-base mb-1">
                    <span class="font-bold">Country: </span>{{ !empty($author['country']) ? Str::title($author['country']) : '-' }}
                </h5>
                <h5 class="text-gray-600 text-base">
                    <span class="font-bold">Date of Birth: </span>{{ Carbon\Carbon::parse($author['dob'], 'UTC')->isoFormat('MMMM Do YYYY') }}</h5>
                <div class="pt-4">
                    <a href="{{ route('authors.index') }}"
                        class="relative flex-none rounded-md text-sm font-semibold leading-6 py-1.5 px-3 bg-sky-500/40 bg-gray-800 text-white shadow-sm transition duration-150 ease-in-out">Author
                        List</a>
                </div>
            </div>
        </div>
    </div>
@endsection
