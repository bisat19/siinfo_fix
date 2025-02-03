@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Tambah Bidang</h1>
</div>

<div class="">
  @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show col-lg-6" role="alert">
        <span>{{ session('success') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  @endif
</div>

<div class="table-responsive small col-lg-6">
    <a href="/dashboard/bidangs/create" class="btn btn-primary mb-3">Tambah Bidang Kerja</a>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama Bidang</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($bidangs as $bidang)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $bidang->name }}</td>
          <td>
            <a href="/dashboard/bidangs/{{ $bidang->id }}/edit" class="badge bg-warning"><i class="bi bi-pencil-square fs-6"></i></a>
            <form action="/dashboard/bidangs/{{ $bidang->id }}" method="post" class="d-inline">
              @method('delete')
                <button class="badge bg-danger border-0" onclick="return confirm('Anda yakin?')">
                  <i class="bi bi-trash fs-6"></i></button>
              @csrf
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection