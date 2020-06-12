@extends('admin.master')
@section('title') Profile @endsection
@section('content')
<section class="container-fluid">
	<div class="col-md-12">
	<div class="row content-up user_profile">
		<div class="col-md-4 profile-info">
			<div class="card" style="width: 18rem;">
			  <img src="
			  @if(isset($user->avater))
			  {{ url('storage/avatar/'.$user->avater) }}
			  @else
			  {{ asset('admin/assets/images/avatar.jpeg')}}
			  @endif" class="card-img-top" alt="{{ $user->name }}">
			  <div class="card-body">
			    <h5 class="card-title">{{ $user->name }}</h5>
			    <h5 class="card-title">{{ $user->email }}</h5>
			  </div>
			  <ul class="list-group list-group-flush">
			  	<a href="{{ route('update_profile', ['userId'=>$user->id]) }}" id="update_profile"></span><li class="list-group-item">Update Profile</li></a>
			  	<a href="{{ route('update_profile_pic', ['userId'=>$user->id]) }}" id="pic"></span><li class="list-group-item">Update Profile Pic</li></a>
			  	<a href="" id="password_reset"></span><li class="list-group-item">Change Password</li></a>
			  </ul>
			</div>
		</div>
		<div class="col-md-6">
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
			<!-- update user info -->
			<div class="card w-100" id="profile"> 
			  <div class="card-body">
			    <div class="col-12 pl-0 pr-0">
		            <div class="form-group">
		                <div class="col-sm-12">
		                    <h4 class="text-center font-weight-bold font-italic mt-3">Update Profile Info</h4>
		                </div>
		            </div>
		            <form method="POST" action="{{ route('user_info_update') }}" enctype="multipart/form-data" autocomplete="off" class="form-inline">
		                @csrf

		                <div class="form-group col-12 mb-3">
		                    <label for="name" class="col-sm-3 col-form-label text-right">Name</label>
		                    <input id="name" type="text" class="col-sm-9 form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" placeholder="Name">
		                    @error('name')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
		                </div>

		                <div class="form-group col-12 mb-3">
		                    <label for="mobile" class="col-sm-3 col-form-label text-right">Mobile</label>
		                    <input id="mobile" type="text" class="col-sm-9 form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ $user->mobile }}" placeholder="8801xxxxxxxxx">
		                    @error('mobile')
		                    <span class="invalid-feedback" role="alert">
		                    <strong>{{ $message }}</strong>
		                    </span>
		                    @enderror
		                </div>
		                <div class="form-group col-12 mb-3">
		                    <label for="email" class="col-sm-3 col-form-label text-right">E-Mail Address</label>
		                    <input id="email" type="email" class="col-sm-9 form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" placeholder="Email Address">
		                    @error('email')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
		                </div>
		                <input type="hidden"  name="user_id" value="{{ $user->id }}">
		                <div class="form-group col-12 mb-3">
		                    <label class="col-sm-3"></label>
		                    <button type="submit" class="col-sm-9 btn btn-block my-btn-submit">Update</button>
		                </div>
		            </form>
		        </div>
		    </div>
		</div>
		        <!-- end update user info -->
		    <div class="card w-100" id="profile_pic">
			  <div class="card-body">
		        <div class="col-12 pl-0 pr-0">
		            <div class="form-group">
		                <div class="col-sm-12">
		                    <h4 class="text-center font-weight-bold font-italic mt-3">Change Profile Pic</h4>
		                </div>
		            </div>
		            <form method="POST" action="{{ route('update_porofile_pic') }}" enctype="multipart/form-data" autocomplete="off" class="form-inline">
		                @csrf
		                <div class="form-group col-12 mb-3">
		                	<label for="avatar" class="col-sm-3 col-form-label text-right"></label>
		                    <img src="{{ asset('/')}}/admin/assets/images/avatar.jpeg" class="col-sm-9" id="profile_photo">
		                </div>
		                <div class="form-group col-12 mb-3">
		                    <label for="avatar" class="col-sm-3 col-form-label text-right" id="filelabel">Image</label>
		                    <input id="avatar" type="file" class="col-sm-9 form-control" name="avater" onchange="showImage(this, 'profile_photo')">
		                </div>
		                <input type="hidden" name="user_id" value="{{ $user->id }}">
		                <div class="form-group col-12 mb-3">
		                    <label class="col-sm-3"></label>
		                    <button type="submit" class="col-sm-9 btn btn-block my-btn-submit">Update</button>
		                </div>
		            </form>
		        </div>
			  </div>
			</div>
			<!--Pass-->
			<div class="card w-100" id="pass_reser">
			  <div class="card-body">
		        <div class="col-12 pl-0 pr-0">
		        	<div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">Password Update</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('password_update') }}" enctype="multipart/form-data" autocomplete="off" class="form-inline">
                @csrf

                <div class="form-group col-12 mb-3">
                    <label for="password" class="col-sm-3 col-form-label text-right">Old Password</label>
                    <input id="password" type="password" class="col-sm-9 form-control @error('password') is-invalid @enderror" name="password" placeholder="Old Password">
                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>

                <div class="form-group col-12 mb-3">
                    <label for="new_password" class="col-sm-3 col-form-label text-right">New Password</label>
                    <input id="new_password" type="password" class="col-sm-9 form-control @error('New Password') is-invalid @enderror" name="new_password" placeholder="New Password">
                    @error('new_password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <input type="hidden" value="{{ $user->id }}" name="user_id">
                <div class="form-group col-12 mb-3">
                    <label class="col-sm-3"></label>
                    <button type="submit" class="col-sm-9 btn btn-block my-btn-submit">Update</button>
                </div>
            </form>
		        </div>
		      </div>
		    </div>
			<!--end -->
		</div>
		</div>
	</div>
</section>
@endsection
@push('js')
    <script>
    $(document).ready(function(){
    	//$('#profile').hide();
	    $('#update_profile').click(function(e){
	    	e.preventDefault();
	    	$('#profile').show();
	    	$('#profile_pic').hide();
	    	$('#pass_reser').hide();
	    	//$('#profile').toggle("slide");
	    });

	    $('#profile_pic').hide();
	    $('#pic').click(function(e){
	    	e.preventDefault();
	    	$('#profile').hide();
	    	$('#pass_reser').hide();
	    	$('#profile_pic').show();
	    });
	    $('#pass_reser').hide();
	    $('#password_reset').click(function(e){
	    	e.preventDefault();
	    	$('#pass_reser').show();
	    	$('#profile').hide();
	    	$('#profile_pic').hide();
	    });
	});
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