@extends('layouts.main')

@section('content')
<div class="container-lg">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Participant') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif


                    <form action="{{route('participant.update', $participant->id)}}" method="post" autocomplete="off"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-row">
                            <div class="position-relative form-group col-4">
                                <label for="name">Name</label>
                                 @error('name')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                                <input name="name" value="{{old('name') ?? $participant->name}}" id="name"
                                    placeholder="Please Enter Name" type="text" required class="form-control">
                            </div>
                            <div class="position-relative form-group col-4">
                                <label for="bank_name">Mobile No</label>
                                <input name="msisdn" value="{{old('msisdn') ?? $participant->msisdn}}" id="msisdn"
                                    placeholder="Please Enter Mobile No" type="text" required class="form-control">
                            </div>
                            <div class="position-relative form-group col-4">
                                <label for="designation">Age</label>
                                <input name="age" value="{{old('age') ?? $participant->age}}"
                                    id="age" placeholder="Please Enter Age" type="text"
                                    class="form-control">
                            </div>
                            <div class="position-relative form-group col-4">
                                <label for="msisdn">Class</label>
                                <input name="class" value="{{old('class') ?? $participant->class}}" id="class"
                                    placeholder="Class" type="text" class="form-control">
                            </div>

                            <div class="position-relative form-group col-4">
                                <label for="msisdn">Division</label>
                                <select name="zone" id="zone2" class="form-control input-lg">
                                <option value=""> {{ $participant->zone}}</option>
                                   @foreach($divisions as $division)
									<option value="{{$division->name}}">{{$division->name}}</option>
                                    @endforeach 
								</select>
                                
                            </div>

                            <!-- <div class="position-relative form-group col-4">
								<label class="sr-only">বিভাগ</label>
                                
								<select name="zone" id="zone2" class="form-control input-lg">
                                <option value="">-- বিভাগ/অঞ্চল  নির্বাচন--</option>
                                   @foreach($divisions as $division)
									<option value="{{$division->name}}">{{$division->name}}</option>
                                    @endforeach
								</select>
						    </div> -->
                            
                        </div>

                        <div class="divider"></div>
                        <div class="clearfix">

                            <button type="submit"
                                class="ladda-button float-right mb-2 mr-2 btn-shadow btn btn-outline-primary"
                                data-style="zoom-out">
                                <span class="ladda-label">Update
                                </span>

                                <span class="ladda-spinner">
                                </span>
                                <div class="ladda-progress" style="width: 0px;"></div>
                            </button>
                        </div>
                    </form>


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

    var startDate = '<?php echo $participant->voting_start_date_time; ?>';
    var endDate = '<?php echo $participant->voting_end_date_time; ?>';
   

    
    // var dates = range.split(' - ');
    startDate = startDate.split('-')
    endDate = endDate.split('-')

    console.log(startDate, endDate[2].split(' ')[1]);

    $('input[name="myDateRange"]').daterangepicker({  timePicker: true, startDate: startDate[1]+'/'+startDate[2]+'/'+startDate[0]+' 00:00', endDate: endDate[1]+'/'+endDate[2]+'/'+endDate[0]+' 12:00' });


$('input[name="myDateRange"]').daterangepicker({
    timePicker: true,
    timePicker24Hour: true,
    autoUpdateInput: false,
    opens: 'left',
    autoApply: true,
 
    
  });

  $('input[name="myDateRange"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY/MM/DD hh:mm') + ' - ' + picker.endDate.format('YYYY/MM/DD hh:mm'));
  });
</script>
@endpush