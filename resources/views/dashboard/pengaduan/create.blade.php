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
    <h2>Layanan Pengaduan</h2>
</div>

<div class="col-lg-7">
    <form id="pengaduanForm" method="post" action="/dashboard/pengaduan/store" 
    enctype="multipart/form-data" class="mb-5">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label @error('nama') is-invalid @enderror">Nama</label>
            <div class="d-flex align-items-center">
                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}">
                <span class="valid-icon" id="valid-nama" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('nama')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="no_telp" class="form-label @error('no_telp') is-invalid @enderror">
                Nomor Telepon PIC
                <small class="form-text text-muted d-block">
                Masukkan Whatsapp Aktif! Contoh: 085877261287
                </small> 
            </label>
            <div class="d-flex align-items-center">
                <input type="tel" class="form-control" id="no_telp" name="no_telp" value="{{ old('no_telp') }}">
                <span class="valid-icon" id="valid-no_telp" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('no_telp')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="jenis_id" class="form-label">Jenis Pengaduan</label>
            <div class="d-flex align-items-center">
                <select class="form-select @error('jenis_id') is-invalid @enderror" name="jenis_id" id="jenis_id">
                    <option selected disabled>Silahkan Pilih Jenis Pengaduan</option>
                    @foreach ($jenispengaduan as $jp)
                        <option value="{{ $jp->id }}" {{ old('jenis_id') == $jp->id ? 'selected' : '' }}>{{ $jp->nama }}</option>  
                    @endforeach
                </select>
                <span class="valid-icon" id="valid-jenis_id" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('jenis_id')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="file" class="form-label @error('file') is-invalid @enderror">Dokumen Pengaduan</label>
            <small class="form-text text-muted d-block">
                Maksimal ukuran file 10MB. Format file: PDF
            </small>
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

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Pengaduan</label>
            <div class="d-flex align-items-center">
                <textarea id="deskripsi" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5">{{ old('deskripsi') }}</textarea>
                <span class="valid-icon" id="valid-deskripsi" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('deskripsi')
            <div class="invalid-feedback d-block">
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
    // Validasi Nama
    $('#nama').on('input', function() {
        const value = $(this).val();
        const validIcon = $('#valid-nama');
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

    // Validasi Nomor Telepon
    $('#no_telp').on('input', function() {
        const value = $(this).val();
        const validIcon = $('#valid-no_telp');
        const regex = /^08\d{8,12}$/; // Format nomor Indonesia
        
        // allow only numbers and when it comes to char, it will disseapear
        if (!regex.test(value)) {
            $(this).val(value.replace(/[^\d]/g, '').substring(0, 15));
        }
        
        if (/^08\d{8,12}$/.test(value)) {
            validIcon.show();
            $(this).removeClass('is-invalid');
        } else {
            validIcon.hide();
            $(this).addClass('is-invalid');
        }
    });

    // Validasi Jenis Pengaduan
    $('#jenis_id').on('change', function() {
        const input = $(this);
        const validIcon = $('#valid-jenis_id');
        
        if (input.val() && input.val() !== 'Silahkan Pilih Jenis Pengaduan') {
            validIcon.show();
            input.removeClass('is-invalid');
        } else {
            validIcon.hide();
            input.addClass('is-invalid');
        }
    });

    // Validasi File
    $('#file').on('change', function() {
        const input = $(this);
        const validIcon = $('#valid-file');
        const allowedExtensions = ['pdf'];
        const maxSize = 5 * 1024 * 1024; // 5MB
        
        const file = this.files[0];
        if (file) {
            const fileExtension = file.name.split('.').pop().toLowerCase();
            
            if (allowedExtensions.includes(fileExtension) && file.size <= maxSize) {
                validIcon.show();
                input.removeClass('is-invalid');
            } else {
                validIcon.hide();
                input.addClass('is-invalid');
            }
        }
    });

    // Validasi Deskripsi
    $('#deskripsi').on('input', function() {
        const input = $(this);
        const validIcon = $('#valid-deskripsi');
        
        if (input.val().length > 0) { // Minimal 10 karakter
            validIcon.show();
            input.removeClass('is-invalid');
        } else {
            validIcon.hide();
            input.addClass('is-invalid');
        }
    });

    // Replace the existing submit handler code with:
    $('#pengaduanForm').on('submit', function(e) {
        e.preventDefault();
        $('#confirmModal').modal('show');
    });

    // Handle confirmation
    $('#confirmSubmit').on('click', function() {
        $('#confirmModal').modal('hide');
        $('#pengaduanForm')[0].submit();
    });
});
</script>

@endsection