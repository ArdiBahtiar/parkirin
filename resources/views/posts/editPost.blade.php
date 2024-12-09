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
                                <form id="editPost" action="{{ url('/posts/items/' . $item->id . '/update') }}" method="POST" role="form">
                                    {{ csrf_field() }}
                                    {{ method_field('put') }}
                                <div class="widget-content widget-content-area">
                                    <div id="edit-circle">
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

                                                            <input type="hidden" name="id_owner" value="{{ Auth::user()->id }}">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <h3>Location</h3>
                                        <section>
                                            <div class="form-group row mb-4">
                                                <label for="alamat" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Link Gmaps</label>
                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                    <input type="url" class="form-control" name="lokasi" id="alamat" value="{{ $item->lokasi }}" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <label for="provinsi" class="col-xl-2 col-sm-3 col-form-label">Provinsi</label>
                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                    <select name="id_province" id="province-dropdown" class="form-control" required>
                                                        <option value="{{ $regency->province->id }}" selected>{{ $regency->province->name }}</option>
                                                        @foreach ($provinces as $provinsi)
                                                            <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row mb-4">
                                                <label for="kota" class="col-xl-2 col-sm-3 col-form-label">Kota/Kabupaten</label>
                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                    <select name="id_regency" id="regency-dropdown" class="form-control" required>
                                                        <option value="{{ $regency->id }}" selected>{{ $regency->name }}</option>
                                                    </select>
                                                </div>
                                            </div>
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
                                                                    <input type="file" name="images[]" class="custom-file-container__custom-file__custom-file-input" multiple>
                                                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                                    <input type="hidden" name="id_owner" value="{{ Auth::user()->id }}">
                                                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                                </label>
                                                                <div class="custom-file-container__image-preview"></div>
                                                                @foreach ($productImages as $image)
                                                                    <div class="image-container position-relative d-inline-block p-2" style="width: 150px; height: 120px;">
                                                                        <img src="{{ asset($image->file_path) }}" class="border p-2 w-100 h-100" alt="Image">
                                                                        <a href="{{ url('/posts/items/' . $image->id . '/delete') }}" class="btn btn-danger btn-sm position-absolute top-0 end-0 p-1" style="border-radius: 50%;">X</a>
                                                                    </div>
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

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>   
                    $(document).on('change', '#province-dropdown', function () {
                        console.log("Province dropdown changed: ", this.value);
                        var provinceId = this.value;
                        // Clear the regency dropdown and show loading text
                        $("#regency-dropdown").html('<option value="">Loading...</option>');

                        $.ajax({
                            url: "{{ route('get.regencies') }}",
                            type: "POST",
                            data: {
                                province_id: provinceId,
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: 'json',
                            success: function (result) {
                                if (result.length === 0) {
                                    $('#regency-dropdown').html('<option value="">No regencies found</option>');
                                    return;
                                }

                                $('#regency-dropdown').html('<option value="">-- Select regency --</option>');
                                $.each(result, function (key, value) {
                                    $("#regency-dropdown").append('<option value="' + value.id + '">' + value.name + '</option>');
                                });
                            },
                            error: function (xhr, status, error) {
                                console.error("AJAX error: ", error);
                                alert("Failed to fetch regencies. Please try again.");
                                $('#regency-dropdown').html('<option value="">-- Error loading regencies --</option>');
                            }
                        });
                    });
                </script> 
@endsection