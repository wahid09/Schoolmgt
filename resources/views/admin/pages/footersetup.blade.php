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
                    <h4 class="text-center font-weight-bold font-italic mt-3">Footer setup</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('footersetup.update', $footer->id) }}" enctype="multipart/form-data" autocomplete="off" class="form-inline">
                @csrf
                @method('PUT')
                <div class="form-group col-12 mb-3">
                    <label for="title" class="col-sm-3 col-form-label text-right">Copyright Text</label>
                    <input id="copyright" type="text" class="col-sm-9 form-control @error('copyright') is-invalid @enderror" name="copyright" value="{{ $footer->copyright }}">
                    @error('copyright')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-12 mb-3">
                    <label for="facebook_url" class="col-sm-3 col-form-label text-right">Facebook URL</label>
                    <input id="facebook_url" type="text" class="col-sm-9 form-control @error('facebook_url') is-invalid @enderror" name="facebook_url" value="{{ $footer->facebook_url }}">
                    @error('facebook_url')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-12 mb-3">
                    <label for="linkedin_url" class="col-sm-3 col-form-label text-right">Linkedin URL</label>
                    <input type="text" id="linkedin_url" class="col-sm-9 form-control @error('linkedin_url') is-invalid @enderror" name="linkedin_url" value="{{ $footer->linkedin_url }}">
                    @error('linkedin_url')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-12 mb-3">
                    <label for="youtube_url" class="col-sm-3 col-form-label text-right">Youtube URL</label>
                    <input id="youtube_url" type="text" class="col-sm-9 form-control @error('youtube_url') is-invalid @enderror" name="youtube_url" value="{{ $footer->youtube_url }}">
                    @error('youtube_url')
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