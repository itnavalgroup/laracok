<script>
    // Form Validation & Loading States for Attachments
    const validateFile = (files) => {
        const maxSize = 5 * 1024 * 1024; // 5MB
        const allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const extension = file.name.split('.').pop().toLowerCase();

            if (file.size > maxSize) {
                return { valid: false, message: 'Ukuran maksimal file adalah 5MB.' };
            }
            if (!allowedExtensions.includes(extension)) {
                return { valid: false, message: 'Hanya file JPG, JPEG, PNG, dan PDF yang diperbolehkan.' };
            }
        }
        return { valid: true };
    };

    const setBtnLoading = (btn) => {
        btn.disabled = true;
        btn.innerHTML = `<span class="spinner-border spinner-border-sm me-1"></span> Please wait...`;
    };

    document.addEventListener('submit', async function(e) {
        if (e.target.id === 'formAddAttachment' || e.target.id === 'formEditAttachment') {
            e.preventDefault();
            const form = e.target;
            const suffix = form.id === 'formAddAttachment' ? 'add' : 'edit';
            const hasCaptured = capturedPhotos[suffix].length > 0;
            const files = form.querySelector('input[type="file"]').files;
            const submitBtn = document.getElementById(suffix === 'add' ? 'btnUploadAdd' : 'btnUploadEdit');

            if (hasCaptured) {
                const success = await processCapturedPhotos(suffix);
                if (!success) return; 
            } else if (files.length > 0) {
                const validation = validateFile(files);
                if (!validation.valid) {
                    window.dispatchEvent(new CustomEvent('alert', { detail: { type: 'warning', title: 'Validation Error', message: validation.message } }));
                    return;
                }
            } else if (suffix === 'add') {
                window.dispatchEvent(new CustomEvent('alert', { detail: { type: 'warning', title: 'Validation Error', message: 'Silakan pilih file atau ambil foto.' } }));
                return;
            }

            if (submitBtn) setBtnLoading(submitBtn);
            form.submit();
        }
    });

    // Camera & Preview Logic
    let activeStream = null;
    let capturedPhotos = { add: [], edit: [] };

    function stopActiveCamera() {
        if (activeStream) {
            activeStream.getTracks().forEach(track => track.stop());
            activeStream = null;
        }
    }

    function handleTakePhoto(suffix) {
        const video = document.getElementById('video_' + suffix);
        const canvas = document.getElementById('canvas_' + suffix);
        const startBtn = document.getElementById('start-camera-' + suffix);
        const takeBtn = document.getElementById('take-photo-' + suffix);

        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0);

        const data = canvas.toDataURL('image/jpeg', 0.8);
        capturedPhotos[suffix].push(data);
        updateGalleryUI(suffix);
    }

    function updateGalleryUI(suffix) {
        const list = document.getElementById(suffix + '_gallery_list');
        const cont = document.getElementById(suffix + '_gallery_container');
        list.innerHTML = '';

        if (capturedPhotos[suffix].length === 0) {
            cont.classList.add('d-none');
            return;
        }

        capturedPhotos[suffix].forEach((photo, index) => {
            const wrapper = document.createElement('div');
            wrapper.className = 'position-relative';
            wrapper.style.width = '80px';
            wrapper.style.height = '80px';
            wrapper.innerHTML = `
                <img src="${photo}" class="img-fluid rounded w-100 h-100 object-fit-cover border">
                <button type="button" class="btn btn-danger btn-sm rounded-circle position-absolute top-0 end-0 p-0 d-flex align-items-center justify-content-center"
                        style="width:20px; height:20px; font-size:10px;" onclick="removeCapturedPhoto('${suffix}', ${index})">
                    <i class="ti ti-x"></i>
                </button>
            `;
            list.appendChild(wrapper);
        });
        cont.classList.remove('d-none');
    }

    window.removeCapturedPhoto = function(suffix, index) {
        capturedPhotos[suffix].splice(index, 1);
        updateGalleryUI(suffix);
    };

    async function processCapturedPhotos(suffix) {
        const photos = capturedPhotos[suffix];
        if (photos.length === 0) return null;

        const mimeInput = document.getElementById('captured_photo_mime_' + suffix);
        const dataInput = document.getElementById('captured_photo_' + suffix);

        if (photos.length === 1) {
            const singleData = photos[0];
            const commaIdx = singleData.indexOf(',');
            const headerPart = singleData.substring(0, commaIdx);
            const rawBase64 = singleData.substring(commaIdx + 1);
            const mimeMatch = headerPart.match(/^data:([^;]+)/);
            mimeInput.value = mimeMatch ? mimeMatch[1] : 'image/jpeg';
            dataInput.value = rawBase64;
            return true;
        }

        const { jsPDF } = window.jspdf;
        const maxSize = 5 * 1024 * 1024;
        let quality = 0.8;
        let pdfBase64 = null;
        let fileSize = 0;

        while (quality > 0.05) {
            const doc = new jsPDF();
            for (let i = 0; i < photos.length; i++) {
                if (i > 0) doc.addPage();
                const img = photos[i];
                const imgProps = doc.getImageProperties(img);
                const pdfWidth = doc.internal.pageSize.getWidth();
                const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
                doc.addImage(img, 'JPEG', 0, 0, pdfWidth, pdfHeight, undefined, 'FAST');
            }
            pdfBase64 = doc.output('datauristring').split(',')[1];
            fileSize = (pdfBase64.length * 3) / 4;

            if (fileSize <= maxSize) {
                mimeInput.value = 'application/pdf';
                dataInput.value = pdfBase64;
                return true;
            }
            quality -= 0.15;
        }

        window.dispatchEvent(new CustomEvent('alert', {
            detail: { type: 'danger', title: 'File Too Large', message: 'Total file terlalu besar (>5MB) dan tidak bisa di-compress lagi. Silakan hapus beberapa foto.' }
        }));
        return null;
    }

    function handleFilePreview(input, suffix) {
        const previewCont = document.getElementById(suffix + '_preview_container');
        const previewImg = document.getElementById(suffix + '_preview_img');
        const previewPdf = document.getElementById(suffix + '_preview_pdf');
        const pdfName = document.getElementById(suffix + '_pdf_name');
        const hiddenInput = document.getElementById('captured_photo_' + suffix);
        const galleryCont = document.getElementById(suffix + '_gallery_container');

        capturedPhotos[suffix] = [];
        updateGalleryUI(suffix);
        hiddenInput.value = '';

        if (input.files && input.files[0]) {
            const file = input.files[0];
            previewCont.classList.remove('d-none');
            const fileReader = new FileReader();
            fileReader.onload = function(e) {
                if (file.type.match('image.*')) {
                    previewImg.src = e.target.result;
                    previewImg.classList.remove('d-none');
                    previewPdf.classList.add('d-none');
                } else if (file.type === 'application/pdf') {
                    previewImg.classList.add('d-none');
                    previewPdf.classList.remove('d-none');
                    pdfName.textContent = file.name;
                }
            };
            fileReader.readAsDataURL(file);
        } else {
            previewCont.classList.add('d-none');
        }
    }

    document.querySelectorAll('input[name="add_upload_mode"], input[name="edit_upload_mode"]').forEach(radio => {
        radio.addEventListener('change', function(e) {
            const suffix = this.name.startsWith('add') ? 'add' : 'edit';
            const uploadCont = document.getElementById(suffix + '_upload_container');
            const cameraCont = document.getElementById(suffix + '_camera_container');
            const startBtn = document.getElementById('start-camera-' + suffix);

            if (this.value === 'upload') {
                uploadCont.classList.remove('d-none');
                cameraCont.classList.add('d-none');
                stopActiveCamera();
            } else {
                uploadCont.classList.add('d-none');
                cameraCont.classList.remove('d-none');
                startBtn.classList.remove('d-none');
                document.getElementById('input_' + suffix + '_file').value = '';
                document.getElementById(suffix + '_preview_container').classList.add('d-none');
            }
        });
    });

    ['add', 'edit'].forEach(suffix => {
        document.getElementById('start-camera-' + suffix)?.addEventListener('click', async function() {
            const video = document.getElementById('video_' + suffix);
            const startBtn = this;
            const takeBtn = document.getElementById('take-photo-' + suffix);
            const previewCont = document.getElementById(suffix + '_preview_container');
            const galleryCont = document.getElementById(suffix + '_gallery_container');

            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                alert("Camera access not available.");
                return;
            }
            try {
                stopActiveCamera();
                activeStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
                video.srcObject = activeStream;
                video.classList.remove('d-none');
                startBtn.classList.add('d-none');
                takeBtn.classList.remove('d-none');
                previewCont.classList.add('d-none');
                galleryCont.classList.add('d-none');
            } catch (err) {
                alert("Error accessing camera: " + err.message);
            }
        });

        document.getElementById('take-photo-' + suffix)?.addEventListener('click', () => handleTakePhoto(suffix));
        document.getElementById('input_' + suffix + '_file')?.addEventListener('change', function() { handleFilePreview(this, suffix); });
    });

    ['modalAddAttachment', 'modalEditAttachment'].forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.addEventListener('hidden.bs.modal', function() {
                stopActiveCamera();
                const suffix = id === 'modalAddAttachment' ? 'add' : 'edit';
                capturedPhotos[suffix] = [];
                updateGalleryUI(suffix);
                document.getElementById(suffix + '_preview_container')?.classList.add('d-none');
                const pPhoto = document.getElementById('captured_photo_' + suffix);
                if (pPhoto) pPhoto.value = '';

                if (suffix === 'add') {
                    document.getElementById('addModeUpload').checked = true;
                    document.getElementById('add_upload_container').classList.remove('d-none');
                    document.getElementById('add_camera_container').classList.add('d-none');
                    document.getElementById('start-camera-add').innerHTML = '<i class="ti ti-video me-1"></i> Start Camera';
                    document.getElementById('start-camera-add').classList.remove('d-none');
                } else {
                    document.getElementById('editModeUpload').checked = true;
                    document.getElementById('edit_upload_container').classList.remove('d-none');
                    document.getElementById('edit_camera_container').classList.add('d-none');
                    document.getElementById('start-camera-edit').innerHTML = '<i class="ti ti-video me-1"></i> Start Camera';
                    document.getElementById('start-camera-edit').classList.remove('d-none');
                }
            });
        }
    });

    window.openPreview = function(url, attachment, note, deleteUrl, updateUrl, catId, canEdit) {
        document.getElementById('previewNote').textContent = note;
        document.getElementById('previewAttachment').textContent = attachment;
        const body = document.getElementById('previewBody');
        body.innerHTML = '<div class="spinner-border text-primary mt-5" role="status"></div>';

        const lower = url.toLowerCase().split('?')[0];
        const isPdf = lower.endsWith('.pdf') || url.startsWith('data:application/pdf');

        if (isPdf) {
            body.innerHTML = `<iframe src="${url}" style="width:100%;height:75vh;" frameborder="0"></iframe>`;
        } else {
            body.innerHTML = `<img src="${url}" style="max-width:100%;max-height:75vh;object-fit:contain;" class="d-block mx-auto border shadow-sm rounded">`;
        }

        document.getElementById('downloadBtn').href = url;

        const editBtn = document.getElementById('editBtn');
        const deleteBtn = document.getElementById('deleteBtn');

        if (canEdit === true || canEdit === "true") {
            editBtn.style.display = 'inline-block';
            deleteBtn.style.display = 'inline-block';

            editBtn.onclick = function() {
                const modalPreview = bootstrap.Modal.getInstance(document.getElementById('previewModal'));
                if (modalPreview) modalPreview.hide();

                document.getElementById('formEditAttachment').action = updateUrl;
                document.getElementById('edit_note').value = note;
                document.getElementById('edit_id_attachment').value = catId;

                const modalEdit = new bootstrap.Modal(document.getElementById('modalEditAttachment'));
                modalEdit.show();
            };

            deleteBtn.onclick = function() {
                window.showConfirm({
                    title: 'Hapus Attachment',
                    message: 'Apakah Anda yakin ingin menghapus attachment ini?',
                    type: 'danger',
                    btnText: 'Ya, Hapus',
                    onConfirm: () => {
                        window.location.href = deleteUrl;
                    }
                });
            };
        } else {
            editBtn.style.display = 'none';
            deleteBtn.style.display = 'none';
        }

        const myModal = new bootstrap.Modal(document.getElementById('previewModal'));
        myModal.show();
    };

    window.previewAttachment = function(el) {
        const url = el.dataset.url;
        const type = el.dataset.type;
        const note = el.dataset.note;
        const deleteUrl = el.dataset.delete;
        const updateUrl = el.dataset.update;
        const catId = el.dataset.catid;
        const canEdit = el.dataset.canEdit;
        window.openPreview(url, type, note, deleteUrl, updateUrl, catId, canEdit);
    };
</script>
