<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV & Portofolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f5f7; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .cv-sidebar { background-color: #1f2833; color: #ffffff; min-height: 100%; }
        .badge-header { background-color: #c5a059; color: #000; font-weight: bold; border-radius: 20px; padding: 6px 20px; display: inline-block; margin-bottom: 15px; font-size: 0.9rem; letter-spacing: 1px; }
        .profile-img { width: 140px; height: 140px; object-fit: cover; border-radius: 50%; border: 4px solid #c5a059; }
        .section-title { font-weight: 700; border-bottom: 2px solid #1f2833; padding-bottom: 5px; margin-bottom: 15px; letter-spacing: 0.5px; }
    </style>
</head>
<body>

<div class="container my-4">
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal Menyimpan Data!</strong>
            <ul class="mb-0 mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0 text-dark">Daftar Curriculum Vitae</h3>
        <button class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#modalTambah">+ Tambah Data CV Baru</button>
    </div>

    @forelse($portofolioList as $portofolio)
        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-warning btn-sm me-2 fw-bold" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $portofolio->id }}">Edit Data CV</button>
            <form action="{{ route('portofolio.destroy', $portofolio->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm fw-bold" onclick="return confirm('Yakin mau hapus CV ini?')">Hapus Data CV</button>
            </form>
        </div>

        <div class="card border-0 shadow-lg overflow-hidden mb-5">
            <div class="row g-0">
                <!-- Sidebar Kiri -->
                <div class="col-md-4 cv-sidebar p-4 text-center text-md-start">
                    <div class="text-center my-3">
                        @if($portofolio->foto)
                            <img src="{{ asset('storage/' . $portofolio->foto) }}" alt="Foto Profil" class="profile-img mb-3">
                        @else
                            <img src="https://via.placeholder.com/150" alt="Foto Profil" class="profile-img mb-3">
                        @endif
                    </div>

                    <div class="mt-4">
                        <div class="badge-header text-uppercase">Kontak</div>
                        <p class="small text-white-50 mb-2"><i class="bi bi-telephone-fill me-2"></i> {{ $portofolio->kontak }}</p>
                    </div>

                    <div class="mt-4">
                        <div class="badge-header text-uppercase">Tempat Tinggal</div>
                        <p class="small text-white-50"><i class="bi bi-geo-alt-fill me-2"></i> {{ $portofolio->tempat_tinggal }}</p>
                    </div>

                    <div class="mt-4 mb-3">
                        <div class="badge-header text-uppercase">Sosial Media</div>
                        <p class="small text-white-50"><i class="bi bi-globe me-2"></i> {{ $portofolio->sosial_media }}</p>
                    </div>
                </div>

                <div class="col-md-8 bg-white p-4 p-md-5">
                    <div class="mb-4">
                        <h1 class="fw-bold text-uppercase m-0" style="letter-spacing: 2px;">{{ $portofolio->nama }}</h1>
                        <p class="fst-italic text-secondary fs-5">Curriculum Vitae</p>
                    </div>

                    @if($portofolio->tentang_saya)
                    <div class="mb-4">
                        <h5 class="section-title text-uppercase">Tentang Saya</h5>
                        <p class="text-secondary small leading-relaxed" style="white-space: pre-line;">{{ $portofolio->tentang_saya }}</p>
                    </div>
                    @endif

                    <div class="mb-4">
                        <h5 class="section-title text-uppercase">Riwayat Pendidikan</h5>
                        <p class="text-secondary small leading-relaxed" style="white-space: pre-line;">{{ $portofolio->riwayat_pendidikan }}</p>
                    </div>

                    @if($portofolio->pengalaman_kerja)
                    <div class="mb-4">
                        <h5 class="section-title text-uppercase">Pengalaman Kerja</h5>
                        <p class="text-secondary small leading-relaxed" style="white-space: pre-line;">{{ $portofolio->pengalaman_kerja }}</p>
                    </div>
                    @endif

                    <div class="mb-4">
                        <h5 class="section-title text-uppercase">Keahlian</h5>
                        <p class="text-secondary small leading-relaxed" style="white-space: pre-line;">{{ $portofolio->keahlian }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalEdit{{ $portofolio->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('portofolio.update', $portofolio->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Data CV</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Upload Foto Profil (Opsional)</label>
                                <input type="file" name="foto" class="form-control" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" value="{{ $portofolio->nama }}" required>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Kontak</label>
                                    <input type="text" name="kontak" class="form-control" value="{{ $portofolio->kontak }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Tempat Tinggal</label>
                                    <input type="text" name="tempat_tinggal" class="form-control" value="{{ $portofolio->tempat_tinggal }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Sosial Media</label>
                                    <input type="text" name="sosial_media" class="form-control" value="{{ $portofolio->sosial_media }}" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tentang Saya</label>
                                <textarea name="tentang_saya" class="form-control" rows="3">{{ $portofolio->tentang_saya }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Riwayat Pendidikan</label>
                                <textarea name="riwayat_pendidikan" class="form-control" rows="3" required>{{ $portofolio->riwayat_pendidikan }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pengalaman Kerja</label>
                                <textarea name="pengalaman_kerja" class="form-control" rows="3">{{ $portofolio->pengalaman_kerja }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Keahlian</label>
                                <textarea name="keahlian" class="form-control" rows="3" required>{{ $portofolio->keahlian }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning fw-bold">Update Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center py-4">
            Belum ada data CV. Klik tombol <strong>+ Tambah Data CV Baru</strong> di atas untuk membuat CV pertama kamu!
        </div>
    @endforelse
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('portofolio.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data CV Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Upload Foto Profil (Opsional)</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Kontak (HP/Email)</label>
                            <input type="text" name="kontak" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tempat Tinggal</label>
                            <input type="text" name="tempat_tinggal" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Sosial Media</label>
                            <input type="text" name="sosial_media" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tentang Saya</label>
                        <textarea name="tentang_saya" class="form-control" rows="3" placeholder="Tulis deskripsi singkat diri kamu..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Riwayat Pendidikan</label>
                        <textarea name="riwayat_pendidikan" class="form-control" rows="3" placeholder="Contoh: S1 Teknik Informatika (2022-Sekarang)" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pengalaman Kerja</label>
                        <textarea name="pengalaman_kerja" class="form-control" rows="3" placeholder="Contoh: Web Developer di PT ABC (2023)"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keahlian</label>
                        <textarea name="keahlian" class="form-control" rows="3" placeholder="Contoh: HTML, CSS, JavaScript, PHP, Laravel" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary fw-bold">Simpan Data CV</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>