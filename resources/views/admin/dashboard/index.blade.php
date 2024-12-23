@extends('admin.layouts.app') 
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $total_students }}</h3>

                <p>Total Students</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ url('admin/customers') }}"  class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>0</h3>

                <p>Total Trips</p>
              </div>
              <div class="icon">
                <i class="ion ion-plane"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $total_transaction_amt }}</h3>

                <p>Total Transcation</p>
              </div>
              <div class="icon">
                <i class="ion ion-filing"></i>
              </div>
              <a href="{{ url('admin/user-transaction') }}"  class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $total_enquires }}</h3>

                <p>Total Enquries</p>
              </div>
              <div class="icon">
                <i class="ion ion-iphone"></i>
              </div>
              <a href="{{ url('admin/enquiry') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>


        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Recent Registered Students</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone Number</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($recent_stundents) > 0)
                    @foreach($recent_stundents as $key => $val)
                    <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>{{ $val->full_name() }}</td>
                      <td>{{ $val->email }}</td>
                      <td>{{ $val->displayPhoneNumber() }}</td>
                      <td class="text-center"><a class="text-muted" href="{{ url('admin/customers/view/'.base64_encode($val->customer_id)) }}"><i class="fas fa-eye"></i></td>
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
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Recent Trips</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Title</th>
                      <th>Program</th>
                      <th>Destination</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($recent_trips) > 0)
                    @foreach($recent_trips as $key => $val)
                    <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>{{ $val->title }}</td>
                      <td>{{ ($val->getprogram) ? $val->getprogram->title : 'N/A' }}</td>
                      <td>{{ ($val->getdestination) ? $val->getdestination->title : 'N/A' }}</td>
                      <td class="text-center"><a class="text-muted" href="{{ url('admin/trips/view/'.base64_encode($val->id)) }}"><i class="fas fa-eye"></i></td>
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



      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
@section('styles')
@endsection
@section('scripts') 
@endsection