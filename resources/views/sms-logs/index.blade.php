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
                        {{ __('SMS Log') }}
                    </div>
                    <div class="btn-actions-pane-right">


                        <div class="btn-group">
                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                style="border-radius: 0.25rem" class="btn-icon btn-icon-only btn-shadow btn btn-info">
                                <i class="pe-7s-filter btn-icon-wrapper"></i>
                            </button>
                            <div tabindex="-1" role="menu" aria-hidden="true"
                                class="dropdown-menu-xl dropdown-menu-right rm-pointers dropdown-menu-shadow dropdown-menu-hover-link dropdown-menu dropdown-menu-right"
                                style="">
                                <h6 tabindex="-1" class="dropdown-header">
                                    Filter options
                                </h6>
                                <form action="" method="get" autocomplete="off">
                                    <div class="px-4">
                                        <div class="form-group mb-1">
                                            <small for="sms_body" class="text-muted mb-2">Select Response</small>
                                            <select name="sms_body" id="sms_body"
                                                class="form-control-sm form-control">
                                                <option value="">Filter by Response</option>
                                                <option value="ys">YS</option>
                                                <option value="no">NO</option>
                                               
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">

                                            <small for="from_date" class="text-muted mb-2">Select Start Date</small>
                                            <input type="text" class="form-control-sm form-control" name="from_date"
                                                id="from_date" placeholder="Select start date"
                                                value="{{request()->from_date ? date("m/d/Y" ,\strtotime(trim(request()->from_date))) : null}}">
                                        </div>
                                        <div class="form-group mb-1">
                                            <small for="to_date" class="text-muted mb-2">Select End Date</small>
                                            <input type="text" class="form-control-sm form-control" name="to_date"
                                                id="to_date" placeholder="Select end date"
                                                value="{{request()->to_date ? date("m/d/Y" ,\strtotime(trim(request()->to_date))) : null}}">
                                        </div>
                                        <div class="form-group mb-1">
                                            <small for="status" class="text-muted mb-2">Select Status</small>

                                            <select name="status" id="status" class="form-control-sm form-control">
                                                <option value="">Filter by status</option>
                                                <option value="{{App\Enums\SmsStatusEnum::SUCCESS}}"
                                                    {{App\Enums\SmsStatusEnum::SUCCESS == request()->status ? 'selected' : ''}}>
                                                    {{ucwords(str_replace('_', ' ', App\Enums\SmsStatusEnum::SUCCESS))}}
                                                </option>
                                                <option value="{{App\Enums\SmsStatusEnum::INVALID}}"
                                                    {{App\Enums\SmsStatusEnum::INVALID == request()->status ? 'selected' : ''}}>
                                                    {{ucwords(str_replace('_', ' ', App\Enums\SmsStatusEnum::INVALID))}}
                                                </option>
                                               
                                            </select>
                                        </div>
                                    </div>

                                    <div tabindex="-1" class="dropdown-divider"></div>
                                    <div class="p-1 text-right">
                                        {{-- <a href="{{route('sms-log.export')}}" type="button"
                                        class=" btn btn-outline-primary">Export as Excel</a> --}}
                                        <a href="{{route('sms-log.index')}}" type="button" class="mr-2 btn btn-outline-alternate">Clear Filters</a>
                                        <button type="submit" name="submit" value="export"
                                            class="mr-2 btn btn-outline-success">Export as Excel</button>
                                        <button type="submit" name="submit" value="submit"
                                            class="mr-2 btn-shadow btn btn-primary">Apply Filter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    <table class="mb-0 table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>From Number</th>
                                <th>SMS Body</th>
                                <th>SMS Reply</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>


                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $rowCount = 0;
                            @endphp
                            @forelse ($smsLogs as $item)
                            <tr>
                                <td>{{++$rowCount}}</td>

                    
                                <td><span>{{$item->msisdn}}</span></td>
                                <td
                                    style='max-width: 100px;overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>
                                    <span>{{$item->sms_body }}</span></td>
                                <td
                                    style='max-width: 100px;overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>
                                    <span>{{$item->sms_reply }}</span></td>
                                <td><span>{{$item->sms_date }}</span></td>
                                <td><span>{{\Carbon\Carbon::parse($item->created_at)->format('H:i:s') }}</span></td>
                                <td><span> {{ucwords(str_replace('_', ' ', $item->status))}} </span></td>
                                {{-- <td>
                                    @if ($item->status)
                                    <div class="mb-2 mr-2 badge badge-success">Active</div>
                                    @else
                                    <div class="mb-2 mr-2 badge badge-danger">Inactive</div>
                                    @endif
                                </td> --}}
                                {{-- <td>
                                    @if ($item->is_used == 0)
                                    <div class="mb-2 mr-2 badge badge-success">No</div>
                                    @else
                                    <div class="mb-2 mr-2 badge badge-danger">Yes</div>
                                    @endif
                                </td> --}}
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">No Records Found</td>
                            </tr>
                            @endforelse


                        </tbody>

                    </table>

                    {{ $smsLogs->appends(request()->input())->links() }}


                </div>
            </div>
        </div>
    </div>

</div>
@endsection

