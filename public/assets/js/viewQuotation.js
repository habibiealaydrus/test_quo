$(document).ready(function () {
    $('.quotation-page').addClass('active')
    $('#nameTo, #emailTo').on('input', function () {
        const nameTo = $('#nameTo').val().trim();
        const emailTo = $('#emailTo').val().trim();
        if (nameTo !== '' && emailTo !== '') {
            $('.data-submit').prop('disabled', false);
        } else {
            $('.data-submit').prop('disabled', true);
        }
    });
});

$(document).ready(function () {
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

        var quillEditor = document.getElementById('quill-editor-area');
        if (quillEditor) {
            quill.on('text-change', function () {
                quillEditor.value = quill.root.innerHTML;
            });
        }
    });
});
// Select2 (jquery)
$(function () {

    const sendQuotationForm = document.getElementById('sendQuotationForm');;

    const fv = FormValidation.formValidation(sendQuotationForm, {
        fields: {
            nameTo: {
                validators: {
                    notEmpty: {
                        message: 'Please enter receiver name '
                    }
                }
            },
            emailTo: {
                validators: {
                    notEmpty: {
                        message: 'Please enter receiver email'
                    },
                    emailAddress: {
                        message: 'The value is not a valid email address'
                    }
                }
            }
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                // Use this for enabling/changing valid/invalid class
                eleValidClass: '',
                rowSelector: function (field, ele) {
                    // field is the field name & ele is the field element
                    return '.mb-3';
                }
            }),
            submitButton: new FormValidation.plugins.SubmitButton(),
            // Submit the form when all fields are valid
            defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
            autoFocus: new FormValidation.plugins.AutoFocus()
        },
    });
    var select2 = $('.select2');
    // For all Select2
    if (select2.length) {
        select2.each(function () {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>');
            $this.select2({
                dropdownParent: $this.parent()
            });
        });
    }
});
