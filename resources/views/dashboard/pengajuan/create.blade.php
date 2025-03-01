@extends('dashboard.layouts.main')

{{-- CSS dan JS --}}

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
    .is-invalid {
        border-color: red;
    }
    .valid-icon {
        display: none;
        color: green;
        margin-left: 5px;
    }
</style>

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Ajukan Permohonan Tanda Tangan Elektronik</h2>
</div>

<div class="col-lg-7">
    <form method="post" action="/dashboard/pengajuan/store" class="mb-5" id="pengajuanForm">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label @error('nama') is-invalid @enderror">Nama
                <small class="form-text text-muted d-block"> (Maksimal 20 Karakter termasuk spasi, tanpa tanda baca, misal ANDI SETIAWAN ST MM)
                </small>
            </label>
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
        </div>

        <div class="mb-3">
            <label for="nip" class="form-label @error('nip') is-invalid @enderror">NIP
                <small class="form-text text-muted d-block">
                    Contoh: 198709032018021002
                </small>
            </label>
            <div class="d-flex align-items-center">
                <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip') }}">
                <span class="valid-icon" id="valid-nip" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('nip')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nik" class="form-label @error('nik') is-invalid @enderror">NIK KTP
            <small class="form-text text-muted d-block">
                    Contoh: 3374110309872001
                </small>
            </label>
            <div class="d-flex align-items-center">
                <input type="text" class="form-control" 
                id="nik" name="nik" value="{{ old('nik') }}">
                <span class="valid-icon" id="valid-nik" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('nik')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

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
        </div>

        <div class="mb-3">
            <label for="no_telp" class="form-label @error('no_telp') is-invalid @enderror">
                Nomor Telepon
                <small class="form-text text-muted d-block">
                    Contoh: 0818824864
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

        <div class="mb-3">
            <label for="email_domain" class="form-label @error('email_domain') is-invalid @enderror">
                Email Domain
                <small class="form-text text-muted d-block">
                    Pastikan email valid dan bisa dibuka, hanya menerima email @semarangkota.go.id
                </small>  
            </label>
            <div class="d-flex align-items-center">
                <input type="email" class="form-control" 
                id="email_domain" name="email_domain" value="{{ old('email_domain') }}">
                <span class="valid-icon" id="valid-email" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('email_domain')
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
    // Validasi nama -> hanya huruf kapital dan maksimal 20 karakter
    $('#nama').on('input', function() {
        const validIcon = $('#valid-nama');
        const value = $(this).val();
        const regex = /^[\p{L} ]+$/u; // Hanya huruf dan spasi
        
        // Remove any non-letter characters (except spaces)
        if (!regex.test(value)) {
            $(this).val(value.replace(/[^A-Za-z\s]/g, '').substring(0, 20));
        }
        
        // Check length and regex
        if (value.length > 0 && value.length <= 20 && regex.test(value)) {
            validIcon.show();
            $(this).removeClass('is-invalid');
        } else {
            validIcon.hide();
            $(this).addClass('is-invalid');
        }
    });
    });

    // validasi nip
    $('#nip').on('input', function() {
        const value = $(this).val();
        const validIcon = $('#valid-nip');
        const regex = /^\d{0,18}$/; // Format NIP 18 digit

        // allow only numbers and when it comes to char, it will disseapear
        if (!regex.test(value)) {
            $(this).val(value.replace(/[^\d]/g, '').substring(0, 18));
        }

        if (/^\d{18}$/.test(value)) {
            validIcon.show();
            $(this).removeClass('is-invalid');
        } else {
            validIcon.hide();
            $(this).addClass('is-invalid');
        }
    });

    // validasi nik
    $('#nik').on('input', function() {
        const value = $(this).val();
        const validIcon = $('#valid-nik');
        const regex = /^\d{0,16}$/;

        // allow only numbers and when it comes to char, it will disseapear
        if (!regex.test(value)) {
            $(this).val(value.replace(/[^\d]/g, '').substring(0, 18));
        }

        if (/^\d{16}$/.test(value)) {
            validIcon.show();
            $(this).removeClass('is-invalid');
        } else {
            validIcon.hide();
            $(this).addClass('is-invalid');
        }
    });

    // validasi nama opd
    $('#nama_opd').on('input', function() {
        const value = $(this).val();
        const validIcon = $('#valid-nama_opd');
        const regex = /^[\p{L} ]+$/u;

        // Remove any non-letter characters (except spaces)
        if (!regex.test(value)) {
            $(this).val(value.replace(/[^A-Za-z\s]/g, ''));
        }

        if (value.length > 0 && value.length <= 255 && regex.test(value)) {
            validIcon.show();
            $(this).removeClass('is-invalid');
        } else {
            validIcon.hide();
            $(this).addClass('is-invalid');
        }
    });

    // validasi no telp
    $('#no_telp').on('input', function() {
        const input = $(this);
        const validIcon = $('#valid-no_telp');
        const regex = /^08\d{10,15}$/; // Format nomor Indonesia
        
        if (input.val().length > 0 && regex.test(input.val())) {
            validIcon.show();
            input.removeClass('is-invalid');
        } else {
            validIcon.hide();
            input.addClass('is-invalid');
        }
    });

    // validasi email domain
    $('#email_domain').on('input', function() {
        const input = $(this);
        const validIcon = $('#valid-email');
        const regex = /^[a-zA-Z0-9._%+-]+@semarangkota\.go\.id$/;
        //format nama email tidak boleh selain nama@semarangkota.go.id
        
        if (input.val().length > 0 && regex.test(input.val())) {
            validIcon.show();
            input.removeClass('is-invalid');
        } else {
            validIcon.hide();
            input.addClass('is-invalid');
        }
    });

    // validasi jabatan
    $('#jabatan').on('input', function() {
        const input = $(this);
        const validIcon = $('#valid-jabatan');
        const regex = /^[a-zA-Z\s]+$/;

        if (input.val().length > 0 && regex.test(input.val())) {
            validIcon.show();
            input.removeClass('is-invalid');
        } else {
            validIcon.hide();
            input.addClass('is-invalid');
        }
    });

    // Prevent form from submitting directly
    $('#pengajuanForm').on('submit', function(e) {
        e.preventDefault();
        $('#confirmModal').modal('show');
    });

    // Handle confirmation
    $('#confirmSubmit').on('click', function() {
        $('#confirmModal').modal('hide');
        $('#pengajuanForm')[0].submit();
    });

</script>

@endsection