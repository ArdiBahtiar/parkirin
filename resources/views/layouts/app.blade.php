@include('inc.function')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setTitle($page_name) }}</title>
    <link rel="icon" type="image/x-icon" href="{{asset('storage/img/favicon.ico')}}"/>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    @include('inc.styles')  

    @livewireStyles
</head>
<body {{ ($has_scrollspy) ? scrollspy($scrollspy_offset) : '' }} class=" {{ ($page_name === 'alt_menu') ? 'alt-menu' : '' }} {{ ($page_name === 'error404') ? 'error404 text-center' : '' }} {{ ($page_name === 'error500') ? 'error500 text-center' : '' }} {{ ($page_name === 'error503') ? 'error503 text-center' : '' }} {{ ($page_name === 'maintenence') ? 'maintanence text-center' : '' }}">
    
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    @include('inc.navbar')
    
    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        @include('inc.sidebar')

        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">

            @yield('content')

            @if ($page_name != 'account_settings')
                @include('inc.footer')
            @endif
        </div>
        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->

    @include('inc.scripts')

    @livewireScripts

    <div id="loadingOverlay">
        <div class="loading-spinner"></div>
        <div>Loading... Please wait</div>
    </div>

    {{-- PUSHER CHATS JAVASCRIPT AND AJAX, script jquery & pusher ada di inc.scripts --}}  
    <script>
        var receiver_id = '';
        var my_id = "{{ Auth::id() }}";
        $(document).ready(function () {
            // ajax setup form csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('b2f655da82dd4f67114a', {
            cluster: 'ap1'
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
            // alert(JSON.stringify(data));
                if (my_id == data.from) {
                    $('#' + data.to).click();
                } else if (my_id == data.to) {
                    if (receiver_id == data.from) {
                        // if receiver is selected, reload the selected user ...
                        $('#' + data.from).click();
                    } else {
                        // if receiver is not seleted, add notification for that user
                        var pending = parseInt($('#' + data.from).find('.pending').html());
    
                        if (pending) {
                            $('#' + data.from).find('.pending').html(pending + 1);
                        } else {
                            $('#' + data.from).append('<span class="pending">1</span>');
                        }
                    }
                }
            });
    
            $('.user').click(function () {
                $('.user').removeClass('active');
                $(this).addClass('active');
                $(this).find('.pending').remove();
    
                receiver_id = $(this).attr('id');
                $.ajax({
                    type: "get",
                    url: "convos/" + receiver_id, // need to create this route
                    data: "",
                    cache: false,
                    success: function (data) {
                        $('#messages').html(data);
                        scrollToBottomFunc();
                    }
                });
            });
    
            $(document).on('keyup', '.input-text input', function (e) {
                var message = $(this).val();
    
                // check if enter key is pressed and message is not null also receiver is selected
                if (e.keyCode == 13 && message != '' && receiver_id != '') {
                    $(this).val(''); // while pressed enter text box will be empty
    
                    var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                    $.ajax({
                        type: "post",
                        url: "convo/message", // need to create this post route
                        data: datastr,
                        cache: false,
                        success: function (data) {
    
                        },
                        error: function (jqXHR, status, err) {
                        },
                        complete: function () {
                            scrollToBottomFunc();
                        }
                    })
                }
            });

            document.addEventListener('DOMContentLoaded', () => {
                const urlParams = new URLSearchParams(window.location.search);
                const activeUserId = urlParams.get('active_user');

                if (activeUserId) {
                    // Remove 'active' class from any existing user
                    const activeUser = document.querySelector('.users .user.active');
                    if (activeUser) {
                        activeUser.classList.remove('active');
                    }

                    // Add 'active' class to the new user
                    const targetUser = document.querySelector(`.users .user[id="${activeUserId}"]`);
                    if (targetUser) {
                        targetUser.classList.add('active');
                    }
                }
            });
        });
    
        // make a function to scroll down auto
        function scrollToBottomFunc() {
            $('.message-wrapper').animate({
                scrollTop: $('.message-wrapper').get(0).scrollHeight
            }, 50);
        }

    </script>
</body>
</html>
