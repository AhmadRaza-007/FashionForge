@extends('app')
@section('content')
    {{-- <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" /> --}}
    <style>
        .filepond--credits {
            display: none !important
        }
    </style>
    <div class="container">
        <form id="fileUploadForm" method="POST" action="{{ url('/file') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <input name="file" type="file" class="form-control">
            </div>
            {{-- <div class="form-group">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-dark" role="progressbar"
                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                </div>
            </div> --}}
            <div class="d-grid mt-4">
                <input type="submit" value="Upload" class="btn btn-dark">
            </div>
        </form>
    </div>
    {{-- <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script>
        // Get a reference to the file input element
        const inputElement = document.querySelector('input[type="file"]');

        // Create a FilePond instance
        const pond = FilePond.create(inputElement);

        FilePond.setOptions({
            server: {
                url: '/file',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            credit: false,
        });
    </script> --}}


    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script>
        $(function() {
            $(document).ready(function() {

                var message = $('.success__msg');

                $('#fileUploadForm').ajaxForm({
                    beforeSend: function() {
                        var percentage = '0';
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                        var percentage = percentComplete;
                        $('.progress .progress-bar').css("width", 80 + '%', function() {
                            return $(this).attr("aria-valuenow", 80) + "%";
                        })
                    },
                    complete: function(xhr) {
                        console.log('File has uploaded');
                        $('.progress .progress-bar').css("width", 100 + '%', function() {
                            return $(this).attr("aria-valuenow", 100) + "%";
                        })
                        message.fadeIn().removeClass('alert-danger').addClass('alert-success');
                        message.text("Uploaded File successfully.");
                        setTimeout(function() {
                            message.fadeOut();
                        }, 2000);
                        // form.find('input:not([type="submit"]), textarea').val('');
                        var percentage = '0';
                    }
                });
            });
        });
    </script> --}}
@endsection
