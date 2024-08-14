<div class="modal fade" id="tambahSuratMasukModal" tabindex="-1" aria-labelledby="tambahSuratMasukModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahSuratMasukModalTitle">Tambah Surat Masuk</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <form id="formTambahSuratMasuk" method="POST" action="{{ route('suratMasuk.store') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Nomor Surat -->
                    <div class="form-group">
                        <label for="nomor_surat">Nomor Surat</label>
                        <input type="text" id="nomor_surat" class="form-control" name="nomor_surat" required>
                    </div>

                    <!-- Tanggal Surat -->
                    <div class="form-group">
                        <label for="tanggal_surat">Tanggal Surat</label>
                        <input type="date" id="tanggal_surat" class="form-control" name="tanggal_surat" required>
                    </div>

                    <!-- Tanggal Masuk -->
                    <div class="form-group">
                        <label for="tanggal_masuk">Tanggal Masuk</label>
                        <input type="date" id="tanggal_masuk" class="form-control" name="tanggal_masuk" required>
                    </div>

                    <!-- Pengirim -->
                    <div class="form-group">
                        <label for="pengirim">Pengirim</label>
                        <input type="text" id="pengirim" class="form-control" name="pengirim" required>
                    </div>

                    <!-- Perihal -->
                    <div class="form-group">
                        <label for="perihal">Perihal</label>
                        <textarea id="perihal" class="form-control" name="perihal" required></textarea>
                    </div>

                    <!-- Unggah File Surat -->
                    <div class="form-group">
                        <label for="fileSurat">Unggah File Surat</label>
                        <input type="file" class="form-control" id="fileSurat" name="file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.bmp">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Batal</span>
                </button>
                <button type="submit" class="btn btn-primary ms-1" form="formTambahSuratMasuk">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Simpan</span>
                </button>
            </div>
        </div>
    </div>
</div>
