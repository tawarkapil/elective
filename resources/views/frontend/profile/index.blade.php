@extends('frontend.layouts.dashboard_app')
@section('title')
<title>Profile - {{ ViewsHelper::getConfigKeyData('website_title') }}</title>
@stop
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Profile</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Profile</li>
               </ol>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-warning card-outline">
               <div class="card-body box-profile">
                  <div class="text-center" style="position:relative;">
                     <img class="profile-user-img img-fluid img-circle update-pic-cls" src="{{ ViewsHelper::displayUserProfileImage($data) }}" style="height:120px;width: 120px;" alt="User profile picture">

                     <div style="height:0px;overflow:hidden"> 
                         <input type="file" id="profile_image" name="profile_image"/> 
                     </div>
                     <a style="position: absolute;left: 100px;bottom: 5px;font-size: 20px;" class="camera_icon" onclick="profile_image.click();">
                         <i class="text-white fa fa-camera"></i>
                     </a>
                  </div>
                  <h3 class="profile-username text-center">{{ $data->full_name() }}</h3>
                  <p class="text-muted text-center">{{ $data->email }}</p>
                  <ul class="list-group list-group-unbordered mb-3">
                     <li class="list-group-item">
                        <b>Date of birth</b> <a class="float-right">{{ ($data->dob) ? ViewsHelper::displayDate($data->dob) : 'N/A' }}</a>
                     </li>
                     <li class="list-group-item">
                        <?php
                        $genderArr = [1 => 'Male', 2 => 'Female', 3 => 'Unspecified', 4 => 'Undisclosed']; 
                        ?>
                        <b>Gender</b> <a class="float-right"> {{ isset($genderArr[$data->gender]) ? $genderArr[$data->gender] : 'N/A' }}</a>
                     </li>
                  </ul>
               </div>
               <!-- /.card-body -->
            </div>
            <!-- /.card -->
            @if($data->getcountry)
            <!-- About Me Box -->
            <div class="card card-warning card-outline">
               <div class="card-header">
                  <h3 class="card-title">About Me</h3>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                  <strong><i class="fas fa-book mr-1"></i> Education</strong>
                  <p class="text-muted">
                     {{ $data->degree_title }} from the {{ $data->university }}
                  </p>
                  <hr>
                  <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                  <p class="text-muted">{{ $data->city }}, {{ $data->getcountry->name }} - {{ $data->zip_code }}</p>
               </div>
               <!-- /.card-body -->
            </div>
            <!-- /.card -->
            @endif
         </div>
         <div class="col-md-9">
            <div class="card card-warning card-outline">
               <div class="card-header">
                  <h3 class="card-title">Personal Info</h3>
                  <div class="card-tools">
                     <button type="button" class="btn btn-tool personalFrmToggle" data-card-widget="collapse" title="Collapse">
                     <i class="fas fa-minus"></i>
                     </button>
                  </div>
               </div>
               <div class="card-body">
                  <form name="personalInfoFrm" id="personalInfoFrm">
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">First Name</label>
                        <div class="col-sm-9">
                           <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{ $data->first_name }}">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Last Name</label>
                        <div class="col-sm-9">
                           <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{ $data->last_name }}">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Date of birth</label>
                        <div class="col-sm-9">
                           <input type="text" class="form-control" id="dob" name="dob" placeholder="Date of birth" value="{{ ($data->dob) ? date('d-m-Y', strtotime($data->dob)) : '' }}">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Gender</label>
                        <div class="col-sm-9">
                           {{ Form::select('gender', ['' => 'Please Select', 1 => 'Male', 2 => 'Female', 3 => 'Unspecified', 4 => 'Undisclosed'], $data->gender, ['id' => 'gender', 'class' => 'form-control']) }}
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="nationality" class="col-sm-3 col-form-label">Nationality</label>
                        <div class="col-sm-9">
                           <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Nationality" value="{{ $data->nationality }}">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">About me</label>
                        <div class="col-sm-9">
                           <textarea class="form-control" id="about_me" name="about_me" placeholder="About me">{{ $data->about_me }}</textarea>
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-sm-12">
                           <button type="submit" class="btn btn-outline-success float-right">Submit</button>
                        </div>
                     </div>
                  </form>
               </div>
               <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card card-warning card-outline collapsed-card">
               <div class="card-header">
                  <h3 class="card-title">My contact details</h3>
                  <div class="card-tools">
                     <button type="button" class="btn btn-tool contactFrmToggle" data-card-widget="collapse" title="Collapse">
                     <i class="fas fa-plus"></i>
                     </button>
                  </div>
               </div>
               <div class="card-body" style="display: none;">
                  <form name="contactDetailsFrm" id="contactDetailsFrm" class="form-horizontal">
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email Address</label>
                        <div class="col-sm-9">
                           <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}" placeholder="Email Address">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Phone Number</label>
                        <div class="col-sm-9">
                           <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $data->phone_number }}" placeholder="Phone Number">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Address line 1</label>
                        <div class="col-sm-9">
                           <input type="text" class="form-control" id="address1" name="address1" value="{{ $data->address1 }}" placeholder="Address line 1">
                        </div>
                     </div>

                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Address line 2</label>
                        <div class="col-sm-9">
                           <input type="text" class="form-control" id="address2" name="address2" value="{{ $data->address2 }}" placeholder="Address line 2">
                        </div>
                     </div>

                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">City </label>
                        <div class="col-sm-9">
                           <input type="text" class="form-control" id="city" name="city" value="{{ $data->city }}" placeholder="Address line 2">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Country/State/Province</label>
                        <div class="col-sm-9">
                           {!! Form::select('country', ['' => 'Select Country'] + $countries, ($data) ? $data->country : $default_country, ['id' => 'country', 'class' => 'form-control']) !!}
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Zipcode/ Postal code</label>
                        <div class="col-sm-9">
                           <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ $data->zip_code }}" placeholder="Zipcode/ Postal code">
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-sm-12">
                           <button type="submit" class="btn btn-outline-success float-right">Submit</button>
                        </div>
                     </div>
                  </form>
               </div>
               <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card card-warning card-outline collapsed-card">
               <div class="card-header">
                  <h3 class="card-title">My studies</h3>
                  <div class="card-tools">
                     <button type="button" class="btn btn-tool studiesFrmToggle" data-card-widget="collapse" title="Collapse">
                     <i class="fas fa-plus"></i>
                     </button>
                  </div>
               </div>
               <div class="card-body" style="display: none;">
                  <form name="studiesDetailsFrm" id="studiesDetailsFrm" class="form-horizontal">
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">My University</label>
                        <div class="col-sm-9">
                           <input type="text" class="form-control" id="university" name="university" placeholder="My University" value="{{ $data->university }}">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Degree Title</label>
                        <div class="col-sm-9">
                           <input type="text" class="form-control" id="degree_title" name="degree_title" placeholder="Degree Title" value="{{ $data->degree_title }}">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">My year of study at time of trip</label>
                        <div class="col-sm-9">
                            {!! Form::select('year_of_study', ['' => 'Please Select'] + Config::get('params.year_of_studies'), ($data) ? $data->year_of_study : null, ['id' => 'year_of_study', 'class' => 'form-control']) !!}
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">My graduation year</label>
                        <div class="col-sm-9">
                           <input type="text" class="form-control" id="graduation_date" name="graduation_date"  value="{{ $data->graduation_date }}" placeholder="Eg. 2001">
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-sm-12">
                           <button type="submit" class="btn btn-outline-success float-right">Submit</button>
                        </div>
                     </div>
                  </form>
               </div>
               <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card card-warning card-outline collapsed-card">
               <div class="card-header">
                  <h3 class="card-title">Socials</h3>
                  <div class="card-tools">
                     <button type="button" class="btn btn-tool socialFrmToggle" data-card-widget="collapse" title="Collapse">
                     <i class="fas fa-plus"></i>
                     </button>
                  </div>
               </div>
               <div class="card-body" style="display: none;">
                  <form id="socialFrm" name="socialFrm">
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Facebook <i  data-toggle="tooltip" data-placement="top" title="Paste your social handle url in the space provided" class="fa fa-info-circle"></i></label>
                        <div class="col-sm-9">
                           <input type="text" class="form-control" id="facebook_url" name="facebook_url" placeholder="Facebook URL" value="{{ $data->facebook_url }}">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Instagram <i  data-toggle="tooltip" data-placement="top" title="Paste your social handle url in the space provided" class="fa fa-info-circle"></i></label>
                        <div class="col-sm-9">
                           <input type="text" class="form-control" id="instagram_url" name="instagram_url" placeholder="Instagram URL" value="{{ $data->instagram_url }}">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">X (Twitter) <i  data-toggle="tooltip" data-placement="top" title="Paste your social handle url in the space provided" class="fa fa-info-circle"></i></label>
                        <div class="col-sm-9">
                           <input type="text" class="form-control" id="twitter_url" name="twitter_url" placeholder="X (Twitter) URL" value="{{ $data->twitter_url }}">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Google+ <i  data-toggle="tooltip" data-placement="top" title="Paste your social handle url in the space provided" class="fa fa-info-circle"></i></label>
                        <div class="col-sm-9">
                           <input type="text" class="form-control" id="google_url" name="google_url" value="{{ $data->google_url }}" placeholder="Google+ URL">
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-sm-12">
                           <button type="submit" class="btn btn-outline-success float-right">Submit</button>
                        </div>
                     </div>
                  </form>
               </div>
               <!-- /.card-body -->
            </div>
            <!-- /.card --> 
            <div class="card card-warning card-outline collapsed-card">
               <div class="card-header">
                  <h3 class="card-title">Profile Gallery</h3>
                  <div class="card-tools">
                     <button type="button" class="btn btn-tool galleryFrmToggle" data-card-widget="collapse" title="Collapse">
                     <i class="fas fa-plus"></i>
                     </button>
                  </div>
               </div>
               <div class="card-body" style="display: none;">
                  <form name="gallaryFrm" id="gallaryFrm">
                        <div class="row">
                            {{ csrf_field() }}
                            <div class="col-lg-6 offset-3">
                                <label for="attachments"></label>
                                <div class="form-group files">
                                    <input type="file" id="uploadFiles" name="attachments" class="form-control" multiple="">
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated video-progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-5">
                                 <div class="row displayUploadedFileName">
                                    @if(isset($data->attachments) && count($data->attachments) > 0 )
                                        @foreach($data->attachments as $file)

                                          <div class="col-sm-2">
                                            <a href="{{ ViewsHelper::getBlogImage($file)  }}" data-toggle="lightbox" data-gallery="gallery">
                                              <img src="{{ ViewsHelper::getBlogImage($file)  }}" class="im
                                              g-fluid mb-2 gallery_img"/>
                                            </a>
                                          </div>
                                          <!-- <div class="gallery-item documentfileContainer" data-key="{{ $file->attachment }}" >
                                            <div class="thumb">
                                              <img class="img-fullwidth imagefit_cover" src="{{ ViewsHelper::getBlogImage($file)  }}" alt="project">
                                              <div class="overlay-shade"></div>
                                              <div class="icons-holder">
                                                <div class="icons-holder-inner">
                                                  <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                                                    <a data-lightbox="image" href="{{ ViewsHelper::getBlogImage($file)  }}"><i class="fa fa-plus"></i></a>
                                                    <a href="#"><i class="fa fa-trash removeUploadFile"></i></a>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div> -->
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                   </form>
               </div>
               <!-- /.card-body -->
            </div>
            <!-- /.card -->
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@stop
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ url('public/frontend/assets/plugins/daterangepicker/daterangepicker.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('public/frontend/dashboard/plugins/ekko-lightbox/ekko-lightbox.css') }}" />
<style type="text/css">
   .files input {
        outline: 2px dashed #92b0b3;
        outline-offset: -10px;
        -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
        transition: outline-offset .15s ease-in-out, background-color .15s linear;
        padding: 70px 0px 100px 35%;
        text-align: center !important;
        margin: 0;
        width: 100% !important;
    }
    .files input:focus{     outline: 2px dashed #92b0b3;  outline-offset: -10px;
        -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
        transition: outline-offset .15s ease-in-out, background-color .15s linear; border:1px solid #92b0b3;
     }
    .files{ position:relative}
    .files:after {  pointer-events: none;
        position: absolute;
        top: 60px;
        left: 0;
        width: 50px;
        right: 0;
        height: 60px;
        content: "";
        display: block;
        margin: 0 auto;
        background-size: 100%;
        background-repeat: no-repeat;
    }

    .files:before {
        position: absolute;
        bottom: 10px;
        left: 0;  pointer-events: none;
        width: 100%;
        right: 0;
        height: 45px;
        content: " or drag it here. ";
        display: block;
        margin: 0 auto;
        color: #133d59;
        font-weight: 600;
        text-transform: capitalize;
        text-align: center;
    }

    .bg-success{
        background-color: green;
    }

   .bg-warning{
      background-color: yellow;
   }

   .video-progress-bar {
       height: 12px;
       border-radius: 5px;
   }

   .progress{
       display: none;
       height: 12px;
       margin-top: 6px;
   }

   .progress-bar span.percent{
    display: none !important;
   }

   .gallery_img{
      border: 1px solid #DDD;
      padding: 5px;
      width: 100%;
      height: 125px;
      object-fit: cover;
   }

</style>
@stop
@section('scripts')
<script type="text/javascript">
   var states = <?php echo json_encode($states, true) ?>;
   var country_code = "{{ ($data) ? $data->country_code : 'CA' }}";
   var dial_code = "{{ ($data) ? $data->dial_code : '1' }}";
   var default_country = "{{ $default_country }}";
   
   var uploaderMines = "jpg|png|jpeg";
   var maxSizeMb = 2;
   var attachments = {!! ($data) ? json_encode($data->getAttachmentArr()) : json_encode([]) !!};

   $(function () {
     $('[data-toggle="tooltip"]').tooltip()
   });
   
</script>
<script src="{{ url('public/frontend/dashboard/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<script type="text/javascript" src="{{ url('public/common/jquery-file-upload/js/vendor/jquery.ui.widget.js') }}"></script>
<script type="text/javascript" src="{{ url('public/common/jquery-file-upload/js/jquery.fileupload.js') }}"></script>
<script type="text/javascript" src="{{ url('public/common/jquery-file-upload/js/jquery.fileupload-process.js') }}"></script>
<script type="text/javascript" src="{{ url('public/common/jquery-file-upload/js/jquery.fileupload-validate.js') }}"></script>
<script src="{{ url('public/frontend/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script type="text/javascript" src="{{ url('public/frontend/custom/profile/index.js') }}{{ Config::get('params.app_version') }}"></script>
@stop