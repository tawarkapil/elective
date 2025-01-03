@extends('frontend.layouts.app')
@section('title')
    <title>Volunteers - {{ ViewsHelper::getConfigKeyData('website_title') }}</title>
@stop
@section('content')
    <!-- Start main-content -->
    <div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header divider layer-overlay overlay-dark"
            data-bg-img="{{ url('public/frontend/assets/images/volunteer-bg.jpg') }}">
            <div class="container pt-30 pb-30">
                <!-- Section Content -->
                <div class="section-content text-center">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 text-center">
                            <h3 class="text-theme-colored font-36">Trip Details</h3>
                            <ol class="breadcrumb text-center mt-10 white">
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><a href="{{ url('trips') }}">Trips</a></li>
                                <li class="active">Trip Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Volunteer Details -->
        @if($data)
        <section>
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="thumb">
                                <img style="height: 270px;object-fit: cover;"
                                    src="{{ ViewsHelper::getTripCoverImage($data) }}" alt="">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="">
                                <h4 class="line-bottom text-uppercase mt-0 pull-start">Trip</h4>
                                @if(!$tripCustomersData)
                                    <button id="joinGroup" data-id={{ $data->id }} class="btn btn-success pull-right">Join This Group</button>
                                @else
                                    <a class="btn btn-success pull-right" href="{{ url('my-trips/my-group') }}"> View Group</a>
                                @endif
                            </div>
                            <h5 class="name mt-30 mb-0">{{ $data->title }}</h5>
                            <h6 class="mt-5">Organiser :
                                {{ $data->getcustomer ? $data->getcustomer->full_name() : 'N/A' }}</h6>
                            <p>{!! $data->description !!}</p>
                            <div class="mt-30 mb-0">
                                <h5 class="pull-left mt-10 mr-20 text-theme-colored">Share:</h5>
                                <span id="jssocialshare"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-30">
                        <div class="col-md-4">
                            <h4 class="line-bottom">About Me:</h4>
                            <div class="volunteer-address">
                                <ul>
                                    <li>
                                        <div class="bg-light media border-bottom p-15 mb-20">
                                            <div class="media-left">
                                                <i class="fa fa-map-marker text-theme-colored font-24 mt-5"></i>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="mt-0 mb-0">Destination:</h5>
                                                <p>{{ $data->title }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <div class="bg-light media border-bottom p-15 mb-20">
                                        <div class="media-left">
                                            <i class="fa fa-map-marker text-theme-colored font-24 mt-5"></i>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0 mb-0">Duration:</h5>
                                            <p>2 Week</p>
                                        </div>
                                    </div>
                                    </li>
                                    <li>
                                        <div class="bg-light media border-bottom p-15">
                                            <div class="media-left">
                                                <i class="fa fa-phone text-theme-colored font-24 mt-5"></i>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="mt-0 mb-0">Members:</h5>
                                                <p>
                                                    <span>Member 1:</span> Rahul Nagar<br>
                                                    <span>Member 2:</span> Ravi Nagar
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h4 class="line-bottom">Find Location:</h4>

                            <!-- Google Map HTML Codes -->
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5456.163483134849!2d144.95177475051227!3d-37.81589041361766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4dd5a05d97%3A0x3e64f855a564844d!2s121+King+St%2C+Melbourne+VIC+3000%2C+Australia!5e0!3m2!1sen!2sbd!4v1556130803137!5m2!1sen!2sbd"
                                width="100%" height="290" frameborder="0" style="border:0" allowfullscreen=""></iframe>
                            <div class="map-popupstring hidden" id="popupstring1">
                                <div class="text-center">
                                    <h3>CharityFund Office</h3>
                                    <p>121 King Street, Melbourne Victoria 3000 Australia</p>
                                </div>
                            </div>
                            <!-- Google Map Javascript Codes -->
                            <script src="http://maps.google.com/maps/api/js"></script>
                            <script src="js/google-map-init.js"></script>
                        </div>
                        <div class="col-md-4">
                            <div class="clearfix">
                                <h4 class="line-bottom">Quick Contact:</h4>
                            </div>
                            <form id="quickContactFrm" name="quickContactFrm" class="contact-form-transparent">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" placeholder="Enter Name" id="contact_name"
                                                name="contact_name"
                                                value="{{ Auth::guard('customer')->check() ? Auth::guard('customer')->user()->full_name() : '' }}"
                                                readonly="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" placeholder="Enter Subject" id="subject" name="subject"
                                                class="form-control" value="">
                                            <span class="multi-custom-error" for="subject"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea rows="5" placeholder="Enter Message" id="message" name="message" class="form-control"></textarea>
                                    <span class="multi-custom-error" for="message"></span>
                                </div>
                                <div class="form-group">
                                    <button data-loading-text="Please wait..."
                                        class="btn btn-flat btn-dark btn-theme-colored mt-5" type="submit">Send your
                                        message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        @else 
        <!-- create Group Html -->
        <section id="createBtnSection">
            <div class="container mt-30 mb-30 pt-30 pb-30">
                <div class="filter pt-30 pb-20 mb-30">
                    <div class="row d-flex align-items-center justify-Content-center flex-wrap">
                        <div class="col-sm-5 col-xs-12">
                            <div class="form-group text-right mobile_text_center">
                                
                            </div>
                        </div>
                        <div class="col-sm-2 col-xs-12">
                            <div class="form-group"> 
                                <button id="groupBtnClick" type="submit" class="btn btn-colored btn-theme-colored btn-flat pull-right login_btn">
                                    Create Group
                                </button> 
                            </div>
                        </div>
                        <div class="col-sm-5 col-xs-12">
                            <div class="d-flex align-items-center justify-Content-between mobile_mb_15">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> 
        <section style="display:none; " id="group-tab" class="divider grey_bg"
            data-bg-img="{{ url('public/frontend/assets/images/enquire-form-grey.jpg') }}">
            <div class="container mt-30 mb-30 pt-30 pb-30">
                <div class="row">
                    <div class="col-md-7">
                        <div class="blue_bg_color p-40">
                            <h4 class="text-uppercase line-bottom text-white">Create Group</h4>
                            <!-- Paypal Both Onetime/Recurring Form Starts -->
                            <form id="saveCustomerTrip" class="form-text-white">
                               
                                <input type="hidden" name="application_id" id="application_id" value="{{ $application->id }}">
                                <input type="hidden" name="_token" id="csrf_token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="email"> Date </label>
                                            <input name="email" id="email" class="form-control" type="text"
                                                placeholder="Enter Email" readonly value="{{ ViewsHelper::displayDate($application->trip_start_date) }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="institution">Program</label>
                                            <input readonly value="{{ $application->getprogram->title }}" name="institution" id="institution" class="form-control" type="text"
                                                placeholder="Institution">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="phone_number">Destination</label>
                                            <input readonly value="{{ $application->getdestination->title }}-{{$application->getdestination->getcountry->name}}" name="phone_number" id="phone_number" class="form-control" type="text" placeholder="Enter Phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="title">Title <span class="required text-danger">*</span></label>
                                            <input name="title" id="title" class="form-control" type="text" placeholder="Enter Name">
                                        </div>
                                    </div>
                                   
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="image">Image <span class="required text-danger">*</span></label><br/>
                                            <input type="file" id="image" name="image">
                                         </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 form-group">
                                        <label for="description">Description <span class="required text-danger">*</span></label>
                                        <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter Message"></textarea>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group mb-20">
                                            <button type="submit" id="saveCustomerTrip"
                                                class="btn btn-flat btn-dark mt-10 pl-30 pr-30 quick-link-btn-hover"
                                                data-loading-text="Please wait...">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>       
        @endif 
        
        @if (count($similar_trips) > 0)
            <section>
                <div class="container pt-10">
                    <div class="section-title text-center">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <h3 class="text-uppercase mt-0">Other Trending Groups</h3>
                                <div class="title-icon">
                                    <i class="flaticon-charity-hand-holding-a-heart"></i>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem
                                    obcaecati!</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="news-carousel owl-nav-top mb-sm-80" data-dots="true">
                                @foreach ($similar_trips as $row)
                                    <div class="item">
                                        <article class="post clearfix maxwidth600 mb-sm-30">
                                            <div class="entry-header">
                                                <div class="post-thumb thumb">
                                                    <img src="{{ ViewsHelper::getTripCoverImage($row) }}" alt=""
                                                        class="img-responsive img-fullwidth">
                                                </div>
                                            </div>
                                            <div class="entry-content border-1px p-20">
                                                <h5 class="entry-title mt-0 pt-0"><a title="{{ $row->title }}"
                                                        href="{{ $row->getDetailsPageUrl() }}">{{ $row->short_title(40) }}</a>
                                                </h5>
                                                <p class="text-left mb-20 mt-15 font-13 text-justify">
                                                    {{ $row->short_desc(150) }}</p>
                                                <a class="btn btn-flat btn-dark btn-theme-colored btn-sm pull-left mt-0"
                                                    href="{{ $row->getDetailsPageUrl() }}">Read more</a>
                                                <ul class="list-inline entry-date pull-right font-12 mt-5">
                                                    <li><a class="text-theme-colored"
                                                            href="{{ $row->getcustomer ? $row->getcustomer->getDetailsPageUrl() : '#' }}">{{ $row->author_name }}</a>
                                                    </li> | <li><span
                                                            class="text-theme-colored">{{ ViewsHelper::displayDate($row->created_at) }}</span>
                                                    </li>
                                                </ul>
                                                <div class="clearfix"></div>
                                            </div>
                                        </article>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </div>
    <!-- end main-content -->
@stop
@section('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js"></script>
    <script>
        $("#jssocialshare").jsSocials({
            showLabel: false,
            showCount: false,
            shareIn: "popup",
            url: "{{ $data?->getDetailsPageUrl() }}",
            text: "{{ $data?->title }}",
            shares: ["twitter", "facebook", "googleplus", "linkedin"]
        });
        $("body").on('submit', '#saveCustomerTrip', function (e) {
            e.preventDefault();
            let customTripForm = new FormData(this);
            
            let title = $("#title").val();
            let description = $("#description").val();
            let image = $("#image")[0].files[0];
            let csrfToken = $("#csrf_token").val(); // Fetch CSRF token
            let applicationId = $("#application_id").val();
            
            customTripForm.append('title', title);
            customTripForm.append('description', description);
            customTripForm.append('_token', csrfToken)
            customTripForm.append('application_id', applicationId);
            if (image) {
                customTripForm.append('image', image);
            }
            $('button[type=submit]').attr('disabled', 'disabled').addClass('disable-btn');

            $.ajax({
                type: "POST",
                url: HTTP_PATH + 'trips/add-trip',
                data: customTripForm,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                success: function (data) {
                    error_remove();
                    $('button[type=submit]').removeAttr('disabled').removeClass('disable-btn');
                    if (data.status == 1) {
                        location.href = data.url;
                    } else if (data.status == 0) {
                        error_display(data.message);
                    } else if (data.status == 2) {
                        display_toster(data.message, 2);
                    }
                }
            });
        });
        $(document).on('click', '#joinGroup', function (e) {
            e.preventDefault();
            let  groupId = $(this).data('id');
            let currentButton = $(this);
            currentButton.attr('disabled', 'disabled').addClass('disable-btn');
            $.ajax({
                type: "POST",
                url: HTTP_PATH + 'trips/add-customer-trip',
                data: {
                    id: groupId, 
                    _token: '{{ csrf_token() }}'
                },
                success: function (data) {
                    currentButton.removeAttr('disabled').removeClass('disable-btn');
                    if (data.status == 1) {
                        console.log(data);
                        display_toster(data.message, 1);
                    } else if (data.status == 0) {
                        error_display(data.message);
                    } else if (data.status == 2) {
                        display_toster(data.message, 2);
                    }
                }
            });
        });
        $("#groupBtnClick").click(function () {
            $("#group-tab").show();
            $("#createBtnSection").hide();
        });
    </script>

    <script type="text/javascript" src="{{ url('public/frontend/custom/pages/volunteer-details.js') }}"></script>
@stop
@section('styles')
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css" />
    <link type="text/css" rel="stylesheet"
        href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-flat.css" />
    <style type="text/css">
        .jssocials-share-link {
            border-radius: 50%;
        }
    </style>
@stop
