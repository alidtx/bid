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
                <div class="card-header">{{ __('Question List') }}</div>

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
                               
                                <th>Body</th>
                                <th class="text-center">Correct Answer</th>
                                <th>Sending Date</th>
                                <th>Status</th>
                                <th>Is Used</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $rowCount = 0;
                            @endphp
                            @forelse ($questions as $item)
                            <tr>
                                <td>{{++$rowCount}}</td>
                            
                                <td><span>{{$item->body}}</span></td>
                                <td class="text-center text-bold">{{$item->correct_answer}}</td>
                                <td><span>{{$item->sending_date }}</span></td>
                                <td>
                                    @if ($item->status)
                                    <div class="mb-2 mr-2 badge badge-success">Active</div>
                                    @else
                                    <div class="mb-2 mr-2 badge badge-danger">Inactive</div>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->is_used == 0)
                                    <div class="mb-2 mr-2 badge badge-success">No</div>
                                    @else
                                    <div class="mb-2 mr-2 badge badge-danger">Yes</div>
                                    @endif
                                </td>

                                <td>

                                    <button type="button"data-toggle="modal" data-target="#questionEditModal-{{$item->id}}"
                                        class="btn btn-sm btn-outline-primary mr-2" title="Edit"><i
                                            class="fa fa-edit"></i></button>
                            
                                            
                                
                                </td>




                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No Records Found</td>
                            </tr>
                            @endforelse


                        </tbody>
                        
                    </table>
                    
                    {{ $questions->appends(request()->input())->links() }}


                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('modal')
@foreach ($questions as $item)
<div class="modal fade" id="questionEditModal-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="questionEditModal-{{$item->id}}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="questionEditModal-{{$item->id}}Label">Edit Question</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('question.update', $item->id)}}" method="post">
            @method('put')
            @csrf
        
      
        <div class="modal-body">
      <div class="form-group">
          
          
          <div class="form-row">
              <div class="position-relative form-group col-12">
                  <label for="image">Sending Date</label>
                  <input type="text" name="sending_date" id="sending_date" class="form-control" value="{{$item->sending_date}}" data-toggle="datepicker" data-format="yyyy-mm-dd" >
            </div>
        </div>
          <div class="form-row">
            <div class="position-relative form-group col-6">
                <label for="image">Status</label>

                <div class="custom-radio custom-control">
                    <input type="radio" id="active" value="1" {{$item->status == 1 ? 'checked' : ''}} name="status"
                        class="custom-control-input">
                    <label class="custom-control-label" for="active">Active</label>
                </div>
                <div class="custom-radio custom-control">
                    <input type="radio" id="inactive" value="0"  {{$item->status == 0 ? 'checked' : ''}} name="status"
                        class="custom-control-input">
                    <label class="custom-control-label" for="inactive">Inactive</label>
                </div>

            </div>
        </div>
          <div class="form-row">
            <div class="position-relative form-group col-6">
                <label for="image">Is Used</label>

                <div class="custom-radio custom-control">
                    <input type="radio" id="yes" value="1" {{$item->is_used == 1 ? 'checked' : ''}} name="is_used"
                        class="custom-control-input">
                    <label class="custom-control-label" for="yes">Yes</label>
                </div>
                <div class="custom-radio custom-control">
                    <input type="radio" id="no" value="0"  {{$item->is_used == 0 ? 'checked' : ''}} name="is_used"
                        class="custom-control-input">
                    <label class="custom-control-label" for="no">no</label>
                </div>

            </div>
        </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Update</button>
        </div>
    </form>
      </div>
    </div>
  </div>

@endforeach
  @endsection

  @push('script')
  <script>
    $(document).ready(function () {
        $('.datepicker').datepicker({
            format: 'YYYY-mm-dd'
        })
    });
</script>
  @endpush
