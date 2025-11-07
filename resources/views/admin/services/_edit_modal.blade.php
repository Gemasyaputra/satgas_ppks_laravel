<div class="modal fade" id="editServiceModal{{ $service->id }}" tabindex="-1" aria-labelledby="editServiceModalLabel{{ $service->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editServiceModalLabel{{ $service->id }}">Edit Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title{{ $service->id }}" class="form-label">Judul Layanan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title{{ $service->id }}" name="title" value="{{ $service->title }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description{{ $service->id }}" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="description{{ $service->id }}" name="description" rows="3" required>{{ $service->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="phone{{ $service->id }}" class="form-label">Kontak (Telepon/Email) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="phone{{ $service->id }}" name="phone" value="{{ $service->phone }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="icon{{ $service->id }}" class="form-label">Nama Ikon Bootstrap</label>
                        <input type="text" class="form-control" id="icon{{ $service->id }}" name="icon" value="{{ $service->icon }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>