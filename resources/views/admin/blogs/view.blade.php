@extends('admin.layouts.app') 
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Blog View</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a class="text-muted" href="{{ url('admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a class="text-muted" href="{{ url('admin/blogs') }}">Blogs</a></li>
              <li class="breadcrumb-item active">Blog View</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content" id="page-refresh-container">
          <div class="container-fluid" id="page-refresh-box">
            <div class="row">
               <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                        <h3 class="card-title float-left">Blog View</h3>
                    </div>
                    <div class="card-body ribbon-box pb-1">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Title</label>
                                    <p>{{ $data->title }}</p>
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Trip</label>
                                    <p>{{ ($data->gettrip) ? $data->gettrip->title : 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Author Name</label>
                                    <p>{{ $data->author_name }}</p>
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Tags</label>
                                    <p>{{ $data->tags }}</p>
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Category</label>
                                    <p>{{ ($data->getcategory) ? $data->getcategory->title : 'N/A' }}</p>
                                </div>
                            </div>

                            @if($data->upload_type == 1)
                             <div class="col-md-12">
                                <div class="form-group">
                                    @if($data->upload_file == 'Video')
                                    <label class="control-label">Video</label>
                                    <p>{!! $data->youtube_url !!}</p>
                                    @else
                                    <label class="control-label">Gallery</label>
                                    <p>
                                        <div class="row">
                                            @foreach($data->attachments as $key => $attach)
                                              <div class="col-sm-2">
                                                  <img src="{{ url($attach->attachment) }}?text={{ $key + 1 }}" class="img-fluid mb-2" alt="white sample"/>
                                              </div>
                                            @endforeach
                                        </div>
                                    </p>
                                    @endif
                                </div>
                            </div>
                            @endif
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
                    <h4 class="card-title">Comments</h4>
                </div>

                <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th style="width: 10px">#</th>
                              <th>Customer Name</th>
                              <th>Comments</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if(count($comments) > 0)
                            @foreach($comments as $key => $val)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ ($val->getcustomer) ? $val->getcustomer->full_name() : 'N/A' }}</td>
                                <td>{{ $val->comment }}</td>
                                <td>
                                    @if($val->status == 0)
                                        <a class="action-icon  mr-2 text-muted update_status" href="#" title="Change Status" data-status="1"  data-key="{{ base64_encode($val->id) }}"><i class="badge-circle badge-circle-danger fa fa-times font-medium-1"></i></a>
                                    @else
                                        <a class="action-icon mr-2 text-muted update_status" href="#" title="Change Status" data-status="0" data-key="{{ base64_encode($val->id) }}"><i class="badge-circle badge-circle-success fa fa-check-circle font-medium-1"></i></a>
                                    @endif
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
        </div>
    </section>
</div>
<div class="modal fade text-left" id="confirm_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel111" aria-hidden="true">
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
@stop
@section("styles")
@stop
@section("scripts")
<script type="text/javascript" src="{{ url('public/panel/custom/blogs/view.js') }}"></script>
@stop