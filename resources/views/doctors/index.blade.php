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
                <div class="card-header">{{ __('Doctor List') }}</div>

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
                                <th>Image</th>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Designation</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $rowCount = 0;
                            @endphp
                            @forelse ($doctors as $item)
                            <tr>
                                <td>{{++$rowCount}}</td>
                                <td>
                                    @php
                                    $image = $item->image ? asset('images/doctors/'.$item->image) :
                                    "https://avatars.dicebear.com/api/initials/".$item->name.".svg"
                                    @endphp

                                    <div class="avatar-icon-wrapper">
                                        <div class="avatar-icon">
                                            <img class="rounded-circle" src="{{ $image }}" alt="">
                                        </div>
                                    </div>



                                </td>
                                <td><span>{{$item->name}}</span></td>
                                <td><span>{{$item->msisdn }}</span></td>
                                <td><span>{{$item->email ?? '-'}}</span></td>
                                <td><span>{{$item->designation ?? '-'}}</span></td>
                                <td>

                                    @if (count($item->getRoleNames()) && $item->getRoleNames()[0] == 'doctor')
                                    <div class="mb-2 mr-2 badge badge-primary">Doctor</div>
                                    @else

                                    <div class="mb-2 mr-2 badge badge-info">Corporate User</div>
                                    @endif

                                </td>
                                <td>

                                    @if ($item->status)
                                    <div class="mb-2 mr-2 badge badge-success">Active</div>
                                    @else

                                    <div class="mb-2 mr-2 badge badge-danger">Inactive</div>
                                    @endif

                                </td>

                                <td>

                                    <a type="button" href="{{route('doctor.edit', $item->id)}}"
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
                    
                    {{ $doctors->appends(request()->input())->links() }}


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
