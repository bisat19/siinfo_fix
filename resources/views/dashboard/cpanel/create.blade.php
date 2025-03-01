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
    <h2>Ajukan Akses Cpanel Aplikasi di Pemkot</h2>
</div>

<div class="col-lg-7">
    <form method="post" action="/dashboard/cpanel/store" 
    enctype="multipart/form-data" class="mb-5" id="cpanelForm">
        @csrf
        <div class="mb-3">
        <label for="nama" class="form-label @error('nama') is-invalid @enderror">Nama Pemohon</label>
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
            <label for="nip" class="form-label @error('nip') is-invalid @enderror">NIP/ID non ASN
            <small class="form-text text-muted d-block">
                (Tanpa spasi, tanpa tanda baca, misal 198709032018021002)
            </small>
            </label>
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
            <label for="jabatan" class="form-label @error('jabatan') is-invalid @enderror">
                Jabatan 
            </label>
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
            <label for="asal_opd" class="form-label @error('asal_opd') 
            is-invalid @enderror">Asal OPD</label>
            <div class="d-flex align-items-center">
            <input type="text" class="form-control" 
            id="asal_opd" name="asal_opd" value="{{ old('asal_opd') }}">
            <span class="valid-icon" id="valid-asal_opd" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('asal_opd')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="url" class="form-label @error('url') is-invalid @enderror">
                URL Applikasi
                <small class="form-text text-muted d-block">
                    (Contoh: bongsari.semarangkota.go.id)
                </small> 
            </label>
            <div class="d-flex align-items-center">
            <input type="text" class="form-control" 
            id="url" name="url" value="{{ old('url') }}">
            <span class="valid-icon" id="valid-url" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('url')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="file" class="form-label @error('file') is-invalid @enderror">Surat Tugas Pengambilan Berita Acara
                <small class="form-text text-muted d-block">
                    (Contoh template klik <a href="https://docs.google.com/document/d/1yMXzjmWdXelyIk06wam9qMPnrTlvFoiZ4cdaX7eW8oM/edit?usp=sharing"
                    target="_blank" rel="noopener noreferrer">disini</a> (.pdf maksimal 1MB))
                </small> 
            </label>
            <div class="d-flex align-items-center">
            <input class="form-control" type="file" id="file" name="file" value="{{ old('file') }}" accept=".pdf">
            <span class="valid-icon" id="valid-file" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
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
            @error('file')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Terms and Conditions Section -->
        <!-- <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="termsCheckbox" required>
                <label class="form-check-label" for="termsCheckbox">
                    Saya telah membaca dan menyetujui 
                    <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">
                        Syarat dan Ketentuan
                    </a>
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
    
        // Validasi untuk NIP
        $('#nip').on('input', function() {
            const validIcon = $('#valid-nip');
            const value = $(this).val();
    
            if (/^\d{18}$/.test(value)) { // Cek panjang dan format
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
    
        // Validasi untuk Asal OPD
        $('#asal_opd').on('input', function() {
            const validIcon = $('#valid-asal_opd');
            const value = $(this).val();
    
            if (value.length > 0 && value.length <= 255) {
                validIcon.show(); // Tampilkan centang hijau
                $(this).removeClass('is-invalid'); // Hapus kelas invalid
            } else {
                validIcon.hide(); // Sembunyikan centang hijau
                $(this).addClass('is-invalid'); // Tambahkan kelas invalid
            }
        });
    
        // Validasi untuk URL
        $('#url').on('input', function() {
            const validIcon = $('#valid-url');
            const regex = /^(https?:\/\/)?[a-z0-9-]+\.semarangkota\.go\.id$/i; // Cek format URL
            const value = $(this).val();
    
            if (value.length > 0 && value.length <= 255 && regex.test(value)) {
                validIcon.show(); // Tampilkan centang hijau
                $(this).removeClass('is-invalid'); // Hapus kelas invalid
            } else {
                validIcon.hide(); // Sembunyikan centang hijau
                $(this).addClass('is-invalid'); // Tambahkan kelas invalid
            }
        });
    
        // Validasi untuk File
        $('#file').on('change', function() {
            const validIcon = $('#valid-file');
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
        $('#cpanelForm').on('submit', function(e) {
            e.preventDefault();
            $('#confirmModal').modal('show');
        });

        // Handle confirmation
        $('#confirmSubmit').on('click', function() {
            $('#confirmModal').modal('hide');
            $('#cpanelForm')[0].submit();
        });
    
    });
</script>


<!-- Terms and Conditions Modal -->
<!-- <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Syarat dan Ketentuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                {{-- Panggil komponen terms and conditions --}}
                @include('dashboard.layouts.terms_condition')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                {{-- <button type="button" class="btn btn-primary" id="acceptTermsBtn">Saya Setuju</button> --}}
            </div>
        </div>
    </div>
</div> -->
<!-- 
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