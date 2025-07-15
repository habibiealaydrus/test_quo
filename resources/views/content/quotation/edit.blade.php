<link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet"> {{-- Make sure this path is correct --}}

@include('content.quotation.terbilang') 
@extends('app')
@section('content')
<form action="{{ url('/quotation/updateQuotation') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card border border-info mb-3">
        <div class="card-body">
            <div>
                <span>Status Quotation :</span>
                @if($data['quotation']->quoStatus == "Submitted")
                <span class="fw-medium text-warning">
                    {{ strtoupper($data['quotation']->quoStatus) }}
                </span>
                @elseif($data['quotation']->quoStatus == "On Process")
                <span class="fw-medium text-info">
                    {{ strtoupper($data['quotation']->quoStatus) }}
                </span>
                @elseif($data['quotation']->quoStatus == "Done")
                <span class="fw-medium text-success">
                    {{ strtoupper($data['quotation']->quoStatus) }}
                </span>
                @elseif($data['quotation']->quoStatus == "Canceled")
                <span class="fw-medium text-danger">
                    {{ strtoupper($data['quotation']->quoStatus) }}
                </span>
                @endif
            </div>
            <hr>
            <div class="d-flex my-2">
                <a href="{{url('quotation/viewQuotation/'.$data['quotation']->quoSlug)}}"
                    class="btn btn-label-secondary w-100 me-2">Cancel</a>
                <button type="submit" class="btn btn-label-success w-100">Save</button>
            </div>
        </div>
    </div>
    <div class="card invoice-preview-card border border-primary">
        <div class="card-body">
            @if ($data['quotation']->compsId == 1)
            <div class="py-3 max-w-5xl mx-auto"> 
                <div class="d-flex justify-content-center"> 
                    <div class=""> 
                        <img src="{{ asset('/assets/img/front-pages/branding/logo_mlm.png') }}" alt="MLM_logo" class="mb-0" style="height:90pt;"> 
                    </div>
                    <div class="text-center"> 
                        <h1 class="text-3xl mb-0"><u>PT. MAJU LANGGENG MANDIRI</u></h1> 
                        <p class="mb-0">Sales & Service for Construction Equipment</p> 
                        <p class="text-lg mb-0 ">{{ $data['quotation']->address_office ??"-"}}</p> 
                        <div class="d-flex "> 
                            <div class="pr-2 fw-bold">Telp.</div>
                            <div class="pr-4">{{ $data['quotation']->phone_office ??"-"}}</div>
                            <div class="mx-2 fw-bold">Email</div>
                            <div>
                                <a href="{{ $data['quotation']->email_office ??"-"}}" class="text-blue-600 underline">{{ $data['quotation']->email_office ??"-"}}</a>
                            </div>
                            <div class="mx-2 fw-bold">Website</div>
                            <div>
                                <a href="http://www.majulanggang.co.id" class="text-blue-600 underline italic ">www.majulanggeng.co.id</a> 
                            </div>      
                        </div>
                    </div>
                </div>
            </div>    
            @elseif ($data['quotation']->compsId == 2)
            <div class="row mb-2">
                <div class="col-3 place-content-center">
                    <img src="{{asset ('/assets/img/front-pages/branding/logo_adk.png')}}" alt="MLM_logo" class="mx-auto">
                </div>
                <div class="col-9">
                    <div class="d-flex align-items-center">
                        <span class="fw-bold fs-4">PT. Andalan Dinamika Konstrukindo</span>
                    </div>
                    <p class="mb-1">{{ $data['quotation']->address_office ??"-"}}</p>
                    <p class="mb-1">Phone :{{ $data['quotation']->phone_office ??"-"}}</p>
                    <p class="mb-1">{{ $data['quotation']->website_office ??"-"}}</p>
                  
                </div>
            </div>
            @elseif ($data['quotation']->compsId == 3)
            <div class="row mb-2">
                <div class="col-3 text-center">
                    <img src="{{asset ('/assets/img/front-pages/branding/mlm_rental_logo.png')}}" alt="MLM_rental_logo" class="mx-auto">
                </div>
                <div class="col-9">
                    <div class="d-flex align-items-center">
                        <span class="fw-bold fs-4">PT. Maju Langgeng Rental</span>
                    </div>
                    <p class="mb-1">Jl. Taman Plaza Meruya II Blok E14 No.17, Kembangan, Meruya Utara, Kembangan, Daerah Khusus Ibukota, Jakarta 11620</p>
                    <p class="mb-1">Phone :(021) 5851478</p>
                    <p class="mb-1">www.majulancar.com</p>
                  
                </div>
            </div>
            @endif
            <hr class="h-px bg-gray-400 mb-3"/>
            @if ($data['quotation']->compsId == 1)
            <table class=" " style="width: 100%">
                <tr class=" ">
                 <td class="">
                    <p class=" flex flex-row gap-2 whitespace-nowrap">
                        Ref No :
                        <input type="text" class="form-control mb-1" style="width: 300px" name="quoCode" value="{{$data['quotation']->quoCode}}" readonly>
                    </p>
                 </td>
                 <td class="">
                    <span class=" flex flex-row justify-end items-center "> 
                        <p class=" ">
                            {{$data['quotation']->nama_wilayah}},&nbsp;{{ date('d F Y', strtotime($data['quotation']->created_at)) }}
                       </p>     
                    </span>
                 </td>
                </tr>
                <tr class=" ">
                    <td class=" ">
                        <span class="  "> 
                            <p class="">
                                Perihal	:	Penawaran Harga
                           </p>
                        </span>     
                    </td>
                </tr>
             </table>
            <table class="w-full py-3 mt-3">
                <tr class=" ">
                    <td class="w-1/2">
                        <input type="hidden" name="idQ" value="{{$data['quotation']->quotationId}}">
                        <p class=" font-semibold">
                            Kepada Yth,
                        </p>
                        <input type="text" class="form-control mb-1 w-1/2" name="quoCompany"  value="{{ $data['quotation']->quoCompany ?? '-'}}">     
                    </td>
                </tr>
                <tr class="w-1/2 ">
                    <td>
                       <p class=" w-1/2 ">
                           Alamat :      
                       </p>
                       <input type="text" class="form-control mb-1 w-1/2" name="quoAddress"  value="{{ $data['quotation']->quoAddress ?? '-'}}">
                    </td>
                </tr>
                <tr class="w-1/2 ">
                    <td>
                       <p class=" w-1/2 ">
                           Project :      
                       </p>
                       <input type="text" class="form-control mb-1 w-1/2" name="quoProject"  value="{{ $data['quotation']->quoProject ?? '-'}}">
                    </td>
                </tr>
                <tr class="w-1/2 ">
                    <td>
                       <p class=" w-1/2 ">
                           UP :      
                       </p>
                       <input type="text" class="form-control mb-1 w-1/2" name="quoPIC"  value="{{ $data['quotation']->quoPIC ?? '-'}}">
                    </td>
                <tr class="w-1/2 ">
                    <td>
                       <p class=" w-1/2 ">
                           Telepon :      
                       </p>
                       <input type="text" class="form-control mb-1 w-1/2" name="quoContact"  value="{{ $data['quotation']->quoContact ?? '-'}}">
                    </td>
                </tr>
            </table>
             @else
             <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
                <div class="mb-xl-0 mt-4">
                    <h4 class="fw-medium mb-2"></h4>
                    <input type="hidden" name="idQ" value="{{$data['quotation']->quotationId}}">
                    <table class="borderless boldTitle">
                        <tr>
                            <td>ATN</td>
                            <td style="padding-left:10px; padding-right:10px;">:</td>
                            <td>
                                <input type="text" class="form-control mb-1" name="pic"
                                    value="{{$data['quotation']->quoPIC}}">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <input type="text" class="form-control mb-1" name="company"
                                    value="{{$data['quotation']->quoCompany}}">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="d-flex">
                                    <input type="text" class="form-control mb-1 me-2" name="address"
                                        value="{{$data['quotation']->quoAddress}}">
                                    <input type="text" class="form-control mb-1" name="contact"
                                        value="{{$data['quotation']->quoContact}}">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <input type="text" class="form-control mb-1" name="project"
                                    value="{{$data['quotation']->quoProject}}">
                            </td>
                        </tr>
                    </table>
                </div>
                <div>
                    <h2 class="fw-medium mb-2 text-center"><span class="badge bg-label-secondary">Quotation</span>
                    </h2>
                    <table class="borderless boldTitle">
                        <tr>
                            <td>Date</td>
                            <td style="padding-left:10px; padding-right:10px;">:</td>
                            <td>{{ date('d F, Y', strtotime($data['quotation']->created_at)) }}</td>
                        </tr>
                        <tr>
                            <td>No. Quotation</td>
                            <td style="padding-left:10px; padding-right:10px;">:</td>
                            <td>{{$data['quotation']->quoCode}}</td>
                        </tr>
                    </table>
                </div>
            </div>
             @endif
            <p class="mb-0 mt-2 boldTitle">Pelanggan Yth, </p>
            <p class="mb-2">Terimakasih telah menghubungi kami, Dengan senang hati kami menawarkan hal-hal berikut :</p>
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" style="width:3%">No.</th>
                            <th class="text-center" style="width:30%">Item</th>
                            <th class="text-center" style="width:23%">Price</th>
                            <th class="text-center" style="width:10%">Disc</th>
                            <th class="text-center" style="width:10%">Qty</th>
                            <th class="text-center" style="width:24%">Total Price</th>
                            <th class="text-center" style="width:5%">Aksi</th> </tr>
                    </thead>
                    <tbody id="item-container"> 
                        @php $item = isset($data['lizt']) ? $data['lizt'] : []; @endphp
                        @if (count($item) > 0)
                        @for ($i = 0; $i < count($item); $i++)
                        <tr>
                            <input type="hidden" name="itemId[]" value="{{ $item[$i]['qLId'] }}">
                            <input type="hidden" id="codeQuo" name="itemCode[]" value="{{ $item[$i]['code'] }}">
                          
                            <td class="text-center item-number-column">{{ $i + 1 }}</td>
                            <td class="listItem">
                                <input type="text" value="{{ $item[$i]['items'] }}" name="items[]" class="form-control mb-1 item-name">
                                
                                @if (in_array(auth()->user()->role, [1,2,4,5,6]))
                                <div id="elementId{{ $i }}" class="item-description-editor" style="min-height: 150px;" value="{{ $item[$i]['desc'] }}">
                                </div>
                                    
                                <input type="hidden" name="desc[]" class="item-desc-hidden" value="{{ $item[$i]['desc'] }}">
                                
                                @if($item[$i]['img'])
                                <img src="{{ asset('storage/media/image/quotation_item/'.$item[$i]['img'])}}" class="w-px-100 mb-2 py-2" alt="Item Image" />
                                @endif
                                <label class="form-label">Change Picture</label>
                                <input type="file" class="form-control mb-1 item-img" name="img[]">
                                @endif
                            </td>
                            <td class="alnright">
                                <input type="text" min="1" value="{{ $item[$i]['price'] }}" name="price[]" class="rupiah form-control item-price">
                            </td>
                            <td class="text-center">
                                <input type="number" min="0" value="{{ $item[$i]['disc'] }}" name="disc[]" class="form-control item-disc">
                            </td>
                            <td class="text-center">
                                <input type="number" value="{{ $item[$i]['qty'] }}" name="qty[]" class="form-control item-qty">
                            </td>
                            <td class="alnright">
                                <input type="text" min="1"  name="net[]" class="rupiah form-control item-net" readonly>
                            </td>
                            <td>
                            <button type="button" class="btn btn-danger btn-sm btn-delete-item" data-id="{{ $item[$i]['qLId'] }}">X</button>
                            </td>
                        </tr>
                        @endfor
                        @endif
                    </tbody>
                    
                    <tbody>
                        <tr>
                            <td colspan="4">Terbilang : "<i id="terbilang-text"> ***************************** </i>"</td>
                            <td class="boldTitle">Total</td>
                            <td class="alnright boldTitle">
                                <input type="text" class="rupiah form-control" name="totalAll" id="totalAll"
                                    value="{{ $data['quotation']->quoTotal }}" readonly>
                            </td>
                            <td></td> 
                        </tr>
                        <tr>
                            <td colspan="7"> 
                               <button type="button" class="btn btn-sm btn-primary mt-2" id="add-item">Tambah Item</button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7"> 
                                <p class="mb-2"><b><u>NOTES</u></b></p>
                                <div class="row mb-2">
                                    <label class="col-sm-2 col-form-label" for="notePeriod">*) Period
                                        Note :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="notePeriod"
                                            value="{{ $data['quotation']->quoPeriodNote ?? '-' }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-2 col-form-label" for="notePpn">*) PPN Note
                                        :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="notePpn"
                                            value="{{ $data['quotation']->quoPpnNote ?? '-' }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-2 col-form-label" for="noteTop">*) Term of
                                        Payment Note :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="noteTop"
                                            value=" {{ $data['quotation']->quoTopNote ?? '-' }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-2 col-form-label" for="noteDelivery">*)
                                        Delivery Note :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="noteDelivery"
                                            value="{{ $data['quotation']->quoDeliveryNote ?? '-' }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-2 col-form-label" for="noteStock">*)
                                        Availability Note :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="noteStock"
                                            value="{{ $data['quotation']->quoStockNote ?? '-' }}">
                                    </div>
                                </div>

                                <p class="mt-4">Atas perhatianya kami ucapkan terimakasih</p>
                            </td>
                        </tr>
                        <tr class="border-1">
                            @if ($data['quotation']->compsId == 1)
                            <td colspan="3" class="border-none">
                                @if($qr_sales != null)
                                <p style="padding-left:30px;">Hormat kami,
                                <p style="padding-left:30px;" class="px-4.5 py-2.5">
                                     {{ $qr_sales}}
                                </p>
                                <p style="padding-left:30px;" class="mb-0 boldTitle">
                                    <u>{{ $data['quotation']->name ?? '-' }}</u>
                                </p>
                                <p style="padding-left:30px;" class="mb-0 boldTitle">
                                    <u>{{ $data['quotation']->spPhone ?? '-' }}</u>
                                </p>
                                @else
                                <p style="padding-left:30px;">Hormat kami,</p>
                                <p style="padding-left:30px; padding-top:50px;" class="mb-0 boldTitle">
                                    <u>{{ $data['quotation']->name ?? '-' }}</u>
                                    
                                </p>
                                @endif
                                
                                <p style="padding-left:30px;" class="mb-0 boldTitle">
                                    {{ $data['quotation']->rolesName ?? '-' }}</p>
                            </td>
                            <td colspan="3" class="border-none">
                                @if($qr_spv != null)
                                <p style="padding-left:30px;">Mengetahui,
                                <p style="padding-left:30px;" class="px-4.5 py-2.5">
                                     {{ $qr_spv}}
                                </p>
                                <p style="padding-left:30px;" class="mb-0 boldTitle">
                                    <u>{{ $data['quotation']->supervisor_name ?? '-' }}</u>
                                </p>
                               
                                @else
                                <p style="padding-left:30px;">Mengetahui,</p>
                                <p style="padding-left:30px; padding-top:50px;" class="mb-0 boldTitle">
                                    <u>{{ $data['quotation']->name ?? '-' }}</u>
                                    
                                </p>
                                @endif
                                
                                <p style="padding-left:30px;" class="mb-0 boldTitle ">
                                    {{ $data['quotation']->supervisor_role_name?? '-' }}</p>
                            </td>
                            @else
                            <td colspan="6">
                                @if($qr_sales != null)
                                <p style="padding-left:30px;">Hormat kami,
                                <p style="padding-left:30px;" class="px-4.5 py-2.5">
                                     {{ $qr_sales}}
                                </p>
                                <p style="padding-left:30px;" class="mb-0 boldTitle">
                                    <u>{{ $data['quotation']->name ?? '-' }}</u>
                                </p>
                                <p style="padding-left:30px;" class="mb-0 boldTitle">
                                    <u>{{ $data['quotation']->spPhone ?? '-' }}</u>
                                </p>
                                @else
                                <p style="padding-left:30px;">Hormat kami,</p>
                                <p style="padding-left:30px; padding-top:50px;" class="mb-0 boldTitle">
                                    <u>{{ $data['quotation']->name ?? '-' }}</u>
                                    
                                </p>
                                @endif
                                
                                <p style="padding-left:30px;" class="mb-0 boldTitle">
                                    {{ $data['quotation']->rolesName ?? '-' }}</p>
                            </td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-12">
                    <span class="fw-medium">Catatan:</span>
                    <span>Penawaran ini dihasilkan oleh sistem kami. Terimakasih.</span>
                </div>
            </div>
        </div>
    </div>

</form>
@endsection
@section('script')
<script src="{{asset ('/assets/js/editScript.js')}}"></script>
<script src="{{asset ('/assets/js/ribuan.js')}}"></script>
<script type="text/javascript">
    const quillInstances = [];
    let nextEditorIndex = {{ count($item) }};

    function initializeQuill(elementId, initialContent = '') {
        const editorElement = document.getElementById(elementId);

        // Hindari inisialisasi ganda
        if (!editorElement || editorElement.classList.contains('quill-initialized')) {
            return null;
        }

        const quill = new Quill(editorElement, {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    [{ 'indent': '-1' }, { 'indent': '+1' }],
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'font': [] }],
                    [{ 'align': [] }],
                    ['link', 'image'],
                    ['clean']
                ]
            }
        });

        // Set konten awal
        if (initialContent) {
            quill.clipboard.dangerouslyPasteHTML(initialContent);
        }

        // Tandai sudah diinisialisasi
        editorElement.classList.add('quill-initialized');

        // Sync isi ke input hidden
        quill.on('text-change', function () {
            const hiddenInput = editorElement.previousElementSibling;
            if (hiddenInput && hiddenInput.classList.contains('item-desc-hidden')) {
                hiddenInput.value = quill.root.innerHTML;
            }
        });

        return quill;
    }

    function initializeExistingQuillEditors() {
    document.querySelectorAll('.item-description-editor').forEach((editorElement) => {
        const initialContent = editorElement.closest('td')?.querySelector('.item-desc-hidden')?.value || '';
        const quill = initializeQuill(editorElement.id, initialContent);
        if (quill) {
            quillInstances.push(quill);
        }
    });
    }

    function updateItemNumbers() {
        document.querySelectorAll('#item-container .item-number-column').forEach((el, index) => {
            el.textContent = index + 1;
        });
    }

    function calculateAndSetTotal() {
        let total = 0;
        document.querySelectorAll('#item-container tr').forEach(row => {
            const priceInput = row.querySelector('.item-price');
            const discInput = row.querySelector('.item-disc');
            const qtyInput = row.querySelector('.item-qty');
            const netInput = row.querySelector('.item-net');

            if (!priceInput || !discInput || !qtyInput || !netInput) return;

            let price = parseFloat(priceInput.value.replace(/[^0-9,]/g, '').replace(',', '.')) || 0;
            let disc = parseFloat(discInput.value) || 0;
            let qty = parseFloat(qtyInput.value) || 0;

            let netPrice = price - (price * disc / 100);
            let itemTotal = netPrice * qty;

            netInput.value = formatRupiah(itemTotal);
            total += itemTotal;
        });

        document.getElementById('totalAll').value = formatRupiah(total);

        if (typeof terbilang === 'function') {
            document.getElementById('terbilang-text').textContent = terbilang(total);
        } else {
            document.getElementById('terbilang-text').textContent = 'Terbilang tidak tersedia';
        }
    }

    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(number).replace('IDR', '').trim();
    }

    document.addEventListener('DOMContentLoaded', function () {
        $('.quotation-page').addClass('active');

        const addItemBtn = document.getElementById('add-item');
        const itemContainer = document.getElementById('item-container');

        initializeExistingQuillEditors();
        updateItemNumbers();
        calculateAndSetTotal();

        // Tambah item baru
        addItemBtn.addEventListener('click', function () {
            const newRow = document.createElement('tr');
            const newEditorId = `editor_new_${nextEditorIndex++}`;
            const codeQuot = document.getElementById('codeQuo').value;

            newRow.innerHTML = `
                <input type="hidden" name="itemId[]">
                <input type="hidden" name="itemCode[]" value="${codeQuot}">
                <td class="text-center item-number-column"></td>
                <td class="listItem">
                    <input type="text" name="items[]" class="form-control mb-1 item-name">
                    <input type="hidden" name="desc[]" class="item-desc-hidden">
                    @if (in_array(auth()->user()->role, [1,2,4]))
                    <div id="${newEditorId}" class="item-description-editor" style="min-height: 150px;"></div>
                    <label class="form-label mt-2">Add Picture</label>
                    <input type="file" class="form-control mb-1 item-img" name="img[]">
                     @endif
                </td>
                <td class="alnright">
                    <input type="text" name="price[]" class="rupiah form-control item-price" value="0">
                </td>
                <td class="text-center">
                    <input type="number" name="disc[]" class="form-control item-disc" value="0">
                </td>
                <td class="text-center">
                    <input type="number" name="qty[]" class="form-control item-qty" value="1">
                </td>
                <td class="alnright">
                    <input type="text" name="net[]" class="rupiah form-control item-net" readonly value="0">
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-item">X</button>
                </td>
            `;

            itemContainer.appendChild(newRow);

            const newlyAddedEditor = newRow.querySelector('.item-description-editor');
            if (newlyAddedEditor) {
                const quill = initializeQuill(newEditorId, '');
                if (quill) {
                    quillInstances.push(quill);
                }
            }

            updateItemNumbers();
            calculateAndSetTotal();

            $(newRow).find('.item-price, .item-net').maskMoney({
                prefix: '',
                thousands: '.',
                decimal: ',',
                allowNegative: false
            });
        });

        // Tombol hapus item dari database
        document.querySelectorAll('.btn-delete-item').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const itemId = this.getAttribute('data-id');

                if (!confirm('Yakin ingin menghapus item ini?')) return;

                fetch(`/quotation/deleteItemQuotation/${itemId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(() => {
                    location.reload();
                });
            });
        });

        // Hitung ulang total saat input berubah
        itemContainer.addEventListener('input', function (event) {
            if (['item-price', 'item-disc', 'item-qty'].some(cls => event.target.classList.contains(cls))) {
                calculateAndSetTotal();
            }
        });

        // Sync semua Quill ke input hidden saat submit
        const form = document.querySelector('form');
        form.addEventListener('submit', function () {
            quillInstances.forEach(quill => {
                if (quill && quill.container) {
                    const parent = quill.container.closest('td');
                    const hiddenInput = parent?.querySelector('.item-desc-hidden');
                    if (hiddenInput) {
                        hiddenInput.value = quill.root.innerHTML;
                    }
                }
            });
        });
    });
</script>
@endsection