@extends('frontend.layouts.dashboard_app')

@section('title')

<title>Trips - {{ ViewsHelper::getConfigKeyData('website_title') }}</title>

@stop

@section('content')

 <!-- Start main-content -->

  <div class="main-content dashboard">

  

    <section class="inner-header divider layer-overlay overlay-dark"  data-bg-img="{{ url('public/frontend/assets/images/contact-us.jpg') }}">

      <div class="container pt-30 pb-30">

        <!-- Section Content -->

        <div class="section-content">

          <div class="row"> 

            <div class="col-sm-8 xs-text-center">

              <h2 class="text-white mt-10">My Trips</h2>

            </div>

            <div class="col-sm-4">

              <ol class="breadcrumb white mt-10 text-right xs-text-center"> 

                <li><a href="{{ url('dashboard') }}">Dashboard</a></li>

                <li class="active">My Trips</li>

              </ol>

            </div>

          </div>

        </div>

      </div>

    </section> 

 @include('frontend.layouts.sidebar')

    <!-- Section: Registration Form -->

    <section class="divider">

      <div class="container">

        <div class="row"> 

          <div class="col-md-12">

            <div class="white_box">

              <div class="card-header">



                <div class="pull-right">

                    <a href="{{ url('my-trips/addnew') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>

                    <button type="button" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" title="Filter" class="btn waves-effect waves-light btn-warning"><i class="fa fa-filter"></i> Filter</button>

                </div>

              </div>

              <!-- /.card-header -->

              <div class="clearfix mb-10"></div>

              <div class="row collapse" id="collapseExample">

                   <div class="col-lg-12">

                      <div class="filter-main-box">

                         <form name="filterFrm" id="filterFrm">

                            <div class="row">

                               <div class="col-lg-4 col-md-6">

                                  <div class="form-group">

                                     <label>Start Date</label>

                                     <input class="form-control custom-date-pickeer" type="text" name="srch_start_date" id="srch_start_date" autocomplete="off">

                                  </div>

                               </div>

                               <div class="col-lg-4 col-md-6">

                                  <div class="form-group">

                                     <label>End Date</label>

                                     <input class="form-control custom-date-pickeer" type="text" name="srch_end_date" id="srch_end_date" autocomplete="off">

                                  </div>

                               </div>

                               <div class="col-lg-4 col-md-6">

                                  <div style="margin-top: 32px;">

                                     <a class="btn btn-secondary text-light mr-1 resetBtn" type="button">Reset</a>

                                     <a class="btn btn-info text-light searchBtn" type="submit">Go</a>

                                  </div>

                               </div>

                            </div>

                         </form>

                      </div>

                   </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <table class="table table-bordered" id="custom-ajax-tbl" style="width:100%">

                          <thead>

                            <tr>
                              <th style="width: 10px">#</th>
                              <th>Cover Image</th>
                              <th>Title</th>
                              <th>Program</th>
                              <th>Status</th>
                              <th>Created Date</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>

                    </div>

                </div>

            </div>

          </div>

        </div>

      </div>

    </section>

  </div>

  <!-- end main-content -->



   <div class="modal fade" id="viewContentMdl">

   <div class="modal-dialog modal-md">

      <div class="modal-content">

         <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

         </div>

         <div class="modal-body">

         </div>

      </div>

   </div>

</div>

<div class="modal fade text-left" id="confirm_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel111" aria-hidden="true">

   <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">

      <div class="modal-content">

         <div class="modal-header bg-primary">

            <h5 class="modal-title white pull-left" id="myModalLabel111">Change Status</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <i class="fa fa-times"></i>

            </button>

         </div>

         <div class="modal-body">

           <div class="modal-content-value"></div>

         </div>

         <div class="modal-footer text-right">

            <button data-dismiss="modal" class="btn btn-danger">CANCEL</button> 

            <button class="btn btn-success confirm_status">CONFIRM</button>

         </div>

      </div>

   </div>

</div>

@stop

@section('styles')

<link rel="stylesheet" type="text/css" href="{{ url('public/panel/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" />

<link rel="stylesheet" type="text/css" href="{{ url('public/panel/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" />

<link rel="stylesheet" type="text/css" href="{{ url('public/panel/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}" />

<link rel="stylesheet" type="text/css" href="{{ url('public/panel/assets/plugins/daterangepicker/daterangepicker.css') }}" />



@endsection

@section('scripts') 

<script src="{{ url('public/panel/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script src="{{ url('public/panel/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ url('public/panel/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script> 

<script src="{{ url('public/panel/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>

<script type="text/javascript" src="{{ url('public/frontend/custom/trip/index.js') }}"></script>

@endsection