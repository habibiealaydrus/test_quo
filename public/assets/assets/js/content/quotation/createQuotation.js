document.addEventListener('DOMContentLoaded', function (e) {
    (function () {
        // variables
        // Edit user form validation
        FormValidation.formValidation(document.getElementById('addNewQuotationForm'), {
            fields: {
                company: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter name of company'
                        }
                    }
                },
                project: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter name of project'
                        }
                    }
                },
                customer: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter name of customer'
                        }
                    }
                },
                contact: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter contact phone of customer'
                        }
                    }
                },
                address: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter address of customer'
                        }
                    }
                },
                totalAll: {
                    validators: {
                        notEmpty: {
                            message: 'Total Cannot be empty'
                        }
                    }
                },
                sk: {
                    validators: {
                        notEmpty: {
                            message: 'Please input SK of customer'
                        }
                    }
                },
                notes: {
                    validators: {
                        notEmpty: {
                            message: 'Please input notes'
                        }
                    }
                },
                'items[]': {
                    validators: {
                        notEmpty: {
                            message: 'Please input item name'
                        }
                    }
                },
                'price[]': {
                    validators: {
                        notEmpty: {
                            message: 'Please input price minimum 1'
                        }
                    }
                },
                'disc[]': {
                    validators: {
                        notEmpty: {
                            message: 'Please input discount or 0'
                        }
                    }
                },
                'qty[]': {
                    validators: {
                        notEmpty: {
                            message: 'Please input qty minimum 1'
                        }
                    }
                }
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    // Use this for enabling/changing valid/invalid class
                    // eleInvalidClass: '',
                    eleValidClass: '',
                    rowSelector: '.qic'
                }),
                submitButton: new FormValidation.plugins.SubmitButton(),
                // Submit the form when all fields are valid
                defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                autoFocus: new FormValidation.plugins.AutoFocus()
            }
        });
    })();
});
