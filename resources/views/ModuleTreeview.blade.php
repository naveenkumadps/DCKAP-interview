<!DOCTYPE html>
<html>
<head>
	<title>Laravel DcKap Machine test</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="/css/style.css" rel="stylesheet">

</head>
<body>
    <div class="alert alert-success alert-block delete_block" style="display:none">
      
    </div>
    @if ($message = Session::get('success'))
									<div class="alert alert-success alert-block">
										<button type="button" class="close" data-dismiss="alert">×</button>	
									        <strong>{{ $message }}</strong>
									</div>
								@endif
                                @if ($message = Session::get('successTask'))
									<div class="alert alert-success alert-block">
										<button type="button" class="close" data-dismiss="alert">×</button>	
									        <strong>{{ $message }}</strong>
									</div>
								@endif
    <div class="pull-right">
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-Module">
					  Add Module
				</button>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-Task">
					  Add Task
				</button>
		        </div>
	<div class="">     
		<div class="panel panel-primary">
			<div class="panel-heading">Manage Task and modules 	<button type="button" class="btn btn-success" onclick="task_table(0)">
					  All Data
				</button></div>
			
				
	  		<div class="panel-body">
	  			<div class="row">
	  				<div class="col-md-3">
	  					<h3>Category List</h3>
				        <ul id="tree1">
				            @foreach($modules as $module)
				                <li id="{{ $module->id }}" class="branch"><i class="indicator "></i>
				                    {{ $module->name }}
				                    @if(count($module->childs))
				                        @include('manageChild',['childs' => $module->childs])
				                    @endif
				                </li>
				            @endforeach
				        </ul>
	  				</div>
            <div class="col-md-9">
                <table class="table  data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>summary</th>
                            <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                </div>
	  		</div>
        </div>
    </div>
    <div class="modal fade" id="create-Module" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		        <h4 class="modal-title" id="myModalLabel">Add New Module</h4>
		      </div>
		      <div class="modal-body">


              

				  			{!! Form::open(['route'=>'add.module']) !!}
				  				
				  				<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
									{!! Form::label('name:') !!}
									{!! Form::text('name', old('name'), ['id'=>"name",'class'=>'form-control', 'placeholder'=>'Enter name']) !!}
								</div>
								<div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
									{!! Form::label('Module:') !!}
									{!! Form::select('parent_id',$subModules, old('parent_id'), ['id'=>"parent_id",'class'=>'form-control', 'placeholder'=>'Select Module']) !!}
								</div>
								<div class="form-group">
									<button class="btn btn-success add_module">Save</button>
									<button type="button"  data-dismiss="modal" class="btn btn-Danger">Cancel</button>
								</div>
				  			{!! Form::close() !!}
		      </div>
		    </div>
		  </div>
		</div>
    <div class="modal fade" id="create-Task" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		        <h4 class="modal-title" id="myModalLabel">Add New Task</h4>
		      </div>
		      <div class="modal-body">

				  			{!! Form::open(['route'=>'add.testCase','enctype'=>"multipart/form-data"]) !!}

				  			
                                <div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
									{!! Form::label('Module:') !!}
									{!! Form::select('parent_id',$subModules, old('parent_id'), ['class'=>'form-control', 'placeholder'=>'Select Category']) !!}
								</div>

				  				<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
									{!! Form::label('Test Case Title:') !!}
									{!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Enter title']) !!}
								</div>
                                <div class="form-group {{ $errors->has('summary') ? 'has-error' : '' }}">
									{!! Form::label('Description:') !!}
									{!! Form::textarea('summary', old('summary'), ['class'=>'form-control', 'placeholder'=>'Test Case Summary']) !!}
								</div>
                                <div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
									{!! Form::label('File:') !!}
									{!! Form::file('image', old('file'), ['class'=>'form-control']) !!}
								</div>
								<div class="form-group">
                                    <button class="btn btn-success">Save</button>

									<button type="button"  data-dismiss="modal" class="btn btn-Danger">Cancel</button>
								</div>


				  			{!! Form::close() !!}
		      </div>
		    </div>
		  </div>
		</div>
								<span class="text-danger">{{ $errors->first('file') }}</span>
								<span class="text-danger">{{ $errors->first('summary') }}</span>
								<span class="text-danger">{{ $errors->first('parent_id') }}</span>
								<span class="text-danger">{{ $errors->first('name') }}</span>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script src="/js/main.js"></script>
</html>

      