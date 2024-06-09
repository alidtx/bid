@extends('layouts.main')

@section('css')
    <style>
        .pagination {
            justify-content: flex-end;
        }
    </style>
@endsection
@section('content')
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                            {{ __('Participant Report') }}
                        </div>
                        
                    </div>
                    <div>
                    @if (session('error'))
                    <div class="alert alert-success" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif

                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    </div>
                    <div class="btn-actions-pane-right">
                        <div class="btn-group">
                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    style="border-radius: 0.25rem" class="btn-icon btn-icon-only btn-shadow btn btn-info">
                                <i class="pe-7s-filter btn-icon-wrapper"></i>
                            </button>
                            <a href="{{ $download_url }}"  class="mx-2 btn btn-outline-success">Export as Excel</a>
                            <form action="" method="get" autocomplete="off">
                                <div tabindex="-1" role="menu" aria-hidden="true"
                                     class="dropdown-menu-xl dropdown-menu-right rm-pointers dropdown-menu-shadow dropdown-menu-hover-link dropdown-menu dropdown-menu-right"
                                     style="">
                                    <h6 tabindex="-1" class="dropdown-header">
                                        Filter options
                                    </h6>
                                    <div class="px-4">
                                        <div class="form-group mb-1">
                                            <small for="from_date" class="text-muted mb-2">Select Start Date</small>
                                            <input type="text" class="form-control-sm form-control" name="from_date" id="from_date" placeholder="Select start date" value="{{request()->from_date ? date("m/d/Y" ,\strtotime(trim(request()->from_date))) : null}}">
                                        </div>
                                        <div class="form-group mb-1">
                                            <small for="to_date" class="text-muted mb-2">Select End Date</small>
                                            <input type="text" class="form-control-sm form-control" name="to_date" id="to_date" placeholder="Select end date" value="{{request()->to_date ? date("m/d/Y" ,\strtotime(trim(request()->to_date))) : null}}">
                                        </div>
                                        <div class="form-group mb-1">
                                            <small for="to_date" class="text-muted mb-2">Mobile No.</small>
                                            <input type="text" class="form-control-sm form-control" name="mobile_no" id="mobile_no" placeholder="Enter Mobile No." value="{{request()->mobile_no ? request()->mobile_no : null}}">
                                        </div>

                                        <div class="form-group mb-1">
                                            <small for="to_date" class="text-muted mb-2">Class</small>
                                            <select name="class" id="class" class="form-control input-lg">
									         <option value=""></option>
									         <option value="6">ষষ্ঠ</option>
									         <option value="7">সপ্তম</option>
									         <option value="8">অষ্টম</option>
									         <option value="9">নবম</option>
									         <option value="10">দশম</option>
								           </select>
                                        </div>
                                        
                                        <div class="form-group mb-1">
                                            <small for="to_date" class="text-muted mb-2">Zone</small>
                                            <select id="zone" class="form-control-sm form-control" name="zone">
                                            <option value=""></option>
                                            @foreach($divisions as $division)
									        <option value="{{$division->name}}">{{$division->name_bn}}</option>
                                            @endforeach                                                
                                            </select>
                                        </div>

                                        <div class="form-group mb-1">
                                            <small for="to_date" class="text-muted mb-2">Type</small>
                                            <select name="type" id="type" class="form-control input-lg">
									         <option value=""></option>
									         <option value="Web">Web</option>
									         <option value="Sms">Sms</option>
									         <option value="Call Center">Call Center</option>
									         <option value="Field agent">Field agent</option>
								           </select>
                                        </div>

                                    </div>
                                    <div tabindex="-1" class="dropdown-divider"></div>
                                    <div class="p-1 text-right">
                                        <a href="{{route('report.participant')}}" type="button" class="mr-2 btn btn-outline-alternate">Clear Filters</a>
                                        <button type="submit" name="submit" value="submit" class="mr-2 btn-shadow btn btn-primary">Apply Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="mb-0 table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Mobile No</th>
                                <th>Age</th>
                                <th>Class</th>
                                <th>Division</th>
                                <th>Type</th>
                                <th>Created Date</th>
                                @if (Auth::user()->can('edit-Role'))
                                <th>Action</th>
                                @endif


                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($tableData as $key=>$item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td><span>{{ $item->name}}</span></td>
                                    <td><span>{{ $item->msisdn}}</span></td>
                                    <td><span>{{ $item->age}}</span></td>
                                    <td><span>{{ $item->class}}</span></td>
                                    <td><span>{{ $item->zone}}</span></td>
                                    <td><span>{{ $item->registration_type}}</span></td>
                                    <td><span>{{ dateTimeConvertDBtoForm($item->created_at) }}</span></td>
                                    @if (Auth::user()->can('edit-Role'))
                                     <td><a type="button" href="{{route('participant.edit', $item->id)}}"
                                        class="btn btn-sm btn-outline-primary mr-2" title="Edit"><i
                                            class="fa fa-edit"></i></a> </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="19" class="text-center">No Records Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="row d-flex justify-content-center">
                            <div class="col-6" style="padding-top: 15px;">
                                <!-- {{($tableData->currentPage() * $tableData->perPage()) - $tableData->perPage()}} -->
                               <p class="lead">You are viewing {{($tableData->currentPage() * $tableData->perPage()) - $tableData->perPage()}} to {{$tableData->currentPage() * $tableData->perPage()}} out of  {{$tableData->total() }}  records</p>

                            </div>
                            <div class="col-6">
                            {{ $tableData->appends(request()->input())->links() }}
                            </div>

                        </div>
                        
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

