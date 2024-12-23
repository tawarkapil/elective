@extends('frontend.layouts.dashboard_app')
@section('title')
    <title>Application - {{ ViewsHelper::getConfigKeyData('website_title') }}</title>
@stop
@section('content')
      <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Application</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Application</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!------ Include the above in your HEAD tag ---------->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="process">
                            <div class="process-row nav nav-tabs">
                                <div class="process-step">
                                    <?php
                                    
                                    $step1 = $stepName == 'basic' ? 'btn-success active' : 'btn-default';
                                    $step2 = $stepName == 'about-trip' ? 'btn-success active' : 'btn-default';
                                    $step3 = $stepName == 'summary' ? 'btn-success active' : 'btn-default';
                                    
                                    ?>
                                    <a href="{{ url('application') }}">
                                        <button type="button" class="btn btn-circle {{ $step1 }}">1</button>
                                    </a>
                                    <p><b>About me</b></p>
                                </div>
                                <div class="process-step">
                                    <a href="{{ url('application/step/about-trip') }}">
                                        <button type="button" class="btn  btn-circle {{ $step2 }}">2</button>
                                    </a>
                                    <p><b>About my trip</b></p>
                                </div>
                                <div class="process-step">
                                    <a href="{{ url('application/step/summary') }}">
                                        <button type="button" class="btn btn-circle {{ $step3 }}">3</button>
                                    </a>
                                    <p><b>Summary</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="tab-content">
                            @if ($stepName == 'basic')
                                <div id="menu1" class="tab-pane fade active show">
                                    <form name="personalInfoFrm" id="personalInfoFrm">
                                        <div class="card card-warning card-outline">
                                            <div class="card-header">
                                                <h3 class="card-title text-uppercase">Personal Info</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool personalFrmToggle"
                                                        data-card-widget="collapse" title="Collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">First Name</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="first_name"
                                                            name="first_name" placeholder="First Name"
                                                            value="{{ $data->first_name }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Last Name</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="last_name"
                                                            name="last_name" placeholder="Last Name"
                                                            value="{{ $data->last_name }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Date of birth</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="dob"
                                                            name="dob" placeholder="Date of birth"
                                                            value="{{ $data->dob ? date('d-m-Y', strtotime($data->dob)) : '' }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Gender</label>
                                                    <div class="col-sm-8">
                                                        {{ Form::select('gender', ['' => 'Please Select', 1 => 'Male', 2 => 'Female', 3 => 'Unspecified', 4 => 'Undisclosed'], $data->gender, ['id' => 'gender', 'class' => 'form-control']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="nationality"
                                                        class="col-sm-4 col-form-label">Nationality</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="nationality"
                                                            name="nationality" placeholder="Nationality"
                                                            value="{{ $data->nationality }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                        <div class="card card-warning card-outline collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title text-uppercase">My contact details</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool contactFrmToggle"
                                                        data-card-widget="collapse" title="Collapse">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body" style="display: none;">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Email Address</label>
                                                    <div class="col-sm-8">
                                                        <input type="email" class="form-control" id="email"
                                                            name="email" value="{{ $data->email }}"
                                                            placeholder="Email Address">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Phone Number</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="phone_number"
                                                            name="phone_number" value="{{ $data->phone_number }}"
                                                            placeholder="Phone Number">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Address line 1</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="address1"
                                                            name="address1" value="{{ $data->address1 }}"
                                                            placeholder="Address line 1">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Address line 2</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="address2"
                                                            name="address2" value="{{ $data->address2 }}"
                                                            placeholder="Address line 2">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">City </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="city"
                                                            name="city" value="{{ $data->city }}"
                                                            placeholder="Address line 2">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Country/State/Province</label>
                                                    <div class="col-sm-8">
                                                        {!! Form::select('country', ['' => 'Select Country'] + $countries, $data ? $data->country : $default_country, [
                                                            'id' => 'country',
                                                            'class' => 'form-control',
                                                        ]) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Zipcode/ Postal code</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="zip_code"
                                                            name="zip_code" value="{{ $data->zip_code }}"
                                                            placeholder="Zipcode/ Postal code">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                        <div class="card card-warning card-outline collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title text-uppercase">My Education</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool studiesFrmToggle"
                                                        data-card-widget="collapse" title="Collapse">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body" style="display: none;">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">My University</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="university"
                                                            name="university" placeholder="My University"
                                                            value="{{ $data->university }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Degree Title</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="degree_title"
                                                            name="degree_title" placeholder="Degree Title"
                                                            value="{{ $data->degree_title }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">My year of study at time of
                                                        trip</label>
                                                    <div class="col-sm-8">
                                                        {!! Form::select(
                                                            'year_of_study',
                                                            ['' => 'Please Select'] + Config::get('params.year_of_studies'),
                                                            $data ? $data->year_of_study : null,
                                                            ['id' => 'year_of_study', 'class' => 'form-control'],
                                                        ) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">My graduation year</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="graduation_date"
                                                            name="graduation_date" value="{{ $data->graduation_date }}"
                                                            placeholder="Eg. 2001">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->

                                          <div class="row">
                                            <div class="col-sm-12">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox"name="accept_terms_condition" id="terms-chckbox"
                                                        value="Yes">
                                                    <label for="terms-chckbox">
                                                        By checking this box, I agree to the <a
                                                            href="#"><strong>Terms of Service</strong></a> and <a
                                                            href="#"><strong>Privacy Policy</strong></a>
                                                    </label>
                                                    <div class="display-terms-error">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-5">
                                                <button type="submit"
                                                    class="btn btn-outline-success float-right">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif

                            @if ($stepName == 'about-trip')
                                <div id="menu2" class="tab-pane fade active show">
                                    <form name="submitFrm" id="submitFrm">
                                        <div class="card card-warning card-outline">
                                            <div class="card-header">
                                                <h3 class="card-title text-uppercase">Trip</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool personalFrmToggle"
                                                        data-card-widget="collapse" title="Collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <label class="col-sm-6 col-form-label">Which program would you like to
                                                        enroll in?</label>
                                                    <div class="col-sm-6">
                                                        {!! Form::select('program', $programs, $data ? $data->program : null, [
                                                            'id' => 'program',
                                                            'class' => 'form-control  changeSummaryVal',
                                                        ]) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-6 col-form-label">Where would you like to
                                                        go?</label>
                                                    <div class="col-sm-6">
                                                        {!! Form::select('destination', $destinations, $data ? $data->destination : null, [
                                                            'id' => 'destination',
                                                            'class' => 'form-control  changeSummaryVal',
                                                        ]) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-6 col-form-label">When do you want to start your
                                                        program? </label>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="trip_start_date" id="trip_start_date"
                                                            class="form-control"
                                                            value="{{ $data->trip_start_date ? date('d-m-Y', strtotime($data->trip_start_date)) : '' }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-6 col-form-label">How long would you like your
                                                        program to be? <i data-toggle="tooltip" data-placement="top"
                                                            title="if >12 weeks please contact us"
                                                            class="fa fa-info-circle"></i></label>
                                                    <div class="col-sm-6">
                                                        {!! Form::select(
                                                            'duration',
                                                            ['' => 'Please Select'] + Config::get('params.trip_durations'),
                                                            $data ? $data->duration : null,
                                                            ['id' => 'duration', 'class' => 'form-control changeSummaryVal'],
                                                        ) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="nationality" class="col-sm-6 col-form-label">Will my
                                                        program count for Academic Credit Hours/ Continuing Education Units
                                                        (CEUs) /Other educational credits?</label>
                                                    <div class="col-sm-6">
                                                        <div class="icheck-info d-inline mr-2">
                                                            <input type="radio" name="educational_credits"
                                                                id="educational_credits_yes" value="Yes" checked>
                                                            <label for="educational_credits_yes">
                                                                Yes
                                                            </label>
                                                        </div>

                                                        <div class="icheck-info d-inline">
                                                            <input type="radio" name="educational_credits"
                                                                id="educational_credits_no" value="No">
                                                            <label for="educational_credits_no">
                                                                No
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-6 col-form-label">Specific Dietary
                                                        Preferences/Allergies <i data-toggle="tooltip"
                                                            data-placement="top" title=""
                                                            class="fa fa-info-circle"></i></label>
                                                    <div class="col-sm-6">

                                                        <input type="text" name="preferences_allergies"
                                                            id="preferences_allergies" class="form-control"
                                                            value="{{ $data ? $data->preferences_allergies : '' }}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-6 col-form-label">Other Preferences <i
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="This part of your application helps us know you better. You can jot down anything of interest to you in this section that will help us tailor your elective to suit you e.g. “I would like to improve my neurological examination skills” “learn how to suture” etc. This part of your application is forwarded to relevant Electives Global departments e.g. program advisors, hospital staff, catering department etc."
                                                            class="fa fa-info-circle"></i></label>
                                                    <div class="col-sm-6">

                                                        <input type="text" name="other_preferences"
                                                            id="other_preferences" class="form-control"
                                                            value="{{ $data ? $data->other_preferences : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 mb-5">
                                                <button type="submit"
                                                    class="btn btn-outline-success float-right">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif

                            @if ($stepName == 'summary')
                                <div class="tab-pane fade active show">
                                    <div class="row">
                                        @foreach ($tours as $key => $row)
                                            <div class="col-sm-6">
                                                <div class="card">
                                                    <img src="{{ url('public/uploads/tours/' . $row->image) }}"
                                                        class="card-img-top" alt="...">
                                                    <div class="card-body">
                                                        <h4> 
                                                            <a href="{{ $row->getDetailsPageUrl() }}">
                                                               {{ $row->title }}
                                                            </a>
                                                         </h4>
                                                        <p class="card-text">{{ $row->short_desc() }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>


                                </div>
                            @endif

                        </div>
                    </div>

                    <?php
                    
                    $array = ViewsHelper::getApplicationSummaryArray($data);
                    $summaryConf = ViewsHelper::getApplicationSummary($array);
                    
                    ?>
                     <div class="col-lg-4">
                        <div class="summary-container">
                            @include('frontend.profile._summary')
                        </div>
                     </div>
        </section>
    </div>
@stop
@section('styles')
    <link rel="stylesheet" type="text/css"
        href="{{ url('public/frontend/assets/plugins/daterangepicker/daterangepicker.css') }}" />
    <style>
        .daterangepicker .drp-calendar {
            max-width: unset;
        }

        .process-step .btn:focus {
            outline: none
        }

        .process {
            display: table;
            width: 100%;
            position: relative
        }

        .process-row {
            display: table-row
        }

        .process-step button[disabled] {
            opacity: 1 !important;
            filter: alpha(opacity=100) !important
        }

        .process-row:before {
            top: 24px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 5px;
            background-color: #ccc;
            z-order: 0
        }

        .process-step {
            display: table-cell;
            width: 33.33%;
            text-align: center;
            position: relative
        }

        .process-step p {
            margin-top: 4px;
            text-transform: uppercase;
        }

        .btn-circle {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 18px;
            border-radius: 50%
        }

        .list-group-item {
            padding: 7px 14px;
        }
    </style>
@stop
@section('scripts')
    <script type="text/javascript">
        // $(function(){
        // $('.btn-circle').on('click',function(){
        //  $('.btn-circle.btn-success').removeClass('btn-success').addClass('btn-default');
        //  $(this).addClass('btn-success').removeClass('btn-default').blur();
        // });

        // $('.next-step, .prev-step').on('click', function (e){
        //  var $activeTab = $('.tab-pane.active');

        //  $('.btn-circle.btn-success').removeClass('btn-success').addClass('btn-default');

        //  if ( $(e.target).hasClass('next-step') )
        //  {
        //     var nextTab = $activeTab.next('.tab-pane').attr('id');
        //     $('[href="#'+ nextTab +'"]').addClass('btn-info').removeClass('btn-default');
        //     $('[href="#'+ nextTab +'"]').tab('show');
        //  }
        //  else
        //  {
        //     var prevTab = $activeTab.prev('.tab-pane').attr('id');
        //     $('[href="#'+ prevTab +'"]').addClass('btn-info').removeClass('btn-default');
        //     $('[href="#'+ prevTab +'"]').tab('show');
        //  }
        // });
        // });
    </script>
    <script src="{{ url('public/frontend/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script type="text/javascript" src="{{ url('public/frontend/custom/profile/application.js') }}"></script>
@stop
