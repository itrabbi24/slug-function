<?php

namespace App\Http\Controllers;
use App\Brand;
use DB;
use Session;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    
	//add brand
	public function addBrand()
	{
		return view('admin.brand.add-brand');
	}



	//manage brand
	public function manageBrand()
	{
		$brand=Brand::all();
    	return view('admin.brand.manage-brand',compact('brand'));
		
	}


	//brand store
	public function saveBrand(Request $request)
	{	
		//Eluqurent Insert

		$brand = new Brand();
		$brand->brand_name = $request->brand_name;
		$brand->brand_slug = $this->slug_generator($request->brand_name);
		$brand->save();

		//Advance Way....
		Session::flash('success','Brand Add Successfully!!');
		return back();

		//Normal Way to show alert message
		// return redirect()->back()->with('message','Brand Add Success!!');


		// //Qurey Builder
		// Brand::Create($request->all());
		// return 'success';


		// //Qurey Builder
		// DB::table('brands')->insert([
		// 	'brand_name'=> $request->brand_name
		// ]);

		// return 'success';


	}



	//Slug create Function
	public function slug_generator($string)
	{
		$string = str_replace(' ', '-', $string);
		$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
		return strtolower(preg_replace('/-+/', '-', $string));

	}





}
