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
                        {{ __('Voter\'s Vote Counts') }}
                    </div>
                    <div class="btn-actions-pane-right">


                        <div class="btn-group">
                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                style="border-radius: 0.25rem"
                                class="btn-icon btn-icon-only btn-shadow btn btn-info">
                                <i class="pe-7s-filter btn-icon-wrapper"></i>
                            </button>
                            <div tabindex="-1" role="menu" aria-hidden="true"
                                class="dropdown-menu-xl dropdown-menu-right rm-pointers dropdown-menu-shadow dropdown-menu-hover-link dropdown-menu dropdown-menu-right"
                                style="">
                                <h6 tabindex="-1" class="dropdown-header">
                                    Filter by
                                </h6>
                                <form action="" method="get" autocomplete="off">
                                    
                                    <div class="px-4">

                                        <div class="form-group mb-1">
                                            <small for="sortBy" class="text-muted mb-2">Order By Votes</small>
                                            <select name="sortBy" id="sortBy"
                                                class="form-control-sm form-control">
                                                <option value="">Order by Votes</option>
                                                <option value="ASC" {{request()->sortBy == 'ASC' ? 'selected' : ''}}>Ascending order</option>
                                                <option value="DESC" {{request()->sortBy == 'DESC' ? 'selected' : ''}}>Descending Order</option>
                                              
                                            </select>
                                        </div>
                                    {{-- <input type="text" name="startDate" data-toggle="datepicker" data-autoclose="true" value="{{request()->startDate ?? ''}}" class="mb-2 form-control-sm form-control" placeholder="Select start date" > --}}
                                    {{-- <input type="text" name="myDateRange"  class="mb-3 form-control-sm form-control" placeholder="Select date range"> --}}
                               
                                  
                                    {{-- <select name="status" id="status" class="mb-3 form-control-sm form-control">
                                        <option value="">Filter by status</option>
                                        <option value="{{App\Enums\SmsStatusEnum::SUCCESS}}" {{App\Enums\SmsStatusEnum::SUCCESS == request()->status ? 'selected' : ''}}>{{ucwords(str_replace('_', ' ', App\Enums\SmsStatusEnum::SUCCESS))}}</option>
                                        <option value="{{App\Enums\SmsStatusEnum::VOTING_TIME_OVER}}" {{App\Enums\SmsStatusEnum::VOTING_TIME_OVER == request()->status ? 'selected' : ''}}>{{ucwords(str_replace('_', ' ', App\Enums\SmsStatusEnum::VOTING_TIME_OVER))}}</option>
                                        <option value="{{App\Enums\SmsStatusEnum::INVALID}}" {{App\Enums\SmsStatusEnum::INVALID == request()->status ? 'selected' : ''}}>{{ucwords(str_replace('_', ' ', App\Enums\SmsStatusEnum::INVALID))}}</option>
                                        <option value="{{App\Enums\SmsStatusEnum::FAILED}}" {{App\Enums\SmsStatusEnum::FAILED == request()->status ? 'selected' : ''}}>{{ucwords(str_replace('_', ' ', App\Enums\SmsStatusEnum::FAILED))}}</option>
                                    </select> --}}
                                        
                                </div>
                                
                                <div tabindex="-1" class="dropdown-divider"></div>
                                <div class="p-1 text-right">
                                    {{-- <a href="{{route('sms-log.export')}}" type="button"
                                        class=" btn btn-outline-primary">Export as Excel</a> --}}
                                    <a href="{{route('vote-count.voter.vote.count')}}" type="button" class="mr-2 btn btn-outline-alternate">Clear Filters</a>
                                    <button type="submit" name="submit" value="export" class="mr-2 btn btn-outline-success">Export as Excel</button>
                                    <button type="submit" name="submit" value="submit" class="mr-2 btn-shadow btn btn-primary">Apply Filter</button>
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
                                <th>Mobile Number</th>
                                <th>Total Votes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $rowCount = 0;
                            @endphp
                            @forelse ($data as $item)
                            <tr>
                                <td>{{++$rowCount}}</td>

                            

                    
                                <td>
                                    <div class="widget-numbers fsize-1 text-bold">{{$item->msisdn}}</div>
                                </td>
                               
                                <td>
                                    <div class="widget-numbers fsize-1 text-success text-bold">{{$item->total}}</div>
                                </td>
                               
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
                                <td colspan="7" class="text-center">No Records Found</td>
                            </tr>
                            @endforelse


                        </tbody>

                    </table>

                    {{ $data->appends(request()->input())->links() }}


                </div>
            </div>
        </div>
    </div>
   
</div>
@endsection

@push('script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>

    var range = '<?php echo request()->myDateRange; ?>';
   
if (range) {
    
    var dates = range.split(' - ');
    var startDate = dates[0].split('/')
    var endDate = dates[1].split('/')

    $('input[name="myDateRange"]').daterangepicker({ startDate: startDate[1]+'/'+startDate[2]+'/'+startDate[0], endDate: endDate[1]+'/'+endDate[2]+'/'+endDate[0] });
}

$('input[name="myDateRange"]').daterangepicker({
    autoUpdateInput: false,
    opens: 'left',
    autoApply: true,
    
  });

  $('input[name="myDateRange"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
  });
</script>
@endpush
