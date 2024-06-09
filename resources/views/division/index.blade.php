@extends('layouts.main')

@section('css')
    <style>
        .pagination{
            justify-content: flex-end;
        }
    </style>
@endsection
@section('content')
<div class="container-lg">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Division List') }}</div>

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
                                <th>Name</th>
                                <th>Name Bn</th>
                                <th>Short Name</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $rowCount = 0;
                            @endphp
                            @forelse ($divisions as $item)
                            <tr>
                                <td>{{++$rowCount}}</td>
                                <td><span>{{$item->name}}</span></td>
                                <td><span>{{$item->name_bn}}</span></td>
                                <td><span>{{$item->short_name }}</span></td>
                                <td><span>{{$item->start_time ?? '-'}}</span></td>
                                <td><span>{{$item->end_time ?? '-'}}</span></td>
                                <td>

                                    @if ($item->status==1)
                                    <div class="mb-2 mr-2 badge badge-success">Active</div>
                                    @else

                                    <div class="mb-2 mr-2 badge badge-danger">InActive</div>
                                    @endif

                                </td>
                                
                                <td>

                                    <a type="button" href="{{route('division.edit', $item->id)}}"
                                        class="btn btn-sm btn-outline-primary mr-2" title="Edit"><i
                                            class="fa fa-edit"></i></a>

                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No Records Found</td>
                            </tr>
                            @endforelse


                        </tbody>
                        
                    </table>
                    


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
