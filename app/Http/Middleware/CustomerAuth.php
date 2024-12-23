<?php 
namespace App\Http\Middleware;

use Closure, Auth;
use Session;

class CustomerAuth{

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next){

		if(!Auth::guard('customer')->check()){
			return redirect('login');
		}
		
		return $next($request);

	}
}
