<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
          content="ie=edge">
    <meta name="csrf-token"
          content="{{ csrf_token() }}">
    <title>
        Register
    </title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous"
          rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
    <link href="{{ asset('css/jquery-ui.min.css') }}"
          rel="stylesheet">
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <link href="{{ asset('css/style.css') }}"
          rel="stylesheet">
</head>
<body>
<div class="container mt-md-5 mb-md-5">
    <div class="col-md-6 offset-md-3">
        <h3 class="text-center">
            Registration form
        </h3>
        <form id="register">

            <fieldset>
                <legend class="h5">
                    Basic information
                </legend>

                <div class="form-group">
                    <label for="first-name">
                        First Name
                        <span class="mandatory">*</span>
                    </label>
                    <input type="text"
                           class="form-control"
                           id="first-name"
                           autocomplete="form-first-name-{{ csrf_token() }}">
                    <div class="invalid-feedback"
                         id="first-name-error"></div>
                </div>

                <div class="form-group">
                    <label for="last-name">
                        Last Name
                        <span class="mandatory">*</span>
                    </label>
                    <input type="text"
                           class="form-control"
                           id="last-name"
                           autocomplete="form-last-name-{{ csrf_token() }}">
                    <div class="invalid-feedback"
                         id="last-name-error"></div>
                </div>

                <div class="form-group">
                    <label for="email">
                        E-Mail
                        <span class="mandatory">*</span>
                    </label>
                    <input type="text"
                           class="form-control"
                           id="email"
                           autocomplete="form-email-{{ csrf_token() }}">
                    <div class="invalid-feedback"
                         id="email-error"></div>
                </div>

                <div class="form-group">
                    <label for="password">
                        Password
                        <span class="mandatory">*</span>
                    </label>
                    <input type="password"
                           class="form-control"
                           id="password"
                           autocomplete="new-password">
                    <div class="invalid-feedback"
                         id="password-error"></div>
                </div>

                <div class="form-group">
                    <label for="password-confirmation">
                        Confirm Password
                        <span class="mandatory">*</span>
                    </label>
                    <input type="password"
                           class="form-control"
                           id="password-confirmation"
                           autocomplete="new-password">
                    <div class="invalid-feedback"
                         id="password-confirmation-error"></div>
                </div>

                <div class="form-group">
                    <label for="date-of-birth">
                        Date of Birth
                        <span class="mandatory">*</span>
                    </label>
                    <input type="date"
                           class="form-control"
                           id="date-of-birth"
                           max="{{ now()->subYears(18)->toDateString() }}"
                           autocomplete="form-date-of-birth-{{ csrf_token() }}">
                    <div class="invalid-feedback"
                         id="date-of-birth-error">
                    </div>
                </div>

                <div class="form-group">
                    <label>
                        Gender
                        <span class="mandatory">*</span>
                    </label>
                    <br>
                    <div class="custom-control custom-radio">
                        <input type="radio"
                               id="male"
                               class="custom-control-input"
                               name="gender"
                               value="male"
                               autocomplete="form-gender-male-{{ csrf_token() }}">
                        <label class="custom-control-label"
                               for="male">
                            Male
                        </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio"
                               id="female"
                               class="custom-control-input"
                               name="gender"
                               value="female"
                               autocomplete="form-gender-female-{{ csrf_token() }}">
                        <label class="custom-control-label"
                               for="female">
                            Female
                        </label>
                        <div class="invalid-feedback"
                             id="gender-error">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="annual-income">
                        Annual Income
                        <span class="mandatory">*</span>
                    </label>
                    <input type="text"
                           class="form-control"
                           id="annual-income">
                    <div class="invalid-feedback"
                         id="annual-income-error">
                    </div>
                </div>

                <div class="form-group">
                    <label for="occupation">
                        Occupation
                    </label>
                    <select class="form-control"
                            id="occupation">
                        <option value="" selected disabled>
                            Please select one...
                        </option>
                        <option value="private job">
                            Private job
                        </option>
                        <option value="government job">
                            Government job
                        </option>
                        <option value="business">
                            Business
                        </option>
                    </select>
                    <div class="invalid-feedback"
                         id="occupation-error">
                    </div>
                </div>

                <div class="form-group">
                    <label for="family-type">
                        Family Type
                    </label>
                    <select class="form-control"
                            id="family-type">
                        <option value="" selected disabled>
                            Please select one...
                        </option>
                        <option value="joint family">
                            Joint family
                        </option>
                        <option value="nuclear family">
                            Nuclear family
                        </option>
                    </select>
                    <div class="invalid-feedback"
                         id="family-type-error">
                    </div>
                </div>

                <div class="form-group">
                    <label for="manglik">
                        Manglik
                    </label>
                    <select class="form-control"
                            id="manglik">
                        <option value="" selected disabled>
                            Please select one...
                        </option>
                        <option value="yes">
                            Yes
                        </option>
                        <option value="no">
                            No
                        </option>
                    </select>
                    <div class="invalid-feedback"
                         id="manglik-error">
                    </div>
                </div>

            </fieldset>

            <fieldset>
                <legend class="h5">
                    Partner preference
                </legend>

                <div class="form-group">
                    <label for="expected-income">
                        Expected income
                    </label>
                    <span class="float-right"
                          id="expected-income">
                        0-0
                    </span>
                    <div id="expected-income-slider"></div>
                    <div class="invalid-feedback"
                         id="expected-income-error">
                    </div>
                </div>

                <div class="form-group">
                    <label for="expected-occupation">
                        Occupation
                    </label>
                    <select class="form-control"
                            id="expected-occupation"
                            multiple>
                        <option value="private job">
                            Private job
                        </option>
                        <option value="government job">
                            Government job
                        </option>
                        <option value="business">
                            Business
                        </option>
                    </select>
                    <div class="invalid-feedback"
                         id="expected-occupation-error">
                    </div>
                </div>

                <div class="form-group">
                    <label for="expected-family-type">
                        Family Type
                    </label>
                    <select class="form-control"
                            id="expected-family-type"
                            multiple>
                        <option value="joint family">
                            Joint family
                        </option>
                        <option value="nuclear family">
                            Nuclear family
                        </option>
                    </select>
                    <div class="invalid-feedback"
                         id="expected-family-type-error">
                    </div>
                </div>
                <div class="form-group">
                    <label for="expected-manglik">
                        Manglik
                    </label>
                    <select class="form-control"
                            id="expected-manglik">
                        <option value="" selected disabled>
                            Please select one...
                        </option>
                        <option value="yes">
                            Yes
                        </option>
                        <option value="no">
                            No
                        </option>
                        <option value="both">
                            Both
                        </option>
                    </select>
                    <div class="invalid-feedback"
                         id="expected-manglik-error">
                    </div>
                </div>
            </fieldset>

            <div class="form-group text-center">
                <input type="button"
                       class="btn btn-primary"
                       id="submit"
                       value="Submit">
            </div>

        </form>
    </div>
</div>
<script src="{{ asset('js/register.js') }}"></script>
</body>
</html>
