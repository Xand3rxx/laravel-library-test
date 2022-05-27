@extends('layouts.app')
@section('title', 'Authors List')
@section('content')

    <div class="px-4 py-4">
        <div class="hidden sm:flex items-center space-x-4 min-w-0"><a href="{{ route('authors.create') }}"
                class="relative flex-none rounded-md text-sm font-semibold leading-6 py-1.5 px-3 bg-sky-500/40  bg-gray-800 text-white shadow-sm">+Create
                Author</a></div>

    </div>

    <div class="relative rounded-xl overflow-auto">
        <div class="shadow-sm overflow-hidden my-8">
            <table class="border-collapse table-auto w-full text-sm">
                <thead class="bg-slate-900">
                    <tr>
                        <th class="border-b border-slate-600 font-medium p-4 pb-3 text-slate-200 text-center">#</th>
                        <th class="border-b border-slate-600 font-medium p-4 pb-3 text-slate-200 text-left">
                            Name</th>
                        <th class="border-b border-slate-600 font-medium p-4 pb-3 text-slate-200 text-left">
                            Country</th>
                        <th class="border-b border-slate-600 font-medium p-4 pb-3 text-slate-200 text-left">
                            Date of Birth</th>
                    </tr>
                </thead>
                <tbody class="bg-slate-800">
                    @foreach ($authors as $author)
                        <tr>
                            <td class="text-center border-b border-slate-100 p-4 text-slate-200">
                                {{ $loop->iteration }}</td>
                            <td class="border-b border-slate-100 p-4 text-slate-200">
                                {{ !empty($author['name']) ? Str::title($author['name']) : '-' }}</td>
                            <td class="border-b border-slate-100 p-4 text-slate-200">
                                {{ !empty($author['country']) ? Str::title($author['country']) : '-' }}</td>
                            <td class="border-b border-slate-100 p-4 text-slate-200">
                                {{ Carbon\Carbon::parse($author['dob'], 'UTC')->isoFormat('MMMM Do YYYY') }}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
