<?php
namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Blogs;
use App\Models\Customer;
use App\Models\Program;
use App\Models\CustomerTrip;
use App\Models\Pricing;
use App\Models\Destination;
use App\Models\Testimonial;
use App\Models\Category;
use App\Models\OurMember;
use App\Models\Tour;
use App\Models\Addon;
use App\Models\MstTag;
use App\Models\Comment;
use App\Models\Application;
use Auth;
use Config;

class HomeController extends Controller
{
    
    public function index(Request $request){
    	 $input = $request->all();
         $testimonials = Testimonial::where('status', 1)->get();
         $destination = Destination::where('status', 1)->take(10)->get();
         $programs = Program::where('status', 1)->take(10)->get();
         $blogsdata = Blogs::where('status', 1)->take(10)->get();
    	 return view('frontend.home.index', ['input' => $input, 'testimonials' => $testimonials, 'destination' => $destination, 'programs' => $programs, 'blogsdata' => $blogsdata]);
    }

    function blog(Request $request) {
        $input = $request->all();
        $obj = new Blogs();
        $data = $obj->where('status', 1)->where(function($query) use($input){
            if(isset($input['category'])){
                $query->where('category_id', $input['category']);
            }
        })->orderBy('created_at', 'DESC')->paginate(20);
        $categories = Category::where('status', 1)->orderBy('title', 'ASC')->get();
        $msttags = MstTag::orderBy('name', 'ASC')->get();
        return view('frontend.pages.blog', ['request' => $request, 'data' => $data, 'categories' => $categories, 'msttags' => $msttags]);
    }

    function blogtimeline(Request $request, $customer_id) {
        $input = $request->all();
        $customer_id = base64_decode($customer_id);
        $obj = new Blogs();
        $customerdata = Customer::where('customer_id', $customer_id)->first();
        if(!$customerdata){
            return abort(404);
        }
        $data = $obj->where('customer_id', $customerdata->customer_id)->where('status', 1)->orderBy('created_at', 'DESC')->paginate(5);
        return view('frontend.pages.blogtimeline', ['request' => $request, 'data' => $data]);
    }

    function ajaxLoadBlogsTimeline(Request $request){
        $input = $request->all();

        $obj = new Blogs();
        $data = $obj->where('status', 1)->orderBy('created_at', 'DESC')->paginate(5);
        $html = view('frontend.pages._ajax_timeline_blog', ['request' => $request, 'data' => $data]);
        $json['status'] = 1;
        $json['message'] = 'Loaded successfully';
        $json['html'] = $html->render();
        return json_encode($json);
    }

    function blogsInfo(Request $request, $title, $id){
        $id = base64_decode($id);
        $data = Blogs::where('id', $id)->where('status', 1)->first();
        if (!$data) {
            return abort(404);
        }
        $categories = Category::where('status', 1)->orderBy('title', 'ASC')->get();
        $similar_blogs = Blogs::where('status', 1)->where('category_id', $data->category_id)->where('id', '!=', $data->id)->orderBy('created_at', 'DESC')->take(5)->get();
        $comments = Comment::where('blog_id', $data->id)->where('status', 1)->orderBy('created_at', 'desc')->get();
        return view('frontend.pages.blog-details', ['request' => $request, 'data' => $data, 'categories' => $categories, 'similar_blogs' => $similar_blogs, 'comments' => $comments]);
    }



    function volunteer(Request $request) {
        
        if(!Auth::guard('customer')->check()){
            return redirect('/');
        }

        $customers = Customer::where('status', 1)->orderBy('created_at', 'DESC')->paginate(12);
        return view('frontend.pages.volunteer', ['request' => $request, 'customers' => $customers]);
    }

    function volunteerInfo(Request $request, $customer_name, $customer_id){
        if(!Auth::guard('customer')->check()){
            return redirect('/');
        }

        $customer_id = base64_decode($customer_id);
        $customer = Customer::where('customer_id', $customer_id)->where('status', 1)->orderBy('created_at', 'DESC')->first();
        if (!$customer) {
            return abort(404);
        }

        $blogsdata = Blogs::where('customer_id', $customer_id)->where('status', 1)->orderBy('created_at', 'DESC')->take(20)->get();
        return view('frontend.pages.volunteer-details', ['request' => $request, 'customer' => $customer, 'blogsdata' => $blogsdata]);
    }


    function trips(Request $request) {
        $obj = new CustomerTrip();
        $data = $obj->where('status', 1)->orderBy('created_at', 'DESC')->paginate(20);
        $programs = Program::where('status', 1)->orderBy('title', 'ASC')->get();
        return view('frontend.pages.trips', ['request' => $request, 'data' => $data, 'programs' => $programs]);
    }

    function tripInfo(Request $request, $title, $id){
        $id = base64_decode($id);
        $data = CustomerTrip::where('id', $id)->where('status', 1)->first();
        // if (!$data) {
        //     return abort(404);
        // }
        $application = Application::where('customer_id', \Auth::guard('customer')->user()->customer_id)->with(['getprogram','getdestination'])->first();
        $programs = Program::where('status', 1)->orderBy('title', 'ASC')->get();
        $similar_trips = CustomerTrip::where('status', 1)->orderBy('created_at', 'DESC')->take(20)->get();
        return view('frontend.pages.trips-details', ['application'=>$application,'request' => $request, 'data' => $data, 'programs' => $programs, 'similar_trips' => $similar_trips]);
    }

    public function addnewCustomerTrip(Request $request)
    {
        
        $obj = new CustomerTrip();
        $input = $request->all();
        // $input['id'] = base64_decode($input['id']);
        $data = $obj->addNew($input);
        return json_encode($data);
    }

    function destinations(Request $request) {
        $input = $request->all();
        $srch_program = isset($input['srch_program']) ? $input['srch_program'] : null;
        $data = Destination::select('mst_destinations.*')->leftJoin('mst_destination_programs', 'mst_destination_programs.destination_id', 'mst_destinations.id')->where(function($query) use($srch_program){
            if($srch_program){
                $query->where('mst_destination_programs.program_id', $srch_program);
            }
        })->where('mst_destinations.status', 1)->groupBy('mst_destinations.id')->orderBy('title', 'ASC')->paginate(12);

        $programs = Program::where('status', 1)->orderBy('title', 'ASC')->pluck('title', 'id')->toArray();
        return view('frontend.pages.destinations', ['request' => $request, 'data' => $data, 'programs' => $programs, 'srch_program' => $srch_program]);
    }

    function destinationsInfo(Request $request, $title, $id){
        $id = base64_decode($id);
        $data = Destination::where('id', $id)->where('status', 1)->first();
        if (!$data) {
            return abort(404);
        }

        $programs = Program::select('mst_programs.*')
        ->join('mst_destination_programs', 'mst_destination_programs.program_id', 'mst_programs.id')
        ->where('mst_destination_programs.destination_id', $data->id)
        ->where('mst_programs.status', 1)->groupBy('mst_programs.id')->take(10)->get();

        $blogsdata = Blogs::where('destination_id', $data->id)->where('status', 1)->take(10)->get();
        $customers = Customer::where('status', 1)->orderBy('created_at', 'DESC')->take(10)->get();
        $tours = Tour::where('destination', $data->id)->where('status', 1)->orderBy('title', 'ASC')->take(10)->get();

        $trips = CustomerTrip::where('destination_id', $data->id)->where('status', 1)->orderBy('created_at', 'DESC')->take(10)->get();
        $members = OurMember::where('destination', $data->id)->where('status', 1)->orderBy('created_at', 'DESC')->take(10)->get();


        return view('frontend.pages.destination-details', ['request' => $request, 'data' => $data, 'programs' => $programs, 'blogsdata' => $blogsdata, 'customers' => $customers, 'tours' => $tours, 'trips' => $trips, 'members' => $members]);
    }

    function quickContactFrm(Request $request){
        $obj = new Customer();
        $input = $request->all();
        $input['customer_id'] = base64_decode($input['customer_id']);
        $data = $obj->quickContactFrm($input);
        return json_encode($data);
    }

    function programs(Request $request) {
        $input = $request->all();
        $srch_destination = isset($input['srch_destination']) ? $input['srch_destination'] : null;
        $programs = Program::select('mst_programs.*')->leftJoin('mst_destination_programs', 'mst_destination_programs.program_id', 'mst_programs.id')->where(function($query) use($srch_destination){
            if($srch_destination){
                $query->where('mst_destination_programs.destination_id', $srch_destination);
            }
        })->where('mst_programs.status', 1)->groupBy('mst_programs.id')->orderBy('title', 'ASC')->paginate(12);

        $full_destination = Destination::where('status', 1)->orderBy('title', 'ASC')->get();
        $destinations = [];
        foreach($full_destination as $row){
            $destinations[$row->id] = $row->title.' - '.$row->getcountry->name;
        }
        return view('frontend.pages.programs', ['request' => $request, 'programs' => $programs, 'destinations' => $destinations, 'srch_destination' => $srch_destination]);
    }

    function programsInfo(Request $request, $title, $id){
        $id = base64_decode($id);
        $data = Program::where('id', $id)->where('status', 1)->first();
        if (!$data) {
            return abort(404);
        }
        $destination = Destination::select('mst_destinations.*')
        ->join('mst_destination_programs', 'mst_destination_programs.destination_id', 'mst_destinations.id')
        ->where('mst_destination_programs.program_id', $data->id)
        ->where('mst_destinations.status', 1)->groupBy('mst_destinations.id')->take(10)->get();

        $blogsdata = Blogs::where('program_id', $data->id)->where('status', 1)->take(10)->get();
        $customers = Customer::where('status', 1)->orderBy('created_at', 'DESC')->take(10)->get();
        $events = Addon::where('program', $data->id)->where('status', 1)->orderBy('title', 'ASC')->take(10)->get();
        $trips = CustomerTrip::where('program_id', $data->id)->where('status', 1)->orderBy('created_at', 'DESC')->take(10)->get();


        return view('frontend.pages.programs-details', ['request' => $request, 'data' => $data, 'destination' => $destination, 'blogsdata' => $blogsdata, 'customers' => $customers, 'events' => $events, 'trips' => $trips]);
    }


    function tours(Request $request) {
        $input = $request->all();
        $srch_destination = isset($input['srch_destination']) ? $input['srch_destination'] : null;
        $srch_price = isset($input['srch_price']) ? $input['srch_price'] : null;

        $tours = Tour::where('status', 1)
        ->where(function($query) use($srch_destination, $srch_price){
            if($srch_destination){
                $query->where('destination', $srch_destination);
            }
            if($srch_price){
                if(isset(Config::get('params.price_filter')[$srch_price])){
                    if($srch_price == 10){
                        $query->where('payment_amount', '>', 1000);
                    }else{
                        $configArr = explode('-', \Config::get('params.price_filter')[$srch_price]);
                        $minVal = $configArr[0];
                        $maxVal = $configArr[1];
                        $query->where('payment_amount', '>=', $minVal)->where('payment_amount', '<=', $maxVal);
                    }
                }
            }
        })->orderBy('title', 'ASC')->paginate(12);
        $full_destination = Destination::where('status', 1)->orderBy('title', 'ASC')->get();
        $destinations = [];
        foreach($full_destination as $row){
            $destinations[$row->id] = $row->title.' - '.$row->getcountry->name;
        }
        return view('frontend.pages.tours', ['request' => $request, 'tours' => $tours, 'destinations' => $destinations, 'srch_destination' => $srch_destination, 'srch_price' => $srch_price]);
    }

    function tourInfo(Request $request, $title, $id){
        $id = base64_decode($id);
        $data = Tour::where('id', $id)->where('status', 1)->first();
        if (!$data) {
            return abort(404);
        }
        return view('frontend.pages.tour-details', ['request' => $request, 'data' => $data]);
    }

    function events(Request $request) {
        $input = $request->all();
        $srch_program = isset($input['srch_program']) ? $input['srch_program'] : null;
        $srch_price = isset($input['srch_price']) ? $input['srch_price'] : null;

        $events = Addon::where('status', 1)
        ->where(function($query) use($srch_program, $srch_price){
            if($srch_program){
                $query->where('program', $srch_program);
            }
            if($srch_price){
                if(isset(Config::get('params.price_filter')[$srch_price])){
                    if($srch_price == 10){
                        $query->where('payment_amount', '>', 1000);
                    }else{
                        $configArr = explode('-', \Config::get('params.price_filter')[$srch_price]);
                        $minVal = $configArr[0];
                        $maxVal = $configArr[1];
                        $query->where('payment_amount', '>=', $minVal)->where('payment_amount', '<=', $maxVal);
                    }
                }
            }
        })->orderBy('title', 'ASC')->paginate(12);

        $programs = Program::where('status', 1)->orderBy('title', 'ASC')->pluck('title', 'id')->toArray();
        return view('frontend.pages.events', ['request' => $request, 'events' => $events, 'programs' => $programs, 'srch_program' => $srch_program, 'srch_price' => $srch_price]);
    }

    function eventsInfo(Request $request, $title, $id){
        $id = base64_decode($id);
        $data = Addon::where('id', $id)->where('status', 1)->first();
        if (!$data) {
            return abort(404);
        }
        return view('frontend.pages.event-details', ['request' => $request, 'data' => $data]);
    }

    function pricing(Request $request){
        $data = Pricing::where('status', 1)->get();
        return view('frontend.pages.pricing', ['request' => $request, 'data' => $data]);
    }

}