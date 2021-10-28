<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\PersonController;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redis;
use Illuminate\Pagination\LengthAwarePaginator;

class PersonController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function index()
	{
		$allPersons = DB::table('person')->orderBy('ID', "ASC")->paginate(20);
		$totalPerson = $allPersons->total();
		return view('person', compact('allPersons','totalPerson'))->render();
	}
	
	function fetch_data(Request $request)
    {
		if($request->ajax())
		{
			$flagRedis = 0; 
			$isRedisCache = $request->get('isRedisCache');
			if($isRedisCache == 1)
			{
				$flagRedis = 1;
			}
			
			$birth_year = $request->get('birth_year');
			$birth_year = str_replace(" ", "%", $birth_year);
			  
			$birth_month = $request->get('birth_month');
			$birth_month = str_replace(" ", "%", $birth_month);
			
			$kh_redis_birth_year = Redis::get('redis_birth_year');
			$kh_redis_birth_month = Redis::get('redis_birth_month');
			
			if($kh_redis_birth_year == $birth_year && $kh_redis_birth_month == $birth_month)
			{
				$flagRedis = 1;
			}else{
				$flagRedis = 0;
			}
			
			if($flagRedis == 1)
			{
				// Redis::del('posts');
			 
				$cachedBlog = Redis::get('posts');
		
				if(isset($cachedBlog))
				{
					echo 'cached!!';
					
					$page = request()->has('page') ? request('page') : 1;
					$perPage = request()->has('per_page') ? request('per_page') : 20;
					$offset = ($page * $perPage) - $perPage;
					$newCollection = json_decode($cachedBlog, false);
					$newCollection2 = collect($newCollection);

					$allPersons =  new LengthAwarePaginator(
						 $newCollection2->slice($page, $perPage),
						 count($newCollection),
						 $perPage,
						 $page,
						 ['path' => request()->url(), 'query' => request()->query()]
					);
					
					$totalPerson = count($newCollection);
					return view('pagination_data', compact('allPersons','totalPerson'))->render();
					
				}else 
				{
					echo 'not chaced!!';
					
					Redis::set('redis_birth_year', $birth_year);
					Redis::set('redis_birth_month', $birth_month);
					   
					$allPersons = DB::table('person')
									->where(DB::raw('substring("BirthDay" for 4)'), '=', $birth_year)
									->where(DB::raw('substring("BirthDay" from 6 for 2)'), '=', str_pad($birth_month, 2, '0', STR_PAD_LEFT))
									->orderBy('ID', "ASC")
									->paginate(20);
									
					$redisallPersons = DB::table('person')
								->where(DB::raw('substring("BirthDay" for 4)'), '=', $birth_year)
								->where(DB::raw('substring("BirthDay" from 6 for 2)'), '=', str_pad($birth_month, 2, '0', STR_PAD_LEFT))
								->orderBy('ID', "ASC")
								->get();
								
					$totalPerson = $allPersons->total();
					$cachedBlog = Redis::set('posts', json_encode($redisallPersons, false));
					return view('pagination_data', compact('allPersons','totalPerson'))->render();
				}
			}
			else
			{
				echo 'not chaced for new filter!!';
				
				Redis::set('redis_birth_year', $birth_year);
				Redis::set('redis_birth_month', $birth_month);
			
				$allPersons = DB::table('person')
								->where(DB::raw('substring("BirthDay" for 4)'), '=', $birth_year)
								->where(DB::raw('substring("BirthDay" from 6 for 2)'), '=', str_pad($birth_month, 2, '0', STR_PAD_LEFT))
								->orderBy('ID', "ASC")
								->paginate(20);
								
				$redisallPersons = DB::table('person')
								->where(DB::raw('substring("BirthDay" for 4)'), '=', $birth_year)
								->where(DB::raw('substring("BirthDay" from 6 for 2)'), '=', str_pad($birth_month, 2, '0', STR_PAD_LEFT))
								->orderBy('ID', "ASC")
								->get();
								
				$totalPerson = $allPersons->total();
				$cachedBlog = Redis::set('posts', json_encode($redisallPersons, false));
				return view('pagination_data', compact('allPersons','totalPerson'))->render();
			}
			
		    
		}
    }
}
