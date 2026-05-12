@extends('layouts.app')

@section('title', 'Admin Profile')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="mb-6">
        <h1 class="text-3xl font-black text-gray-900">Edit Admin Profile</h1>
        <p class="text-gray-600 mt-2">Nama dan foto admin tersimpan di database + upload ke storage Laravel.</p>
    </div>

    <div class="bg-white rounded-3xl shadow-xl border border-gray-100">
        @include('layouts.admin-profile')
    </div>

</div>
@endsection

