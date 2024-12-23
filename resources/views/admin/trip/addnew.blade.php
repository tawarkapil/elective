@extends('admin.layouts.app')
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('admin/customers') }}" class="link">Member list</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Member</li>
                    </ol>
                </nav>
            </div>
            <h4 class="page-title">Edit Member</h4>
        </div>
    </div>
</div>

<div class="container-fluid">
    <!-- .row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-body">
                <form name="submitFrm" id="submitFrm">
                    <div class="row pt-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="user_type" class="control-label">Membership level <span class="text-danger">*</span></label>
                                {!! Form::select('user_type', ['' => 'Please Select'] + Config::get('params.user_type'), $data->user_type, ['id' => 'user_type', 'class' => 'form-control', 'disabled' => true]) !!}                                             
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" for="first_name">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $data->first_name }}">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" for="last_name">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $data->last_name }}">
                            </div>
                        </div>
                       
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" for="email">Email Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="email" id="email" value="{{ $data->email }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" for="dob">Date of Birth <span class="text-danger">*</span></label>
                                 <span class="input-group-btn glyphicon-calendar">
                                      <i class="fa fa-calendar"></i>
                                </span> 
                                <input type="text" class="form-control" name="dob" id="dob" value="{{ ($data->dob) ? date('d-m-Y', strtotime($data->dob)) : '' }}">
                               
                            </div>
                        </div> 
                       
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" for="phone_number">Phone Number <span class="text-danger">*</span></label>

                                <div class="input-group">
                                 <div class="input-group-prepend">
                                     @include('admin.common._country_code')
                                 </div>

                                 <input class="form-control" maxlength="16" type="text" name="phone_number" id="phone_number" value="{{ ($data) ? $data->contact_number : '' }}">
                                 <small>Please do not include any extension</small>
                              </div>
                            </div>
                        </div>
                        
                        {!! @csrf_field() !!}

                        <div class="col-md-12 col-lg-12">
                           <div class="form-group">
                              <label for="about_me">About me</label>
                              <textarea type="text" class="form-control" name="about_me" id="about_me">{{ $data->about_me }}</textarea>
                           </div>
                        </div> 
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                        <h5 class="card-title">Home Address</h5>
                    </div>
                    <div class="col-md-6 col-lg-4">
                       <div class="form-group">
                          <label for="address" class="control-label">Address <span class="required text-danger">*</span></label>
                          <input type="text" class="form-control" name="address" id="address" value="{{ ($data) ? $data->address : '' }}">
                       </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                       <div class="form-group">
                          <label for="country" class="control-label">Country <span class="required text-danger">*</span></label>
                           <select name="country" id="country" class="form-control">
                             <option value="">Select Country</option>
                             @foreach($countries as $key => $row)
                             <option value="{{ $row->id }}" @if($data && $data->country == $row->id) selected="selected" @endif data-region="{{ $row->region_id }}">{{ $row->name }}</option>

                             @endforeach
                             
                          </select>
                       </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                       <div class="form-group">
                          <label for="state" class="control-label">State</label>
                          {!! Form::select('state', ['' => 'Select State'] + $states, ($data) ? $data->state : null, ['id' => 'state', 'class' => 'form-control']) !!}
                       </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                       <div class="form-group">
                          <label for="city" class="control-label">City <span class="required text-danger">*</span></label>
                          <input type="text" class="form-control" name="city" id="city" value="{{ ($data) ? $data->city : '' }}">
                       </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                       <div class="form-group">
                          <label for="postal_code" class="control-label">Postal Code <span class="addrequired">{!! ($data && $data->country == 231) ? '<span class="required text-danger">*</span>' : '' !!}</span></label>
                          <input type="text" class="form-control" name="postal_code" id="postal_code" value="{{ ($data) ? $data->postal_code : '' }}">
                       </div>
                    </div>
                </div>
                   <div class="row">
                    <div class="col-sm-12">
                       <div class="text-right"> 
                            <button type="submit" class="btn waves-effect waves-light btn-primary">Update</button>
                        </div>
                       </div>
                   </div>
               </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('before-styles')
<link rel="stylesheet" type="text/css" href="{{ url('public/panel/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}{{ Config::get('params.app_version') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/frontend/assets/libs/select2/dist/css/select2.min.css') }}{{ Config::get('params.app_version') }}">
@endsection
@section('scripts')
<script type="text/javascript">
    var customer_id = "{{ base64_encode($data->customer_id) }}";
</script>
<!-- Bootstrap DatePicker -->
<script type="text/javascript" src="{{ url('public/frontend/assets/libs/select2/dist/js/select2.full.min.js') }}{{ Config::get('params.app_version') }}"></script>
<script type="text/javascript">
    var states = <?php echo json_encode($states, true) ?>;
  
   var home_address = {
      first_name : "{{ ($data) ? $data->first_name : '' }}",
      last_name : "{{ ($data) ? $data->last_name : '' }}",
      address : "{{ ($data) ? $data->address : '' }}",
      country : "{{ ($data) ? $data->country : '' }}",
      state : "{{ ($data) ? $data->state : '' }}",
      city : "{{ ($data) ? $data->city : '' }}",
      postal_code : "{{ ($data) ? $data->postal_code : '' }}",
      region : "{{ ($data) ? $data->region : '' }}",
   }

   var country_code = "{{ ($data) ? $data->country_code : 'US' }}";
   var dial_code = "{{ ($data) ? $data->dial_code : 1 }}";

  </script>

<script type="text/javascript" src="{{ url('public/panel/assets/libs/moment/moment.js') }}{{ Config::get('params.app_version') }}"></script>
<script type="text/javascript" src="{{ url('public/panel/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}{{ Config::get('params.app_version') }}"></script>
<script type="text/javascript" src="{{ url('public/panel/custom/customer/addnew.js') }}{{ Config::get('params.app_version') }}"></script>
@stop 