document.addEventListener('DOMContentLoaded', function (e) {
    (function () {
        const formAccSettings = document.querySelector('#formProfileSettings'),
            formChangePass = document.querySelector('#formPasswordSettings');

        // Form validation for Add new record
        if (formAccSettings) {
            const fv = FormValidation.formValidation(formAccSettings, {
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter your full name'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter email'
                            },
                            emailAddress: {
                                message: 'The value is not a valid email address'
                            }
                        }
                    },
                    phone: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter your phone'
                            }
                        }
                    },
                    nik: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter your nik'
                            }
                        }
                    },
                    address: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter your address'
                            }
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        eleValidClass: '',
                        rowSelector: '.col-md-6'
                    }),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    // Submit the form when all fields are valid
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                    autoFocus: new FormValidation.plugins.AutoFocus()
                },
                init: instance => {
                    instance.on('plugins.message.placed', function (e) {
                        if (e.element.parentElement.classList.contains('input-group')) {
                            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                        }
                    });
                }
            });
        }
        if (formChangePass) {
            const fv = FormValidation.formValidation(formChangePass, {
                fields: {
                    currentPassword: {
                        validators: {
                            notEmpty: {
                                message: 'Please current password'
                            },
                            stringLength: {
                                min: 8,
                                message: 'Password must be more than 8 characters'
                            }
                        }
                    },
                    newPassword: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter new password'
                            },
                            stringLength: {
                                min: 8,
                                message: 'Password must be more than 8 characters'
                            }
                        }
                    },
                    confirmPassword: {
                        validators: {
                            notEmpty: {
                                message: 'Please confirm new password'
                            },
                            identical: {
                                compare: function () {
                                    return formChangePass.querySelector('[name="newPassword"]').value;
                                },
                                message: 'The password and its confirm are not the same'
                            },
                            stringLength: {
                                min: 8,
                                message: 'Password must be more than 8 characters'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        eleValidClass: '',
                        rowSelector: '.col-md-6'
                    }),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    // Submit the form when all fields are valid
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                    autoFocus: new FormValidation.plugins.AutoFocus()
                },
                init: instance => {
                    instance.on('plugins.message.placed', function (e) {
                        if (e.element.parentElement.classList.contains('input-group')) {
                            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                        }
                    });
                }
            });
        }
    })();
});

// Select2 (jquery)
$(function () {
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
