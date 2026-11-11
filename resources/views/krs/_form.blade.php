<div class="mb-3">
    <label for="mahasiswa_id" class="form-label">Mahasiswa</label>
    <select name="mahasiswa_id" id="mahasiswa_id" class="form-select @error('mahasiswa_id') is-invalid @enderror" required>
        <option value="">-- Pilih Mahasiswa --</option>
        @foreach ($daftarMahasiswa as $mhs)
            <option value="{{ $mhs->id }}" {{ old('mahasiswa_id', $krs->mahasiswa_id) == $mhs->id ? 'selected' : '' }}>
                {{ $mhs->nim }} - {{ $mhs->nama }}
            </option>
        @endforeach
    </select>
    @error('mahasiswa_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <x-form-input label="Tahun Akademik" name="tahun_akademik" :value="$krs->tahun_akademik" placeholder="Contoh: 2026/2027" maxlength="9" required/>
</div>

<div class="mb-3">
    <label class="form-label d-block">Semester</label>
    <div class="form-check form-check-inline">
        <input class="form-check-input @error('semester') is-invalid @enderror" 
               type="radio" 
               name="semester" 
               id="ganjil" 
               value="Ganjil" 
               {{ old('semester', $krs->semester ?? 'Ganjil') === 'Ganjil' ? 'checked' : '' }} required>
        <label class="form-check-label" for="ganjil">Ganjil</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input @error('semester') is-invalid @enderror" 
               type="radio" 
               name="semester" 
               id="genap" 
               value="Genap" 
               {{ old('semester', $krs->semester) === 'Genap' ? 'checked' : '' }} required>
        <label class="form-check-label" for="genap">Genap</label>
    </div>
    @error('semester')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
        @foreach (['draft' => 'Draft', 'diajukan' => 'Diajukan', 'disetujui' => 'Disetujui', 'ditolak' => 'Ditolak'] as $val => $label)
            <option value="{{ $val }}" {{ old('status', $krs->status ?? 'draft') === $val ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@if ($krs->exists)
<div class="mb-3">
    <label class="form-label">Total SKS</label>
    <input type="text" class="form-control" value="{{ $krs->mataKuliah?->sum('sks') ?? 0 }}" readonly disabled>
    <div class="form-text">Total SKS dihitung otomatis dari akumulasi SKS mata kuliah yang diambil.</div>
</div>
@endif
