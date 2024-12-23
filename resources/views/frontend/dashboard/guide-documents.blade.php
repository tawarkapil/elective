@extends('frontend.layouts.dashboard_app')
@section('title')
<title>Documents - {{ ViewsHelper::getConfigKeyData('website_title') }}</title>
@stop
@section('content')
<div class="content-wrapper">
  
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Documents</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Documents</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title float-left">
              Upload documents
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Document Type</th>
                          <th>Name</th>
                          <th>Status</th>
                          <th class="text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php $i = 1; ?>
                          @foreach(Config::get('params.student_documents') as $mainkey => $row)
                            @foreach($row as $key => $val)
                            <tr>
                              <td>{{ $i }}</td>
                              <td>{{ Config::get('params.system_documents')[$mainkey] }}</td>
                              <td>{{$val }}</td>
                              <td>
                                @if(isset($student_document[$mainkey][$key]))
                                <span class="text-success">Uploaded</span> 
                                @else
                                <span class="text-danger">Not Uploaded</span>
                                @endif
                              </td>
                              <td class="text-center">
                                <a title="Upload" href="#" class="text-muted uploadDocumentsBtn mr-1">
                                  <i class="fa fa-cloud"></i>
                                </a>
                                @if(isset($student_document[$mainkey][$key]))
                                <a target="_blank" title="Download" class="text-muted" href="{{ $student_document[$mainkey][$key]->document_path }}"><i class="fa fa-download"></i></a>
                                @endif
                                </td>
                            </tr>
                            <?php $i += 1; ?>
                            @endforeach
                          @endforeach
                        
                      </tbody>
                    </table>
              </div>  
            </div>
          </div>

          <div class="col-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title float-left">
              Guide documents
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Document Type</th>
                          <th>Name</th>
                          <th class="text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(count($system_documents) > 0)
                          @foreach($system_documents as $key => $val)
                          <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ Config::get('params.system_documents')[$val->document_type] }}</td>
                            <td>{{ $val->document_name }}</td>
                            <td class="text-center">
                              <a target="_blank" class="text-muted" href="{{ url($val->document_path) }}"><i class="fa fa-download"></i></a>
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
  </section>
</div>
@stop
@section('styles')
@stop
@section('scripts')
@stop