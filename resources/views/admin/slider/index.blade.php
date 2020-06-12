@extends('admin.master')
@section('title') Slider List @endsection
@push('css')
<style type="text/css">
    .anchor{
        float: right;
    }
    .head{
        display: inline;
        text-align: right;
    }
    .slider-image{
        width: 100px;
    }
</style>
@endpush
@section('content')
<section class="container-fluid">
    <div class="row content">
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
                @if(Session::get('error'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Message: </strong>{{ Session::get('error') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
                <div class="col-sm-12">
                    <h4 class="font-weight-bold font-italic mt-3 head">Slider List</h4>
                    <a href="{{ route('slidersetup.create') }}" class="btn btn-success btn-sm anchor">Add New</a>
                </div>
            </div>

            <div class="table-responsive p-1">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap text-center" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>Sl.</th>
                        <th>Slider</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th style="width: 100px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($sliders as $slider)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>
                                    <img src="{{ url('storage/slider/'.$slider->photo) }}" class="slider-image">
                                </td>
                                <td>{{ $slider->title }}</td>
                                <td>
                                    @if($slider->status == 1)
                                    <span class="badge bg-green">Active</span>
                                    @else
                                    <span class="badge bg-red">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @if($slider->status == 1)
                                    <a href="{{ route('status', $id=$slider->id) }}" class="btn btn-sm btn-dark"><span class="fa fa-arrow-alt-circle-up"></span></a>
                                    @else
                                    <a href="{{ route('status', $id=$slider->id) }}" class="btn btn-sm btn-dark"><span class="fa fa-arrow-alt-circle-down"></span></a>
                                    @endif
                                    <a href="{{ route('slidersetup.edit', $id=$slider->id) }}" class="btn btn-sm btn-info"><span class="fa fa-edit"></span></a>
                                    <a class="btn btn-sm btn-danger" onclick="
                                        if(confirm('Are you sure, To delete this')){
                                            event.preventDefault();document.getElementById('delete-form-{{$slider->id}}').submit();}
                                            else{event.preventDefault();
                                            }" href="{{route('slidersetup.destroy',$slider->id)}}"><span class="fa fa-trash"></span></a>
                                        <form id="delete-form-{{$slider->id}}" action="{{route('slidersetup.destroy', $slider->id)}}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE')}}
                                        </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection