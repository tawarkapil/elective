@extends('admin.layouts.app') 
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User Transactions</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a class="text-muted" href="{{ url('admin/dashboard') }}">Home</a></li>>
              <li class="breadcrumb-item active">User Transactions</li>
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
                <h3 class="card-title float-left">User Transactions</h3>
                <div class="float-right">
                    <button type="button" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" title="Filter" class="btn waves-effect waves-light btn-warning"><i class="fa fa-filter"></i> Filter</button>
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
                                         <label>Membership</label>
                                         {!! Form::select('srch_plan_type', ['' => 'Please Select'] + $plans, null, ['id' => 'srch_plan_type', 'class' => 'form-control']) !!}
                                    </div>
                                </div> 
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
                                <div class="col-lg-12">
                                    <div class="mt-3 float-right">
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
                      <table class="table table-bordered" id="custom-ajax-tbl">
                         <thead>
                           <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th class="none">Email/Phone  </th>
                            <th>Plan Title</th>
                            <th>Transaction Id</th>
                            <th>Amount</th>
                            <th>Payment Mode</th>
                            <th>Status</th>
                            <th  class="all">Payment Date</th>
                            <th  class="all">Action</th>
                         </tr>
                         <tbody></tbody>
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

@endsection
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ url('public/panel/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('public/panel/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('public/panel/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('public/panel/assets/plugins/daterangepicker/daterangepicker.css') }}" />
@endsection
@section('scripts') 
<script src="{{ url('public/panel/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('public/panel/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('public/panel/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('public/panel/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('public/panel/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script type="text/javascript" src="{{ url('public/panel/custom/usertransaction/index.js') }}"></script>
@endsection