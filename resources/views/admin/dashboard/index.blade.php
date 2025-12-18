@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Dashboard Admin</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-sm text-gray-500">Total Style</h3>
            <p class="text-2xl font-bold">10</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-sm text-gray-500">Total Outfit</h3>
            <p class="text-2xl font-bold">25</p>
        </div>
    </div>
@endsection
