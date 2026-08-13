@extends('layouts.app')

@section('title', 'Edit Kelas - Admin')
@section('header_title', 'Edit Kelas')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Edit Kelas</h4>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.kelas.update', $kelas->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group mb-4">
                    <label for="nama_kelas">Nama Kelas</label>
                    <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required>
                </div>
                
                <button type="submit" class="btn btn-warning">Update Data</button>
                <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</section>
@endsection