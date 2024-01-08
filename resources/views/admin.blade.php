<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--    Dashboard css     -->
    <link rel="stylesheet" href="{{ asset('assets/admin/dashboard.css') }}">

    <!--    Cards css     -->
    <link rel="stylesheet" href="{{ asset('assets/admin/cards.css') }}">

    <!--    Custom css     -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/admin/custom.css') }}"> --}}

    <!--    font Awesome     -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--    Google Icons     -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!--    Google Fonts     -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">

    <!--    Bootstrap 5     -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!--    Data Tables     -->
    <link href="{{ asset('dataTables/datatablestyle.css') }}" rel="stylesheet" />

    <!--    Bootstrap 4     -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet"> -->

    <!-- MultiSelect Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS For MultiSelect -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Style Link For MultiSelect -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />

    <!-- MultiSelect CSS File  -->
    <link rel="stylesheet" href="{{ asset('assets/multiSelect/css/style.css') }}">



    <title>Document</title>
</head>
<style>
    a {
        text-decoration: none;
    }

    a:hover {
        color: unset;
    }

    pre{
        color: unset
    }
</style>

<body>

    <div class='dashboard'>
        <div class='dashboard-app'>
            @include('admin.header')
            @yield('content')
            @include('admin.sidebar')
        </div>
    </div>






    <!--    JQuery     -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!--    Custom     -->
    <script src="{{ asset('assets/admin/script.js') }}"></script>

    <!--    Bootstrap 5     -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>


    <!--    Data Tables     -->
    <script src="{{ asset('dataTables/simple-datatables.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('dataTables/datatables-simple-demo.js') }}"></script>

    <script>
        const product_images = document.querySelector('#product_images');
        let modalForCount = document.getElementById('modalForCount');
        let modal_body = document.getElementById('modal-body')
        let url_fields = document.getElementsByClassName('url_fields');


        console.log(modal_body);
        // modalForCount.addEventListener('mousemove', () => {
        //     // console.log(url_fields.length)
        //     console.log(product_images.files.length)
        //     if (url_fields.length < product_images.files.length) {
        //         modal_body.innerHTML += `<div class="mb-3 url_fields" style="text-align: left;" id="url_fields">
    //                         <label for="product_image_url" class="form-label">Product Image URL</label>
    //                         <input type="text" name="product_image_url" class="form-control" id="product_image_url" placeholder="Enter image url ${url_fields.length}">
    //                     </div>`
        //     }
        // })

        const plusButton = document.querySelector('#plusButton')
        const minusButton = document.querySelector('#minusButton')
        const image_section = document.querySelector('#image_section')
        const input_length = document.querySelector('#input_length')
        let count = 0;
        input_length.innerText = 1;
        plusButton.addEventListener('click', () => {
            console.log(image_section.children.length);
            input_length.innerHTML = image_section.children.length + 1;
            if (input_length.innerHTML > 5) {
                input_length.innerHTML = 5;
            }
            if (image_section.children.length <= 4 || count === 5) {
                ++count
                image_section.innerHTML += `<div class="plusButton" id="image_section" style="display: grid;grid-template-columns: 48% 48%;align-items: center;justify-content: space-between;">
                                    <div class="mb-3" style="text-align: left;">
                                        <label for="product_images" class="form-label">Product Images</label>
                                        <input class="form-control" name="product_images[]" type="file" id="product_images" required>
                                    </div>
                                    <div class="mb-3 url_fields" style="text-align: left;" id="url_fields">
                                        <label for="product_image_url" class="form-label">Product Image URL</label>
                                        <input type="text" name="product_image_url[]" class="form-control" id="product_image_url" placeholder="Enter image url">
                                    </div>
                                </div>`;
            } else {
                alert('limit crossing. Max Inputs Limit is 5')
            }
        })

        minusButton.addEventListener('click', () => {
            // console.log(image_section.children);
            // console.log(image_section.children[image_section.children.length - 1]);
            if (image_section.children.length > 1) {
                image_section.removeChild(image_section.children[image_section.children.length - 1]);
                input_length.innerText = image_section.children.length;
            } else {
                alert('Nothing to Remove')
            }
        })



        const plusButton2 = document.querySelector('#plusButton2')
        const minusButton2 = document.querySelector('#minusButton2')
        const image_section2 = document.querySelector('#image_section2')
        const input_length2 = document.querySelector('#input_length2')
        let count2 = 0;
        input_length2.innerText = 1;
        plusButton2.addEventListener('click', () => {
            input_length2.innerHTML = image_section2.children.length + 1;
            if (input_length2.innerHTML > 5) {
                input_length2.innerHTML = 5;
            }
            if (image_section2.children.length <= 4 || count === 5) {
                ++count2;
                image_section2.innerHTML += `<div class="plusButton" id="image_section2" style="display: grid;grid-template-columns: 48% 48%;align-items: center;justify-content: space-between;">
                                    <div class="mb-3" style="text-align: left;">
                                        <label for="edit_product_images" class="form-label">Product Images</label>
                                        <input class="form-control" name="edit_product_images[]" type="file" id="edit_product_images" required>
                                    </div>
                                    <div class="mb-3 url_fields" style="text-align: left;" id="url_fields">
                                        <label for="edit_product_image_url" class="form-label">Product Image URL</label>
                                        <input type="text" name="edit_product_image_url[]" class="form-control" id="edit_product_image_url" placeholder="Enter image url">
                                    </div>
                                </div>`;
            } else {
                alert('limit crossing. Max Inputs Limit is 5')
            }
        })

        minusButton2.addEventListener('click', () => {
            // console.log(image_section.children);
            // console.log(image_section.children[image_section.children.length - 1]);
            if (image_section2.children.length > 1) {
                image_section2.removeChild(image_section2.children[image_section2.children.length - 1]);
                input_length2.innerText = image_section2.children.length;
            } else {
                alert('Nothing to Remove')
            }
        })
    </script>

    <!-- MultiSelect JS -->
    <script src="{{ asset('assets/multiSelect/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/multiSelect/js/popper.js') }}"></script>
    <script src="{{ asset('assets/multiSelect/js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    <script src="{{ asset('assets/multiSelect/js/main.js') }}"></script>
</body>

</html>
