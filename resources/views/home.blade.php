@extends('layouts.template')   

@section('content')
<div class="card p-3">
    @auth
        <h6>Selamat Datang,</h6>
        <strong>{{ strtoupper(auth()->user()->name) }}</strong>
    @else
        <span>Silakan login terlebih dahulu</span>
    @endauth
</div>
@endsection
