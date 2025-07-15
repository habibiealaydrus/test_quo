<div class="offcanvas offcanvas-end" tabindex="-1" id="sendQuotationOffcanvas" aria-labelledby="sendQuotationOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 id="sendQuotationOffcanvasLabel" class="offcanvas-title">Send Quotation</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
        <form id="sendQuotationForm"
            method="POST"
            action="{{ route('sendQuotation') }}" 
            data-quotation-slug="{{ $data['quotation']->quoSlug ?? '' }}"
            data-quotation-code="{{ $data['quotation']->quoCode ?? '' }}"
            data-quotation-company-name="{{ $data['quotation']->quoCompany ?? '' }}"
            data-quotation-pic="{{ $data['quotation']->quoPIC ?? '' }}">
            @csrf

            <input type="hidden" name="idQuo" value="{{ $data['quotation']->quotationId ?? '' }}">

            <div class="mb-3">
                <label class="form-label" for="nameTo">Name</label>
                <input type="text" class="form-control" readonly id="nameTo"
                    value="{{ $data['quotation']->quoPIC ?? '-' }}" name="nameTo" />
            </div>

            <div class="mb-3">
                <label class="form-label" for="emailTo">Email</label>
                <input type="email" id="emailTo" class="form-control"
                    value="{{ $data['quotation']->quoEmail ?? '-' }}" readonly name="emailTo" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="numberClient">Sales Name</label>
                <input type="text" id="salesName" class="form-control"
                    value="{{ $data['quotation']->name}}" readonly name="salesName" />
            </div>

            <div class="mb-3">
                <label class="form-label" for="numberClient">Sales WhatsApp Number</label>
                <input type="text" id="numberClient" class="form-control"
                    value="{{ $data['quotation']->spPhone}}" readonly name="numberClient" />
            </div>

            <div class="mb-2">
                <label for="subjekEmail" class="form-label">Subject</label>
                <input type="text" class="form-control" id="subjekEmail" name="subjekEmail"
                    value="Quotation No. : {{ $data['quotation']->quoCode ?? '' }}" readonly/>
            </div>

            <div class="mb-2">
                <label for="pesanEmail" class="form-label">Pesan Email</label>
                <textarea name="pesanEmail" class="form-control" rows="4">
                    Terlampir no quotation: {{ $data['quotation']->quoCode ?? '' }},
                    dari perusahaan kami: {{ $data['quotation']->companyName ?? '' }}.
                </textarea>
            </div>

            <div class="mb-3">
                <span class="badge bg-label-primary">
                    <i class="ti ti-link ti-xs"></i>
                    <span class="align-middle">Quotation Attached</span>
                </span>
            </div>

            <hr>

            <div class="container py-1">

                <div class="flex flex-col flex-wrap gap-2 justify-start mb-3 mt-3">
                    {{-- Tombol Submit untuk Email --}}
                    <button type="submit" class="btn btn-primary data-submit" id="submitEmailButton">Send Email</button>

                    {{-- Tombol/Link untuk WhatsApp --}}
                    <a id="whatsappLink" href="#" target="_blank" class="btn btn-success">Send WhatsApp</a>
                    <button type="reset" class="btn btn-label-secondary border border-gray-800 text-black" data-bs-dismiss="offcanvas">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('sendQuotationForm');
        const submitEmailButton = document.getElementById('submitEmailButton');
        const whatsappLink = document.getElementById('whatsappLink');
        const numberClientInput = document.getElementById('numberClient');
        const salesNameInput = document.getElementById('salesName');
        const nameToInput = document.getElementById('nameTo');

        // Fungsi untuk mengupdate URL link WhatsApp
        function updateWhatsappLink() {
            const salesName = salesNameInput.value;
            const numberClient = numberClientInput.value;
            const quotationSlug = form.dataset.quotationSlug;
            const quotationCode = form.dataset.quotationCode;
            const quotationCompany = form.dataset.quotationCompanyName;
            const quotationPic = nameToInput.value;

            let cleanedNumber = numberClient.replace(/[^0-9]/g, '');
            if (cleanedNumber.startsWith('0')) {
                cleanedNumber = '62' + cleanedNumber.substring(1);
            } else if (!cleanedNumber.startsWith('62') && cleanedNumber.length > 5) {
                cleanedNumber = '62' + cleanedNumber;
            }

            const viewQuotationLink = `${window.location.origin}/quotation/viewQuotation/${quotationSlug}`;
            const message = `Halo ${salesName},\n\nKami ingin memberitahukan bahwa quotation dengan kode ${quotationCode} untuk ${quotationCompany} telah dibuat dan siap untuk Anda tinjau.\nAnda bisa melihat detailnya di email anda.\n\nTerima kasih.`;
            const encodedMessage = encodeURIComponent(message);
            const whatsappUrl = `https://wa.me/${cleanedNumber}?text=${encodedMessage}`;

            whatsappLink.href = whatsappUrl;
            console.log('WhatsApp URL updated:', whatsappUrl); // Untuk debugging
        }

        if (!form || !submitEmailButton || !whatsappLink) {
            console.error('ERROR: Required elements (form, submitEmailButton, or whatsappLink) not found.');
            return;
        }

        // Panggil saat DOM siap dan setiap kali ada perubahan pada input yang memengaruhi pesan WA
        updateWhatsappLink();
        numberClientInput.addEventListener('input', updateWhatsappLink);
        nameToInput.addEventListener('input', updateWhatsappLink);
        // Jika ada input lain yang memengaruhi pesan WA, tambahkan event listener di sini

        // Event listener untuk tombol "Send Email"
        // Karena ini adalah type="submit", dia akan secara otomatis submit form
        // kecuali jika kita panggil e.preventDefault()
        form.addEventListener('submit', function(e) {
            // Ini adalah handler untuk tombol "Send Email"
            // Form akan disubmit ke action="{{ route('sendQuotation') }}"
            // Anda tidak perlu mengubah action di sini karena itu sudah action defaultnya.
            // Jika Anda punya rute terpisah untuk email saja, pastikan action form mengarah kesana
            console.log('DEBUG: Sending email via form submission.');
            // Tidak perlu e.preventDefault() di sini karena kita memang ingin form disubmit.
            // Cukup pastikan action form sudah benar.
        });


        // Event listener untuk link "Send WhatsApp"
        whatsappLink.addEventListener('click', function(e) {
            // e.preventDefault() tidak perlu di sini karena ini link, bukan submit button
            // window.open() akan bekerja sesuai href yang sudah diatur
            console.log('DEBUG: WhatsApp link clicked. Opening new tab.');

            // Opsional: Tutup offcanvas setelah link WhatsApp diklik
            const offcanvasElement = document.getElementById('sendQuotationOffcanvas');
            if (typeof bootstrap !== 'undefined' && bootstrap.Offcanvas) {
                const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasElement);
                if (offcanvas) {
                    offcanvas.hide();
                    console.log('DEBUG: Offcanvas hidden after WhatsApp click.');
                }
            }
        });

        // Opsional: Validasi nomor WhatsApp sebelum membuka link
        whatsappLink.addEventListener('click', function(e) {
            const numberClient = numberClientInput.value;
            if (!numberClient || numberClient.trim() === '-' || numberClient.trim() === '') {
                e.preventDefault(); // Mencegah link dibuka
                alert('Nomor WhatsApp tidak boleh kosong.');
                console.log('DEBUG: WhatsApp link prevented due to empty number.');
            }
        });
    });
</script>