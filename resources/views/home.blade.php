@extends('layouts.main')

@section('content')
<div class="container-lg">
    <div class="row">
        <div class="col-12">
        <div class="row">
                <div class="col-md-4 col-lg-4">
                    <div
                        class="widget-chart widget-chart2 text-left mb-3 card-btm-border card-shadow-success border-success card">
                        <div class="widget-chat-wrapper-outer">
                            <div class="widget-chart-content">
                                <div class="widget-title opacity-5 text-uppercase">Total Participant COunt</div>
                                <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                                    <div class="widget-chart-flex align-items-center">
                                        <div>
                                            <span class="opacity-10 text-success pr-2">
                                                <i class="fa fa-arrow-up"></i>
                                            </span>
                                            {{ $totalParticipant }}
                                            <small class="opacity-5 pl-1" style="font-size: 50%">
                                                {{ $totalParticipantToday .' Today'}}
                                            </small>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div
                        class="widget-chart widget-chart2 text-left mb-3 card-btm-border card-shadow-success border-success card">
                        <div class="widget-chat-wrapper-outer">
                            <div class="widget-chart-content">
                                <div class="widget-title opacity-5 text-uppercase">Total Web COunt</div>
                                <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                                    <div class="widget-chart-flex align-items-center">
                                        <div>
                                            <span class="opacity-10 text-success pr-2">
                                                <i class="fa fa-arrow-up"></i>
                                            </span>
                                            {{ $totalWebCount }}
                                            <small class="opacity-5 pl-1" style="font-size: 50%">
                                                {{ $totalWebCountToday .' Today'}}
                                            </small>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div
                        class="widget-chart widget-chart2 text-left mb-3 card-btm-border card-shadow-info border-info card">
                        <div class="widget-chat-wrapper-outer">
                            <div class="widget-chart-content">
                                <div class="widget-title opacity-5 text-uppercase">Total Sms Count
                                </div>
                             
                                <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                                    <div class="widget-chart-flex align-items-center">
                                        <div>
                                            <span class="opacity-10 text-info pr-2">
                                                <i class="fa fa-arrow-down"></i>
                                            </span>
                                                {{$totalSms}}
                                            <small class="opacity-5 pl-1" style="font-size: 50%">
                                            {{ $totalSmsToday .' Today'}}

                                            </small>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-4">
                    <div class="mb-3 card">
                        <div class="card-header-tab card-header">
                            <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                Latest Registration
                            </div>
                            <div class="btn-actions-pane-right">
                                <a href="{{route('report.participant')}}" type="button"
                                    class="btn-icon btn-wide btn-outline-2x btn btn-outline-focus btn-sm d-flex">
                                    See more
                                    <span class="pl-2 align-middle opacity-7">
                                        <i class="fa fa-angle-right"></i>
                                    </span>
                                </a>
                            </div>

                        </div>
                        <div class="px-1 py-0 card-body" style="position: relative;">
                            <div class="scroll-area-md" style="height: 500px;">
                                <div class="scrollbar-container ps ps--active-y">
                                    <table class="mb-0 table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Registration Type</th>
                                                <th>Name</th>
                                                <th>Mobile No</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($participants as $participant)
                                            <tr>
                                                <td>{{ $participant->registration_type }}</td>
                                                <td>{{ $participant->name }}</td>
                                                <td>{{ $participant->msisdn }}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="3" class="text-center">No records found</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="col-8" >
            <!-- <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                     Division Wise Participant Pie Chart
            </div> -->
            <div class="mb-12 card" id="divisionPieChart">
                <center><h5>Division Wise Participant Pie Chart</h5></center>
           
            </div>
            </br>
            <div class="mb-12 card" id="divisionBarChart">
            <center><h5>Registration Type Wise Participant Bar Chart</h5></center>
            </div>
            </div>

           
            </div>
            

            

        </div>
        
    </div>
</div>

@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    $(document).ready(function () {



        $.ajax({
            type: "get",
            url: "{{route('division.wise.participant.chart')}}",
            success: function (response) {
                var options = {
                    series: response.counts,
                    chart: {
                        width: 380,
                        type: 'pie',
                    },
                    legend: {
                        show: true,
                        position: 'bottom',
                    },

                    labels: response.type,
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#divisionPieChart"),
                    options);
                chart.render();
            }
        });
                $.ajax({
                    type: "get",
                    url: "{{route('registration.wise.participant.chart')}}",
                    success: function (response) {
                    console.log(response);
                    var options = {
                        series: [{
                    data: [{
                    x: response.type[0],
                    y: response.counts[0]
                    },  
                    {
                    x: response.type[1],
                    y: response.counts[1]
                    },  
                    {
                    x: response.type[2],
                    y: response.counts[2]
                    },  
                    {
                    x: response.type[3],
                    y: response.counts[3]
                    },  
                        
                 ]
                }],

                    chart: {
                        width: 380,
                        type: 'bar',
                    },
                    legend: {
                        show: true,
                        position: 'top',
                    },

                    // labels: response.type,
                    responsive: [{
                        breakpoint: 380,
                        options: {
                            chart: {
                                width: 300
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#divisionBarChart"),
                    options);
                chart.render();
            }
        });
    });

</script>
@endpush
