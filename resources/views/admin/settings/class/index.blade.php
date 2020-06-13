@extends('admin.master')
@section('title') School List @endsection
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
<section class="container">
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
                    <h4 class="font-weight-bold font-italic mt-3 head">Class List</h4>
                    <button type="button" class="btn btn-success anchor" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add New</button>
                </div>
                <hr>
            </div>

            <div class="table-responsive p-1">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap text-center" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>Sl.</th>
                        <th>Class Name</th>
                        <th>Status</th>
                        <th style="width: 100px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($classes as $value)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $value->class_name}}</td>
                                <td>
                                    @if($value->status == 1)
                                    <span class="badge bg-green">Active</span>
                                    @else
                                    <span class="badge bg-red">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @if($value->status == 1)
                                    <a href="{{ route('status_update', $id=$value->id) }}" class="btn btn-sm btn-success"><span class="fa fa-arrow-alt-circle-up" title="Disable"></span></a>
                                    @else
                                    <a href="{{ route('status_update', $id=$value->id) }}" class="btn btn-sm btn-warning"><span class="fa fa-arrow-alt-circle-down" title="Enable"></span></a>
                                    @endif
                                    <button class="btn btn-sm btn-primary" data-myname="{{$value->class_name}}" data-schoolid={{$value->id}} data-toggle="modal" data-target="#edit"><span class="fa fa-edit" title="Edit"></span></button>
                                    <a class="btn btn-sm btn-danger" onclick="
                                        if(confirm('Are you sure, To delete this')){
                                            event.preventDefault();document.getElementById('delete-form-{{$value->id}}').submit();}
                                            else{event.preventDefault();
                                            }" href="{{route('classmgt.destroy',$value->id)}}" title="Delete"><span class="fa fa-trash"></span></a>
                                        <form id="delete-form-{{$value->id}}" action="{{route('classmgt.destroy', $value->id)}}" method="post">
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
    <!-- ADD NEW MODAL-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Add Class Name</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('classmgt.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="recipient-name" class="control-label">Class Name:</label>
            <input type="text" class="form-control" id="recipient-name" name="class_name">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Status:</label>
            <input type="checkbox" name="status">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
  </form>
    </div>
  </div>
</div>  <!--End-------------------------------->

<!-- EDIT MODAL -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Update Class Name</h4>
      </div>
      <form action="{{ route('classmgt.update', 'id') }}" method="POST">
        @csrf
          @method('PUT')
      <div class="modal-body">
          <input type="hidden" name="class_id" id="school_id" value="">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Class Name:</label>
            <input type="text" class="form-control" id="name" name="class_name">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
  </form>
    </div>
  </div>
</div>  <!-- End -------------------->
</section>
@endsection
@push('js')
<script type="text/javascript">
    $('#edit').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var name = button.data('myname');
      var sc_id   = button.data('schoolid');
  
      var modal = $(this)
      //modal.find('.modal-title').text('New message to ' + recipient)
      modal.find('.modal-body #name').val(name);
      modal.find('.modal-body #school_id').val(sc_id);
})
</script>
@endpush