@extends('layouts.app')

@section('title', 'Dasbor Admin')
@section('header_title', 'Dasbor Admin')

@section('content')
<div class="card">
    <div class="card-body">
        <h4>Selamat Datang di Panel Admin</h4>
        <p>Anda dapat mengelola master data dari sini.</p>
        <a href="{{ route('admin.mapel.index') }}" class="btn btn-primary">Kelola Mata Pelajaran</a>
    </div>
</div>
@endsection