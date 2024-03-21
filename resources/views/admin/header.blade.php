<head>
    <meta name="csrf-token" content="content">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<header class='dashboard-toolbar d-flex justify-content-between align-items-center'>
    <a href="#" class="menu-toggle">
        <i class="fas fa-bars"></i>
    </a>
    <form id="themeForm" action="{{ route('setTheme') }}" method="GET" class="m-0">
        @csrf
        <div class="checkbox-wrapper-54">
            <label class="switch">
                <input type="checkbox" id="switchCeckbox" type='checkbox' name="theme"
                    @if (Illuminate\Support\Facades\Cookie::get('theme') == 'light') checked @endif onchange="saveData(), toggleTheme()">
                <span class="slider"></span>
            </label>
        </div>
    </form>
</header>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function saveData() {
        // console.log(`#createForm${id}`)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $.ajax({
            url: "{{ url('/setTheme') }}",
            type: 'get',
            data: $(`#themeForm`).serialize(),
            success: function(response) {

            }
        })
    }
</script>
