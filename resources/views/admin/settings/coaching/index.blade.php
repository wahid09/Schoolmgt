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
                  <div class="row">
                    <div class="col-sm-9 text-center">
                      <h4 class="font-weight-bold font-italic mt-3 head">Coaching Type List</h4>
                    </div>
                    <div class="col-sm-3 text-right">
                      <button type="button" class="btn btn-success anchor" data-toggle="modal" data-target="#addModal" data-whatever="@mdo">Add New</button>
                    </div>
                  </div>
                </div>
            </div>
            <div class="table-responsive p-1">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap text-center" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>Sl.</th>
                        <th>Class Name</th>
                        <th>Coaching Type Name</th>
                        <th>Status</th>
                        <th style="width: 100px;">Action</th>
                    </tr>
                    </thead>
                    <tbody id="coachingTypeId">
                      @include('admin.settings.coaching.coaching_list')  
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Batch Add Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="addModalLabel">Add Coaching Type</h4>
      </div>
      <form action="{{ route('coachingtype.store') }}" method="POST" id="caochingId">
        @csrf
      <div class="modal-body">    
          <div class="form-group">
            <label for="class-name" class="control-label">Class Name:</label>
            <select name="class_name_id" class="form-control" id="classId">
                <option value="">--Select--</option>
                @foreach ($classes as $val)
                  <option value="{{$val->id}}">{{ $val->class_name }}</option>
                @endforeach    
            </select>
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Coaching Type Name:</label>
            <input type="text" class="form-control" id="name" name="coaching_type">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Status:</label>
            <input type="checkbox" id="status" name="status">
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
      <form action="" method="POST">
        @csrf
        @method('PUT')
      <div class="modal-body">
      <input type="hidden" name="batch_id" id="batch_id" value="">    
          <div class="form-group">
            <label for="class-name" class="control-label">Class Name:</label>
            <select name="class_name_id" class="form-control" id="class_name_id">
                <option value="">--Select--</option>
                    <option value="">Name</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Batch Name:</label>
            <input type="text" class="form-control" id="name" name="coaching_type">
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
  //add by ajax
  $('#caochingId').submit(function(e){
    e.preventDefault();

    var url = $(this).attr('action');
    var data = $(this).serialize();
    var method = $(this).attr('method');
    $('#addModal').modal('hide');

    $.ajax({
      data:data,
      type:method,
      url:url,
      success: function(){
        $.get("{{ route('coaching_type_list') }}", function(data){
          $('#coachingTypeId').empty().html(data);
        })
      }
    })
  });
  //unpublish
  function unpublish(caochingId) {
    var check = confirm('If you want to Unpublish this item, Please press ok..');
    if(check){
      $.get("{{ route('caochingtypeunpublishbyajax') }}", {caochingId:caochingId}, function(data){
                $("#coachingTypeId").empty().html(data);
            });
    }
  }
  //Publish
  function publish(caochingId){
    var check = confirm('If you want to Publish this item, Please press ok..');
    if(check){
      $.get("{{ route('caochingtypepublishbyajax') }}", {caochingId:caochingId}, function(data){
                $("#coachingTypeId").empty().html(data);
            });
    }
  }
  //Delete
  function delItem(caochingId, ClassId) {
    var check = confirm('If you want to delete this item, Please press ok..');
    if(check){
      $.get("{{ route('coachingdeletebyajax') }}", {caochingId:caochingId, ClassId:ClassId}, function(data){
                $("#coachingTypeId").html(data);
            });
    }
  }

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