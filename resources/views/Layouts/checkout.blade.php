<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--    Bootstrap 5     -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!--    Font Awesome     -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Document</title>

</head>

<style>
    body {
        margin: 0;
        padding: 0;
        display: grid;
        grid-template-columns: 50% 50%;
    }

    form {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-column: span 2;
    }

    header {
        grid-column: span 2;
        height: 6rem;
        width: 100%;
        padding: 0 2rem;
        border-bottom: .5px solid rgba(0, 0, 0, 0.5)
    }

    .logo {
        height: 100%;
    }

    .logo .container a {
        height: 100%;
        width: fit-content;
    }

    .logo .container a img {
        height: 80%;
    }

    section {
        flex: 1;
        padding: 2rem;
    }

    section:nth-child(2) {
        background-color: #f5f8fa;
        /* Change this to your desired color */
        border-left: .5px solid rgba(0, 0, 0, 0.1);
        /* position: sticky; */
        /* top: 0; */
        /* z-index: 1; */
    }

    .tooltip {
        position: relative;
        display: inline-block;
        border-bottom: 1px dotted black;
    }

    .tooltip .tooltiptext {
        visibility: hidden;
        width: 120px;
        background-color: black;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;

        /* Position the tooltip */
        position: absolute;
        z-index: 1;
        bottom: 100%;
        left: 50%;
        margin-left: -60px;
    }

    .tooltip:hover .tooltiptext {
        visibility: visible;
    }

    footer {
        height: 4rem;
        background-color: #f8f9fa;
        text-align: center;
        padding-top: 1rem;
        margin-top: auto;
        /* Push the footer to the bottom */
        grid-column: span 2;
        position: relative;
        z-index: 40;
    }
</style>

<body>
    <header>
        <div class="logo">
            <div class="container h-100 d-flex justify-content-between">
                <a href="{{ route('user.homeSection') }}" class="d-flex align-items-center">
                    <img src="{{ asset('assets/webResources/Belle_Chic_Logo_PNG.png') }}" class="m-auto" alt="Logo">
                </a>

                <div class="cart mx-3 d-flex align-items-center">
                    <a href="{{ route('user.cart') }}" class="material-symbols-outlined position-relative d-flex"
                        style="color: white;text-decoration:none;height: fit-content;">

                        {{-- <span class="cart_count">{{ $cart_count }}</span> --}}

                        <svg class="icon icon-cart" aria-hidden="true" focusable="false" role="presentation"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" fill="none"
                            style="height: 3rem;
                            width: 4rem;transform: scale(1.2);color:black;">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M20.5 6.5a4.75 4.75 0 00-4.75 4.75v.56h-3.16l-.77 11.6a5 5 0 004.99 5.34h7.38a5 5 0 004.99-5.33l-.77-11.6h-3.16v-.57A4.75 4.75 0 0020.5 6.5zm3.75 5.31v-.56a3.75 3.75 0 10-7.5 0v.56h7.5zm-7.5 1h7.5v.56a3.75 3.75 0 11-7.5 0v-.56zm-1 0v.56a4.75 4.75 0 109.5 0v-.56h2.22l.71 10.67a4 4 0 01-3.99 4.27h-7.38a4 4 0 01-4-4.27l.72-10.67h2.22z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </header>
    @auth
        <form action="{{ route('user.completeOrder') }}" method="POST">
            @csrf
            <section>
                <div class="row g-5 justify-content-end">
                    <div class="col-md-7 col-lg-8">

                        <div class="needs-validation">
                            @error('*')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <h4 class="mb-3">Payment</h4>
                            <span>All transactions are secure and encrypted.</span>
                            <div class="col-12 mb-3">
                                {{-- <input type="text" class="form-control" id="email" placeholder="" name="trans_type"
                                value="Cash on Delivery (COD)"> --}}
                                <select class="form-select" name="trans_type" id="trans_type">
                                    <option value="" disabled>--- SELECT TRANSACTION TYPE ---</option>
                                    <option value="Cash on Delivery (COD)" selected>Cash on Delivery (COD)</option>
                                </select>
                            </div>

                            <h4 class="mb-3">Billing address</h4>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label for="firstName" class="form-label">First name</label>
                                    <input type="text" class="form-control" id="firstName" placeholder=""
                                        name="first_name" value="{{ old('first_name', $address->first_name ?? '') }}">
                                </div>

                                <div class="col-sm-6">
                                    <label for="lastName" class="form-label">Last name</label>
                                    <input type="text" class="form-control" id="lastName" placeholder=""
                                        name="last_name" value="{{ old('last_name', $address->last_name ?? '') }}">
                                </div>


                                <div class="col-12">
                                    <label for="email" class="form-label">Email <span
                                            class="text-muted">(Optional)</span></label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="you@example.com" value="{{ old('email', $address->email ?? '') }}">
                                </div>

                                <div class="col-12">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        value="{{ old('address', $address->address ?? '') }}" placeholder="">
                                </div>

                                <div class="col-12">
                                    <label for="address2" class="form-label">Address 2 <span
                                            class="text-muted">(Optional)</span></label>
                                    <input type="text" class="form-control" id="address2" name="address_optional"
                                        value="{{ old('address_optional', $address->address_2 ?? '') }}"
                                        placeholder="Apartment or suite">
                                </div>

                                <div class="col-md-12">
                                    <label for="country" class="form-label">Country</label>
                                    <select class="form-select" id="country" name="country"
                                        value="{{ old('country', $address->country ?? '') }}">
                                        <option value="">Choose...</option>
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antartica">Antarctica</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Aruba">Aruba</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bermuda">Bermuda</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Bouvet Island">Bouvet Island</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="British Indian Ocean Territory">British Indian Ocean Territory
                                        </option>
                                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Cape Verde">Cape Verde</option>
                                        <option value="Cayman Islands">Cayman Islands</option>
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Christmas Island">Christmas Island</option>
                                        <option value="Cocos Islands">Cocos (Keeling) Islands</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo">Congo</option>
                                        <option value="Congo">Congo, the Democratic Republic of the</option>
                                        <option value="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Cota D'Ivoire">Cote d'Ivoire</option>
                                        <option value="Croatia">Croatia (Hrvatska)</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="East Timor">East Timor</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
                                        <option value="Faroe Islands">Faroe Islands</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="France Metropolitan">France, Metropolitan</option>
                                        <option value="French Guiana">French Guiana</option>
                                        <option value="French Polynesia">French Polynesia</option>
                                        <option value="French Southern Territories">French Southern Territories</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Gibraltar">Gibraltar</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Greenland">Greenland</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guadeloupe">Guadeloupe</option>
                                        <option value="Guam">Guam</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guinea-Bissau">Guinea-Bissau</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
                                        <option value="Holy See">Holy See (Vatican City State)</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hong Kong">Hong Kong</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Iran">Iran (Islamic Republic of)</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Democratic People's Republic of Korea">Korea, Democratic People's
                                            Republic of</option>
                                        <option value="Korea">Korea, Republic of</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Lao">Lao People's Democratic Republic</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Macau">Macau</option>
                                        <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall Islands">Marshall Islands</option>
                                        <option value="Martinique">Martinique</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mayotte">Mayotte</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Micronesia">Micronesia, Federated States of</option>
                                        <option value="Moldova">Moldova, Republic of</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montserrat">Montserrat</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Namibia">Namibia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherlands">Netherlands</option>
                                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                                        <option value="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Niue">Niue</option>
                                        <option value="Norfolk Island">Norfolk Island</option>
                                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan" selected>Pakistan</option>
                                        <option value="Palau">Palau</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Pitcairn">Pitcairn</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Puerto Rico">Puerto Rico</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Reunion">Reunion</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russia">Russian Federation</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                        <option value="Saint LUCIA">Saint LUCIA</option>
                                        <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia (Slovak Republic)</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
                                        <option value="Span">Spain</option>
                                        <option value="SriLanka">Sri Lanka</option>
                                        <option value="St. Helena">St. Helena</option>
                                        <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
                                        <option value="Swaziland">Swaziland</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syria">Syrian Arab Republic</option>
                                        <option value="Taiwan">Taiwan, Province of China</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania">Tanzania, United Republic of</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tokelau">Tokelau</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Turks and Caicos">Turks and Caicos Islands</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                        <option value="United States Minor Outlying Islands">United States Minor Outlying
                                            Islands</option>
                                        <option value="Uruguay">Uruguay</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Vietnam">Viet Nam</option>
                                        <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                                        <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
                                        <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
                                        <option value="Western Sahara">Western Sahara</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Serbia">Serbia</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                        value="{{ old('city', $address->city ?? '') }}" placeholder="">
                                </div>
                                <div class="col-md-6">
                                    <label for="zip" class="form-label">Zip</label>
                                    <input type="text" class="form-control" id="zip" name="zip_code"
                                        value="{{ old('zip_code', $address->zip_code ?? '') }}" placeholder="">
                                </div>
                                <div class="col-md-12 position-relative">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <div class="input"
                                        style="display: flex;justify-content: center;align-items: center;">
                                        <input type="tel" class="form-control pe-4" id="phone"
                                            name="phone_number" value="{{ old('phone_number', $address->phone ?? '') }}"
                                            placeholder="">
                                        <i class="far fa-question-circle" style="position: absolute;right: 1rem;"></i>
                                    </div>
                                </div>
                                {{-- <div class="col-md-12 position-relative">
                                <label for="phone" class="form-label">title</label>
                                <div class="input"
                                    style="display: flex;justify-content: center;align-items: center;">
                                    <input type="text" class="form-control pe-4" id="phone" name="title" value="{{ old('title') }}"
                                        placeholder="">
                                    <i class="far fa-question-circle" style="position: absolute;right: 1rem;"></i>
                                </div>
                            </div>
                            <div class="col-md-12 position-relative">
                                <label for="phone" class="form-label">Color</label>
                                <div class="input"
                                    style="display: flex;justify-content: center;align-items: center;">
                                    <input type="text" class="form-control pe-4" id="phone" name="color" value="{{ old('color') }}"
                                        placeholder="">
                                    <i class="far fa-question-circle" style="position: absolute;right: 1rem;"></i>
                                </div>
                            </div>
                            <div class="col-md-12 position-relative">
                                <label for="phone" class="form-label">Size</label>
                                <div class="input"
                                    style="display: flex;justify-content: center;align-items: center;">
                                    <input type="text" class="form-control pe-4" id="phone" name="size" value="{{ old('size') }}"
                                        placeholder="">
                                    <i class="far fa-question-circle" style="position: absolute;right: 1rem;"></i>
                                </div>
                            </div>
                            <div class="col-md-12 position-relative">
                                <label for="phone" class="form-label">Quantity</label>
                                <div class="input"
                                    style="display: flex;justify-content: center;align-items: center;">
                                    <input type="text" class="form-control pe-4" id="phone" name="quantity" value="{{ old('quantity') }}"
                                        placeholder="">
                                    <i class="far fa-question-circle" style="position: absolute;right: 1rem;"></i>
                                </div>
                            </div> --}}
                            </div>

                            <hr class="my-4">
                            @if ($address != null)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="same-address"
                                        name="email_offers" value="{{ old('email_offers', 1) }}"
                                        @if ($address->email_offers) checked @endif>
                                    <label class="form-check-label" for="same-address">Email me with news and
                                        offers</label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="save-info"
                                        name="save_information" value="{{ old('save_information', 1) }}"
                                        @if ($address->save_information) checked @endif>
                                    <label class="form-check-label" for="save-info">Save this information for next
                                        time</label>
                                </div>
                            @else
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="same-address"
                                        name="email_offers" value="{{ old('email_offers', 1) }}">
                                    <label class="form-check-label" for="same-address">Email me with news and
                                        offers</label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="save-info"
                                        name="save_information" value="{{ old('save_information', 1) }}">
                                    <label class="form-check-label" for="save-info">Save this information for next
                                        time</label>
                                </div>
                            @endif

                            <hr class="my-4">

                            {{-- <h4 class="mb-3">Payment</h4> --}}

                            {{-- <div class="my-3">
                    <div class="form-check">
                        <input id="credit" name="paymentMethod" type="radio" class="form-check-input"
                            checked required>
                        <label class="form-check-label" for="credit">Credit card</label>
                    </div>
                    <div class="form-check">
                        <input id="debit" name="paymentMethod" type="radio" class="form-check-input"
                            required>
                        <label class="form-check-label" for="debit">Debit card</label>
                    </div>
                    <div class="form-check">
                        <input id="paypal" name="paymentMethod" type="radio" class="form-check-input"
                            required>
                        <label class="form-check-label" for="paypal">Paytm</label>
                    </div>
                    <div class="form-check">
                        <input id="paypal" name="paymentMethod" type="radio" class="form-check-input"
                            required>
                        <label class="form-check-label" for="paypal">Phonepe</label>
                    </div>
                </div> --}}

                            {{-- <div class="row gy-3">
                    <div class="col-md-6">
                        <label for="cc-name" class="form-label">Name on card</label>
                        <input type="text" class="form-control" id="cc-name" placeholder="" required>
                        <small class="text-muted">Full name as displayed on card</small>
                        <div class="invalid-feedback">
                            Name on card is required
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="cc-number" class="form-label">Credit card number</label>
                        <input type="text" class="form-control" id="cc-number" placeholder="" required>
                        <div class="invalid-feedback">
                            Credit card number is required
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="cc-expiration" class="form-label">Expiration</label>
                        <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                        <div class="invalid-feedback">
                            Expiration date required
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="cc-cvv" class="form-label">CVV</label>
                        <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                        <div class="invalid-feedback">
                            Security code required
                        </div>
                    </div>
                </div> --}}

                            {{-- <hr class="my-4"> --}}

                            <button class="w-100 btn btn-primary btn-lg" type="submit">Complete order</button>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                @if ($isGift)
                    <div class="col-md-12 col-lg-12 order-md-last" style="position: sticky; top:3rem">
                        @if ($products)
                            <h4 class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-primary">Your cart</span>
                                <span class="badge bg-primary rounded-pill">{{ $products->count() }}</span>
                            </h4>
                            <ul class="list-group mb-3">
                                @foreach ($products as $product)
                                    <li class="list-group-item d-flex justify-content-between lh-sm">
                                        <div>
                                            <h4 class="my-0">{{ $product->name }}</h4>
                                            <small class="text-muted">{{ $product->fabric_detail }}</small>
                                            <br>
                                            {{-- @foreach ($product->color->where('id', $request->color) as $color)
                                                Color: <small class="text-muted">{{ $color->color }}</small>
                                                <br>
                                            @endforeach
                                            @foreach ($product->size->where('id', $request->size) as $size)
                                                Size: <small class="text-muted">{{ $size->size }}</small>
                                                <br>
                                            @endforeach
                                            @foreach ($product->size->where('id', $request->size) as $size)
                                                Quantity: <small class="text-muted">{{ $request->quantity }}</small>
                                                <br>
                                            @endforeach --}}
                                        </div>
                                        <span class="text-muted">Rs.{{ $product->price }}</span>
                                    </li>
                                    <input type="hidden" name="{{ 'product[]' }}" value="{{ $product->id }}">
                                    <input type="hidden" name="{{ 'color[]' }}" value="{{ $request->color }}">
                                    <input type="hidden" name="{{ 'size[]' }}" value="{{ $request->size }}">
                                    <input type="hidden" name="{{ 'quantity[]' }}" value="{{ $request->quantity }}">
                                    <input type="hidden" name="{{ 'price[]' }}" value="{{ $product->price }}">
                                @endforeach
                            </ul>
                        @else
                            <h4 class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-primary">Your cart</span>
                                <span class="badge bg-primary rounded-pill">{{ $items->count() }}</span>
                            </h4>
                            <ul class="list-group mb-3">
                                @foreach ($items as $key => $product)
                                    <li class="list-group-item d-flex justify-content-between lh-sm">
                                        <div>
                                            <h4 class="my-0">{{ $product->clothe->name }}</h4>
                                            <small class="text-muted">{{ $product->clothe->fabric_detail }}</small><br>
                                            Color: <small class="text-muted">{{ $product->color->color }}</small><br>
                                            Size: <small class="text-muted">{{ $product->size->size }}</small><br>
                                            Quantity: <small class="text-muted">{{ $product->quantity }}</small><br>
                                        </div>
                                        <span class="text-muted">Rs.{{ $product->price }}</span>
                                    </li>
                                    <input type="hidden" name="{{ 'product[]' }}"
                                        value="{{ $product->clothe->id }}">
                                    <input type="hidden" name="{{ 'color[]' }}" value="{{ $product->color->id }}">
                                    <input type="hidden" name="{{ 'size[]' }}" value="{{ $product->size->id }}">
                                    <input type="hidden" name="{{ 'quantity[]' }}" value="{{ $product->quantity }}">
                                    <input type="hidden" name="{{ 'price[]' }}" value="{{ $product->price }}">
                                @endforeach
                            </ul>
                        @endif

                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total (Rupee)</span>
                                {{-- <strong>₹1500</strong> --}}
                                <strong>Rs.{{ $total ?? $product->price * $request->quantity }}</strong>
                            </li>
                        </ul>

                    </div>
                @else
                    <div class="col-md-12 col-lg-12 order-md-last" style="position: sticky; top:3rem">
                        @if ($products)
                            <h4 class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-primary">Your cart</span>
                                <span class="badge bg-primary rounded-pill">{{ $products->count() }}</span>
                            </h4>
                            <ul class="list-group mb-3">
                                @foreach ($products as $product)
                                    <li class="list-group-item d-flex justify-content-between lh-sm">
                                        <div>
                                            <h4 class="my-0">{{ $product->name }}</h4>
                                            <small class="text-muted">{{ $product->fabric_detail }}</small>
                                            <br>
                                            @foreach ($product->color->where('id', $request->color) as $color)
                                                Color: <small class="text-muted">{{ $color->color }}</small>
                                                <br>
                                            @endforeach
                                            @foreach ($product->size->where('id', $request->size) as $size)
                                                Size: <small class="text-muted">{{ $size->size }}</small>
                                                <br>
                                            @endforeach
                                            @foreach ($product->size->where('id', $request->size) as $size)
                                                Quantity: <small class="text-muted">{{ $request->quantity }}</small>
                                                <br>
                                            @endforeach
                                        </div>
                                        <span class="text-muted">Rs.{{ $product->price }}</span>
                                    </li>
                                    <input type="hidden" name="{{ 'product[]' }}" value="{{ $product->id }}">
                                    <input type="hidden" name="{{ 'color[]' }}" value="{{ $request->color }}">
                                    <input type="hidden" name="{{ 'size[]' }}" value="{{ $request->size }}">
                                    <input type="hidden" name="{{ 'quantity[]' }}" value="{{ $request->quantity }}">
                                    <input type="hidden" name="{{ 'price[]' }}" value="{{ $product->price }}">
                                @endforeach
                            </ul>
                        @else
                            <h4 class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-primary">Your cart</span>
                                <span class="badge bg-primary rounded-pill">{{ $items->count() }}</span>
                            </h4>
                            <ul class="list-group mb-3">
                                @foreach ($items as $key => $product)
                                    <li class="list-group-item d-flex justify-content-between lh-sm">
                                        <div>
                                            <h4 class="my-0">{{ $product->clothe->name }}</h4>
                                            <small class="text-muted">{{ $product->clothe->fabric_detail }}</small><br>
                                            Color: <small class="text-muted">{{ $product->color->color }}</small><br>
                                            Size: <small class="text-muted">{{ $product->size->size }}</small><br>
                                            Quantity: <small class="text-muted">{{ $product->quantity }}</small><br>
                                        </div>
                                        <span class="text-muted">Rs.{{ $product->price }}</span>
                                    </li>
                                    <input type="hidden" name="{{ 'product[]' }}"
                                        value="{{ $product->clothe->id }}">
                                    <input type="hidden" name="{{ 'color[]' }}" value="{{ $product->color->id }}">
                                    <input type="hidden" name="{{ 'size[]' }}" value="{{ $product->size->id }}">
                                    <input type="hidden" name="{{ 'quantity[]' }}" value="{{ $product->quantity }}">
                                    <input type="hidden" name="{{ 'price[]' }}" value="{{ $product->price }}">
                                @endforeach
                            </ul>
                        @endif

                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total (Rupee)</span>
                                {{-- <strong>₹1500</strong> --}}
                                <strong>Rs.{{ $total ?? $product->price * $request->quantity }}</strong>
                            </li>
                        </ul>

                    </div>
                @endif

            </section>
        </form>
    @endauth

    @guest
        <a href="{{ route('user.login') }}" style="grid-column: span 2">
            <h1 class="text-center">Login To Continue</h1>
        </a>
    @endguest

    <footer @if (!auth()->check()) style='position:absolute; bottom:0;width:100%' @endif>
        &copy; {{ date('Y') }} FashionForge. All rights reserved.
    </footer>
</body>

</html>
