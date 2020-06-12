@extends('admin.master')
@section('title') Slider @endsection
@push('css')
<style type="text/css">
    .slide-photo{
        margin-left: 100px;
        width: 250px;
        height: 250px;
    }
</style>
@endpush
@section('content')
<section class="container-fluid">
    <div class="row content register-form">
        <div class="col-12 pl-0 pr-0">
            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">Slider Form</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('slidersetup.store') }}" enctype="multipart/form-data" autocomplete="off" class="form-inline">
                @csrf

                <div class="form-group col-12 mb-3">
                    <label for="photo" class="col-sm-3 col-form-label text-right"></label>
                    <img src="{{ asset('admin/assets/images/avatar.jpeg') }}" class="slide-photo" id="slider_photo">
                </div>
                <div class="form-group col-12 mb-3">
                    <label for="photo" class="col-sm-3 col-form-label text-right" id="filelabel">Slider Image</label>
                    <input id="photo" type="file" class="col-sm-9 form-control @error('photo') is-invalid @enderror" name="photo" onchange="showImage(this, 'slider_photo')">
                    @error('photo')
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                    @enderror
                </div>
                <div class="form-group col-12 mb-3">
                    <label for="title" class="col-sm-3 col-form-label text-right">Slider Title</label>
                    <input id="title" type="text" class="col-sm-9 form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="Slider Title">
                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>

                <div class="form-group col-12 mb-3">
                    <label for="description" class="col-sm-3 col-form-label text-right">Description</label>
                    <textarea id="description" class="col-sm-9 form-control @error('description') is-invalid @enderror" name="description" placeholder="Write slider description in here...."></textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-12 mb-3">
                    <label for="status" class="col-sm-3 col-form-label text-right">Status</label>
                    <input type="checkbox" name="status">
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
@push('js')
<script type="text/javascript">
    //Image Show Before Upload Start
        $(document).ready(function(){
            $('input[type="file"]').change(function(e){
                var fileName = e.target.files[0].name;
                if (fileName){
                    $('#fileLabel').html(fileName);
                }
            });
        });

        function showImage(data, imgId){
            if(data.files && data.files[0]){
                var obj = new FileReader();

                obj.onload = function(d){
                    var image = document.getElementById(imgId);
                    image.src = d.target.result;
                }
                obj.readAsDataURL(data.files[0]);
            }
        }
        //Image Show Before Upload End
</script>
@endpush