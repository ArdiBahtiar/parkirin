@extends('layouts.app')

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">
            @foreach ($posts as $post)
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
                                <h6>Dev Summit - New York</h6>
                                <p class="meta-date-time">Bronx, NY</p>
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
        </div>
    </div>
    
    {{ $posts->links() }}
@endsection