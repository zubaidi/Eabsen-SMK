@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header"><h4>Tambah Kelas Binaan BK</h4></div>
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

        <form action="{{ route('admin.penugasan-bk.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label>Pilih Guru BK</label>
                <select name="bk_user_id" class="form-select" required>
                    <option value="">-- Pilih Guru BK --</option>
                    @foreach($guruBks as $bk)
                        <option value="{{ $bk->id }}">{{ $bk->nama }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group mb-4">
                <label>Pilih Kelas Binaan</label>
                <select name="kelas_id" class="form-select" required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelases as $kelas)
                        <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan Penugasan</button>
            <a href="{{ route('admin.penugasan-bk.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection