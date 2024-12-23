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
    <section class="content">
          <div class="container-fluid">
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