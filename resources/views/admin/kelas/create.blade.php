<form action="{{ route('admin.kelas.store') }}" method="POST">
    @csrf
    
    <!-- Tambahan Dropdown Jurusan -->
    <div class="form-group mb-3">
        <label for="jurusan_id">Jurusan</label>
        <select class="form-select" id="jurusan_id" name="jurusan_id" required>
            <option value="" selected disabled>-- Pilih Jurusan --</option>
            @foreach($jurusans as $jurusan)
                <option value="{{ $jurusan->id }}" {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                    {{ $jurusan->nama_jurusan }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group mb-4">
        <label for="nama_kelas">Nama Kelas</label>
        <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Contoh: X RPL 1" value="{{ old('nama_kelas') }}" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary">Batal</a>
</form>