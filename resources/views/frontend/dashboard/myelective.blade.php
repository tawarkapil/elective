@extends('frontend.layouts.dashboard_app')
@section('title')
    <title>My Elective - {{ ViewsHelper::getConfigKeyData('website_title') }}</title>
@stop
@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">My Elective</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">My Elective</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-warning card-outline">
                            <div class="card-header">
                                <h3 class="card-title">My Elective </h3>
                                <div class="card-tools">
                                    <span id="totalAmount"> {{ $summaryConf['trip_total'] }} </span>
                                    <button type="button" class="btn btn-tool personalFrmToggle"
                                        data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="list-icon theme-colored listnone pl-0">
                                    <li class="check_list mb-2">
                                        <span><i class="fa fa-check-circle"></i></span>
                                        <span>Date : {{ ViewsHelper::displayDate($applicatinData->trip_start_date) }}</span>
                                    </li>
                                    <li class="check_list mb-2"><span><i class="fa fa-check-circle"></i></span>
                                        <span>Destination : {{ $applicatinData->getdestination->title }} </span>
                                    </li>
                                    <li class="check_list mb-2"><span><i class="fa fa-check-circle"></i></span>
                                        <span>Program : {{ $applicatinData->getprogram->title }} </span>
                                    </li>
                                    <li class="check_list mb-2">
                                        <span><i class="fa fa-check-circle"></i></span>
                                        <span>Add-ons :<span id="addonAppend"></span>
                                            <button class="btn btn-outline-success" type="button" data-toggle="modal"
                                                data-target="#addonsModel">Add Addons</button>
                                        </span>
                                    </li>
                                    <li class="check_list mb-2">
                                        <span><i class="fa fa-check-circle"></i></span>
                                        <span>Tours : <span id="tourAppend"></span>
                                            <button class="btn btn-outline-success" type="button" data-toggle="modal"
                                                data-target="#tourModel">Add Tours</button>
                                        </span>
                                    </li>
                                    <li class="check_list mb-2">
                                        <span>
                                            <i class="fa fa-check-circle"></i>
                                        </span> 
                                        <span>Group Trip : 
                                            <a href="{{ isset($customerTrip->id) ?$customerTrip->getDetailsPageUrl():url('trips/info/no/0') }}">Create Group</a>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <div class="card card-warning card-outline collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Program Advisor</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool contactFrmToggle" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body" style="display: none;">

                                <div class="timeline">
                                    <!-- timeline item -->
                                    @foreach ($calls as $call)
                                        <div>
                                            <i class="fas fa-phone bg-blue"></i>
                                            <div class="timeline-item">
                                                <h3 class="timeline-header"><a href="#">{{ $call->title }} </a>
                                                </h3>
                                                <div class="timeline-body">
                                                    <b>Call Description : </b> {{ $call->description }}
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->
                                    @endforeach
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <!-- /.card -->

                        <div class="card card-warning card-outline collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Program Coordinator</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool studiesFrmToggle" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body" style="display: none;">
                                <div class="row">
                                    @foreach ($ourmembers as $key => $row)
                                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                            <div class="card bg-light d-flex flex-fill">
                                                <div class="card-header text-muted border-bottom-0">
                                                    <h2 class="lead">
                                                        <b>{{ $row->name . '(' . $row->designation . ')' }}</b>
                                                    </h2>
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class="row">
                                                        <div class="col-8">
                                                            <!-- <h2 class="lead"><b>{{ $row->name . '(' . $row->designation . ')' }}</b></h2> -->
                                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                <li class="small"><span class="fa-li"><i
                                                                            class="fas fa-lg fa-building"></i></span>
                                                                    {{ $row->getdestination->title }} -
                                                                    {{ $row->getdestination->getcountry->name }}</li>
                                                                <li class="small"><span class="fa-li"><i
                                                                            class="fas fa-lg fa-phone"></i></span> + 800 -
                                                                    12 12 23 52</li>
                                                                <li class="small"><span class="fa-li"><i
                                                                            class="fas fa-lg fa-envelope"></i></span>
                                                                    {{ $row->email }}</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-4 text-center">
                                                            <img style="height: 85px;border: 1px solid #DDD;width: 85px;object-fit: cover;"
                                                                src="{{ url('public/uploads/our-member/' . $row->cover_image) }}"
                                                                alt="user-avatar" class="img-circle img-fluid">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <p class="text-muted text-sm">{!! $row->description !!}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>


                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>



        <!-- Tour Modal -->
        <div class="modal fade" id="tourModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Tour</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-12 col-form-label">Select Tour</label>
                            <div class="col-sm-12">
                                <select class="select-box" multiple="multiple" id="tour_id" name="tour_id[]">
                                    <option value="">Select Here</option>
                                    @foreach ($tour as $key => $value)
                                        <option value="{{ $value->id }}" data-amount="{{ $value->payment_amount }}">
                                            {{ $value->title }} {{ $value->payment_amount }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="saveTour" type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Addon Modal -->
        <div class="modal fade" id="addonsModel" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add-ons</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-12 col-form-label">Select Add-ons</label>
                            <div class="col-sm-12">
                                <select class="select-box" multiple="multiple" id="addon_id" name="addon_id[]">
                                    <option value="">Select Here</option>
                                    @foreach ($addon as $key => $value)
                                        <option value="{{ $value->id }}" data-amount="{{ $value->payment_amount }}">
                                            {{ $value->title }} {{ $value->payment_amount }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="saveAddon" type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('styles')
@stop
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.select-box').select2();
            // Initialize totalAmount
            let totalAmount = parseInt($("#totalAmount").text());

            // Initialize previous selected values
            const previousSelectedValues = {
                '#tour_id': [],
                '#addon_id': []
            };

            // Function to update total and display
            function updateTotalAndDisplay(selectId, displayId) {
                $(document).on('change', selectId, function() {
                    const currentSelectedValues = $(this).val() || [];
                    const newlySelectedValues = currentSelectedValues.filter(value => !
                        previousSelectedValues[selectId].includes(value));
                    const deselectedValues = previousSelectedValues[selectId].filter(value => !
                        currentSelectedValues.includes(value));

                    newlySelectedValues.forEach(value => {
                        const amount = $(this).find(`option[value="${value}"]`).data('amount');
                        totalAmount += parseInt(amount);
                    });

                    deselectedValues.forEach(value => {
                        const amount = $(this).find(`option[value="${value}"]`).data('amount');
                        totalAmount -= parseInt(amount);
                    });

                    const selectedOptionsText = currentSelectedValues.map(value => {
                        return $(this).find(`option[value="${value}"]`).text();
                    }).join(',');

                    $(displayId).html(selectedOptionsText);
                    $("#totalAmount").text(totalAmount);

                    // Update previousSelectedValues to the current selected values
                    previousSelectedValues[selectId] = currentSelectedValues;
                });
            }

            // Call the function for different sets of IDs
            updateTotalAndDisplay('#tour_id', '#tourAppend');
            updateTotalAndDisplay('#addon_id', '#addonAppend');

            // Handle save button clicks
            function handleSaveButtonClick(buttonId, modalId, selectId) {
                $(document).on('click', buttonId, function() {
                    $(modalId).modal('hide');
                    let selectedIds = $(selectId).val();
                    console.log(selectedIds);
                });
            }

            // Call the function for the save buttons
            handleSaveButtonClick('#saveTour', '#tourModel', '#tour_id');
            handleSaveButtonClick('#saveAddon', '#addonsModel', '#addon_id');
        });
    </script>
@stop
