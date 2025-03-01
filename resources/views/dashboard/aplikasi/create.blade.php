@extends('dashboard.layouts.main')

{{-- CSS dan JS --}}

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
    .is-invalid {
        border-color: red; /* Mengubah warna batas menjadi merah */
    }
    .valid-icon {
    display: none; /* Sembunyikan secara default */
    color: green; /* Warna hijau untuk centang */
    margin-left: 5px; /* Jarak antara input dan centang */
    }
</style>

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Ajukan Pembuatan Aplikasi</h2>
</div>

<div class="col-lg-7">
    <form method="post" action="/dashboard/aplikasi/store" 
    enctype="multipart/form-data" class="mb-5" id="aplikasiForm">
        @csrf
        <div class="mb-3">
            <h6>Data Diri</h6>
        </div>
        <div class="mb-3">
        <label for="nip" class="form-label @error('nip') is-invalid @enderror">NIP</label>
        <div class="d-flex align-items-center">
        <input type="text" class="form-control" 
        id="nip" name="nip" value="{{ old('nip') }}">
        <span class="valid-icon" id="valid-nip" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
        </div>
        @error('nip')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        </div>
        <div class="mb-3">
            <label for="nama_pic" class="form-label @error('nama_pic') is-invalid @enderror">Nama PIC</label>
            <div class="d-flex align-items-center">
            <input type="text" class="form-control" 
            id="nama_pic" name="nama_pic" value="{{ old('nama_pic') }}">
            <span class="valid-icon" id="valid-nama_pic" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('nama_pic')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jabatan" class="form-label @error('jabatan') is-invalid @enderror">Jabatan</label>
            <div class="d-flex align-items-center">
            <input type="text" class="form-control" 
            id="jabatan" name="jabatan" value="{{ old('jabatan') }}">
            <span class="valid-icon" id="valid-jabatan" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('jabatan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="opd" class="form-label @error('opd') is-invalid @enderror">OPD</label>
            <div class="d-flex align-items-center">
            <input type="text" class="form-control" 
            id="opd" name="opd" value="{{ old('opd') }}">
            <span class="valid-icon" id="valid-opd" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('opd')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label @error('email') is-invalid @enderror">Email</label>
            <div class="d-flex align-items-center">
            <input type="email" class="form-control" 
            id="email" name="email" value="{{ old('email') }}">
            <span class="valid-icon" id="valid-email" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="no_telp" class="form-label @error('no_telp') is-invalid @enderror">
                Nomor Telepon PIC
                <small class="form-text text-muted d-block">
                    (Whatsapp Aktif! Contoh : 0818824864)
                </small> 
            </label>
            <div class="d-flex align-items-center">
            <input type="tel" class="form-control" 
            id="no_telp" name="no_telp" value="{{ old('no_telp') }}">
            <span class="valid-icon" id="valid-no_telp" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('no_telp')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mt-5 mb-3">
            <h6>Deskripsi Aplikasi</h6>
        </div>
        <div class="mb-3">
            <label for="nama_app" class="form-label @error('nama_app') is-invalid @enderror">Usulan Nama Applikasi</label>
            <div class="d-flex align-items-center">
            <input type="text" class="form-control" 
            id="nama_app" name="nama_app" value="{{ old('nama_app') }}">
            <span class="valid-icon" id="valid-nama_app" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('nama_app')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Aplikasi</label>
            <div class="d-flex align-items-center">
            <textarea 
                class="form-control @error('deskripsi') is-invalid @enderror" 
                name="deskripsi" 
                id="deskripsi" 
                rows="5" 
                placeholder="Masukkan deskripsi aplikasi"
            >{{ old('deskripsi') }}</textarea>
            <span class="valid-icon" id="valid-deskripsi" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('deskripsi')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tipe" class="form-label">Tipe Aplikasi</label>
            <div class="d-flex align-items-center">
            <select class="form-select @error('tipe') is-invalid @enderror" name="tipe" id="tipe">
                <option selected disabled>Silahkan Pilih Tipe Aplikasi</option>
                <option value="Android" {{ old('tipe') == 'Android' ? 'selected' : '' }}>Android</option>
                <option value="Berbasis Web" {{ old('tipe') == 'Berbasis Web' ? 'selected' : '' }}>Berbasis Web</option>
                <option value="Desktop" {{ old('tipe') == 'Desktop' ? 'selected' : '' }}>Desktop</option>
            </select>
            <span class="valid-icon" id="valid-tipe" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('tipe')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tahun_pembuatan" class="form-label">Tahun Pembuatan</label>
            <div class="d-flex align-items-center">
            <input type="number" class="form-control @error('tahun_pembuatan') is-invalid @enderror" name="tahun_pembuatan" 
                   id="tahun_pembuatan" min="2020" max="{{ date('Y') }}" placeholder="Masukkan Tahun Pembuatan" value="{{ old('tahun_pembuatan') }}">
            <span class="valid-icon" id="valid-tahun_pembuatan" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('tahun_pembuatan')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
           @enderror
        </div>
        <div class="mb-3">
            <label for="bahasa_pemograman" class="form-label">Bahasa Pemrograman</label>
            <div class="d-flex align-items-center">
            <input type="text" class="form-control @error('bahasa_pemograman') is-invalid @enderror" name="bahasa_pemograman" 
                   id="bahasa_pemograman" placeholder="Contoh: PHP, Java, Python" value="{{ old('bahasa_pemograman') }}">
            <span class="valid-icon" id="valid-bahasa_pemograman" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('bahasa_pemograman')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
           @enderror
        </div>
        <div class="mb-3">
            <label for="framework" class="form-label">Framework</label>
            <div class="d-flex align-items-center">
            <input type="text" class="form-control @error('framework') is-invalid @enderror" name="framework" 
                   id= "framework" placeholder="Contoh: Laravel, CodeIgniter, React" value="{{ old('framework') }}">
            <span class="valid-icon" id="valid-framework" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('framework')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
           @enderror
        </div>
        <div class="mb-3">
            <label for="database" class="form-label">Database</label>
            <div class="d-flex align-items-center">
            <input type="text" class="form-control @error('database') is-invalid @enderror" name="database" 
                   id= "database" placeholder="Contoh: MySQL, PostgreSQL, MongoDB" value="{{ old('database') }}">
            <span class="valid-icon" id="valid-database" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('database')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
           @enderror
        </div>
        <div class="mb-3">
            <label for="sistem_operasi" class="form-label">Sistem Operasi</label>
            <div class="d-flex align-items-center">
            <input type="text" class="form-control @error('sistem_operasi') is-invalid @enderror" name="sistem_operasi" 
                   id="sistem_operasi" placeholder="Contoh: Windows, Linux, macOS" value="{{ old('sistem_operasi') }}">
            <span class="valid-icon" id="valid-sistem_operasi" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('sistem_operasi')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="instalasi" class="form-label">Lokasi Instalasi</label>
            <div class="d-flex align-items-center">
            <select class="form-select @error('instalasi') is-invalid @enderror" name="instalasi" id="instalasi">
                <option selected disabled>Pilih Lokasi Instalasi</option>
                <option value="Data Center Diskominfo Kota Semarang" {{ old('instalasi') == 'Data Center Diskominfo Kota Semarang' ? 'selected' : '' }}>Data Center Diskominfo Kota Semarang</option>
                <option value="Server OPD" {{ old('instalasi') == 'Server OPD' ? 'selected' : '' }}>Server OPD</option>
                <option value="Server Pihak Ketiga" {{ old('instalasi') == 'Server Pihak Ketiga' ? 'selected' : '' }}>Server Pihak Ketiga</option>
            </select>
                <span class="valid-icon" id="valid-instalasi" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('instalasi')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mt-5 mb-3">
            <h6>Data Dukung</h6>
        </div>

        <div class="mb-3">
            <label for="dokumen" class="form-label @error('dokumen') is-invalid @enderror">Data Dukung
                <small class="form-text text-muted d-block"> Wajib upload surat permohonan resmi bertandatangan kepala OPD & Proses Bisnis Aplikasi</small> 
            </label>
            <div class="d-flex align-items-center">
            <input class="form-control" type="file" id="dokumen" name="dokumen" accept=".pdf">
            <span class="valid-icon" id="valid-dokumen" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @if(old('dokumen') || isset($existingFileName))
                <small class="form-text text-muted">
                    @if(old('dokumen'))
                        File yang diunggah sebelumnya: {{ old('dokumen') }}
                    @else
                        File yang diunggah sebelumnya: {{ $existingFileName }}
                    @endif
                </small>
            @endif
            @error('dokumen')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <!-- Confirmation Modal with Terms and Conditions -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Pengajuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="fw-bold">Apakah Anda yakin ingin mengajukan permohonan ini?</p>
                    
                    <div class="mt-3">
                        <h6>Syarat dan Ketentuan</h6>
                        <div style="max-height: 300px; overflow-y: auto; border: 1px solid #dee2e6; padding: 10px; border-radius: 5px;">
                            <!-- Isi terms and conditions -->
                            @include('dashboard.layouts.terms_condition')
                        </div>
                        <!-- <p class="mt-2 text-muted small">Dengan menekan tombol "Ya, Ajukan", Anda menyetujui syarat dan ketentuan di atas.</p> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="confirmSubmit">Ya, Ajukan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
    // Validasi untuk NIP
    $('#nip').on('input', function() {
        const validIcon = $('#valid-nip');
        const value = $(this).val();

        if (/^[0-9]{18}$/.test(value)) { // Memastikan NIP terdiri dari 18 digit dan hanya angka
            validIcon.show(); // Tampilkan centang hijau
            $(this).removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            $(this).addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });

    // Validasi untuk Nama PIC
    $('#nama_pic').on('input', function() {
        const validIcon = $('#valid-nama_pic');
        const regex = /^[\p{L} ]+$/u; // Hanya huruf dan spasi
        const value = $(this).val();

        if (value.length > 0 && value.length <= 255 && regex.test(value)) {
            validIcon.show(); // Tampilkan centang hijau
            $(this).removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            $(this).addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });

    // Validasi untuk Jabatan
    $('#jabatan').on('input', function() {
        const validIcon = $('#valid-jabatan');
        const value = $(this).val();

        if (value.length > 0 && value.length <= 255) {
            validIcon.show(); // Tampilkan centang hijau
            $(this).removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            $(this).addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });
    

    // Validasi untuk OPD
    $('#opd').on('input', function() {
        const validIcon = $('#valid-opd');
        const value = $(this).val();

        if (value.length > 0 && value.length <= 255) {
            validIcon.show(); // Tampilkan centang hijau
            $(this).removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            $(this).addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });

    // Validasi untuk Email
    $('#email').on('input', function() {
        const validIcon = $('#valid-email');
        const value = $(this).val();

        if (value.length > 0 && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) { // Cek format email
            validIcon.show(); // Tampilkan centang hijau
            $(this).removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            $(this).addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });

    // Validasi untuk Nomor Telepon
    $('#no_telp').on('input', function() {
        const validIcon = $('#valid-no_telp');
        const value = $(this).val();

        if (/^[0-9]{10,15}$/.test(value)) { // Cek panjang dan format
            validIcon.show(); // Tampilkan centang hijau
            $(this).removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            $(this).addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });

    // Validasi untuk Nama Aplikasi
    $('#nama_app').on('input', function() {
        const validIcon = $('#valid-nama_app');
        const value = $(this).val();

        if (value.length > 0) {
            validIcon.show(); // Tampilkan centang hijau
            $(this).removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            $(this).addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });

    // Validasi untuk Deskripsi
    $('#deskripsi').on('input', function() {
        const validIcon = $('#valid-deskripsi');
        const value = $(this).val();

        if (value.length > 0) {
            validIcon.show(); // Tampilkan centang hijau
            $(this).removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            $(this).addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });

    // Validasi untuk Tipe
    $('#tipe').on('change', function() {
        const validIcon = $('#valid-tipe');
        const value = $(this).val();

        if (value) {
            validIcon.show(); // Tampilkan centang hijau
            $(this).removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            $(this).addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });

    // Validasi untuk Tahun Pembuatan
    $('#tahun_pembuatan').on('input', function() {
        const validIcon = $('#valid-tahun_pembuatan');
        const value = $(this).val();

        if (value >= 2020 && value <= new Date().getFullYear()) { // Cek tahun
            validIcon.show(); // Tampilkan centang hijau
            $(this).removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            $(this).addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });

    // Validasi untuk Bahasa Pemrograman
    $('#bahasa_pemograman').on('input', function() {
        const validIcon = $('#valid-bahasa_pemograman');
        const value = $(this).val();

        if (value.length > 0) {
            validIcon.show(); // Tampilkan centang hijau
            $(this).removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            $(this).addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });

    // Validasi untuk Framework
    $('#framework').on('input', function() {
        const validIcon = $('#valid-framework');
        const value = $(this).val();

        if (value.length > 0) {
            validIcon.show(); // Tampilkan centang hijau
            $(this).removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            $(this).addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });

    // Validasi untuk Database
    $('#database').on('input', function() {
        const validIcon = $('#valid-database');
        const value = $(this).val();

        if (value.length > 0) {
            validIcon.show(); // Tampilkan centang hijau
            $(this).removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            $(this).addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });

    // Validasi untuk Sistem Operasi
    $('#sistem_operasi').on('input', function() {
        const validIcon = $('#valid-sistem_operasi');
        const value = $(this).val();

        if (value.length > 0) {
            validIcon.show(); // Tampilkan centang hijau
            $(this).removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            $(this).addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });

    // Validasi untuk Lokasi Instalasi
    $('#instalasi').on('change', function() {
        const validIcon = $('#valid-instalasi');
        const value = $(this).val();

        if (value) {
            validIcon.show(); // Tampilkan centang hijau
            $(this).removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            $(this).addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });

    // Validasi untuk Dokumen
    $('#dokumen').on('change', function() {
        const validIcon = $('#valid-dokumen');
        const file = this.files[0];

        if (file && file.type === 'application/pdf' && file.size <= 1024 * 1024) { // Cek format dan ukuran
            validIcon.show(); // Tampilkan centang hijau
            $(this).removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            $(this).addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });

    // Prevent form from submitting directly
    $('#aplikasiForm').on('submit', function(e) {
        e.preventDefault();
        $('#confirmModal').modal('show');
    });

    // Handle confirmation
    $('#confirmSubmit').on('click', function() {
        $('#confirmModal').modal('hide');
        $('#aplikasiForm')[0].submit();
    });
});
</script>
@endsection