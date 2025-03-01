@extends('dashboard.layouts.main')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Dashboard Pengajuan Pembuatan dan Reset Akun CPANEL</h1>
</div>

<div class="">
  @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show col-lg-6" role="alert">
        <span>{{ session('success') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  @endif
</div>

<div class="">
  <form method="GET" action="{{ url()->current() }}" class="mb-3 d-flex gap-2 align-items-end">
      <!-- Filter Status -->
      <div class="col-lg-3 d-flex align-items-end">
          <select name="status" class="form-select" style="min-width: 200px;">
              <option value="" disabled selected hidden>Status</option>
              <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
              <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
              <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
          </select>
      </div>
      <button type="submit" class="btn btn-primary">Filter</button>
  </form>
</div>


<div class="table-responsive small col-lg-15">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama Pemohon</th>
          <th scope="col">No Telepon</th>
          <th scope="col">Asal OPD</th>
          {{-- <th scope="col">Jabatan</th> --}}
          <th scope="col">Dokumen</th>
          <th scope="col">Status</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($cpanel as $p)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $p->nama }}</td>
          <td>{{ $p->no_telp }}</td>
          <td>{{ $p->asal_opd }}</td>
          {{-- <td>{{ $p->jabatan }}</td> --}}
          <td>
            @if($p->file)
                                @php
                                    $fileExtension = pathinfo($p->file, PATHINFO_EXTENSION);
                                    $filePath = asset('storage/' . $p->file);
                                @endphp

                                @if(in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif']))
                                    <a href="{{ $filePath }}" target="_blank">
                                        <img src="{{ $filePath }}" 
                                             alt="Dokumen CPANEL" 
                                             class="img-fluid" 
                                             style="max-height: 200px;">
                                    </a>
                                @else
                                    <a href="{{ $filePath }}" 
                                       target="_blank" 
                                       class="btn btn-outline-primary">
                                        <i class="bi bi-file-earmark-{{ $fileExtension }}"></i> 
                                        Dokumen ({{ strtoupper($fileExtension) }})
                                    </a>
                                @endif
                            @else
                            Tidak ada dokumen terlampir
                            @endif
                          </td>
          <td>              
            <span class="badge {{ 
              $p->status == 'diproses' ? 'bg-warning' : 
              ($p->status == 'disetujui' ? 'bg-success' : 
              ($p->status == 'ditolak' ? 'bg-danger' : 'bg-secondary')) 
              }}" style="font-size: 0.9em;">
              {{ $p->status }}
            </span>
          </td>
          <td>
            <div class="d-flex align-items-center gap-1">
              <a href="{{ route('cpanel.admin.tanggapan', $p->id) }}" class="badge bg-warning d-flex align-items-center justify-content-center">
                  <i class="bi bi-pencil-square fs-6"></i>
              </a>
              <a href="{{ route('cpanel.admin.show', $p->id) }}" class="badge bg-primary d-flex align-items-center justify-content-center">
                  <i class="bi bi-eye fs-6"></i>
              </a>
          
              @if ($p->status !== 'disetujui' && $p->status !== 'ditolak')
                  <form action="/dashboard/cpanel/admin/{{ $p->id }}/selesai" method="POST" class="d-inline m-0" 
                      onsubmit="event.preventDefault(); confirmAction('setuju').then((result) => { if (result) this.submit(); })">
                      @csrf
                      @method('put')
                      <button class="badge bg-success border-0 d-flex align-items-center justify-content-center">
                          <i class="bi bi-check-lg fs-6"></i>
                      </button>
                  </form>
                  <form action="/dashboard/cpanel/admin/{{ $p->id }}/tolak" method="POST" class="d-inline m-0" 
                      onsubmit="event.preventDefault(); confirmAction('tolak').then((result) => { if (result) this.submit(); })">
                      @csrf
                      @method('put')
                      <button class="badge bg-danger border-0 d-flex align-items-center justify-content-center">
                          <i class="bi bi-x-lg fs-6"></i>
                      </button>
                  </form>
              @endif
          </div>
          
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
    <form action="/dashboard/cpanel/admin/selesaiSemua" method="POST" class="d-inline" 
    onsubmit="event.preventDefault(); confirmAction('setujuSemua').then((result) => { if (result) this.submit(); })">
      @csrf
      @method('put')
      <button class="btn btn-success rounded mt-1 me-2">Setujui Semua</button>
    </form>

    <form action="/dashboard/cpanel/admin/export-excel" method="GET" class="d-inline">
      <button class="btn btn-success rounded mt-1">Export Excel</button>
    </form>
    </div>

    
    <div class="d-inline">{{ $cpanel->links() }}</div>
</div>

<script>
  function confirmAction(action) {
      let title, text, icon;

      if (action === 'setuju') {
          title = 'Apakah Anda yakin?';
          text = 'Anda akan menyetujui entri ini.';
          icon = 'warning';
      } else if (action === 'tolak') {
          title = 'Apakah Anda yakin?';
          text = 'Anda akan menolak entri ini.';
          icon = 'warning';
      } else if (action === 'setujuSemua') {
            title = 'Apakah Anda yakin?';
            text = 'Anda akan menyetujui semua entri ini.';
            icon = 'warning';
      }

      return Swal.fire({
          title: title,
          text: text,
          icon: icon,
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya',
          cancelButtonText: 'Batal'
      }).then((result) => {
          if (result.isConfirmed) {
              return true; // Form akan dikirim
          } else {
              return false; // Form tidak akan dikirim
          }
      });
  }
</script>
@endsection