@extends('admin.master')
@section('title') Settings @endsection
@section('content')
<section class="container-fluid">
    <div class="row content register-form">
        <div class="col-12 pl-0 pr-0">
            <div class="form-group">
                @if(Session::get('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Message: </strong>{{ Session::get('message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">Header setup</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('headersetup.update', $header->id) }}" enctype="multipart/form-data" autocomplete="off" class="form-inline">
                @csrf
                @method('PUT')
                <div class="form-group col-12 mb-3">
                    <label for="title" class="col-sm-3 col-form-label text-right">Site Title</label>
                    <input id="title" type="text" class="col-sm-9 form-control @error('title') is-invalid @enderror" name="title" value="{{ $header->title }}">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-12 mb-3">
                    <label for="slogan" class="col-sm-3 col-form-label text-right">Site Slogan</label>
                    <input id="slogan" type="text" class="col-sm-9 form-control @error('slogan') is-invalid @enderror" name="slogan" value="{{ $header->slogan }}">
                    @error('slogan')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-12 mb-3">
                    <label for="address" class="col-sm-3 col-form-label text-right">Site Address</label>
                    <textarea id="address" class="col-sm-9 form-control @error('address') is-invalid @enderror" name="address">{{ $header->address }}</textarea>
                    @error('address')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-12 mb-3">
                    <label for="mobile" class="col-sm-3 col-form-label text-right">Site Mobile</label>
                    <input id="mobile" type="text" class="col-sm-9 form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ $header->mobile }}">
                    @error('mobile')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group col-12 mb-3">
                    <label class="col-sm-3"></label>
                    <button type="submit" class="col-sm-9 btn btn-block my-btn-submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>
   
@endsection