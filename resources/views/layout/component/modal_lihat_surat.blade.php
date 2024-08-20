<!--Modal Lihat Surat-->
<div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileModalLabel">{{ $title ?? 'File Surat' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="ExternalFiles">
                    <iframe id="pdfViewer" src="" width="100%" height="500px"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
