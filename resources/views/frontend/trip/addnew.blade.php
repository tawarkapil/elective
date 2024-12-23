@extends('frontend.layouts.dashboard_app')
@section('title')
<title>Trip - {{ ViewsHelper::getConfigKeyData('website_title') }}</title>
@stop
@section('content')
  <div class="main-content dashboard">
    <section class="inner-header divider layer-overlay overlay-dark"  data-bg-img="{{ url('public/frontend/assets/images/contact-us.jpg') }}">
      <div class="container pt-30 pb-30">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row"> 
            <div class="col-sm-8 xs-text-center">
              <h2 class="text-white mt-10">Add Trip</h2>
            </div>
            <div class="col-sm-4">
              <ol class="breadcrumb white mt-10 text-right xs-text-center"> 
                <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li><a href="{{ url('my-trips') }}">My Trips</a></li>
                <li class="active">Add Trip</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section> 
    <!-- Section: Registration Form -->
    <section class="divider">
      <div class="container">
        <div class="row">
          @include('frontend.layouts.sidebar')
          <div class="col-md-9">
            <div class="white_box">
              <!-- /.card-header -->
              <div class="row" style="border-bottom: 1px solid #DDD;margin-bottom: 20px;">
                 <div class="col-lg-12">
                    <h4>Trip</h4>
                 </div>
              </div>
                 <form name="submitFrm" id="submitFrm">
                     <div class="row">
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label for="title">Title <span class="required text-danger">*</span></label>
                              <input type="text" class="form-control" id="title" name="title" value="{{ ($data) ? $data->title : '' }}">
                           </div>
                        </div>

                        <div class="col-lg-6">
                           <div class="form-group">
                              <label for="destination_id">Destination <span class="required text-danger">*</span></label>
                              {!! Form::select('destination_id', ['' => 'Please Select'] + $destinations, ($data) ? $data->destination_id : null, ['id' => 'destination_id', 'class' => 'form-control change-payment-summary-inp']) !!}
                           </div>
                        </div>

                        <div class="col-lg-6">
                           <div class="form-group">
                              <label for="program_id">Program <span class="required text-danger">*</span></label>
                              {!! Form::select('program_id', ['' => 'Please Select'] + $programs, ($data) ? $data->program_id : null, ['id' => 'program_id', 'class' => 'form-control change-payment-summary-inp']) !!}
                           </div>
                        </div>


                        <div class="col-lg-6">
                           <div class="form-group">
                              <label for="duration">How much Week you want go ? <span class="required text-danger">*</span></label>
                              <input type="text" class="form-control allow_number_only change-payment-summary-inp" id="duration" name="duration" value="{{ ($data) ? $data->duration : '' }}">
                           </div>
                        </div>

                        <div class="col-lg-6">
                           <div class="form-group">
                              <label for="tour_ids">You want join any Tour ? </label>
                              {!! Form::select('tour_ids[]', $tours, ($data) ? $data->getTourIds() : null, ['id' => 'tour_ids', 'class' => 'form-control change-payment-summary-inp', 'multiple' => true]) !!}
                           </div>
                        </div>

                        <div class="col-lg-6">
                           <div class="form-group">
                              <label for="event_ids">You want join any Events & Addons ? </label>
                              {!! Form::select('event_ids[]', $addons, ($data) ? $data->getEventIds() : null, ['id' => 'event_ids', 'class' => 'form-control change-payment-summary-inp', 'multiple' => true]) !!}
                           </div>
                        </div>


                        <div class="col-lg-12">
                           <div class="form-group">
                              <label for="event_ids">Members (<small><a href="#" style="color:green;">Add Member</a></small>)</label>
                                <table class="table table-bordered table-striped">
                                     <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                     </thead>
                                     <tbody>
                                         <tr>
                                             <td>1</td>
                                             <td>{{ Auth::guard('customer')->user()->full_name() }}</td>
                                             <td><label class="badge badge-success">Owner</label></td>
                                             <td>{{ Auth::guard('customer')->user()->email }}</td>
                                             <td></td>

                                         </tr>
                                     </tbody>
                                 </table>
                           </div> 
                        </div>
                     </div>

                     <div class="row">
                         <div class="col-lg-12">
                            <div class="form-group payment-info-bx">
                                @if($data)
                                <?php 
                                    $program_name = $programs[$data->program_id];
                                    $duration = $data->duration;
                                    $members = $data->total_members;

                                    $tours_payment = $data->getTourSum();
                                    $events_payment = $data->getEventSum();
                                    $tours_name = $data->getToursName();
                                    $events_name = $data->getEventsName();

                                    $total_payment = 0;

                                    $destination_payment = ($data->destination_payment * $members) + ($data->extra_week_payment * $members); 

                                    $total_payment += $destination_payment;
                                    $total_payment += $tours_payment;
                                    $total_payment += $events_payment;
                                ?>

                                @include('frontend.trip._ajax_load_payment_summary')
                                @endif
                             </div>
                         </div>
                     </div>

                     <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group">
                              <label for="description">Description <span class="required text-danger">*</span></label>
                              <textarea class="form-control" rows="5" id="description" name="description">{!! ($data) ? $data->description : '' !!}</textarea>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-lg-12">
                        <button type="submit" id="submitBtn" name="submitBtn" class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10"> Submit & Pay </button>
                  </div>
                  </div>
                </form>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- end main-content -->
@stop
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
    .select2-selection__choice{
        background: #164058 !important;
        color: #FFF;
    }
</style>
@endsection
@section('scripts') 
<script type="text/javascript">
   var id = "{{ ($data) ? base64_encode($data->id) : 0 }}";
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.11.1/full-all/ckeditor.js"></script>
<script type="text/javascript" src="{{ url('public/frontend/custom/trip/addnew.js') }}"></script>
@endsection