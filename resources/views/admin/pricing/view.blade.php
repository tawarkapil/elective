@extends('admin.layouts.app') 
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Pricing View</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a class="text-muted" href="{{ url('admin/dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item"><a class="text-muted" href="{{ url('admin/addons') }}">Pricing</a></li>
                  <li class="breadcrumb-item active">Pricing View</li>
               </ol>
            </div>
            <!-- /.col -->
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->
   <section class="content" id="page-refresh-container">
      <div class="container-fluid" id="page-refresh-box">
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-header">
                     <h3 class="card-title float-left">{{ $data->title }}</h3>
                  </div>
                  <div class="card-body ribbon-box pb-1">
                     
                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label class="control-label">Program </label>
                              <p>{{ $data->getdestination->title.' - '.$data->getdestination->getcountry->name }}</p>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label class="control-label">Status</label>
                              <p>{{ ($data->status == 1) ? 'Active' : 'Inactive' }}</p>
                           </div>
                        </div>

                        <div class="col-md-4">
                           <div class="form-group">
                              <label class="control-label">Week1 Payment</label>
                              <p>{{ ViewsHelper::displayAmount($data->week1_payment) }}</p>
                           </div>
                        </div>
                         <div class="col-md-4">
                           <div class="form-group">
                              <label class="control-label">Week2 Payment</label>
                              <p>{{ ViewsHelper::displayAmount($data->week2_payment) }}</p>
                           </div>
                        </div>
                         <div class="col-md-4">
                           <div class="form-group">
                              <label class="control-label">Week3 Payment</label>
                              <p>{{ ViewsHelper::displayAmount($data->week3_payment) }}</p>
                           </div>
                        </div>
                         <div class="col-md-4">
                           <div class="form-group">
                              <label class="control-label">Week4 Payment</label>
                              <p>{{ ViewsHelper::displayAmount($data->week4_payment) }}</p>
                           </div>
                        </div>
                         <div class="col-md-4">
                           <div class="form-group">
                              <label class="control-label">Week5 Payment</label>
                              <p>{{ ViewsHelper::displayAmount($data->week5_payment) }}</p>
                           </div>
                        </div>
                         <div class="col-md-4">
                           <div class="form-group">
                              <label class="control-label">Week6 Payment</label>
                              <p>{{ ViewsHelper::displayAmount($data->week6_payment) }}</p>
                           </div>
                        </div>
                        
                         <div class="col-md-4">
                           <div class="form-group">
                              <label class="control-label">Every Extra Week Payment</label>
                              <p>{{ ViewsHelper::displayAmount($data->extra_week_payment) }}</p>
                           </div>
                        </div>


                        <div class="col-md-12">
                           <div class="form-group">

                              <div id="accordion">
                                 <div class="card card-secondary">
                                    <div class="card-header">
                                       <h4 class="card-title w-100">
                                          <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="true">
                                          Overview
                                          </a>
                                       </h4>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordion" style="">
                                       <div class="card-body">
                                         {!! $data->description !!}
                                       </div>
                                    </div>
                                 </div>
                                 
                                 @if($data->what_included)
                                 <div class="card card-secondary">
                                    <div class="card-header">
                                       <h4 class="card-title w-100">
                                          <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false">
                                          What's Included
                                          </a>
                                       </h4>
                                    </div>
                                    <div id="collapseThree" class="collapse" data-parent="#accordion" style="">
                                       <div class="card-body">
                                          {!! $data->what_included !!}
                                       </div>
                                    </div>
                                 </div>
                                 @endif

                                

                                 @if($data->price_description)
                                 <div class="card card-secondary">
                                    <div class="card-header">
                                       <h4 class="card-title w-100">
                                          <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseFive" aria-expanded="false">
                                         Price Description
                                          </a>
                                       </h4>
                                    </div>
                                    <div id="collapseFive" class="collapse" data-parent="#accordion" style="">
                                       <div class="card-body">
                                          {!! $data->price_description !!}
                                       </div>
                                    </div>
                                 </div>
                                 @endif
                              </div>
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