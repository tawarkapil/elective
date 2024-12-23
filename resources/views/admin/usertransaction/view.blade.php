@extends('admin.layouts.app') 
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Transactions Views</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a class="text-muted" href="{{ url('admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a class="text-muted" href="{{ url('admin/user-transaction') }}">User Trasactions</a></li>
              <li class="breadcrumb-item active">Transactions Views</li>
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
                        <h3 class="card-title float-left">User Transactions</h3>
                    </div>
                     <div class="card-body">
                        <!-- Invoice Detail-->
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="float-left mt-3">
                                 <p></p>
                                 <h3 style="text-transform: uppercase;">{{ $data->txn_id }}</h3>
                                 <p></p>
                                 <p>{{ ViewsHelper::displayAmount($data->amount) }}</p>
                              </div>
                           </div>
                           <!-- end col -->
                           <div class="col-sm-4 offset-sm-2">
                              <div class="mt-3 float-sm-right">
                                 <p class="font-13"><strong>Payment Date: </strong> &nbsp;&nbsp;&nbsp; {{ ViewsHelper::displayDate($data->created_at) }}</p>
                                 <p class="font-13"><strong>Payment Status: </strong> 
                                    @if($data->status == 0)
                                    <span class="badge badge-danger">Un-Paid</span>
                                    @else
                                    <span class="badge badge-success">Paid</span>
                                    @endif
                                 </p>
                                 <p><strong>Payment Mode : </strong> {{ $data->payment_mode }}</p>
                              </div>
                           </div>
                           <!-- end col -->
                        </div>
                        <!-- end row -->
                        <div class="row mt-4">
                           <div class="col-sm-5">
                              <h6>User Info</h6>
                              <address>{{ $data->buyer_name }}<br>
                                 {{ $data->buyer_email }}<br>
                                 <abbr title="Phone">P:</abbr> {{ $data->buyer_phone }}
                              </address>
                           </div>
                        </div>
                        <!-- end row -->
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