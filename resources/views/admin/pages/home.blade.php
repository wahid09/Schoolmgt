@extends('admin.master')
@section('title') Home @endsection
@push('css')
<style type="text/css">
    .item{
    position: relative;
}
.item .slid-caption {
    position: absolute;
    bottom: 5%;
    width: 80%;
    overflow: hidden;
    left: 50%;
    background: rgba(0,0,0,0.4);
    transform: translateX(-50%);
    text-align: center;
    border-radius: 10px;
    color: #fff;
    padding-top: 15px;
}
</style>
@endpush
@section('content')
    <!--Slider Start-->
<section class="container-fluid">
    <div class="row">
        <div class="col-12 pl-0 pr-0">
            <div class="owl-carousel">
                @if($sliders->count() > 0)
                @foreach ($sliders as $slider)
                    <div class="item">
                    <img src="{{ url('storage/slider/'.$slider->photo) }}" alt="">
                    <div class="slid-caption">
                        <h2>{{ $slider->title }}</h2>
                        <p>{{ $slider->description }}</p>
                    </div>
                </div>
                @endforeach
                @else
                <div class="item"><img src="{{asset('/')}}/admin/assets/images/img-2.jpg" alt=""></div>
                <div class="item"><img src="{{asset('/')}}/admin/assets/images/img-3.jpg" alt=""></div>
                <div class="item"><img src="{{asset('/')}}/admin/assets/images/img-4.jpg" alt=""></div>
                <div class="item"><img src="{{asset('/')}}/admin/assets/images/img-5.jpg" alt=""></div>
                <div class="item"><img src="{{asset('/')}}/admin/assets/images/img-6.jpg" alt=""></div>
                <div class="item"><img src="{{asset('/')}}/admin/assets/images/img-7.jpg" alt=""></div>
                <div class="item"><img src="{{asset('/')}}/admin/assets/images/img-8.jpg" alt=""></div>
                @endif
            </div>
        </div>
    </div>
</section>
<!--Slider End-->
@endsection
