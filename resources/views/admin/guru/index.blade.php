@extends('layouts.app')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title">Daftar Guru</h5>
            
            <div>
                <!-- Tombol Download Template -->
                <a href="{{ route('admin.guru.download-template') }}" class="btn btn-success btn-sm me-2">
                    <i class="fas fa-file-excel"></i> Template
                </a>
                
                <!-- Tombol Modal Upload -->
                <button type="button" class="btn btn-info btn-sm me-2 text-white" data-bs-toggle="modal" data-bs-target="#importGuruModal">
                    <i class="fas fa-upload"></i> Import
                </button>

                <!-- Tombol Tambah Manual -->
                <a href="{{ route('admin.guru.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah
                </a>
            </div>
        </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>NIP/NIK</th>
                        <th>Nama Lengkap</th>
                        <th>Email Login</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gurus as $guru)
                    <tr>
                        <td>{{ $guru->nip_nik }}</td>
                        <td>{{ $guru->nama }}</td>
                        <td>{{ $guru->email }}</td>
                        <td>
                        <!-- Tombol Edit -->
                        <a href="{{ route('admin.guru.edit', $guru->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <!-- Tombol Hapus -->
                        <form action="{{ route('admin.guru.destroy', $guru->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data akun guru ini?')">
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
    <!-- Modal Import Guru -->
<div class="modal fade" id="importGuruModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Import Data Guru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('admin.guru.import') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
              <div class="mb-3">
                  <label class="form-label">Pilih File Excel (.xlsx)</label>
                  <input class="form-control" type="file" name="file" accept=".xlsx, .xls, .csv" required>
                  <small class="text-muted mt-2 d-block">Gunakan format file dari template yang disediakan.</small>
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