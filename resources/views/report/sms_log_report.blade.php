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
                            {{ __('Sms Log Report') }}
                        </div>
                    </div>
                    <div class="btn-actions-pane-right">
                        <div class="btn-group">
                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    style="border-radius: 0.25rem" class="btn-icon btn-icon-only btn-shadow btn btn-info">
                                <i class="pe-7s-filter btn-icon-wrapper"></i>
                            </button>
                            <a href="{{ $download_url_log }}"  class="mx-2 btn btn-outline-success">Export as Excel</a>
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
									        <option value="{{$division->name}}">{{$division->name}}</option>
                                            @endforeach                                                
                                            </select>
                                        </div>

                                        <div class="form-group mb-1">
                                            <small for="to_date" class="text-muted mb-2">Age</small>
                                            <select name="age" id="age" class="form-control input-lg">
                                            <option value=""></option>
									        <option value="10">১০</option>
									        <option value="11">১১</option>
									        <option value="12">১২</option>
									        <option value="13">১৩</option>
									        <option value="14">১৪</option>
									        <option value="15">১৫</option>
									        <option value="16">১৬</option>
									         <option value="17">১৭</option>
									        <option value="18">১৮</option>
									         <option value="19">১৯</option>
									         <option value="20">২০</option>
								             </select>
                                        </div>
                                    </div>
                                    <div tabindex="-1" class="dropdown-divider"></div>
                                    <div class="p-1 text-right">
                                        <a href="{{route('report.sms-log')}}" type="button" class="mr-2 btn btn-outline-alternate">Clear Filters</a>
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
                                <th>Status</th>
                                <th>Created Date</th>
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
                                    <td><span>{{ $item->status}}</span></td>
                                    <td><span>{{ dateTimeConvertDBtoForm($item->created_at) }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="19" class="text-center">No Records Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        {{ $tableData->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

