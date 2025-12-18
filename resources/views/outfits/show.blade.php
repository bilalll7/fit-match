@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-24 text-center">

    <img src="{{ asset('storage/'.$outfit->image) }}"
         class="h-96 mx-auto rounded-3xl shadow">

    <h1 class="text-3xl font-semibold mt-6">
        {{ $outfit->name }}
    </h1>

    <span class="inline-block mt-3 bg-green-100 px-4 py-1 rounded-full">
        {{ $outfit->category->name }}
    </span>
</div>
@endsection
