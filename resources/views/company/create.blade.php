@extends('partials.app')
@section('title','Company')
@section('title-card-h1','Company')
@section('title-card-small','Details')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                    class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item active">Company</li>
    </ol>
@stop
@push('customCss')
    <style>
        .note-editor.note-frame .note-editing-area {
            overflow: hidden;
            min-height: 200px;
        }
    </style>
@endpush
@section('content')
    @php
        $user_type = request()->cookie('userType');
    @endphp
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-edit"></i>
                Check Company Details
            </h3>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill"
                       href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home"
                       aria-selected="true">Company</a>
                </li>
                @if($user_type == 'manager')
                    <li class="nav-item">
                        <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill"
                           href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile"
                           aria-selected="false">Update</a>
                    </li>
                @endif
            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
                <div class="tab-pane fade active show" id="custom-content-below-home" role="tabpanel"
                     aria-labelledby="custom-content-below-home-tab">
                    <br>
                    <h6>Company name: {{ $data['company']['name'] }}</h6>
                    <h6>Company Phone: {{ $data['company']['phone'] }}</h6>
                    <h6>Company Address: </h6>
                    <p>{!! $data['company']['address'] !!}</p>
                    <h6>Company Message:</h6>
                    <p>{!! $data['company']['message'] !!}</p>
                </div>
                @if($user_type == 'manager')
                    <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel"
                         aria-labelledby="custom-content-below-profile-tab">
                        <br>
                        <form method="post" action="{{ route('companies.update') }}">
                            @csrf
                            @method("PUT")
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="name">Company Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-times"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" placeholder="Company Name" name="name"
                                               value="{{ $data['company']['name'] }}">
                                    </div>
                                    @error('name')
                                    <div class="text-danger text-bold">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="phone">Contact Number <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-times"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                               id="name" placeholder="Company Contact Number" name="phone"
                                               value="{{ $data['company']['phone'] }}">
                                    </div>
                                    @error('phone')
                                    <div class="text-danger text-bold">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="address">Adderss <span class="text-danger">*</span></label>
                                    <div>
                                    <textarea class=" form-control textarea" id="address" name="address"
                                              placeholder="Place some text here"
                                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$data['company']['address']}}</textarea>
                                    </div>
                                    @error('address')
                                    <div class="text-danger text-bold">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="message">Message</label>
                                <textarea class=" form-control textarea" id="message" name="message"
                                          placeholder="Place some text here"
                                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $data['company']['message'] }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>

                    </div>
                @endif
            </div>
        </div>
        <!-- /.card -->
    </div>
    <script>
        $(function () {
            $('.textarea').summernote()
        })
    </script>
@endsection
