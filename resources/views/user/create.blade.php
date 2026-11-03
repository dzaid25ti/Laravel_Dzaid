<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-4">
        <!-- Breadcrumb & Navigation -->
        <small class="text-muted d-block mb-2">
            / User / Tambah User
        </small>
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">Tambah User</h2>
                <p class="text-muted mb-0">Form untuk menambahkan data user baru.</p>
            </div>
            <div>
                <a href="{{ route('user.index') }}" class="btn btn-dark px-4">
                    Kembali
                </a>
            </div>
        </div>

        <!-- Form Tambah User -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3">
                        <!-- Input Name -->
                        <div class="col-md-6">
                            <label for="name" class="form-label text-secondary fw-semibold">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Password -->
                        <div class="col-md-6">
                            <label for="password" class="form-label text-secondary fw-semibold">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Email -->
                        <div class="col-md-6">
                            <label for="email" class="form-label text-secondary fw-semibold">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Confirm Password -->
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label text-secondary fw-semibold">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-4">
                        <button type="submit" class="btn btn-dark px-4 me-2">Simpan</button>
                        <a href="{{ route('user.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>