@extends('admin_layout_view')

@section('admin_content')
<div class="row">
	<div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Chỉnh sửa danh mục sản phẩm
            </header>
            <?php 
            $addBrand_message = Session::get('messBrand');
            if($addBrand_message) {
                echo '<span class="text-alert">'.$addBrand_message.'</span>';
                Session::put('messBrand', null);
            }
            ?>
            <div class="panel-body">
                @foreach($edit_brand as $key => $edit_brand)
                <div class="position-center">
                    <form role="form" action="{{URL::to('/admin/brand/update-brand/'.$edit_brand->brand_id)}}" method="post">
                    {{csrf_field() }}
                    <div class="form-group">
                        <label for="brandName">Tên danh mục</label>
                        <input type="text" value="{{$edit_brand->brand_name}}" class="form-control" id="brandName" name="brandName" placeholder="Chân Váy JK" required>
                    </div>
                    <div class="form-group">
                        <label for="brandDescription">Thông tin brand</label>
                        <textarea style="resize: none;" rows=9 class="form-control" id="brandDescription" name="brandDescription" required placeholder="Nhập thông tin">{{$edit_brand->description}}</textarea> 
                    </div>
                    <button type="submit" name="updateBrand" class="btn btn-info">Cập nhật</button>
                	</form>
                </div>
                @endforeach
            </div>
        </section>
	</div>
</div>
@endsection