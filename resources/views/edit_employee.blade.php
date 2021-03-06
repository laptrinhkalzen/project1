@extends('admin_layout')
@section('admin_content')
<div class="page-content-wrapper ">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title m-0">Cập nhật thông tin nhân viên</h4>
                            <?php
                            $message= Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message', null);
                            }
                            ?>                            
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end page-title-box -->
            </div>
        </div> 
        <!-- end page title -->
        @foreach($edit_employee as $key=> $employee)
        <form role="form" action="{{URL::to('/update-employee/'.$employee->e_id)}}" method="post" enctype="multipart/form-data">
        	{{csrf_field()}}     	
			<div class="form-group row">
			    <label for="example-name-input" class="col-sm-2 col-form-label">Tên nhân viên</label>
			    <div class="col-sm-4">
			        <input class="form-control" value="{{$employee->e_name}}" type="text" name="e_name" id="example-name-input">
			    </div>
			</div>
			<div class="form-group row">
			    <label for="example-email-input" class="col-sm-2 col-form-label">Email</label>
			    <div class="col-sm-4">
			        <input class="form-control" value="{{$employee->e_email}}" type="email" name="e_email" id="example-email-input">
			    </div>
			</div>
			<div class="form-group row">
			    <label for="example-password-input" class="col-sm-2 col-form-label">Password</label>
			    <div class="col-sm-4">
			        <input class="form-control" value="{{$employee->e_password}}" type="password" name="e_password" id="example-password-input">
			    </div>
			</div>
			<div class="form-group row">
			    <label for="example-tel-input" class="col-sm-2 col-form-label">Địa chỉ</label>
			    <div class="col-sm-4">
			        <input class="form-control" value="{{$employee->e_address}}" type="text" name="e_address" id="example-tel-input">
			    </div>
			</div>
			<div class="form-group row">
			    <label for="example-tel-input" class="col-sm-2 col-form-label">Giới tính</label>
			    <div class="col-sm-4">
			        <input class="form-control" value="{{$employee->e_sex}}" type="text" name="e_sex" id="example-tel-input">
			    </div>
			</div>	
			<div class="form-group row">
			    <label for="example-tel-input" class="col-sm-2 col-form-label">Số điện thoại</label>
			    <div class="col-sm-4">
			        <input class="form-control" value="{{$employee->e_phone}}" type="tel" name="e_phone" id="example-tel-input">
			    </div>
			</div>

	    	<div class="form-group row">
		        <label class="col-sm-2 col-form-label">Phòng ban</label>
		        <div class="col-sm-2">
		            <select class="form-control" name="department_id">
                    @foreach($e_department as $key => $department)
                        @if($department->department_id == $employee->department_id)
                        <option selected value="{{$department->department_id}}">{{$department->department_name}}</option>
                        @else
                        <option value="{{$department->department_id}}">{{$department->department_name}}</option>
                        @endif
                    @endforeach  
		            </select>
		        </div>
		    </div>
	    	<div class="form-group row">
		        <label class="col-sm-2 col-form-label">Chức vụ</label>
		        <div class="col-sm-2">
		            <select class="form-control" name="position_id">
                    @foreach($e_position as $key => $position)
                        @if($position->position_id== $employee->position_id)
                        <option selected value="{{$position->position_id}}">{{$position->position_name}}</option>
                        @else
                        <option value="{{$position->position_id}}">{{$position->position_name}}</option>
                        @endif
                    @endforeach                         
		            </select>
		        </div>
		    </div>
		     <ul>
		    	@foreach($errors->all() as $error)
		    	     <li>{{$error}}</li>
		    	@endforeach
		    </ul>
            <button type="submit" name="update_employee" class="btn btn-success waves-effect waves-light">Cập nhật</button>
		</form>
		@endforeach
    </div><!-- container fluid -->

</div> <!-- Page content Wrapper -->
@endsection