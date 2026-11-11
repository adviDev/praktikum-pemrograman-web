<div class="mb-3">
    <x-form-input label="NIM" name="nim" :value="$mahasiswa->nim" maxlength="15" required autofocus/>
</div>
<div class="mb-3">
    <x-form-input label="Nama mahasiswa" name="nama" :value="$mahasiswa->nama" maxlength="120" required/>
</div>
<div class="mb-3">
    <x-form-input label="Email" 
    type="email" name="email" :value="$mahasiswa->email" maxlength="120" required/>
</div>
<div class="mb-3">
    <label class="form-label d-block">Jenis Kelamin</label>
    
    <div class="form-check form-check-inline">
        <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror" 
               type="radio" 
               name="jenis_kelamin" 
               id="jk_l" 
               value="L" 
               {{ old('jenis_kelamin', $mahasiswa->jenis_kelamin ?? 'L') === 'L' ? 'checked' : '' }} required>
        <label class="form-check-label" for="jk_l">Laki-laki</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror" 
               type="radio" 
               name="jenis_kelamin" 
               id="jk_p" 
               value="P" 
               {{ old('jenis_kelamin', $mahasiswa->jenis_kelamin) === 'P' ? 'checked' : '' }} required>
        <label class="form-check-label" for="jk_p">Perempuan</label>
    </div>
    @error('jenis_kelamin')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <x-form-input label="angkatan" name="angkatan" :value="$mahasiswa->angkatan" maxlength="10" required/>
</div>
<div class="mb-3">
    <x-form-input label="Program Studi" name="program_studi" :value="$mahasiswa->program_studi" maxlength="50" required/>
</div>
