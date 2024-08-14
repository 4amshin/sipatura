<div class="modal fade" id="tambahSuratKeluarModal" tabindex="-1" aria-labelledby="tambahSuratKeluarModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahSuratKeluarModalTitle">Tambah Surat Keluar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <form id="formTambahSuratKeluar" method="POST" action="{{ route('suratKeluar.store') }}" enctype="multipart/form-data">
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

                    <!-- Tanggal Keluar -->
                    <div class="form-group">
                        <label for="tanggal_keluar">Tanggal Keluar</label>
                        <input type="date" id="tanggal_keluar" class="form-control" name="tanggal_keluar" required>
                    </div>

                    <!-- Kepada -->
                    <div class="form-group">
                        <label for="kepada">Kepada</label>
                        <input type="text" id="kepada" class="form-control" name="kepada" required>
                    </div>

                    <!-- Perihal -->
                    <div class="form-group">
                        <label for="perihal">Perihal</label>
                        <textarea id="perihal" class="form-control" name="perihal" required></textarea>
                    </div>

                    <!-- File -->
                    <div class="form-group">
                        <label for="file">Unggah File</label>
                        <input type="file" id="file" class="form-control" name="file">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Batal</span>
                </button>
                <button type="submit" class="btn btn-primary ms-1" form="formTambahSuratKeluar">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Simpan</span>
                </button>
            </div>
        </div>
    </div>
</div>
