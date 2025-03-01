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
    <h2>Ajukan Email Dinas</h2>
</div>

<div class="col-lg-7">
    <form method="post" action="/dashboard/emaildinas/store" 
    enctype="multipart/form-data" class="mb-5" id="emaildinasForm">
        @csrf

        <div class="mb-3">
        <label for="nama_opd" class="form-label @error('nama_opd') is-invalid @enderror">Nama OPD</label>
        <div class="d-flex align-items-center">
        <input type="text" class="form-control" 
        id="nama_opd" name="nama_opd" value="{{ old('nama_opd') }}">
        <span class="valid-icon" id="valid-nama_opd" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
        </div>
        @error('nama_opd')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror

        <div class="mb-3">
            <label for="nama_pic" class="form-label @error('nama_pic') is-invalid @enderror">Nama PIC</label>
            <div class="d-flex align-items-center">
            <input type="text" class="form-control" 
            id="nama_pic" name="nama_pic" value="{{ old('nama_pic') }}" >
            <span class="valid-icon" id="valid-nama_pic" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('nama_pic')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

        <div class="mb-3">
            <label for="no_telp_pic" class="form-label @error('no_telp_pic') is-invalid @enderror">
                Nomor Telepon PIC
                <small class="form-text text-muted d-block">
                    (Whatsapp Aktif PIC! Contoh : 0818824864)
                </small> 
            </label>
            <div class="d-flex align-items-center">
            <input type="tel" class="form-control" 
            id="no_telp_pic" name="no_telp_pic"value="{{ old('no_telp_pic') }}">
            <span class="valid-icon" id="valid-no_telp_pic" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('no_telp_pic')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="surat_rekomendasi" class="form-label @error('surat_rekomendasi') is-invalid @enderror">Surat Permohonan Rekomendasi Pembuatan Email
                <small class="form-text text-muted d-block">
                    (Contoh template klik <a href="https://docs.google.com/document/d/19eoa5WC2NGI7UhNAQzETs-tT7JQLh7BWJIJMmqgxRoQ/edit?usp=sharing"
                    target="_blank" rel="noopener noreferrer">disini</a> (.pdf maksimal 1MB))
                </small> 
            </label>
            <div class="d-flex align-items-center">
            <input class="form-control" type="file" id="surat_rekomendasi" name="surat_rekomendasi"accept=".pdf">
            <span class="valid-icon" id="valid-surat_rekomendasi" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @if(old('file') || isset($existingFileName))
                <small class="form-text text-muted">
                    @if(old('file'))
                        File yang diunggah sebelumnya: {{ old('file') }}
                    @else
                        File yang diunggah sebelumnya: {{ $existingFileName }}
                    @endif
                </small>
            @endif
            @error('surat_rekomendasi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="form_pengajuan" class="form-label @error('form_pengajuan') is-invalid @enderror">Formulir Pengajuan Pembuatan Email
                <small class="form-text text-muted d-block">
                    (Contoh template klik <a href="https://docs.google.com/document/d/1vQjLyRwKNN1BscENI4SvQtT2CcpdnLZOg2jyGAzqRAA/edit?usp=sharing"
                    target="_blank" rel="noopener noreferrer">disini</a> (.pdf maksimal 1MB))
                </small> 
            
            </label>
            <div class="d-flex align-items-center">
            <input class="form-control" type="file" id="form_pengajuan" name="form_pengajuan"accept=".pdf">
            <span class="valid-icon" id="valid-form_pengajuan" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @if(old('file') || isset($existingFileName))
                <small class="form-text text-muted">
                    @if(old('file'))
                        File yang diunggah sebelumnya: {{ old('file') }}
                    @else
                        File yang diunggah sebelumnya: {{ $existingFileName }}
                    @endif
                </small>
            @endif
            @error('form_pengajuan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mt-5 mb-3 text-center">
            <h6>Pemohon</h6>
            <p class="text-muted">
                Minimal terdapat satu pemohon. Silakan tuliskan nama lengkap tanpa gelar.
            </p>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="nama_pemohon" class="form-label  @error('nama_pemohon') is-invalid @enderror">Nama Pemohon
                </label>
                <div class="d-flex align-items-center">
                <input type="text" class="form-control @error('nip_pemohon') is-invalid @enderror" 
                       id="nama_pemohon" name="nama_pemohon" value="{{ old('nama_pemohon') }}" >
                       <span class="valid-icon" id="valid-nama_pemohon" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
                </div>
                @error('nama_pemohon')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label for="nip_pemohon" class="form-label @error('nip_pemohon') is-invalid @enderror">NIP Pemohon
                </label>
                <div class="d-flex align-items-center">
                <input type="text" class="form-control @error('nip_pemohon') is-invalid @enderror" 
                    id="nip_pemohon" name="nip_pemohon" value="{{ old('nip_pemohon') }}">
                    <span class="valid-icon" id="valid-nip_pemohon" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
                    </div>
                @error('nip_pemohon')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label for="no_telp_pemohon" class="form-label @error('no_telp_pemohon') is-invalid @enderror">No. WA Pemohon</label>
                <div class="d-flex align-items-center">
                <input type="text" class="form-control @error('no_telp_pemohon') is-invalid @enderror" 
                       id="no_telp_pemohon" name="no_telp_pemohon" value="{{ old('no_telp_pemohon') }}">
                       <span class="valid-icon" id="valid-no_telp_pemohon" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
        </div>
                @error('no_telp_pemohon')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="d-flex align-items-center">
                <input type="text" class="form-control  @error('nama_2') is-invalid @enderror" 
                       id="nama_2" name="nama_2" value="{{ old('nama_2') }}">
                       <span class="valid-icon" id="valid-nama_2" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
        </div>
                @error('nama_2')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="d-flex align-items-center">
                <input type="text" class="form-control @error('nip_2') is-invalid @enderror" 
                       id="nip_2" name="nip_2" value="{{ old('nip_2') }}">
                       <span class="valid-icon" id="valid-nip_2" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
                    </div>
                @error('nip_2')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <div class="d-flex align-items-center">
                <input type="text" class="form-control @error('no_telp_2') is-invalid @enderror" 
                       id="no_telp_2" name="no_telp_2" value="{{ old('no_telp_2') }}">
                       <span class="valid-icon" id="valid-no_telp_2" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
        </div>
                @error('no_telp_2')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="d-flex align-items-center">
                <input type="text" class="form-control  @error('nama_3') is-invalid @enderror" 
                       id="nama_3" name="nama_3" value="{{ old('nama_3') }}">
                       <span class="valid-icon" id="valid-nama_3" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
        </div>
                @error('nama_3')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <div class="d-flex align-items-center">
                <input type="text" class="form-control @error('nip_3') is-invalid @enderror" 
                       id="nip_3" name="nip_3" value="{{ old('nip_3') }}">
                       <span class="valid-icon" id="valid-nip_3" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
        </div>
                @error('nip_3')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <div class="d-flex align-items-center">
                <input type="text" class="form-control @error('no_telp_3') is-invalid @enderror" 
                       id="no_telp_3" name="no_telp_3" value="{{ old('no_telp_3') }}">
                       <span class="valid-icon" id="valid-no_telp_3" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
        </div>
                @error('no_telp_3')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="d-flex align-items-center">
                <input type="text" class="form-control  @error('nama_4') is-invalid @enderror" 
                       id="nama_4" name="nama_4" value="{{ old('nama_4') }}">
                       <span class="valid-icon" id="valid-nama_4" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
        </div>
                @error('nama_4')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="d-flex align-items-center">
                <input type="text" class="form-control @error('nip_4') is-invalid @enderror" 
                       id="nip_4" name="nip_4" value="{{ old('nip_4') }}">
                       <span class="valid-icon" id="valid-nip_4" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
                    </div>
                @error('nip_4')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <div class="d-flex align-items-center">
                <input type="text" class="form-control @error('no_telp_4') is-invalid @enderror" 
                       id="no_telp_4" name="no_telp_4" value="{{ old('no_telp_4') }}">
                       <span class="valid-icon" id="valid-no_telp_4" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
        </div>
                @error('no_telp_4')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="d-flex align-items-center">
                <input type="text" class="form-control  @error('nama_5') is-invalid @enderror" 
                       id="nama_5" name="nama_5" value="{{ old('nama_5') }}">
                       <span class="valid-icon" id="valid-nama_5" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
        </div>
                @error('nama_5')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="d-flex align-items-center">
                <input type="text" class="form-control @error('nip_5') is-invalid @enderror" 
                       id="nip_5" name="nip_5" value="{{ old('nip_5') }}">
                       <span class="valid-icon" id="valid-nip_5" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
                    </div>
                @error('nip_5')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <div class="d-flex align-items-center">
                <input type="text" class="form-control @error('no_telp_5') is-invalid @enderror" 
                       id="no_telp_5" name="no_telp_5" value="{{ old('no_telp_5') }}">
                       <span class="valid-icon" id="valid-no_telp_5" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
        </div>
                @error('no_telp_5')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <script>
            $(document).ready(function() {
                // Validasi untuk Nama opd
                $('#nama_opd').on('input', function() {
                    const validIcon = $('#valid-nama_opd');
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

                // Validasi untuk Nomor Telepon PIC
                $('#no_telp_pic').on('input', function() {
                    const validIcon = $('#valid-no_telp_pic');
                    const value = $(this).val();
            
                    if (/^\d{10,15}$/.test(value)) { // Cek panjang dan format
                        validIcon.show(); // Tampilkan centang hijau
                        $(this).removeClass('is-invalid'); // Hapus kelas invalid
                    } else {
                        validIcon.hide(); // Sembunyikan centang hijau
                        $(this).addClass('is-invalid'); // Tambahkan kelas invalid
                    }
                });

                // Validasi untuk Surat_Rekomendasi
                $('#surat_rekomendasi').on('change', function() {
                    const validIcon = $('#valid-surat_rekomendasi');
                    const file = this.files[0];
            
                    if (file && file.type === 'application/pdf' && file.size <= 1024 * 1024) { // Cek format dan ukuran
                        validIcon.show(); // Tampilkan centang hijau
                        $(this).removeClass('is-invalid'); // Hapus kelas invalid
                    } else {
                        validIcon.hide(); // Sembunyikan centang hijau
                        $(this).addClass('is-invalid'); // Tambahkan kelas invalid
                    }
                });
                
                // Validasi untuk Form_Pengajuan
                $('#form_pengajuan').on('change', function() {
                        const validIcon = $('#valid-form_pengajuan');
                        const file = this.files[0];
                
                        if (file && file.type === 'application/pdf' && file.size <= 1024 * 1024) { // Cek format dan ukuran
                            validIcon.show(); // Tampilkan centang hijau
                            $(this).removeClass('is-invalid'); // Hapus kelas invalid
                        } else {
                            validIcon.hide(); // Sembunyikan centang hijau
                            $(this).addClass('is-invalid'); // Tambahkan kelas invalid
                        }
                    });


                     // Validasi untuk Nama Pemohon 
                $('#nama_pemohon').on('input', function() {
                    const validIcon = $('#valid-nama_pemohon');
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
                // Validasi untuk NIP pemohon
                $('#nip_pemohon').on('input', function() {
                    const validIcon = $('#valid-nip_pemohon');
                    const value = $(this).val();
            
                    if (/^\d{18}$/.test(value)) { // Cek panjang dan format
                        validIcon.show(); // Tampilkan centang hijau
                        $(this).removeClass('is-invalid'); // Hapus kelas invalid
                    } else {
                        validIcon.hide(); // Sembunyikan centang hijau
                        $(this).addClass('is-invalid'); // Tambahkan kelas invalid
                    }
                });

            // Validasi untuk Nomor Telepon Pemohon
            $('#no_telp_pemohon').on('input', function() {
                    const validIcon = $('#valid-no_telp_pemohon');
                    const value = $(this).val();
            
                    if (/^\d{10,15}$/.test(value)) { // Cek panjang dan format
                        validIcon.show(); // Tampilkan centang hijau
                        $(this).removeClass('is-invalid'); // Hapus kelas invalid
                    } else {
                        validIcon.hide(); // Sembunyikan centang hijau
                        $(this).addClass('is-invalid'); // Tambahkan kelas invalid
                    }
                });


                 // Validasi untuk Nama Pemohon 2
                 $('#nama_2').on('input', function() {
                    const validIcon = $('#valid-nama_2');
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
                // Validasi untuk NIP pemohon 2
                $('#nip_2').on('input', function() {
                    const validIcon = $('#valid-nip_2');
                    const value = $(this).val();
            
                    if (/^\d{18}$/.test(value)) { // Cek panjang dan format
                        validIcon.show(); // Tampilkan centang hijau
                        $(this).removeClass('is-invalid'); // Hapus kelas invalid
                    } else {
                        validIcon.hide(); // Sembunyikan centang hijau
                        $(this).addClass('is-invalid'); // Tambahkan kelas invalid
                    }
                });

            // Validasi untuk Nomor Telepon Pemohon 2
            $('#no_telp_2').on('input', function() {
                    const validIcon = $('#valid-no_telp_2');
                    const value = $(this).val();
            
                    if (/^\d{10,15}$/.test(value)) { // Cek panjang dan format
                        validIcon.show(); // Tampilkan centang hijau
                        $(this).removeClass('is-invalid'); // Hapus kelas invalid
                    } else {
                        validIcon.hide(); // Sembunyikan centang hijau
                        $(this).addClass('is-invalid'); // Tambahkan kelas invalid
                    }
                });


                 // Validasi untuk Nama Pemohon  3
                 $('#nama_3').on('input', function() {
                    const validIcon = $('#valid-nama_3');
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
                // Validasi untuk NIP pemohon 3
                $('#nip_3').on('input', function() {
                    const validIcon = $('#valid-nip_3');
                    const value = $(this).val();
            
                    if (/^\d{18}$/.test(value)) { // Cek panjang dan format
                        validIcon.show(); // Tampilkan centang hijau
                        $(this).removeClass('is-invalid'); // Hapus kelas invalid
                    } else {
                        validIcon.hide(); // Sembunyikan centang hijau
                        $(this).addClass('is-invalid'); // Tambahkan kelas invalid
                    }
                });

            // Validasi untuk Nomor Telepon Pemohon 3
            $('#no_telp_3').on('input', function() {
                    const validIcon = $('#valid-no_telp_3');
                    const value = $(this).val();
            
                    if (/^\d{10,15}$/.test(value)) { // Cek panjang dan format
                        validIcon.show(); // Tampilkan centang hijau
                        $(this).removeClass('is-invalid'); // Hapus kelas invalid
                    } else {
                        validIcon.hide(); // Sembunyikan centang hijau
                        $(this).addClass('is-invalid'); // Tambahkan kelas invalid
                    }
                });

                 // Validasi untuk Nama Pemohon  4
                 $('#nama_4').on('input', function() {
                    const validIcon = $('#valid-nama_4');
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
                // Validasi untuk NIP pemohon 4
                $('#nip_4').on('input', function() {
                    const validIcon = $('#valid-nip_4');
                    const value = $(this).val();
            
                    if (/^\d{18}$/.test(value)) { // Cek panjang dan format
                        validIcon.show(); // Tampilkan centang hijau
                        $(this).removeClass('is-invalid'); // Hapus kelas invalid
                    } else {
                        validIcon.hide(); // Sembunyikan centang hijau
                        $(this).addClass('is-invalid'); // Tambahkan kelas invalid
                    }
                });

            // Validasi untuk Nomor Telepon Pemohon 4
            $('#no_telp_4').on('input', function() {
                    const validIcon = $('#valid-no_telp_4');
                    const value = $(this).val();
            
                    if (/^\d{10,15}$/.test(value)) { // Cek panjang dan format
                        validIcon.show(); // Tampilkan centang hijau
                        $(this).removeClass('is-invalid'); // Hapus kelas invalid
                    } else {
                        validIcon.hide(); // Sembunyikan centang hijau
                        $(this).addClass('is-invalid'); // Tambahkan kelas invalid
                    }
                });


                 // Validasi untuk Nama Pemohon  5
                 $('#nama_5').on('input', function() {
                    const validIcon = $('#valid-nama_5');
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
                // Validasi untuk NIP pemohon 5
                $('#nip_5').on('input', function() {
                    const validIcon = $('#valid-nip_5');
                    const value = $(this).val();
            
                    if (/^\d{18}$/.test(value)) { // Cek panjang dan format
                        validIcon.show(); // Tampilkan centang hijau
                        $(this).removeClass('is-invalid'); // Hapus kelas invalid
                    } else {
                        validIcon.hide(); // Sembunyikan centang hijau
                        $(this).addClass('is-invalid'); // Tambahkan kelas invalid
                    }
                });

            // Validasi untuk Nomor Telepon Pemohon 5
            $('#no_telp_5').on('input', function() {
                    const validIcon = $('#valid-no_telp_5');
                    const value = $(this).val();
            
                    if (/^\d{10,15}$/.test(value)) { // Cek panjang dan format
                        validIcon.show(); // Tampilkan centang hijau
                        $(this).removeClass('is-invalid'); // Hapus kelas invalid
                    } else {
                        validIcon.hide(); // Sembunyikan centang hijau
                        $(this).addClass('is-invalid'); // Tambahkan kelas invalid
                    }
                });

            // Prevent form from submitting directly
            $('#emaildinasForm').on('submit', function(e) {
                e.preventDefault();
                $('#confirmModal').modal('show');
            });

            // Handle confirmation
            $('#confirmSubmit').on('click', function() {
                $('#confirmModal').modal('hide');
                $('#emaildinasForm')[0].submit();
            });
        });
        </script>  
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
@endsection