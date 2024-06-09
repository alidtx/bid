@extends('layouts.main')
@section('title','Role edit')
@section('css')
<style>
    .card{
        
        -webkit-box-shadow: 3px 0px 7px 0px rgba(0,0,0,0.40); 
        box-shadow: 3px 0px 7px 0px rgba(0,0,0,0.40);
    }
    .checkbox *{
        cursor: pointer;
    }
</style>
@endsection
@section('content')

<div class="content container-fluid">
    <!-- Page Header -->


    <div class="row">
        <div class="col-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        Role Edit
                    </div>
                </div>
                {{ Form::model($role,['route' =>['roles.update',$role->id ],'method' => 'PUT','id'=>'roles-form'])}}
                <div class="card-body order-list">
             

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="mb-2">Role Name</label>
                                {!! Form::text( 'name', old('name'), $attributes = ['class'=>'form-control','id'=>'name','placeholder'=>'Enter Role Name']) !!}
                                @if($errors->has('name'))
                                    <strong style="color:red;">{{ $errors->first('name') }}</strong>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel panel-default card-view">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h6 class="panel-title txt-dark">Permissions</h6>
                                    </div>

                                    <br />
                                    <div class="mt-2 mb-2">
                                        <div class="checkbox checkbox-success">
                                            {{Form::checkbox('select-all',null, false, ['class' => 'select-all-permissions', 'id' => 'select-all-permissions'])}}
                                            <label for="{{'select-all-permissions'}}"> Select All Permissions </label>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    
                                    @foreach($permissions as $permission)
                                    <div class="form-group mb-1">
                                        <div class="checkbox checkbox-success">
                                            {{Form::checkbox('permission[]',$permission->id,in_array($permission->id, $rolePermissions) ? true : false, [ 'class' => 'permission',  'id' =>'permission'. $permission->id])}}
                                            <label for="{{'permission'.$permission->id}}">{{ucwords(str_replace('-', ' ', $permission->name))}} </label>
                                        </div>
                                    </div>
                                @endforeach
                                      
                                </div>
                            </div>
                        </div>
                        {{--<div class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="mb-2">Permission</label>
                                <br>
                                @foreach($permission as $value)
                                    <label>
                                        {!! Form::checkbox( 'permission[]',$value->id, in_array($value->id, $rolePermissions) ? true : false, $attributes = ['class'=>'']) !!}
                                        {{ $value->name }}
                                    </label>
                                    <br/>
                                @endforeach
                                @if($errors->has('permission'))
                                    <strong style="color:red;">{{ $errors->first('permission') }}</strong>
                                @endif
                            </div>
                        </div>--}}
                       
                    </div>
                    <!--end /div-->
                </div>
                <!--end card-body-->
                <div class="card-footer">
                    <div class="btn-actions-pane-right">
                        <div class="btn-group">
                            @hasanyrole(\App\Enums\RoleEnum::SUPERADMIN.'|'.\App\Enums\RoleEnum::ADMIN)
                            <button class="ladda-button btn btn-primary btn-lg" data-style="zoom-out" type="submit">
                                <span class="ladda-label">Submit
                                </span>
            
                                <span class="ladda-spinner">
                                </span>
                                <div class="ladda-progress" style="width: 0px;"></div>
                            </button>
                            @endhasanyrole
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
            <!--end card-->
        </div>
        <!--end col-->
    </div>


</div>
@endsection

@push('script')
    


    <script>
       $(document).ready(function() {

           $('.select-all').change( function() {
               let moduleId = $(this).attr('data-id');
                $('.permission-'+moduleId).not(this).prop('checked', this.checked);
              
           })

           $('#select-all-permissions').change( function() {
        
                $('input:checkbox').not(this).prop('checked', this.checked);
              
           })
       })
        
    </script>

@endpush


