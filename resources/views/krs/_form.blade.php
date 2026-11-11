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

<div class="mb-3">
    <label class="form-label fw-semibold">Pilih Mata Kuliah yang Diambil</label>
    <div class="table-responsive border rounded" style="max-height: 280px; overflow-y: auto;">
        <table class="table table-sm table-hover align-middle mb-0">
            <thead class="table-light sticky-top">
                <tr>
                    <th width="40" class="text-center">#</th>
                    <th width="120">Kode MK</th>
                    <th>Nama Mata Kuliah</th>
                    <th width="80" class="text-center">SKS</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $selectedMk = old('mata_kuliah_id', $krs->mataKuliah?->pluck('id')->toArray() ?? []);
                @endphp
                @forelse ($daftarMataKuliah as $mk)
                    <tr>
                        <td class="text-center">
                            <input class="form-check-input" type="checkbox" name="mata_kuliah_id[]" value="{{ $mk->id }}" id="mk_{{ $mk->id }}"
                                {{ in_array($mk->id, $selectedMk) ? 'checked' : '' }}>
                        </td>
                        <td><label for="mk_{{ $mk->id }}" class="mb-0 fw-semibold">{{ $mk->kode_mk }}</label></td>
                        <td><label for="mk_{{ $mk->id }}" class="mb-0">{{ $mk->nama_mk }}</label></td>
                        <td class="text-center"><span class="badge text-bg-secondary">{{ $mk->sks }}</span></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-2">Tidak ada data mata kuliah.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @error('mata_kuliah_id')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

@if ($krs->exists)
<div class="mb-3">
    <label class="form-label">Total SKS Saat Ini</label>
    <input type="text" class="form-control bg-light" value="{{ $krs->mataKuliah?->sum('sks') ?? 0 }}" readonly disabled>
    <div class="form-text">Total SKS akan otomatis terbarui sesuai mata kuliah yang dicentang di atas.</div>
</div>
@endif
