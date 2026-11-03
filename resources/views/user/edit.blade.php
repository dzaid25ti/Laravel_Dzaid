<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-4">
        <!-- Breadcrumb & Navigation -->
        <small class="text-muted d-block mb-2">
            / User / Edit User
        </small>
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">Edit User</h2>
                <p class="text-muted mb-0">Form untuk memperbarui data user.</p>
            </div>
            <div>
                <a href="{{ route('user.index') }}" class="btn btn-dark px-4">
                    Kembali
                </a>
            </div>
        </div>

        <!-- Form Edit User -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('user.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3">
                        <!-- Input Name -->
                        <div class="col-md-6">
                            <label for="name" class="form-label text-secondary fw-semibold">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Password (Opsional saat Edit) -->
                        <div class="col-md-6">
                            <label for="password" class="form-label text-secondary fw-semibold">Password <small class="text-muted">(Kosongkan jika tidak ingin diubah)</small></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Email -->
                        <div class="col-md-6">
                            <label for="email" class="form-label text-secondary fw-semibold">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>