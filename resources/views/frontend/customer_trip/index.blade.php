@extends('frontend.layouts.dashboard_app')
@section('title')
    <title>Group - {{ ViewsHelper::getConfigKeyData('website_title') }}</title>
@stop
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Group</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Group</li>
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
                                <h3 class="card-title float-left">
                                    Group
                                </h3>

                                <div class="float-right">
                                    {{-- <button type="button" class="btn btn-primary addNewBtn"><i class="fa fa-plus"></i> AddNew</button> --}}
                                    <button type="button" data-toggle="collapse" href="#collapseExample" role="button"
                                        aria-expanded="false" aria-controls="collapseExample" title="Filter"
                                        class="btn waves-effect waves-light btn-warning"><i class="fa fa-filter"></i>
                                        Filter</button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row collapse" id="collapseExample">
                                    <div class="col-lg-12">
                                        <div class="filter-main-box">
                                            <form name="filterFrm" id="filterFrm">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="form-group">
                                                            <label>Start Date</label>
                                                            <input class="form-control custom-date-pickeer" type="text"
                                                                name="srch_start_date" id="srch_start_date"
                                                                autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="form-group">
                                                            <label>End Date</label>
                                                            <input class="form-control custom-date-pickeer" type="text"
                                                                name="srch_end_date" id="srch_end_date" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div style="margin-top: 32px;">
                                                            <a class="btn btn-secondary text-light mr-1 resetBtn"
                                                                type="button">Reset</a>
                                                            <a class="btn btn-info text-light searchBtn"
                                                                type="submit">Go</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered" style="width:100%;" id="custom-ajax-tbl">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px">#</th>
                                                    <th>Cover Image</th>
                                                    <th>Customer Name</th>
                                                    <th>Title</th>
                                                    <th>Program</th>
                                                    <th>Location</th>
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
            </div>
        </section>
        <!-- /.content -->
    </div>
    <div class="modal fade text-left" id="confirm_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel111"
        aria-hidden="true">
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
    <script type="text/javascript" src="{{ url('public/frontend/custom/customer_trip/index.js') }}"></script>
@endsection
