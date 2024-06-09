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
                        {{ __('User List') }}
                    </div>
                    <div class="btn-actions-pane-right">


    
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

                                <th>Name</th>
                                <th>Role</th>
                         
                                <th>Action</th>


                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $rowCount = 0;
                            @endphp
                            @forelse ($users as $item)
                            <tr>
                                <td>{{++$rowCount}}</td>

                               
                                <td><span>{{$item->name}}</span></td>
                               
                                <td><span>{{$item->getRoleNames()->first() }}</span></td>

                         
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No Records Found</td>
                            </tr>
                            @endforelse


                        </tbody>

                    </table>

                    {{ $users->appends(request()->input())->links() }}


                </div>
            </div>
        </div>
    </div>
   
</div>
@endsection

