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
                        {{ __('Date Wise Vote Counts') }}
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
                                            <small for="participant_id" class="text-muted mb-2">Select
                                                Participant</small>
                                            <select name="participant_id" id="participant_id"
                                                class="form-control-sm form-control">
                                                <option value="">Filter by Participant</option>
                                                @foreach ($participants as $participant)
                                                <option value="{{$participant->id}}"
                                                    {{$participant->id == request()->participant_id ? 'selected' : ''}}>
                                                    {{ucwords($participant->name.' - '.$participant->bank_name)}}
                                                </option>
                                                @endforeach
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
                                       
                                    </div>
                                
                                <div tabindex="-1" class="dropdown-divider"></div>
                                <div class="p-1 text-right">
                                    {{-- <a href="{{route('sms-log.export')}}" type="button"
                                        class=" btn btn-outline-primary">Export as Excel</a> --}}
                                    <a href="{{route('vote-count.date.wise.report')}}" type="button" class="mr-2 btn btn-outline-alternate">Clear Filters</a>
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
                                <th>Participant</th>
                                <th>Date</th>
                                <th>Votes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $rowCount = 0;
                            @endphp
                            @forelse ($voteCounts as $item)
                            <tr>
                                <td>{{++$rowCount}}</td>

                                <td>

                                    @if ($item->participant)
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                        <div class="widget-content-left">
                                            @php
                                          
                                            $image = $item->participant->image ? asset('images/participants/'.$item->participant->image) :
                                            "https://avatars.dicebear.com/api/initials/".$item->participant->name.".svg"
                                            @endphp
                                        <img width="42" height="42"  class="rounded-circle" src="{{$image}}" alt="">
                                        </div>
                                        </div>
                                        <div class="widget-content-left flex2">
                                        <div class="widget-heading">{{$item->participant->name}}</div>
                                        <div class="widget-subheading opacity-7">{{$item->participant->bank_name}}</div>
                                        </div>
                                        </div>
                                        </div>
                                    @else
                                    -
                                    @endif
                                   
                                </td>
                               

                                <td><span>{{\Carbon\Carbon::parse($item->date)->format('d M, y') }}</span></td>
                                <td><span> {{$item->votes}} </span></td>
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

                    {{ $voteCounts->appends(request()->input())->links() }}


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
