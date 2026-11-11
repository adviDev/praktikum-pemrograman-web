<div class="mb-3">
    <x-form-input label="Kode Mata Kuliah" name="kode_mk" :value="$matakuliah->kode_mk" maxlength="15" required autofocus/>
</div>
<div class="mb-3">
    <x-form-input label="Nama Mata Kuliah" name="nama_mk" :value="$matakuliah->nama_mk" maxlength="50" required/>
</div>
<div class="mb-3">
    <x-form-input label="SKS" name="sks" :value="$matakuliah->sks" maxlength="2" required/>
</div>