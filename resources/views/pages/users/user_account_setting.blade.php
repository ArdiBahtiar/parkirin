@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">                
                    
                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <form action="{{ url('/users/update/' . $user->id) }}" method="POST" id="editProfile" class="section general-info" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('put') }}
                                        <div class="info">
                                            <h6 class="">Profile Update</h6>
                                            <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-2 col-lg-12 col-md-4">
                                                            <div class="upload mt-4 pr-md-4">
                                                                <input type="file" name="image_path" id="input-file-max-fs" class="dropify" data-default-file="{{ asset($user->image_path) }}" data-max-file-size="2M" />
                                                                <p class="mt-2"><i class="flaticon-cloud-upload mr-1"></i> Upload Picture</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="fullName">Full Name</label>
                                                                            <input type="text" class="form-control" name="name" id="fullName" placeholder="Full Name" value="{{ $user->name }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="phoneInput">Phone Number</label>
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text" id="basic-addon5">+62</span>
                                                                                <input type="number" class="form-control" name="phone" min="0" id="phoneInput" placeholder="" value="{{ $user->phone }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="emailInput">Email</label>
                                                                            <input type="email" class="form-control" name="email" id="emailInput" placeholder="" value="{{ $user->email }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="account-settings-footer">
                                            <div class="as-footer-container">
                    
                                                <button id="multiple-reset" class="btn btn-primary">Reset All</button>
                                                <div class="blockui-growl-message">
                                                    <i class="flaticon-double-check"></i>&nbsp; Settings Saved Successfully
                                                </div>
                                                <button type="submit" id="multiple-messages" class="btn btn-dark">Save Changes</button>
                    
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                </div>

            </div>
@endsection