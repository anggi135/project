@extends('layouts.app')

@section('title', 'URL Fuzzer Jobs | Cyber Defense')

@section('content')
<!-- Hero -->
<section class="text-white py-5" style="background: linear-gradient(to right, #1f2937, #111827);">
  <div class="container text-center">
    <h1 class="display-4 fw-bold animate__animated animate__fadeInDown">Fuzzing Url</h1>
    <p class="lead animate__animated animate__fadeInUp">Fuzzing URL, mengirim banyak permintaan otomatis ke URL target dengan wordlist untuk menemukan direktori/endpoint tersembunyi atau celah keamanan.</p>
  </div>
</section>

<section class="py-5" style="background: rgba(31,41,55,0.6);">
  <div class="container" data-aos="fade-up">
    <div class="card shadow-lg mx-auto mb-4" style="max-width: 990px; background: rgba(255,255,255,0.08); backdrop-filter: blur(6px); border:1px solid rgba(255,255,255,0.15);">
      <div class="card-body p-4 text-white">
        <h4 class="fw-bold mb-3">Buat Job Fuzzer Baru</h4>

        @if (session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('fuzz.create') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="mb-3">
            <label class="form-label fw-semibold">Target URL</label>
            <input type="url" name="target" class="form-control" placeholder="https://example.com" required>
            <div class="form-text text-white-50">Masukkan base URL target (tanpa path khusus kecuali memang diperlukan).</div>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Upload Wordlist (.txt)</label>
            <input type="file" name="wordlist_upload" id="wordlist_upload" class="form-control" accept=".txt">
            <div id="wordlistName" class="form-text text-white-50">
              Tidak ada file yang dipilih — akan memakai wordlist default jika kosong.
            </div>
          </div>

          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label class="form-label fw-semibold">Concurrency</label>
              <input type="number" name="concurrency" class="form-control" value="{{ old('concurrency', 5) }}" min="1">
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Rate Limit (req/s)</label>
              <input type="number" step="0.1" name="rate_limit" class="form-control" value="{{ old('rate_limit', 2.0) }}" min="0.1">
            </div>
          </div>

          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="legal" id="legal" required>
            <label class="form-check-label text-white" for="legal">
              Saya memiliki izin untuk melakukan pengujian pada target ini
            </label>
          </div>

          <div class="d-flex justify-content-start">
            <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-2">
              <i class="bi bi-rocket-takeoff"></i>
              <span class="d-none d-md-inline">Mulai Fuzzing</span>
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Riwayat -->
    <div class="card shadow-lg mx-auto" style="max-width: 990px; background: rgba(255,255,255,0.08); backdrop-filter: blur(6px); border:1px solid rgba(255,255,255,0.15);">
      <div class="card-body p-3 text-white">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="mb-0 fw-semibold">Riwayat Fuzz</h5>

          <form action="{{ route('fuzz.destroyAll') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus semua riwayat fuzz milik Anda?')" class="mb-0">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">
              🗑️ Hapus Semua
            </button>
          </form>
        </div>

        <div class="table-responsive">
          <table class="table table-bordered table-hover mb-0 text-white align-middle" style="background: rgba(255,255,255,0.05);">
            <thead style="background: rgba(255,255,255,0.1);">
              <tr>
                <th>ID</th>
                <th>Target</th>
                <th>Status</th>
                <th class="d-none d-sm-table-cell">Dibuat</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($jobs as $j)
                <tr>
                  <td>{{ $j->id }}</td>
                  <td class="text-break">{{ $j->target }}</td>
                  <td>
                    @switch($j->status)
                      @case('running') <span class="badge bg-success">Running</span> @break
                      @case('queued')  <span class="badge bg-secondary">Queued</span> @break
                      @case('failed')  <span class="badge bg-danger">Failed</span> @break
                      @default         <span class="badge bg-info text-dark">{{ ucfirst($j->status) }}</span>
                    @endswitch
                  </td>
                  <td class="d-none d-sm-table-cell">{{ $j->created_at->diffForHumans() }}</td>
                  <td class="text-nowrap">
                    <a href="{{ route('fuzz.show', $j->id) }}" class="btn btn-sm btn-outline-info d-inline-flex align-items-center gap-1" title="Lihat job">
                      <i class="bi bi-eye"></i>
                      <span class="d-none d-md-inline">Lihat</span>
                    </a>

                    <form action="{{ route('fuzz.destroy', $j->id) }}" method="POST" class="d-inline-block ms-1" onsubmit="return confirm('Hapus job ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1" title="Hapus job">
                        <i class="bi bi-trash"></i>
                        <span class="d-none d-md-inline">Hapus</span>
                      </button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center text-white-50 py-3">Belum ada job fuzzing.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div class="mt-3">
          @if($jobs instanceof \Illuminate\Pagination\LengthAwarePaginator)
            {{ $jobs->links() }}
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

<footer class="text-center text-white bg-dark py-3" data-aos="fade-up">
  <small>&copy; 2025 Cyber Defense Team | All Rights Reserved</small>
</footer>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<style>
  table td, table th { vertical-align: middle; }
</style>
@endpush
