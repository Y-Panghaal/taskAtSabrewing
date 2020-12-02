$(document).ready(function () {

    const token = $('meta[name="csrf-token"]').attr('content');

    const addCommas = x => x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    $('div#expected-income-slider').slider({
        range   : true,
        min     : 0,
        max     : 10000000,
        step    : 50000,
        slide   : function (event, ui) {
            $('span#expected-income').text(`${addCommas(ui.values[0])}-${addCommas(ui.values[1])}`);
        }
    });

    const validate = function (data, selector, error) {
        $.ajax({
            url     : '/validate',
            type    : 'POST',
            dataType: 'json',
            data    : {
                _token: token,
                ...data
            },
            success: (response) => {
                if (response['status'] === 'ok') {
                    if (selector.hasClass('is-invalid')) {
                        selector.removeClass('is-invalid');
                    }
                    error.text('');
                    if (!selector.hasClass('is-valid')) {
                        selector.addClass('is-valid');
                    }
                } else {
                    if (selector.hasClass('is-valid')) {
                        selector.removeClass('is-valid');
                    }
                    if (!selector.hasClass('is-invalid')) {
                        selector.addClass('is-invalid');
                    }
                    error.text(response['errors'] ? response['errors'][0] : response['message']);
                }
            },
            error: (jqXHR) => {
                console.log('Error', jqXHR);
            }
        });
    };

    const validateFirstName = function() {
        const
            selector    = $('input#first-name'),
            error       = $('div#first-name-error'),
            data        = {
                check_for   : 'first_name',
                first_name  : selector.val().trim()
            };
        validate(data, selector, error);
    };
    $(document.body)
        .on('keyup', 'input#first-name', validateFirstName)
        .on('change', 'input#first-name', validateFirstName)
        .on('blur', 'input#first-name', validateFirstName);

    const validateLastName = function() {
        const
            selector    = $('input#last-name'),
            error       = $('div#last-name-error'),
            data        = {
                check_for   : 'last_name',
                last_name   : selector.val().trim()
            };
        validate(data, selector, error);
    };
    $(document.body)
        .on('keyup', 'input#last-name', validateLastName)
        .on('change', 'input#last-name', validateLastName)
        .on('blur', 'input#last-name', validateLastName);

    const validateEmail = function() {
        const
            selector    = $('input#email'),
            error       = $('div#email-error'),
            data        = {
                check_for   : 'email',
                email       : selector.val().trim()
            };
        validate(data, selector, error);
    };
    $(document.body)
        .on('keyup', 'input#email', validateEmail)
        .on('change', 'input#email', validateEmail)
        .on('blur', 'input#email', validateEmail);

    const validatePassword = function() {
        const
            selector    = $('input#password'),
            error       = $('div#password-error'),
            data        = {
                check_for   : 'password',
                password    : selector.val().trim()
            };
        validate(data, selector, error);
    };
    $(document.body)
        .on('keyup', 'input#password', validatePassword)
        .on('change', 'input#password', validatePassword)
        .on('blur', 'input#password', validatePassword);

    const validatePasswordConfirmation = function() {
        const
            selector    = $('input#password-confirmation'),
            error       = $('div#password-confirmation-error'),
            data        = {
                check_for               : 'password_confirmation',
                password                : $('input#password').val().trim(),
                password_confirmation   : selector.val().trim()
            };
        validate(data, selector, error);
    };
    $(document.body)
        .on('keyup', 'input#password-confirmation', validatePasswordConfirmation)
        .on('change', 'input#password-confirmation', validatePasswordConfirmation)
        .on('blur', 'input#password-confirmation', validatePasswordConfirmation);

    const validateDateOfBirth = function() {
        const
            selector    = $('input#date-of-birth'),
            error       = $('div#date-of-birth-error'),
            data        = {
                check_for       : 'date_of_birth',
                date_of_birth   : selector.val().trim()
            };
        validate(data, selector, error);
    };
    $(document.body)
        .on('keyup', 'input#date-of-birth', validateDateOfBirth)
        .on('change', 'input#date-of-birth', validateDateOfBirth)
        .on('blur', 'input#date-of-birth', validateDateOfBirth);

    const validateGender = function() {
        const
            selector    = $('input[name="gender"]'),
            error       = $('div#gender-error'),
            data        = {
                check_for   : 'gender',
                gender      : selector.val().trim()
            };
        validate(data, selector, error);
    };
    $(document.body)
        .on('change', 'input[name="gender"]', validateGender)
        .on('blur', 'input[name="gender"]', validateGender);

    const validateAnnualIncome = function() {
        const
            selector    = $('input#annual-income'),
            error       = $('div#annual-income-error'),
            data        = {
                check_for       : 'annual_income',
                annual_income   : selector.val().trim()
            };
        validate(data, selector, error);
    };
    $(document.body)
        .on('keyup', 'input#annual-income', validateAnnualIncome)
        .on('change', 'input#annual-income', validateAnnualIncome)
        .on('blur', 'input#annual-income', validateAnnualIncome);

    const validateOccupation = function() {
        const
            selector    = $('select#occupation'),
            error       = $('div#occupation-error'),
            data        = {
                check_for   : 'occupation',
                occupation  : selector.val().trim()
            };
        validate(data, selector, error);
    };
    $(document.body)
        .on('change', 'select#occupation', validateOccupation)
        .on('blur', 'select#occupation', validateOccupation);

    const validateFamilyType = function() {
        const
            selector    = $('select#family-type'),
            error       = $('div#family-type-error'),
            data        = {
                check_for   : 'family_type',
                family_type : selector.val().trim()
            };
        validate(data, selector, error);
    };
    $(document.body)
        .on('change', 'select#family-type', validateFamilyType)
        .on('blur', 'select#family-type', validateFamilyType);

    const validateManglik = function() {
        const
            selector    = $('select#manglik'),
            error       = $('div#manglik-error'),
            data        = {
                check_for   : 'manglik',
                manglik     : selector.val().trim()
            };
        validate(data, selector, error);
    };
    $(document.body)
        .on('change', 'select#manglik', validateManglik)
        .on('blur', 'select#manglik', validateManglik);

    $(document.body).on('click', 'input#submit', function() {
        const formElements = {
            first_name : {
                selector: $('input#first-name'),
                error: $('div#first-name-error'),
                trimmable: true,
                slider: false,
                radio: false
            },
            last_name : {
                selector: $('input#last-name'),
                error: $('div#last-name-error'),
                trimmable: true,
                slider: false,
                radio: false
            },
            email : {
                selector: $('input#email'),
                error: $('div#email-error'),
                trimmable: true,
                slider: false,
                radio: false
            },
            password : {
                selector: $('input#password'),
                error: $('div#password-error'),
                trimmable: true,
                slider: false,
                radio: false
            },
            password_confirmation : {
                selector: $('input#password-confirmation'),
                error: $('div#password-confirmation-error'),
                trimmable: true,
                slider: false,
                radio: false
            },
            date_of_birth : {
                selector: $('input#date-of-birth'),
                error: $('div#date-of-birth-error'),
                trimmable: true,
                slider: false,
                radio: false
            },
            gender : {
                selector: $('input[name="gender"]'),
                error: $('div#gender-error'),
                trimmable: false,
                slider: false,
                radio: true
            },
            annual_income : {
                selector: $('input#annual-income'),
                error: $('div#annual-income-error'),
                trimmable: true,
                slider: false,
                radio: false
            },
            occupation : {
                selector: $('select#occupation'),
                error: $('div#occupation-error'),
                trimmable: false,
                slider: false,
                radio: false
            },
            family_type : {
                selector: $('select#family-type'),
                error: $('div#family-type-error'),
                trimmable: false,
                slider: false,
                radio: false
            },
            manglik                 : {
                selector: $('select#manglik'),
                error: $('div#manglik-error'),
                trimmable: false,
                slider: false,
                radio: false
            },
            expected_income         : {
                selector: $('div#expected-income-slider'),
                error: $('div#expected-income-error'),
                trimmable: false,
                slider: true,
                radio: false
            },
            expected_occupation     : {
                selector: $('select#expected-occupation'),
                error: $('div#expected-occupation-error'),
                trimmable: false,
                slider: false,
                radio: false
            },
            expected_family_type    : {
                selector: $('select#expected-family-type'),
                error: $('div#expected-family-type-error'),
                trimmable: false,
                slider: false,
                radio: false
            },
            expected_manglik        : {
                selector: $('select#expected-manglik'),
                error: $('div#expected-manglik-error'),
                trimmable: false,
                slider: false,
                radio: false
            },
        };
        let data = {
            _token : token,
        };
        Object.keys(formElements).forEach((key) => {
            formElements[key].error.text('');
            $('.is-valid').removeClass('is-valid');
            $('.is-invalid').removeClass('is-invalid');
            console.log(key);
            if (formElements[key].slider) {
                data[key] = formElements[key].selector.slider('values');
                return;
            }
            if (formElements[key].radio) {
                const name = formElements[key].selector.attr('name');
                const selected = $(`input[name="${name}"]:checked`);
                if (selected.length > 0) {
                    data[key] = selected.val();
                } else {
                    data[key] = '';
                }
                return;
            }
            data[key] = formElements[key].selector.val();
            if (formElements[key].trimmable) {
                data[key] = data[key].trim();
            }
        });
        $.ajax({
            url: '/validate',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: (response) => {
                if (response['status'] === 'ok') {
                    alert('User registered. You will be redirected to dashboard.');
                    location.href = '/login';
                } else {
                    alert(response['message']);
                    if (response['errors']) {
                        Object.keys(response['errors']).forEach(key => {
                            formElements[key].error.text(response['errors'][key][0]);
                            if (formElements[key].slider) {
                                $('span#expected-income').addClass('is-invalid');
                                return;
                            }
                            formElements[key].selector.addClass('is-invalid');
                        });
                    }
                }
            },
            error: (jqXHR) => {
                alert("Something went wrong. Please try again after sometime.");
                console.log(jqXHR);
            },
        });
    });

});
