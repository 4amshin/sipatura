<!--Notifikasi Singkat-->
@if (session('success'))
    <div class="alert alert-light-success color-success alert-dismissible show fade">
        <i class="bi bi-check-circle"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif (session('error'))
    <div class="alert alert-light-danger color-danger alert-dismissible show fade">
        <i class="bi bi-exclamation-circle"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
