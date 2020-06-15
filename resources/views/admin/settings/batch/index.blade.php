@extends('admin.master')
@section('title') Batch @endsection
@push('css')
<style type="text/css">
    .table-responsive {
      display: block;
      width: 100%;
      overflow-x: hidden;
}
</style>
@endpush
@section('content')
<section class="container-fluid">
    <div class="row content register-form">
        <div class="col-12 pl-0 pr-0">
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
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-10">
                            <h4 class="text-center font-weight-bold font-italic mt-3">Class Wise Batch List</h4>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add New</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive p-1">
                <table id="" class="table table-bordered dt-responsive nowrap text-center">
                <tr>
                <td>
                <div class="form-group row mb-0">
                    <label for="classId" class="col-sm-3 col-form-label text-right">Class Name:</label>
                    <div class="col-sm-8">
                        <select name="class_name_id" class="form-control @error('class_name_id') is-invalid @enderror" id="classId" required autofocus>
                            <option value="">--Select--</option>
                            @foreach ($classes as $value)
                                <option value="{{$value->id}}">{{ $value->class_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </td>
            </tr>
            </table>  
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center" id="batchList">
                </table>
            </div>
        </div>
    </div>
    <!-- Batch Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="addModalLabel">Add Batch</h4>
      </div>
      <form action="{{ route('batchmgt.store') }}" method="POST">
        @csrf
      <div class="modal-body">    
          <div class="form-group">
            <label for="class-name" class="control-label">Class Name:</label>
            <select name="class_name_id" class="form-control" id="classId">
                <option value="">--Select--</option>
                @foreach ($classes as $value)
                    <option value="{{ $value->id }}">{{ $value->class_name }}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Batch Name:</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Student Capacity:</label>
            <input type="number" class="form-control" id="studentCapacity" name="student_capacity">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Status:</label>
            <input type="checkbox" id="name" name="status">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
  </form>
    </div>
  </div>
</div>
    <!-- End ----------->
<!-- Edit Batch -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Edit Batch</h4>
      </div>
      <form action="{{ route('batchmgt.update', 'id') }}" method="POST">
        @csrf
        @method('PUT')
      <div class="modal-body">
      <input type="hidden" name="batch_id" id="batch_id" value="">    
          <div class="form-group">
            <label for="class-name" class="control-label">Class Name:</label>
            <select name="class_name_id" class="form-control" id="class_name_id">
                <option value="">--Select--</option>
                @foreach ($classes as $value)
                    <option value="{{ $value->id }}">{{ $value->class_name }}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Batch Name:</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Batch Name:</label>
            <input type="number" class="form-control" id="studentCapacity" name="student_capacity">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
  </form>
    </div>
  </div>
</div>
<!-- END -->
</section>
   
@endsection
@push('js')
<script type="text/javascript">
    $('#classId').change(function(){
        var id = $(this).val();
        //consol.log(id);
        if(id){
            $.get("{{ route('batcbyajax') }}", {id:id}, function(data){
                $("#batchList").html(data);
            });
        }
    });
    //Batch edit script
    $('#edit').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var name = button.data('myname') 
      var classId = button.data('classid') 
      var batchId = button.data('batchid') 
      var studentCapacity = button.data('capacity') 

      var modal = $(this)
      modal.find('.modal-body #name').val(name);
      modal.find('.modal-body #class_name_id').val(classId);
      modal.find('.modal-body #batch_id').val(batchId);
      modal.find('.modal-body #studentCapacity').val(studentCapacity);
    })
</script>
@endpush