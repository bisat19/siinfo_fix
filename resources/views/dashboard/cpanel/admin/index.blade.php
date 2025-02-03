@extends('dashboard.layouts.main')

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
              <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
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
          <th scope="col">No Telp</th>
          <th scope="col">Asal OPD</th>
          <th scope="col">Jabatan</th>
          <th scope="col">Dokumen</th>
          <th scope="col">Aksi</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($cpanel as $p)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $p->nama }}</td>
          <td>{{ $p->no_telp }}</td>
          <td>{{ $p->asal_opd }}</td>
          <td>{{ $p->jabatan }}</td>
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
                                        Lihat Dokumen ({{ strtoupper($fileExtension) }})
                                    </a>
                                @endif
                            @else
                                Tidak ada dokumen terlampir
                            @endif
          </td>
          <td>
            <form action="/dashboard/cpanel/admin/{{ $p->id }}/selesai" method="POST" class="d-inline">
            @csrf
            @method('put')
            <button class="badge bg-success border-0">
                <i class="bi bi-check-lg fs-6"></i></button>
            </form>
          </td>
          <td>              
            <span class="badge {{ 
            $p->status == 'diproses' ? 'bg-warning' : 
            ($p->status == 'selesai' ? 'bg-success' : 
            ($p->status == 'ditolak' ? 'bg-danger' : 'bg-secondary')) 
            }}" style="font-size: 0.9em;">
            {{ $p->status }}
            </span>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="d-flex justify-content-between align-items-center">
    <form action="/dashboard/cpanel/admin/selesaiSemua" method="POST" class="d-inline">
      @csrf
      @method('put')
      <button class="btn btn-success rounded">Selesaikan Semua</button>
    </form>
    
    <div class="d-inline">{{ $cpanel->links() }}</div>
</div>
@endsection