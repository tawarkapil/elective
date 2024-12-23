@extends('frontend.layouts.dashboard_app')
@section('content')

<div class="content-wrapper">
  
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Address & Social Links</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Address & Social Links</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <!-- <i class="far fa-chart-bar"></i> -->
                Address & Social Links
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

               <form name="addressAndSocialFrm" id="addressAndSocialFrm">
                        <h4>Address</h4>  
                       <div class="row">
                            <div class="col-sm-12 form-group">
                              <label class="form-label" for="address">Address <span class="required text-danger">*</span></label>
                              <textarea name="address" id="address" class="form-control">{{ ($data) ? $data->address : '' }}</textarea>
                           </div>
                           <div class="col-sm-3 form-group">
                              <label class="form-label" for="country">Country <span class="required text-danger">*</span></label>
                              {!! Form::select('country', ['' => 'Select Country'] + $countries, ($data) ? $data->country : $default_country, ['id' => 'country', 'class' => 'form-control']) !!}
                           </div>
                           <div class="col-sm-3 form-group">
                              <label class="form-label" for="state">State/Province/County <span class="required text-danger">*</span></label>
                              {!! Form::select('state', ['' => 'Select State'] + $states, ($data) ? $data->state : null, ['id' => 'state', 'class' => 'form-control']) !!}
                           </div>
                           <div class="col-sm-3 form-group">
                              <label class="form-label" for="city">City <span class="required text-danger">*</span></label>
                              <input type="text" name="city" id="city" class="form-control"  value="{{ ($data) ? $data->city : '' }}"/>
                           </div>
                           <div class="col-sm-3 form-group">
                              <label class="form-label" for="zipcode">Zipcode <span class="required text-danger">*</span></label>
                              <input type="text" name="zipcode" id="zipcode" class="form-control"  value="{{ ($data) ? $data->zip_code : '' }}"/>
                           </div>
                       </div>


                         <h4>Social Links</h4>
                       <div class="row">
                           <div class="col-sm-6 form-group">
                              <label class="form-label" for="facebook_url">Facebook Url</label>
                              <input type="text" name="facebook_url" id="facebook_url" class="form-control" value="{{ ($data) ? $data->facebook_url : '' }}" />
                           </div>
                           <div class="col-sm-6 form-group">
                              <label class="form-label" for="instagram_url">Instagram Url</label>
                              <input type="text" name="instagram_url" id="instagram_url" class="form-control" value="{{ ($data) ? $data->instagram_url : '' }}" />
                           </div>
                           <div class="col-sm-6 form-group">
                              <label class="form-label" for="twitter_url">Twitter Url</label>
                              <input type="text" name="twitter_url" id="twitter_url" class="form-control" value="{{ ($data) ? $data->twitter_url : '' }}" />
                           </div>
                           <div class="col-sm-6 form-group">
                              <label class="form-label" for="google_url">Google+ Url</label>
                              <input type="text" name="google_url" id="google_url" class="form-control" value="{{ ($data) ? $data->google_url : '' }}" />
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-sm-4 col-sm-offset-4 form-group">
                                <button class="btn btn-dark btn-block btn-xl">Submit </button>
                           </div>
                        </div>
                   </form>
              
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection
@section('scripts')
<?php
    $change_password_page = true;
 ?>
<script type="text/javascript" src="{{ url('public/frontend/custom/auth/change-password.min.js') }}{{ Config::get('params.app_version') }}"></script>
@stop