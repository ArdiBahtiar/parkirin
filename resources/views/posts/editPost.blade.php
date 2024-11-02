@extends('layouts.app')

@section('content')
                <div class="container-fluid" style="width: 95%">
                    <div class="row layout-top-spacing" id="cancel-row">
                        <div class="col-lg-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Edit Mbah</h4>
                                        </div>
                                    </div>
                                </div>
                                <form id="createPost" action="{{ url('/posts/items/' . $item->id . '/update') }}" method="POST" role="form">
                                    {{ csrf_field() }}
                                    {{ method_field('put') }}
                                <div class="widget-content widget-content-area">
                                    <div id="circle-basic">
                                        <h3>Keyboard</h3>
                                        <section>
                                            <div id="flHorizontalForm" class="col-lg-12 layout-spacing">
                                                <div class="statbox widget box box-shadow">
                                                    <div class="widget-header">                                
                                                        <div class="row">
                                                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                                <h4>Horizontal form</h4>
                                                            </div>                                                                        
                                                        </div>
                                                    </div>
                                                    <div class="widget-content widget-content-area">

                                                            <div class="form-group row mb-4">
                                                                <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Post Title</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="text" class="form-control" name="nama" id="hEmail" value="{{ $item->nama }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-4">
                                                                <label for="harga" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Harga per bulan</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="number" class="form-control" name="harga" id="harga" value="{{ $item->harga }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-4">
                                                                <label for="detail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Detail Info</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="text" class="form-control" name="detail_info" id="detail" value="{{ $item->detail_info }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-4">
                                                                <label for="ukuran" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Ukuran mbah</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="text" class="form-control" name="ukuran" id="ukuran" value="{{ $item->ukuran }}" required>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row mb-4">
                                                                <label for="tambahan" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Deskripsi tambahan</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="text" class="form-control" name="deskripsi" id="tambahan" value="{{ $item->deskripsi }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-4">
                                                                <label for="alamat" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Link Gmaps</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="url" class="form-control" name="lokasi" id="alamat" value="{{ $item->lokasi }}" required>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="id_owner" value="{{ Auth::user()->id }}">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <h3>Effects</h3>
                                        <section>
                                            <p>lorem</p>
                                        </section>
                                        <h3>Pager</h3>
                                        <section>
                                            <p>The next and previous buttons help you to navigate through your content.</p>
                                        </section>
                                        <h3>Mbah</h3>
                                        <section>
                                            <div class="row layout-top-spacing">
                                                <div id="fuMultipleFile" class="col-lg-12 layout-spacing">
                                                    <div class="statbox widget box box-shadow">
                                                        <div class="widget-header">
                                                            <div class="row">
                                                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                                    <h4>Multiple File Upload</h4>
                                                                </div>      
                                                            </div>
                                                        </div>
                                                        <div class="widget-content widget-content-area">
                                                            <div class="custom-file-container" data-upload-id="mySecondImage">
                                                                <label>Upload (Allow Multiple) <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                                                <label class="custom-file-container__custom-file" >
                                                                    <input type="file" class="custom-file-container__custom-file__custom-file-input" multiple>
                                                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                                </label>
                                                                <div class="custom-file-container__image-preview"></div>
                                                                @foreach ($productImages as $image)
                                                                    <img src="{{ asset($image->file_path) }}" style="width: 100px; height: 75px" alt="Image" />
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection