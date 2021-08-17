<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Session;
use DB;

class BrandController extends Controller
{
    public function loginAuthentication() {
        $ad_username = Session::get('username');

        if($ad_username){
            return Redirect::to('admin_login_view');
        }
        else {
            return Redirect::to('admin')->send('Vui lòng đăng nhập');
        }
    }
    public function add(){

        $this->loginAuthentication();

    	return view('admin.brand.add_brand_view');
    }

    public function view_all(){

    	$this->loginAuthentication();

        $all_brand = DB::table('brands')->get();
        $manager_brand = view('admin.brand.all_brands_view') 
                     -> with('all_brands', $all_brand);

    	return view('admin_layout_view')->with('admin.brand.all_brands_view', $manager_brand);
    }

    public function update_brand_status($brand_id){

        $this->loginAuthentication();

        $status_cate = DB::table('brands')->where('brand_id', $brand_id)
                                              ->get('status');
        if($status_cate == '[{"status":0}]') {
            DB::table('brands')->where('brand_id', $brand_id)
                                   ->update(['status' => 1]);

            Session::put('messBrand','Hiển thị brand thành công!!!');
        }
        else {
            DB::table('brands')->where('brand_id', $brand_id)
                                   ->update(['status' => 0]);
            Session::put('messBrand','Ẩn brand thành công!!!');
        }


        return Redirect::to('/admin/brand/view-all');
    }

    public function edit($brand_id){

        $this->loginAuthentication();

        $edit_cate = DB::table('brands')->where('brand_id',$brand_id)
                                            ->get();
        $manager_cate  = view('admin.brand.edit_brand_view')
                      -> with('edit_brand',$edit_cate);

        return view('admin_layout_view')->with('admin.brand.edit_brand_view', $manager_cate);
    }

    public function update(Request $request_update, $brand_id){

        $this->loginAuthentication();

        $data_cate = array();

        $data_cate['brand_name'] = $request_update->brandName;
        $data_cate['description'] = $request_update->brandDescription;

        DB::table('brands')->where('brand_id',$brand_id)
                               ->update($data_cate);

        Session::put('messBrand','Cập nhật brand thành công!!!');
        return Redirect::to('/admin/brand/view-all');
    }

    public function save(Request $request_brand){

        $this->loginAuthentication();

        $data_brand = array();
        
        $data_brand['brand_name'] = $request_brand->brandName;
        $data_brand['description'] = $request_brand->brandDescription;
        $data_brand['status'] = $request_brand->brandStatus;

        if(DB::table('brands')->where('brand_name',$request_brand->brandName)->first() == null){
	        	
	        DB::table('brands')->insert($data_brand);

	        Session::put('messBrand','Thêm brand mới thành công!!!');
	        return view('admin.brand.add_brand_view');
        }
        Session::put('messBrand','Lỗi: Brand '.$request_brand->brandName.' đã có trong cơ sở dữ liệu!!!');
    	
        return Redirect::to('/admin/brand/add');
    }

    public function delete($brand_id){
        
        $this->loginAuthentication();

        DB::table('brands')->where('brand_id', $brand_id)
                               ->delete();

        Session::put('messCate','Xóa brand thành công!!!');
        return Redirect::to('/admin/brand/view-all');
    }
}
