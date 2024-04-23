@extends('app')
@section('content')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <style>
        .filepond--credits {
            display: none !important
        }

        .progress {
            position: relative;
            widows: 50%;
            background-color: #c9cfc9;
        }

        .bar {
            background-color: #00ff00
        }

        .percentage {
            position: absolute;
            display: inline-block;
            left: 50%;
            color: #040608;
        }
    </style>
    <div class="container">
        <form id="fileUploadForm" method="POST" action="{{ url('/file') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <input name="file" type="file" class="form-control">
            </div>
            <div class="progress">
                <div class="bar"></div>
                <div class="percentage"></div>
            </div>
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








    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.js"></script>
    <script>
        $(function() {
            $(document).ready(function() {

                var message = $('.success__msg');
                var intervalId;
                $('#fileUploadForm').ajaxForm({
                    beforeSend: function() {
                        var percentage = '0';
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                        var percentage = percentComplete + '%';
                        // setInterval(() => {
                        // console.log(percentage, '=', total);
                        // }, 100);
                        // $('.progress .progress-bar').css("width", 80 + '%', function() {
                        //     return $(this).attr("aria-valuenow", 80) + "%";
                        // })
                        var increase = 0;
                        intervalId = setInterval(function() {
                            increase++;
                            $('.progress .bar').css("width", increase + '%',
                                function() {
                                    return $(this).attr("aria-valuenow", increase) +
                                        "%";
                                })
                        }, 350); // Execute every 100 milliseconds


                    },
                    complete: function(xhr) {
                        clearInterval(intervalId);
                        console.log('File has uploaded');
                        $('.progress .bar').css("width", 100 + '%', function() {
                            return $(this).attr("aria-valuenow", 100) + "%";
                        })
                        // message.fadeIn().removeClass('alert-danger').addClass('alert-success');
                        // message.text("Uploaded File successfully.");
                        // setTimeout(function() {
                        //     message.fadeOut();
                        // }, 2000);
                        // form.find('input:not([type="submit"]), textarea').val('');
                        var percentage = '0';
                    }
                });
            });

        });
    </script> --}}















    {{-- <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="{{ asset('assets/css/bootstrap5.min.css') }}" rel="stylesheet" />

        <title>{{ config('app.name') }}</title>
    </head>

    <style>
        .card-footer,
        .progress {
            display: none;
        }
    </style>

    <body>

        <div class="container pt-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-center">
                            <h5>Upload File</h5>
                        </div>

                        <div class="card-body">
                            <div id="upload-container" class="text-center">
                                <button id="browseFile" class="btn btn-primary">Brows File</button>
                            </div>
                            <div class="progress mt-3" style="height: 25px">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                    style="width: 75%; height: 100%">75%</div>
                            </div>
                        </div>

                        <div class="card-footer p-4">
                            <iframe id="videoPreview" src="" controls style="width: 100%; height: 20rem"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Bootstrap JS Bundle with Popper --> --}}
        {{-- <script src="{{ asset('assets/js/bootstrap5-bundle.min.js') }}"></script> --}}
        <!-- Resumable JS -->
        {{-- <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script> --}}

        {{-- <script type="text/javascript">
            let browseFile = $('#browseFile');
            let resumable = new Resumable({
                target: '{{ url('file') }}',
                query: {
                    _token: '{{ csrf_token() }}'
                }, // CSRF token
                fileType: ['jpg', 'png', 'gif', 'webp', 'mp4'],
                headers: {
                    'Accept': 'application/json'
                },
                testChunks: false,
                throttleProgressCallbacks: 1,
            });

            resumable.assignBrowse(browseFile[0]);

            resumable.on('fileAdded', function(file) { // trigger when file picked
                showProgress();
                resumable.upload() // to actually start uploading.
            });

            resumable.on('fileProgress', function(file) { // trigger when file progress update
                updateProgress(Math.floor(file.progress() * 100));
            });

            resumable.on('fileSuccess', function(file, response) { // trigger when file upload complete
                response = JSON.parse(response)
                $('#videoPreview').attr('src', response.path);
                $('.card-footer').show();
            });

            resumable.on('fileError', function(file, response) { // trigger when there is any error
                alert('file uploading error.')
            });


            let progress = $('.progress');

            function showProgress() {
                progress.find('.progress-bar').css('width', '0%');
                progress.find('.progress-bar').html('0%');
                progress.find('.progress-bar').removeClass('bg-success');
                progress.show();
            }

            function updateProgress(value) {
                progress.find('.progress-bar').css('width', `${value}%`)
                progress.find('.progress-bar').html(`${value}%`)
            }

            function hideProgress() {
                progress.hide();
            }
        </script> --}}
    </body>

    </html>
@endsection
