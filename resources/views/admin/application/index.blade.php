@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Application</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a class="text-muted" href="{{ url('admin/dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Application</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title float-left">Application</h3>
                                <div class="float-right">
                                    {{-- <button type="button" class="btn bg-gradient-primary addNewBtn"><i class="fa fa-plus"></i> Add New</button> --}}
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
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Duration</th>
                                                    <th>Program</th>
                                                    <th>Destination</th>
                                                    {{-- <th>Amount</th> --}}
                                                    <th>Status</th>
                                                    <th class="all">Date</th>
                                                    <th class="all">Action</th>
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
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <div class="modal fade" id="viewDescriptionMdl">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>

    <!-- /.modal -->
    <div class="modal fade" id="submitFrmMdl">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form name="submitFrm" id="submitFrm">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title float-left" id="page_headline"> Add New</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="image">Image <span class="required text-danger">*</span></label><br />
                                    <input type="file" id="image" name="image">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="imgDisplayBx"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="title">Title <span class="required text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="destination">Destination <span
                                            class="required text-danger">*</span></label>
                                    {!! Form::select('destination', ['' => 'Please Select'] + $destinations, null, [
                                        'id' => 'destination',
                                        'class' => 'form-control',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="payment_amount">Amount <span class="required text-danger">*</span></label>
                                    <input type="text" class="form-control allow_number_only" id="payment_amount"
                                        name="payment_amount">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="status">Status <span class="required text-danger">*</span></label>
                                    {!! Form::select('status', ['' => 'Please Select', 1 => 'Active', 0 => 'Inactive'], null, [
                                        'id' => 'status',
                                        'class' => 'form-control',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="description">Overview <span class="required text-danger">*</span></label>
                                    <textarea class="form-control" rows="5" id="description" name="description"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="itinerary_destination">Itinerary <span
                                            class="required text-danger">*</span></label>
                                    <textarea class="form-control" rows="5" id="itinerary_destination" name="itinerary_destination"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="what_included">What's Included <span
                                            class="required text-danger">*</span></label>
                                    <textarea class="form-control" rows="5" id="what_included" name="what_included"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="what_to_expect">What To Expect <span
                                            class="required text-danger">*</span></label>
                                    <textarea class="form-control" rows="5" id="what_to_expect" name="what_to_expect"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="price_description">Price Description <span
                                            class="required text-danger">*</span></label>
                                    <textarea class="form-control" rows="5" id="price_description" name="price_description"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="additional_information">Additional Information <span
                                            class="required text-danger">*</span></label>
                                    <textarea class="form-control" rows="5" id="additional_information" name="additional_information"></textarea>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> Close </button>
                        <button type="submit" id="submitBtn" name="submitBtn" class="btn btn-success"> Save </button>
                    </div>
                </form>
            </div>
            <!-- /.modal-description -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade text-left" id="confirm_modal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel111" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title white" id="myModalLabel111">Change Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="bx bx-x"></i>
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
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css"
        href="{{ url('public/panel/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ url('public/panel/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ url('public/panel/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ url('public/panel/assets/plugins/daterangepicker/daterangepicker.css') }}" />
    <style type="text/css">
        .cke_toolbar_last {
            display: none !important;
        }

        .dataTables_scrollHeadInner {
            width: 100%;
        }
    </style>
@endsection
@section('scripts')
    <script src="{{ url('public/panel/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('public/panel/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('public/panel/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('public/panel/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('public/panel/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.11.1/full-all/ckeditor.js"></script>
    <script type="text/javascript" src="{{ url('public/panel/custom/application/index.js') }}"></script>
@endsection
