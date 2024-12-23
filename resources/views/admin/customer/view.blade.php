@extends('admin.layouts.app') 
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Customer View</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a class="text-muted" href="{{ url('admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a class="text-muted" href="{{ url('admin/customers') }}">Customers</a></li>
              <li class="breadcrumb-item active">Customer View</li>
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
                            <h4 class="card-title">Personal Information</h4>
                        </div>

                    <div class="card-body ribbon-box pb-1">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">First Name</label>
                                    <p>{{ $data->first_name }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-danger">
                                    <label class="control-label">Last Name</label>
                                    <p>{{ $data->last_name }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-danger">
                                    <label class="control-label">Email Address</label>
                                    <p>{{ $data->email }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-danger">
                                    <label class="control-label">Phone Number</label>
                                    <p>{{ $data->displayPhoneNumber() }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-danger">
                                    <label class="control-label">Date Of birth</label>
                                    <p>{{ ViewsHelper::displayDate($data->dob) }}</p>
                                </div>
                            </div>

                             <div class="col-md-4">
                                <div class="form-group has-danger">
                                    <label class="control-label">Gender</label>
                                    <p>{{ ($data->gender == 1) ? 'Male' : 'Female' }}</p>
                                </div>
                            </div>

                            <br>
                            <div class="col-md-4">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Address </label>
                                       
                                        <p>{{ $data->address }}</p>
                                       
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Country</label>
                                       
                                        <p>{{ ($data->getcountry) ? $data->getcountry->name : 'N/A' }}</p>
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-danger">
                                        <label class="control-label">State</label>
                                       
                                        <p>{{ ($data->getstate) ? $data->getstate->name : 'N/A' }}</p>
                                       
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group has-danger">
                                        <label class="control-label">City</label>
                                        
                                        <p>{{ $data->city }}</p>
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Postal Code </label>
                                        
                                        <p>{{ ($data->zip_code) ? $data->zip_code : 'N/A' }}</p>
                                       
                                    </div>
                                </div>
                        </div>
                        <!---/row--->
                    </div>
                </div>
           

        <div class="card">
                <div class="card-header">
                    <h4 class="card-title">My Trips</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th style="width: 10px">#</th>
                                  <th>Title</th>
                                  <th>Duration</th>
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
                                  <td>{{ $val->duration }} Weeks</td>
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



          <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Uploaded Documents</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th style="width: 10px">#</th>
                                  <th>Document Type</th>
                                  <th>Name</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @if(count($documents) > 0)
                                @foreach($documents as $key => $val)
                                <tr>
                                  <td>{{ $key + 1 }}</td>
                                  <td>{{ Config::get('params.system_documents')[$val->document_type] }}</td>
                                  <td>{{ Config::get('params.student_documents')[$val->document_type][$val->student_doc_type] }}</td>
                                  <td>
                                    <a target="_blank" class="text-muted" href="{{ url($val->document_path) }}"><i class="fas fa-download"></i>
                                    </td>
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
</section>
</div>
@endsection
@section('scripts')
@endsection