    /* Tanpa Rupiah */
    var tanpa_rupiah_elements = document.querySelectorAll('.rupiah');
    tanpa_rupiah_elements.forEach(function (element) {
        element.value = formatRupiah(element.value);
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

    $(document).on('change keyup', '#qty, #price, #disc', function (event) {
        var row = $(this).closest('tr');
        var qty = row.find('#qty').val() || '0';
        var price = row.find('#price').val() || '0';
        var disc = row.find('#disc').val() || '0';
        var _price = price.replace(/[^,\d]/g, '');
        var disco = parseInt(_price) * parseInt(disc) / 100;
        var subtotal = (parseInt(_price) - parseInt(disco)) * parseInt(qty);
        row.find('#net').val(subtotal > 0 ? formatRupiah(subtotal.toString()) : 0);

        var tot = 0;
        $('input[name="net[]"]').each(function() {
            var value = parseInt($(this).val().replace(/[^,\d]/g, ''));
            tot += value;
        });
        $('#totalAll').val(tot > 0 ? formatRupiah(tot.toString()) : 0);
    });

    var editors = document.querySelectorAll("[id^='editor_']");
    editors.forEach(function (editor) {
        var quill = new Quill(editor, {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{
                        font: []
                    }],
                    [{
                        size: []
                    }],
                    ["bold", "italic", "underline"],
                    [{
                        list: "ordered"
                    }, {
                        list: "bullet"
                    }],
                    [{
                        color: []
                    }, {
                        background: []
                    }],
                ]
            },
        });
        quill.on('text-change', function (delta, oldDelta, source) {
            var index = editor.id.split('_')[1];
            document.querySelectorAll("input[name='desc[]']")[index].value = quill.root.innerHTML;
        });
    });
    
    
    
   