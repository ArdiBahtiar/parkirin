@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">

                <div class="row layout-spacing">

                    <!-- Content -->

                    <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">

                        <div class="skills layout-spacing ">
                            <div class="widget-content widget-content-area">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        @foreach ($images as $index => $image)
                                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></li>
                                        @endforeach
                                    </ol>
                                    <div class="carousel-inner">
                                        @foreach ($images as $index => $image)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img class="d-block w-100" src="{{ asset($image->file_path) }}" alt="Slide {{ $index + 1 }}" style="width: 500px; height: 500px">
                                        </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="bio layout-spacing ">
                            <div class="widget-content widget-content-area">
                                <h3 class="">Bio</h3>
                                {{-- {{-- <p>I'm Web Developer from California. I code and design websites worldwide. Mauris varius tellus vitae tristique sagittis. Sed aliquet, est nec auctor aliquet, orci ex vestibulum ex, non pharetra lacus erat ac nulla.</p> --}}
                                <p>Sed vulputate, ligula eget mollis auctor, lectus elit feugiat urna, eget euismod turpis lectus sed ex. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc ut velit finibus, scelerisque sapien vitae, pharetra est. Nunc accumsan ligula vehicula scelerisque vulputate.</p>

                                <div class="bio-skill-box">

                                    <div class="row">
                                        
                                        <div class="col-12 col-xl-6 col-lg-12 mb-xl-5 mb-5 ">
                                            
                                            <div class="d-flex b-skills">
                                                <div>
                                                </div>
                                                <div class="">
                                                    <h5>Ukuran Tempat</h5>
                                                    <p>{{ $list->ukuran }}</p>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-12 col-xl-6 col-lg-12 mb-xl-5 mb-5 ">
                                            
                                            <div class="d-flex b-skills">
                                                <div>
                                                </div>
                                                <div class="">
                                                    <h5>Alamat</h5>
                                                    <p>{{ $list->lokasi }}</p>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-12 col-xl-6 col-lg-12 mb-xl-0 mb-5 ">

                                            <div class="d-flex b-skills">
                                                <div></div>
                                                <div>
                                                    <h5>Bonus</h5>
                                                    @php
                                                        $bonuses = is_array($item->bonus) ? $item->bonus : json_decode($item->bonus, true);
                                                    @endphp
                                            
                                                    @if (!empty($bonuses))
                                                        <ul>
                                                            @foreach ($bonuses as $bonus)
                                                                <li>{{ $bonus }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <p>No bonus available.</p>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-12 col-xl-6 col-lg-12 mb-xl-0 mb-0 ">
                                            
                                            {{-- <div class="d-flex b-skills">
                                                <div>
                                                </div>
                                                <div class="">
                                                    <h5>Mobile Apps</h5>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do et dolore magna aliqua.</p>
                                                </div>
                                            </div> --}}

                                        </div>

                                    </div>

                                </div>

                            </div>                                
                        </div>

                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">

                        <div class="education layout-spacing ">
                            <div class="widget-content widget-content-area">
                                <h3 class="">{{ $list->nama }}</h3>
                                <div class="timeline-alter">
                                    <div class="item-timeline">
                                        {{-- <div class="t-text">
                                            <p class="">{{ $list->nama }}</p>
                                        </div> --}}
                                        <div class="t-dot">
                                        </div>
                                        <div class="t-text">
                                            <p>{{ $list->detail_info }}</p>
                                        </div>
                                    </div>
                                    <div class="item-timeline">
                                        <div class="t-dot">
                                        </div>
                                        <div class="t-text">
                                            <p>{{ $list->deskripsi }}</p>
                                        </div>
                                    </div>
                                    <div class="item-timeline">
                                        <div class="t-dot">
                                        </div>
                                        <div class="t-text">
                                            <p style="font-weight: bold; font-size: large">Rp. {{ $list->harga }}</p>
                                        </div>
                                    </div>
                                    <div class="item-timeline">
                                        <div class="t-dot">
                                        </div>
                                        <div class="t-text">
                                            <p>{{ $regency->name }}, {{ $regency->province->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="user-profile layout-spacing">
                            <div class="widget-content widget-content-area">
                                @if ($user)
                                <div class="d-flex justify-content-between">
                                    <h3 class="">Profile</h3>
                                    <a href="/users/account_settings" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
                                </div>
                                <div class="text-center user-info">
                                    <img src="{{asset('storage/img/90x90.jpg')}}" alt="avatar" style="height: 300px; width: 300px">
                                    {{-- <p class="">{{ $user->name }}</p> --}}
                                </div>

                                    
                                <div class="user-info-list">

                                    <div class="">
                                        <ul class="contacts-block list-unstyled">
                                            <li class="contacts-block__item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg> {{ $user->name }}
                                            </li>
                                            {{-- <li class="contacts-block__item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>Jan 20, 1989
                                            </li> --}}
                                            {{-- <li class="contacts-block__item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>New York, USA
                                            </li> --}}
                                            <li class="contacts-block__item">
                                                <a href="mailto:example@mail.com"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>{{ $user->email }}</a>
                                            </li>
                                            <li class="contacts-block__item">
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> +62 {{ $user->phone }} --}}
                                                
                                                <a href="https://wa.me/+62{{ $user->phone }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>+62 {{ $user->phone }}</a>
                                            </li>
                                            <li class="contacts-block__item mt-2">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item p-2">
                                                        <button id="bookmark-button" class="btn" data-item-id="{{ $item->id }}">
                                                            {{ $isBookmarked ? 'Remove Bookmark' : 'Bookmark' }}
                                                        </button>
                                                    </li>
                                                    @if(auth()->user()->id !== $item->id_owner)
                                                    <li class="list-inline-item p-2">
                                                        <form action="{{ url('/convo/initiate') }}" method="POST">
                                                            @csrf
                                                            <input type="text" name="initiateMessage" class="inputMessage" placeholder="Type your message...">
                                                            <button class="chat-penjual-btn btn" data-owner-id="{{ $item->id_owner }}">Chat Penjual</button>
                                                        </form>
                                                    </li>
                                                    @endif
                                                    @if(auth()->user()->id === $item->id_owner || auth()->user()->hasAnyRole(['Admin', 'Manager']))
                                                    <li class="list-inline-item p-2">
                                                        <form action="{{ url('/posts/items/' . $list->id . '/edit') }}" method="GET">
                                                            @csrf
                                                            <button type="submit" class="btn">Edit Post</button>
                                                        </form>
                                                    </li>
                                                    <li class="list-inline-item p-2">
                                                        <form action="{{ url('/posts/items/' . $item->id . '/delete-item') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item and all its images?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </li>
                                                    @endif
                                                    <li class="list-inline-item p-2">
                                                        <button id="shareButton" class="btn">Share This Post</button>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>                                    
                                </div>

                                @endif
                            </div>
                        </div>

                        

                        {{-- <div class="work-experience layout-spacing ">
                            
                            <div class="widget-content widget-content-area">

                                <h3 class="">Work Experience</h3>
                                
                                <div class="timeline-alter">
                                
                                    <div class="item-timeline">
                                        <div class="t-meta-date">
                                            <p class="">04 Mar 2009</p>
                                        </div>
                                        <div class="t-dot">
                                        </div>
                                        <div class="t-text">
                                            <p>Netfilx Inc.</p>
                                            <p>Designer Illustrator</p>
                                        </div>
                                    </div>

                                    <div class="item-timeline">
                                        <div class="t-meta-date">
                                            <p class="">25 Apr 2014</p>
                                        </div>
                                        <div class="t-dot">
                                        </div>
                                        <div class="t-text">
                                            <p>Google Inc.</p>
                                            <p>Designer Illustrator</p>
                                        </div>
                                    </div>

                                    <div class="item-timeline">
                                        <div class="t-meta-date">
                                            <p class="">04 Apr 2018</p>
                                        </div>
                                        <div class="t-dot">
                                        </div>
                                        <div class="t-text">
                                            <p>Design Reset Inc.</p>
                                            <p>Designer Illustrator</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div> --}}

                    </div>

                    {{-- <div class="layout-px-spacing">
                        <div class="row layout-top-spacing"> --}}
                            @foreach ($lowerItems as $post)
                                @php
                                $thumbnail = \App\Models\Image::where('id_post', $post->id)->first();
                                @endphp
                
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                                <div class="widget widget-card-two">
                                    <div class="widget-content">
                  
                                        <div class="media">
                                            <div class="w-img">
                                                <img src="{{asset('storage/img/90x90.jpg')}}" alt="avatar">
                                            </div>
                                            <div class="media-body">
                                                {{-- <h6>Dev Summit - New York</h6> --}}
                                                <h6>{{ $post->owner->name ?? 'Unknown Owner' }}</h6>
                                                {{-- <p class="meta-date-time">Bronx, NY</p> --}}
                                                <p class="meta-date-time">{{ $post->regency->name }}, {{ $post->province->name }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="card-bottom-section">
                                            <h5 class="card-title">{{ $post->nama }}</h5>
                                            <img src="{{asset($thumbnail->file_path ?? 'storage/img/90x90.jpg') }}" alt="avatar" style="width: 400px; height: 250px">
                                            <div class="card-body">
                                                <p class="card-text">{{ $post->deskripsi }}</p>
                                                <p class="card-text">{{ $post->harga }} /bulan</p>
                                                <a href="{{ url('/posts/items/' . $post->id) }}" class="btn btn-primary">Lihat Postingan</a>            
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            
                            @endforeach
                        {{-- </div>
                    </div> --}}
                </div>
            </div>

<script>
    document.getElementById('shareButton').addEventListener('click', function () {                  // This is script for Share Link
        const shareData = {
            title: '{{ $list->nama }}', // Assuming 'nama' is the title or name of the post
            text: 'Check out this post!',
            url: '{{ request()->url() }}'
        };

        if (navigator.share) {
            // Use the Web Share API for mobile devices and supported browsers
            navigator.share(shareData)
                .then(() => console.log('Post shared successfully'))
                .catch(error => console.error('Error sharing post:', error));
        } else {
            // Fallback for browsers that don't support the Web Share API
            const shareUrl = '{{ request()->url() }}';
            prompt('Copy this link to share:', shareUrl);
        }
    });  

    document.addEventListener('DOMContentLoaded', function () {                                     // This is script for Bookmark button AJAX Toggle
        const bookmarkButton = document.getElementById('bookmark-button');
        const itemId = bookmarkButton.getAttribute('data-item-id');

            bookmarkButton.addEventListener('click', function () {
                const url = bookmarkButton.textContent.trim() === 'Bookmark'
                    ? /bookmarks/${itemId}/save
                    : /bookmarks/${itemId}/delete;
                const method = bookmarkButton.textContent.trim() === 'Bookmark' ? 'POST' : 'DELETE';

                fetch(url, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    // Update button text and display a success message
                    if (data.success) {
                        bookmarkButton.textContent = data.bookmarked ? 'Remove Bookmark' : 'Bookmark';
                        document.getElementById('message').textContent = data.message;
                    }
                })
                .catch(error => console.error('Error:', error));
            });
    });
    
    document.querySelectorAll('.chat-penjual-btn').forEach(button => {
        button.addEventListener('click', function () {
            const receiver_id = this.getAttribute('data-owner-id'); // Get the owner's ID
            const message = document.querySelector('.inputMessage').value.trim(); // Get the message input

            if (!message) {
                alert("Please enter a message before sending.");
                return; // Exit if the message is empty
            }

            $.ajax({
                type: "post",
                url: "/convo/initiate", // Endpoint for sending the message
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // Include CSRF token
                    to: receiver_id,
                    message: message
                },
                success: function (response) {
                },
                error: function (xhr, status, error) {
                    console.error("Error sending message:", error);
                }
            });
        });
    });
</script>            

@endsection