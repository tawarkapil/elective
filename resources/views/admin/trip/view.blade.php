@extends('admin.layouts.app') 
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Trip View</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a class="text-muted" href="{{ url('admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a class="text-muted" href="{{ url('admin/trips') }}">Trips</a></li>
              <li class="breadcrumb-item active">Trip View</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
          <div class="container-fluid">
            <div class="row">
               <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                        <h3 class="card-title float-left">Trip View</h3>
                        <div class="card-tools">
                            @if($data->status == 1)
                                <label class="right badge badge-success">Active</label>                           
                            @else
                                <label class="right badge badge-danger">Inactive</label>                           
                            @endif
                          </div>
                    </div>
                        <div class="card-body ribbon-box pb-1">
                            <div class="row">
                                <div class="col-sm-3 form-group">
                                    <div class="position-relative">
                                      <img src="{{ ViewsHelper::getTripCoverImage($data) }}" alt="Photo 1" class="img-fluid" style="border: 1px solid #DDD;padding: 10px;background: #dddddd3d;object-fit: cover;">
                                      <div class="ribbon-wrapper ribbon-lg">
                                        <div class="ribbon bg-success">
                                          Cover Image
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Title</label>
                                        <p>{{ $data->title }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Customer Name</label>
                                        <p>{{ ($data->getcustomer) ? $data->getcustomer->full_name() : 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Program</label>
                                        <p>{{ ($data->getprogram) ? $data->getprogram->title : 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Destination</label>
                                        <p>{{ ($data->getdestination) ? $data->getdestination->title : 'N/A' }}</p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Duration</label>
                                        <p>{{ Config::get('params.trip_durations')[$data->duration] }}</p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Start Date</label>
                                        <p>{{ ($data->start_date) ? ViewsHelper::displayDate($data->start_date) : 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Description</label>
                                        <p>{!! $data->description !!}</p>
                                    </div>
                                </div>
                            </div>
                            <!---/row--->
                        </div>
                  </div>


                  <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Trip Customers</h4>
                </div>

                <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th style="width: 10px">#</th>
                              <th>Customer Name</th>
                              <th>Type</th>
                              <th>Email</th>
                              <th>Phone Number</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if(count($tripcustomers) > 0)
                            @foreach($tripcustomers as $key => $val)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ ($val->getcustomer) ? $val->getcustomer->full_name() : 'N/A' }}</td>
                                <td>{!! ($val->type == 1) ? '<span class="badge badge-success">Owner</span>' : '<span class="badge badge-danger">Student</span>' !!}</td>
                                <td>{{ ($val->getcustomer) ? $val->getcustomer->email : 'N/A' }}</td>
                                <td>{{ ($val->getcustomer) ? $val->getcustomer->displayPhoneNumber() : 'N/A' }}</td>
                                
                                <td>
                                    <a class="action-icon text-muted mr-2" href="{{ url('admin/customers/view/' . base64_encode($val->customer_id)) }}" title="View"><i class="fa fa-eye"></i></a
                                    ></td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                              <td class="text-center" colspan="12">No records found </td>
                            </tr>
                            @endif
                            
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
</div>
@stop
@section("styles")
@stop
@section("scripts")
@stop