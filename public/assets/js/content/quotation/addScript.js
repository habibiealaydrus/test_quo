    $(window).on('load', function () {
        $('.quotation-page').addClass('active')
    });

    $(document).ready(function () {
        // Add row
        var count = 1;
        $(document).on('click', '.add-row', function () {
            count = count + 1;
            var html = '<tr id="row-' + count + '">';
            html +=
                '<td class="text-nowrap qic">\
                    <input type="text" placeholder="Item Name" name="items[]" id="items[]" class="form-control items item-' +
                count + '">\
                    </td>';
            html +=
                '<td class="text-nowrap qic">\
                    <input type="text" id="rupiah" placeholder="Price" name="price[]" class="form-control price price-' +
                count + '">\
                    </td>';
            html +=
                '<td class="text-nowrap qic">\
                    <input type="text" min="0" placeholder="Discount %" name="disc[]"  class="form-control disc disc-' +
                count + '">\
                    </td>';
            html += '<td class="text-nowrap qic">\
                <input name="qty[]" placeholder="Qty" min="1" type="number" row="' + count +
                '" class="form-control qty qty-' + count + '">\
                </td>';
            html +=
                '<td class="text-nowrap qic">\
                    <input id="rupiah" name="subtotal[]" type="text" class="form-control-plaintext subtotal subtotal-' +
                count + '" readonly="">\
                    </td>';
            html += '<td class="text-nowrap qic">\
                    <a href="#delete-row" row="row-' + count + '" class="btn btn-danger delete-row">Delete</a>\
                    </td>';
            html += '</tr>';
            $('.row-table').append(html);
            var before = count - 1;
            var tanpa_rupiah_elements = document.querySelectorAll('#rupiah');
            tanpa_rupiah_elements.forEach(function (element) {
                element.addEventListener('keyup', function () {
                    element.value = formatRupiah(this.value);
                });
            });
        });
    });

    // Remove Row
    $(document).on('click', '.delete-row', function (event) {
        var row = $(this).attr('row');
        if (confirm('Are you sure want to delete this item?')) {
            event.preventDefault();
            $('#' + row).remove();
        } else {
            event.preventDefault();
        }
    });

    $(document).on('change keyup', '.qty, .price, .disc', function () {
        var row = $(this).attr('row');
        var qty = $(this).val();
        var price = $('.price-' + row).val() || '0';
        var disc = $('.disc-' + row).val() || '0';
        var _price = price.replace(/[^,\d]/g, '');
        var disco = parseInt(_price) * parseInt(disc) / 100;
        if (qty == 0 || qty == '') {            
            $('.subtotal-' + row).val(parseInt(_price) * parseInt(disc) / 100);
            return;
        } else {
            var subtotal = (parseInt(_price) - parseInt(disco)) * parseInt(qty);
            $('.subtotal-' + row).val(subtotal > 0 ? formatRupiah(subtotal.toString()) : 0);
        }

        var total = 0;
        $('.subtotal').each(function () {
            var subtotal = $(this).val().replace(/[^,\d]/g, '');
            if (subtotal) {
                total += parseInt(subtotal);
            }
        });
        $('#totalAll').val(total > 0 ? formatRupiah(total.toString()) : 0);
            
    });


    /* Tanpa Rupiah */
    var tanpa_rupiah_elements = document.querySelectorAll('#rupiah');
    tanpa_rupiah_elements.forEach(function (element) {
        element.addEventListener('keyup', function (e) {
            element.value = formatRupiah(this.value);
        });
    });

    /* Dengan Rupiah */
    var dengan_rupiah = document.getElementById('totalAll');
    dengan_rupiah.addEventListener('keyup', function (e) {
        dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    /* Fungsi */
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{1,3}/gi);

        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
