@extends('layouts.app')

@section('content')
                <div class="container-fluid" style="width: 95%">
                    <div class="row layout-top-spacing" id="cancel-row">
                        <div class="col-lg-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Create Mbah</h4>
                                        </div>
                                    </div>
                                </div>
                                <form id="createPost" action="{{ url('/posts/items') }}" method="POST" role="form" enctype="multipart/form-data">
                                    {{ csrf_field() }}
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
                                                                    <input type="text" class="form-control" name="nama" id="hEmail" placeholder="" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-4">
                                                                <label for="harga" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Harga per bulan</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="number" class="form-control" name="harga" id="harga" placeholder="" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-4">
                                                                <label for="detail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Detail Info</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="text" class="form-control" name="detail_info" id="detail" placeholder="" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-4">
                                                                <label for="ukuran" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Ukuran mbah</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="text" class="form-control" name="ukuran" id="ukuran" placeholder="" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-4">
                                                                <label for="tambahan" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Deskripsi tambahan</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="text" class="form-control" name="deskripsi" id="tambahan" placeholder="" required>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="id_owner" value="{{ Auth::user()->id }}">
                                                            
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <h3>Location</h3>
                                        <section>
                                            <div class="form-group row mb-4">
                                                <label for="alamat" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Link Gmaps</label>
                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                    <input type="url" class="form-control" name="lokasi" id="alamat" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <label for="provinsi" class="col-xl-2 col-sm-3 col-form-label">Provinsi</label>
                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                    <select name="id_province" id="province-dropdown" class="form-control" required>
                                                        <option value="" disabled selected hidden>Pilih Provinsi</option>
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
                                                        <option value="" disabled selected hidden>Pilih Kota/Kabupaten</option>
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
                                                                    <label>Upload (Select multiple files by holding Ctrl/Cmd) <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                                                    <label class="custom-file-container__custom-file" >
                                                                        <input type="file" name="images[]" class="custom-file-container__custom-file__custom-file-input" multiple>
                                                                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                                        <input type="hidden" name="id_owner" value="{{ Auth::user()->id }}">
                                                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                                    </label>
                                                                    <div class="custom-file-container__image-preview"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            

                                            </section>
                                        </div>
                                    </div>
                                </form>
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