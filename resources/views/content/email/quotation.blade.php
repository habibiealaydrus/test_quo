<style>
    @page {
    margin: 0.7cm;
    padding: 0;
}
#invoice {
    font-family: "Times New Roman", Times, serif;
    background: #fff !important;
    margin: 0;
    padding: 0;
    font-size: 0.7em;
}

h1 {
    color: #222;
    margin: 0;
}

h2 {
    font-size: 1em;
    margin: 1px;
}

h3 {
    font-weight: 400;
    line-height: 2em;
}

h4 {
    margin-left: 50px;
    margin-top: 50px;
}

p {
    margin: 0;
}


#invoice-top {
    min-height: 100px;
    margin:0;
    padding:0;
    border-bottom: 1px solid #d8d8d8;
}

#invoice-mid {
    min-height: 100px;
}

#invoice-table {
    min-height: 100px;
}

.logoMLM {
    float: left;
    margin-left: 20px;
    height: 100px;
    width: 100px;
    background: url(data:image/png;base64,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) no-repeat;
    border-radius: 50%;
}

.logoADK {
    float: left;
    margin-left: 20px;
    height: 100px;
    width: 100px;
    background: url(data:image/png;base64,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) no-repeat;
    border-radius: 50%;
}

.info {
    display: block;
    float: left;
    margin-left: 50px;
    margin-top: 10px;
}

.infoCustomer {
    display: block;
    float: left;
    margin-top: 20px;
}

.mlattn {
    margin-left: 42px;
}

#project {
    margin-left: 30%;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

td {
    padding: 5px;
    border: 1px solid black;
}

thead {
    background: #EEE;
    font-weight: bold;
    text-align: center;
}

tbody {
    font-size: 1em;
}

.nomor {
    width: 4%;
    text-align: center;
}

.item {
    width: 35%;
    border-right: hidden;
}
.descImage {
    width: 15%;
    align: center;
    text-align: center;
}

.price {
    width: 13%;
    text-align: right;
}

.discount {
    width: 8%;
    text-align: center;
}

.qty {
    width: 8%;
    text-align: center;
}

.subtotal {
    width: 17%;
    text-align: right;
}

.totalAll {
    text-align: right;
    align: right;
}

.terbilang {
    font-style: italic;
}


#legalcopy {
    margin-top: 5px;
}

.badgeQuote {
    background-color: rgba(165, 168, 170, 0.53) !important;
    color: #000;
    font-size: 1em;
    display: inline;
    padding: 0.2em 1em;
    text-align: center;
    white-space: nowrap;
    letter-spacing: 5px;
    text-transform: uppercase;
    border-radius: 0.25rem;
    border-color: 0.5px solid black;
    border-style: solid;
    border-width: 0.5px;
    margin-left: 50%;
}

.nBorderR {
    border-right: none;
}

.nBorderL {
    border-left: none;
}

</style>
<?php 

function penyebut($nilai) {
 $nilai = abs($nilai);
 $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
 $temp = "";
 if ($nilai < 12) {
     $temp = " ". $huruf[$nilai];
 } else if ($nilai <20) {
     $temp = penyebut($nilai - 10). " Belas";
 } else if ($nilai < 100) {
     $temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
 } else if ($nilai < 200) {
     $temp = " seratus" . penyebut($nilai - 100);
 } else if ($nilai < 1000) {
     $temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
 } else if ($nilai < 2000) {
     $temp = " seribu" . penyebut($nilai - 1000);
 } else if ($nilai < 1000000) {
     $temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
 } else if ($nilai < 1000000000) {
     $temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
 } else if ($nilai < 1000000000000) {
     $temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
 } else if ($nilai < 1000000000000000) {
     $temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
 }     
 return $temp;
}

function terbilang($nilai) {
 if($nilai<0) {
     $hasil = "minus ". trim(penyebut($nilai));
 } else {
     $hasil = trim(penyebut($nilai));
 }     		
 return $hasil;
}
?>

<div id="invoice">
<div>
    @if ($data['comp'] == 1)
    <div style="font-family: Arial, sans-serif; font-size: 12pt; width: 80%; margin: 0 auto; text-align: center; ">
        <div style="width: 100%;"> 
            <table style="width: 100%; border-collapse: collapse; border: none;"> 
                <tr>
                    <td style="width: 15%; text-align: center; vertical-align: middle; border: none; padding-right: 5px;">
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/img/front-pages/branding/logo_mlm.png'))) }}"
                         alt="MLM Logo"
                         style="height: 80px;">
                        
                    </td>
                    <td style="text-align: center; vertical-align: middle; border: none; padding-left: 10px;">
                        <p style="font-size: 18pt; font-weight: bold; margin: 0; text-decoration: underline; white-space: nowrap">PT. MAJU LANGGENG MANDIRI</p>
                        <p style="font-size: 11pt;">Sales & Service for Construction Equipment</p>
                        <p style="font-size: 10pt;">{{ $data['address_office'] ?? '-' }}</p>
                        <div style="margin-top: 6px; font-size: 6.5pt; whitespace:nowrap;">
                            <span style="font-weight: bold;">Telp.</span> {{ $data['phone_office'] ?? '-' }} &nbsp;&nbsp;
                            <span style="font-weight: bold;">Email</span>
                            <a href="{{ $data['email_office'] ?? ''}}" style="color: #0066cc; text-decoration: underline;">{{ $data['email_office'] ?? ''}}  
                            </a>
                            <span style="font-weight: bold;">Website</span>
                            <a href="http://{{ $data['website_office'] ?? 'www.majulanggeng.co.id' }}" style="color: #0066cc;font-style: italic; text-decoration: underline">
                            www.majulanggeng.co.id
                            </a>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>    
    @elseif ($data['comp'] == 2)
    <div id="invoice-top" style="display: flex; justify-content: space-between; align-items: start;">
        <div class="logoADK"></div>
        <div class="info" style="text-align: left;">
            <h1 style="margin: 0; font-weight: bold;">PT. Andalan Dinamika Konstrukindo</h1>
            <p class="mb-1">{{ $data['address_office'] ?? "-" }}</p>
            <p class="mb-1">Phone : {{ $data['phone_office'] ?? "-" }}</p>
            <p class="mb-1">{{ $data['website_office'] ?? "-" }}</p>
        </div>
    </div>
    @endif
</div>
<hr style="border: 0; border-top: 1px solid #ccc; margin: 10px 0;"> {{-- Hapus margin samping, pakai margin top/bottom saja --}}
@if ($data['comp'] == 1)
<table style="border: none; border-collapse: collapse;">
    <tr style="border: none;">
        <td style="border: none;">
            <h2 style="margin: 0; font-size:14px; color: dimgrey;">Ref No.	 : {{ $data['code'] ?? ''}}</h2>  
            <h2 style="margin: 0; font-size:14px; color: dimgrey;">Perihal	 :	Penawaran Harga</h2>  
        </td>
        <td style="border: none;text-align: right; padding-right: 10px;">
            <h2 style="margin: 0; font-size:14px; color: dimgrey;">{{ $data['wilayah'] ?? ''}},&nbsp;{{ $data['date'] ?? ''}}</h2>             
        </td>
    </tr>
</table>
<table style="border: none; border-collapse: collapse;">
    <tr style="border: none;">
        <td style="border: none;">
        <p style="font-size:14px;">Kepada Yth,</p>
        <p style="font-size:14px; font-weight: bold; text-transform:uppercase">{{ $data['company'] ?? ''}}</p>
        <p style="font-size:14px; font-weight: bold;">Project {{ $data['project'] ?? ''}}</p>
        <p style="font-size:14px;">UP : {{ $data['pic'] ?? ''}}</p>
        </td>
    </tr>
</table>
@else
<table style="width: 100%; margin-top: 20px; border-collapse: collapse; border: none;" border="0" cellspacing="0" cellpadding="0">
    <tr style="border: none;">
        <!-- Kolom kiri: ATN -->
        <td style="border-collapse: collapse; border: none;" border="0" cellspacing="0" cellpadding="0">
            <p style="margin: 2px 0;">ATN&nbsp;:<b> {{ $data['pic'] ?? '' }} ({{ $data['contact'] ?? '' }})</b></p>
            <p style="margin: 2px 30px;">&nbsp;<b>{{ $data['address'] ?? '' }}</b></p>
            <p style="margin: 2px 30px;">&nbsp;<b>{{ $data['company'] ?? '' }}</b></p>
            <p style="margin: 2px 30px;">&nbsp;<b>{{ $data['project'] ?? '' }}</b></p>
            <p style="margin: 2px 30px;">&nbsp;<b>{{ $data['email_costumer'] ?? '-' }}</b></p>
        </td>
        <!-- Kolom kanan: Quotation Info -->
        <td style="vertical-align: top; text-align: left; width: 35%; border: none;">
            <div style="padding: 4px 10px; display: inline-block; font-weight: bold; border:1px solid #c3c3c3; background-color:lightgrey;">QUOTATION</div>
            <p style="margin: 4px 0;">Date : {{ $data['date'] ?? '' }}</p>
            <p style="margin: 4px 0;">No. Quotation : {{ $data['code'] ?? '' }}</p>
        </td>
    </tr>
</table>
@endif
<div id="invoice-table" style="margin-top: 5px;">
    <h2>Pelanggan Yth, </h2>
    <p>Terimakasih telah menghubungi kami, Dengan senang hati kami menawarkan hal-hal berikut :</p>
    <table style="width: 100%; border-collapse: collapse; margin-top: 5px;">
        <thead>
            <tr>
                <th>No.</th>
                <th>Item</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['items'] as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                {{-- Fokus pada TD ini untuk mengatur tampilan item, deskripsi, dan gambar --}}
                <td style="vertical-align: top; padding: 5px;">
                    {{-- Gambar akan di-float ke kanan --}}
                    <img src="{{ isset($item['image']) ? 'data:image/png;base64,'.base64_encode(file_get_contents('storage/media/image/quotation_item/'.$item['image'])) : ''}}"
                         alt="Item_Image"
                         width="100px" height="80px"
                         style="float: right; margin-left: 10px; display: block;"> {{-- CSS inline di sini --}}
    
                    {{-- Teks item dan deskripsi akan mengalir di samping gambar --}}
                    <strong>{{ $item['item'] ?? '' }}</strong>
                    <p style="margin-top: 5px; margin-bottom: 0;">{!! $item['desc'] !!}</p>
    
                    {{-- Penting: Membersihkan float agar konten berikutnya tidak terganggu --}}
                    <div style="clear: both; line-height: 0; font-size: 0;"></div>
                </td>
                <td>{{ number_format($item['price'] ?? 0) }}</td>
                <td>{{ $item['disc'] ?? '0' }}%</td>
                <td>{{ $item['qty'] ?? 0 }}</td>
                <td>{{ number_format($item['net'] ?? 0) }}</td>
            </tr>
            @endforeach
    
            <tr>
                <td colspan="6"><strong>Terbilang: </strong> "{{ terbilang($data['total'] ?? 0) }}"</td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <td><strong>TOTAL</strong></td>
                <td><strong>{{ number_format($data['total'] ?? 0) }}</strong></td>
            </tr>
        </tbody>
    </table>
    <div style="margin-top: 2px;">
        <p><strong><u>Notes:</u></strong></p>
        <p>*) {{ $data['periodNote'] ?? '-' }}</p>
        <p><strong>*) {{ $data['ppnNote'] ?? '' }}</strong></p>
        <p><strong>*) {{ $data['topNote'] ?? '' }}</strong></p>
        <p>*) {{ $data['deliveryNote'] ?? '-' }}</p>
        <p>*) {{ $data['stockNote'] ?? '-' }}</p>
        <p>*) Rekening Pembayaran:</p>
        @if ($data['comp'] == 1)
        <span class="ml-4">BCA      : 754 030 6588 PT. Maju Langgeng Mandiri</span><br/>
        <span class="ml-4">BRI      : 3770 1001 2803 01 PT. Maju Langgeng Mandiri</span><br/>
        <span class="ml-4">BNI      : 500 700 5788 01 PT. Maju Langgeng Mandiri</span><br/>
        <span class="ml-4">MANDIRI : 118 000 405 7211 PT. Maju Langgeng Mandiri</span><br/>
        @elseif ($data['comp'] == 2)
        <span class="ml-4">BCA : 754 030 6499 A.N PT. Andalan Dinamika Konstrukindo</span><br/>
        <span class="ml-4">BNI : 400 953 8881 A.N PT. Andalan Dinamika Konstrukindo</span><br/>
        <span class="ml-4">BRI : 0539 01 000377 30 1 A.N PT. Andalan Dinamika Konstrukindo</span><br/>
        <span class="ml-4">DKI : 0539 01 000377 30 1 A.N PT. Andalan Dinamika Konstrukindo</span><br/>
        <span class="ml-4">Mandiri : 165 008 088 0801 A.N PT. Andalan Dinamika Konstrukindo</span><br/>
        @elseif ($data['comp'] == 3)
        <span class="ml-4">BCA : 288 677 6788 A.N PT. Maju Lancar Mandiri</span><br/>
        <span class="ml-4">Mandiri : 165 000 198 1886 A.N PT. Maju Lancar Mandiri</span>
        @endif
        <p>Atas perhatianya kami ucapkan terimakasih.</p>
    </div>
    <div style="width: 100%;margin-top:0;">
        <table style="width: 100%; border-collapse: collapse; margin-top: 2%; margin-bottom: 0%;" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td style="width: 50%; vertical-align: top; padding-right: 2.5%; border: none;">
                    <div style="text-align: left;">
                        <p style="margin-bottom: 5px;">Hormat Kami,</p>
                        <img src="{{ $data['qr_sales'] }}" alt="QR Code Verifikasi" style="width: 100px; height: 100px; padding-top:10px; padding-bottom:10px; display: block; margin: 0 auto;">
                        <p style="margin-top: 5px; margin-bottom: 2px;"><strong><u>{{ $data['sales'] ?? ''}}</u></strong></p>
                        <p style="margin-top: 2px; margin-bottom: 2px;"><strong><u>{{ $data['sales_wa'] ?? ''}}</u></strong></p>
                        <p style="margin-top: 2px;"><strong>{{ $data['role'] ?? ''}}</strong></p>
                    </div>
                </td>
                <td style="width: 50%; vertical-align: top; padding-left: 2.5%; border: none;">
                    <div style="text-align: left;">
                        @if ($data['comp'] == 1)
                            <p style="margin-bottom: 5px;">Mengetahui,</p>
                            <img src="{{ $data['qr_spv'] }}" alt="QR Code Verifikasi" style="width: 100px; height: 100px; padding-top:10px; padding-bottom:10px; display: block; margin: 0 auto;">
                            <p style="margin-top: 5px; margin-bottom: 2px;"><strong><u>{{ $data['supervisor_name'] ?? ''}}</u></strong></p>
                            <p style="margin-top: 2px;"><strong><u>{{ $data['supervisor_role_name'] ?? ''}}</u></strong></p>
                        @endif
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div id="legalcopy" style="margin-top: 1px;">
        <p class="legal">Penawaran ini dihasilkan oleh sistem kami. Terimakasih.</p>
    </div>
</div>
</div>
