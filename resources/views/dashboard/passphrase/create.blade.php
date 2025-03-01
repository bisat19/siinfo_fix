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
    <h2>Ajukan Reset Email atau Passphrase TTE</h2>
</div>

<div class="col-lg-7">
    <form method="post" action="/dashboard/passphrase/store"
    enctype="multipart/form-data" class="mb-5" id="passphraseForm">
        @csrf

         <div class="mb-3">
            <label for="nama" class="form-label @error('nama') is-invalid @enderror">Nama Lengkap Pemohon</label>
            <div class="d-flex align-items-center">
                <input type="text" class="form-control" 
                id="nama" name="nama" value="{{ old('nama') }}">
                <span class="valid-icon" id="valid-nama" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
                </div>
                @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

                <div class="mb-3">
                    <label for="nip_pemohon" class="form-label @error('nip_pemohon') is-invalid @enderror">NIP Pemohon
                    <small class="form-text text-muted d-block">
                        (Tanpa spasi, tanpa tanda baca, misal 198709032018021002)
                    </small>
                    </label>
                    <div class="d-flex align-items-center">
                    <input type="text" class="form-control" 
                    id="nip_pemohon" name="nip_pemohon" value="{{ old('nip_pemohon') }}">
                    <span class="valid-icon" id="valid-nip_pemohon" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
                    </div>
                    @error('nip_pemohon')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

        <div class="mb-3">
            <label for="no_telp" class="form-label @error('no_telp') is-invalid @enderror">
                Nomor Telepon
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
        </div>

        <div class="mb-3">
            <label for="nama_user" class="form-label @error('nama_user') is-invalid @enderror">Nama User/Pemilik Akun</label>
            <div class="d-flex align-items-center">
                <input type="text" class="form-control" 
                id="nama_user" name="nama_user" value="{{ old('nama_user') }}">
                <span class="valid-icon" id="valid-nama_user" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
                </div>
                @error('nama_user')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
        </div>
        
                <div class="mb-3">
                    <label for="nik_user" class="form-label @error('nik_user') is-invalid @enderror">NIK User
                    <small class="form-text text-muted d-block">
                        (Tanpa spasi, tanpa tanda baca, misal 3374110309872001)
                    </small>
                    </label>
                    <div class="d-flex align-items-center">
                    <input type="text" class="form-control" 
                    id="nik_user" name="nik_user" value="{{ old('nik_user') }}">
                    <span class="valid-icon" id="valid-nik_user" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
                    </div>
                    @error('nik_user')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="nip_user" class="form-label @error('nip_user') is-invalid @enderror">NIP User
                    <small class="form-text text-muted d-block">
                        (Tanpa spasi, tanpa tanda baca, misal 198709032018021002)
                    </small>
                    </label>
                    <div class="d-flex align-items-center">
                    <input type="text" class="form-control" 
                    id="nip_user" name="nip_user" value="{{ old('nip_user') }}">
                    <span class="valid-icon" id="valid-nip_user" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
                    </div>
                    @error('nip_user')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

        <div class="mb-3">
            <label for="email_domain" class="form-label @error('email_domain') is-invalid @enderror">Alamat Email User
            <small class="form-text text-muted d-block">(Alamat email dengan domain @semarangkota.go.id, jika lupa/ belum memiliki 
            silakan berkoordinasi dengan petugas terkait)
            </small>
            </label>
            <div class="d-flex align-items-center">
            <input type="email" class="form-control" 
            id="email_domain" name="email_domain" value="{{ old('email_domain') }}">
            <span class="valid-icon" id="valid-email_domain" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('email_domain')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="alasan" class="form-label @error('alasan') is-invalid @enderror">Alasan</label>
            <div class="d-flex align-items-center">
            <textarea 
                class="form-control @error('alasan') is-invalid @enderror" 
                id="alasan" 
                name="alasan" 
                rows="4" 
                placeholder="Jelaskan alasan Anda"
            >{{ old('alasan') }}</textarea>
            <span class="valid-icon" id="valid-alasan" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('alasan')
                <div class="invalid-feedback">
                    {{ $message }}</div>
            @enderror

        </div>

        <script>
$(document).ready(function() {
    // Validasi untuk Nama
    $('#nama').on('input', function() {
        const validIcon = $('#valid-nama');
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

    // Validasi untuk NIP Pemohon
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

    // Validasi untuk Nomor Telepon
    $('#no_telp').on('input', function() {
        const validIcon = $('#valid-no_telp');
        const value = $(this).val();
        
        if (/^\d{10,15}$/.test(value)) { // Cek panjang dan format
            validIcon.show(); // Tampilkan centang hijau
            $(this).removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            $(this).addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });

    // Validasi untuk Nama user
    $('#nama_user').on('input', function() {
        const validIcon = $('#valid-nama_user');
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

    //Validasi untuk nip user
    $('#nip_user').on('input', function() {
        const validIcon = $('#valid-nip_user');
        const value = $(this).val();
        
        if (/^\d{18}$/.test(value)) { // Cek panjang dan format
            validIcon.show(); // Tampilkan centang hijau
            $(this).removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            $(this).addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });

    // Validasi untuk NIK User
    $('#nik_user').on('input', function() {
        const validIcon = $('#valid-nik_user');
        const value = $(this).val();
        
        if (/^\d{16}$/.test(value)) { // Cek panjang dan format
            validIcon.show(); // Tampilkan centang hijau
            $(this).removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            $(this).addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });

    // Validasi untuk Email Domain
    $('#email_domain').on('input', function() {
        const validIcon = $('#valid-email_domain');
        const value = $(this).val();

        if (value.length > 0 && /^[^\s@]+@semarangkota\.go\.id+$/.test(value)) { // Cek format email
            validIcon.show(); // Tampilkan centang hijau
            $(this).removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            $(this).addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });
    
    // Validasi untuk Alasan
    $('#alasan').on('input', function() {
        const validIcon = $('#valid-alasan');
        const value = $(this).val();

        if (value.length > 0) {
            validIcon.show(); // Tampilkan centang hijau
            $(this).removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            $(this).addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });
    
    // Prevent form from submitting directly
    $('#passphraseForm').on('submit', function(e) {
        e.preventDefault();
        $('#confirmModal').modal('show');
    });

    // Handle confirmation
    $('#confirmSubmit').on('click', function() {
        $('#confirmModal').modal('hide');
        $('#passphraseForm')[0].submit();
    }); 
});
</script>

        <!-- Terms and Conditions Section -->
        <!-- <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="termsCheckbox" required>
                <label class="form-check-label" for="termsCheckbox">
                    Saya telah membaca dan menyetujui 
                    <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Syarat dan Ketentuan</a>
                </label>
            </div>
        </div> -->

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

<!-- Terms and Conditions Modal -->
<!-- <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Syarat dan Ketentuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                @include('dashboard.layouts.terms_condition')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const termsCheckbox = document.getElementById('termsCheckbox');
    const submitBtn = document.getElementById('submitBtn');
    const acceptTermsBtn = document.getElementById('acceptTermsBtn');
    const termsModal = new bootstrap.Modal(document.getElementById('termsModal'));

    // Tombol "Saya Setuju" di modal
    acceptTermsBtn.addEventListener('click', function() {
        termsCheckbox.checked = true;
        submitBtn.disabled = false;
        termsModal.hide();
    });

    // Checkbox terms
    termsCheckbox.addEventListener('change', function() {
        submitBtn.disabled = !this.checked;
    });

    // Prevent form submission if terms not accepted
    document.getElementById('pengajuanForm').addEventListener('submit', function(e) {
        if (!termsCheckbox.checked) {
            e.preventDefault();
            alert('Anda harus menyetujui syarat dan ketentuan terlebih dahulu.');
        }
    });
});
</script>
@endpush -->
@endsection