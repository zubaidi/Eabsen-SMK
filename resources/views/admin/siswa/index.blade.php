@extends('layouts.app')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Daftar Siswa</h5>
            
            <!-- Kumpulan Tombol Aksi -->
            <div>
                <!-- Tombol Download Template -->
                <a href="{{ route('admin.siswa.download-template') }}" class="btn btn-success btn-sm me-2">
                    <i class="fas fa-file-excel"></i> Download Template
                </a>
                
                <!-- Tombol Buka Modal Upload -->
                <button type="button" class="btn btn-info btn-sm me-2 text-white" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#importModal">
                    <i class="fas fa-upload"></i> Import Excel
                </button>
                <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary btn-sm">Tambah Siswa</a>
                <!-- Tombol Tambah Manual -->
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($siswas as $siswa)
                    <tr>
                        <td>{{ $siswa->nis }}</td>
                        <td>{{ $siswa->nama }}</td>
                        <td>
                           <!-- Tombol Edit -->
                            <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="btn btn-warning btn-sm " class="d-inline">Edit</a>
    
                            <!-- Tombol Hapus -->
                            <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal Import Excel -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="importModalLabel">Import Data Siswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('admin.siswa.import') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
              <div class="mb-3">
                  <label for="file" class="form-label">Pilih File Excel / CSV</label>
                  <input class="form-control" type="file" id="file" name="file" accept=".xlsx, .xls, .csv" required>
                  <small class="text-muted mt-2 d-block">Pastikan format kolom sesuai dengan template yang di-download.</small>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Mulai Import</button>
          </div>
      </form>
    </div>
  </div>
</div>
</section>
@endsection