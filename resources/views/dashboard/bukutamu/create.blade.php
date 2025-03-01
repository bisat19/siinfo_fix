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
    <h2> Agendakan Kunjungan Anda</h2>
</div>

<div class="col-lg-7">
    <form method="post" action="/dashboard/bukutamu/store" class="mb-5" id="bukutamuForm">
        @csrf
        <div class="mb-3">
        <label for="nama" class="form-label @error('nama') is-invalid @enderror">Nama</label>
        <div class="d-flex align-items-center">
        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
        id="nama" name="nama" value="{{ old('nama') }}">
        <span class="valid-icon" id="valid-nama"><i class="fas fa-check" style="color: green;"></i></span>
        </div>
        @error('nama')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="mb-3">
            <label for="no_telp" class="form-label @error('no_telp') is-invalid @enderror">
                Nomor Telepon 
                <small class="form-text text-muted d-block">
                    Harap menggunakan Nomor WhatsApp Anda!
                </small>
            </label>
            <div class="d-flex align-items-center">
            <input type="tel" class="form-control @error('no_telp') is-invalid @enderror" 
            id="no_telp" name="no_telp" value="{{ old('no_telp') }}">
            <span class="valid-icon" id="valid-no_telp"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('no_telp')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="instansi" class="form-label @error('instansi') is-invalid @enderror">
                Instansi 
            </label>
            <div class="d-flex align-items-center">
            <input type="text" class="form-control @error('instansi') is-invalid @enderror" 
            id="instansi" name="instansi" value="{{ old('instansi') }}">
            <span class="valid-icon" id="valid-instansi"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('instansi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="bidang_id" class="form-label">Tujuan Bidang</label>
            <div class="d-flex align-items-center">
            <select class="form-select {{ $errors->has('bidang_id') ? 'is-invalid' : '' }}" name="bidang_id" id="bidang_id">
                <option selected disabled>Silahkan Pilih Bidang Tujuan</option>
                @foreach ($bidangs as $bidang)
                <option value="{{ $bidang->id }}" {{ old('bidang_id') == $bidang->id ? 'selected' : '' }}>
                    {{ $bidang->name }}
                </option>  
                @endforeach
            </select>
            <span class="valid-icon" id="valid-bidang_id"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('bidang_id')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tujuan" class="form-label @error('tujuan') is-invalid @enderror">Tujuan Kunjungan</label>
            <div class="d-flex align-items-center">
            <textarea class="form-control @error('tujuan') is-invalid @enderror" id="tujuan" rows="3" name="tujuan">{{ old('tujuan') }}</textarea>
            <span class="valid-icon" id="valid-tujuan"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('tujuan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label @error('tanggal') is-invalid @enderror">Tanggal Kunjungan</label>
            <div class="d-flex align-items-center">
            <input 
                type="text" 
                class="form-control @error('tanggal') is-invalid @enderror" 
                id="tanggal" 
                name="tanggal"
                value="{{ old('tanggal') }}"
            >
            <span class="valid-icon" id="valid-tanggal"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('tanggal')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Waktu Kunjungan</label>
            <span class="valid-icon" id="valid-waktu"><i class="fas fa-check" style="color: green;"></i></span>
            <div id="waktu-options">
                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="radio" 
                        name="waktu" 
                        id="waktu-08:00" 
                        value="08:00"
                    >
                    <label class="form-check-label" for="waktu-08:00">
                        08:00
                    </label>
                </div>
                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="radio" 
                        name="waktu" 
                        id="waktu-10:00" 
                        value="10:00"
                    >
                    <label class="form-check-label" for="waktu-10:00">
                        10:00
                    </label>
                </div>
                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="radio" 
                        name="waktu" 
                        id="waktu-13:00" 
                        value="13:00"
                    >
                    <label class="form-check-label" for="waktu-13:00">
                        13:00
                    </label>
                </div>
            </div>
            @error('waktu')
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
    flatpickr("#tanggal", {
        dateFormat: "Y-m-d",
        minDate: "today",
        disable: [
            function(date) {
                // Disable Saturday and Sunday
                return (date.getDay() === 6 || date.getDay() === 0);
            }
        ],
        onChange: function(selectedDates, dateStr, instance) {
            // Cek tanggal yang dipilih
            $.ajax({
                url: "{{ route('bukutamu.check-tanggal') }}",
                method: 'GET',
                data: { tanggal: dateStr },
                success: function(response) {
                    if (response.count >= 3) {
                        alert('Tanggal sudah terdaftar 3 kali, silakan pilih tanggal lain.');
                        instance.clear();
                    } else {
                        // Tampilkan opsi waktu
                        showWaktuOptions(dateStr);
                    }
                }
            });
        }
    });

    function showWaktuOptions(tanggal) {
    $.ajax({
        url: "{{ route('bukutamu.get-waktu-options') }}",
        method: 'GET',
        data: { tanggal: tanggal },
        success: function(response) {
            // Log response untuk debugging
            console.log("Response dari server:", response);

            // Daftar semua waktu
            const semuaWaktu = ['08:00', '10:00', '13:00'];

            // Nonaktifkan semua radio button
            semuaWaktu.forEach(function(waktu) {
                $(`#waktu-${waktu}`)
                    .prop('disabled', true)
                    .parent().addClass('text-muted');
            });

            // Aktifkan hanya waktu yang tersedia
            response.waktu_tersedia.forEach(function(waktu) {
                $(`#waktu-${waktu}`)
                    .prop('disabled', false)
                    .parent().removeClass('text-muted');
            });
        },
        error: function(xhr, status, error) {
            console.error("Terjadi kesalahan:", error);
            console.log(xhr.responseText);
        }
    });
}

$(document).ready(function() {
    // Validasi untuk Nama
    $('#nama').on('input', function() {
        const input = $(this);
        const validIcon = $('#valid-nama');
        const regex = /^[a-zA-Z\s]+$/; // Hanya huruf dan spasi

        if (input.val().length > 0 && input.val().length <= 255 && regex.test(input.val())) {
            validIcon.show(); // Tampilkan centang hijau
            input.removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            input.addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });

    // Validasi untuk Nomor Telepon
    $('#no_telp').on('input', function() {
        const input = $(this);
        const validIcon = $('#valid-no_telp');
        const regex = /^[0-9]+$/; // Hanya angka

        if (input.val().length > 0 && input.val().length <= 15 && regex.test(input.val())) {
            validIcon.show(); // Tampilkan centang hijau
            input.removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            input.addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });

    // Validasi untuk Instansi
    $('#instansi').on('input', function() {
        const input = $(this);
        const validIcon = $('#valid-instansi');

        if (input.val().length > 0 && input.val().length <= 255) {
            validIcon.show(); // Tampilkan centang hijau
            input.removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            input.addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });

    //Validasi untuk Bidang
    $('#bidang_id').on('change', function() {
        const validIcon = $('#valid-bidang_id');
        const selectedValue = $(this).val();

        // Cek apakah nilai yang dipilih bukan opsi default
        if (selectedValue) {
            validIcon.show(); // Tampilkan centang hijau
            $(this).removeClass('is-invalid'); // Hapus kelas invalid jika ada
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            $(this).addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });

    // Validasi untuk Tujuan
    $('#tujuan').on('input', function() {
        const input = $(this);
        const validIcon = $('#valid-tujuan');

        if (input.val().length > 0) {
            validIcon.show(); // Tampilkan centang hijau
            input.removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            input.addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });

    // Validasi untuk Tanggal
    $('#tanggal').on('input', function() {
        const input = $(this);
        const validIcon = $('#valid-tanggal');

        // Cek apakah input adalah tanggal yang valid
        const date = new Date(input.val());
        if (input.val() && !isNaN(date.getTime())) {
            validIcon.show(); // Tampilkan centang hijau
            input.removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            input.addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });

    // Validasi untuk Waktu
    $('input[name="waktu"]').on('change', function() {
        const validIcon = $('#valid-waktu');

        if ($('input[name="waktu"]:checked').length > 0) {
            validIcon.show(); // Tampilkan centang hijau
            $('input[name="waktu"]').removeClass('is-invalid'); // Hapus kelas invalid
        } else {
            validIcon.hide(); // Sembunyikan centang hijau
            $('input[name="waktu"]').addClass('is-invalid'); // Tambahkan kelas invalid
        }
    });
    // Prevent form from submitting directly
    $('#bukutamuForm').on('submit', function(e) {
        e.preventDefault();
        $('#confirmModal').modal('show');
    });

    // Handle confirmation
    $('#confirmSubmit').on('click', function() {
        $('#confirmModal').modal('hide');
        $('#bukutamuForm')[0].submit();
    });

});
</script>
@endsection