@extends('layouts.app')

@section('content')
<form id="uploadImages" action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

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
                        <label class="custom-file-container__custom-file">
                            <!-- Notice the 'images[]' in the name attribute, and 'multiple' attribute -->
                            <input type="file" name="images[]" class="custom-file-container__custom-file__custom-file-input" multiple>
                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                            <input type="hidden" name="id_owner" value="{{ Auth::user()->id }}">
                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                        </label>
                        <div class="custom-file-container__image-preview"></div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
