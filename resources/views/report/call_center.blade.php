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
                            {{ __('Participant Report Call Center') }}
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
                            <form action="" method="get" autocomplete="off">
                                <div tabindex="-1" role="menu" aria-hidden="true"
                                     class="dropdown-menu-xl dropdown-menu-right rm-pointers dropdown-menu-shadow dropdown-menu-hover-link dropdown-menu dropdown-menu-right"
                                     style="">
                                    <h6 tabindex="-1" class="dropdown-header">
                                        Filter options
                                    </h6>
                                    <div class="px-4">
                                        
                                        
                                        <div class="form-group mb-1">
                                            <small for="mobile_no" class="text-muted mb-2">Mobile No.</small>
                                            <input type="text" class="form-control-sm form-control" name="mobile_no" id="mobile_no" placeholder="Enter Mobile No." value="{{request()->mobile_no ? request()->mobile_no : null}}">
                                        </div>

                                    </div>
                                    <div tabindex="-1" class="dropdown-divider"></div>
                                    <div class="p-1 text-right">
                                        <a href="{{route('report.participant.call-center')}}" type="button" class="mr-2 btn btn-outline-alternate">Clear Filters</a>
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

                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($tableData))
                            @forelse ($tableData as $key=>$item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td><span>{{ $item->name ?? ''}} </span></td>
                                    <td><span>{{ $item->msisdn ?? ''}}</span></td>
                                    <td><span>{{ $item->age ?? ''}}</span></td>
                                    <td><span>{{ $item->class ?? ''}}</span></td>
                                    <td><span>{{ $item->zone ?? ''}}</span></td>
                                    <td><span>{{ $item->registration_type ?? ''}}</span></td>
                                    <td><span>{{ dateTimeConvertDBtoForm($item->created_at) ?? '' }}</span></td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="19" class="text-center">No Records Found</td>
                                </tr>
                            @endforelse
                            @endif

                            </tbody>
                        </table>
                        @if(isset($tableData))

                        {{ $tableData->appends(request()->input())->links() }}

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

