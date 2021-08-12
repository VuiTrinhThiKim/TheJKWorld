@extends('admin_layout_view')

@section('admin_content')
<div class="row">
	<div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục sản phẩm
            </header>
            <?php 
            $addCate_message = Session::get('messCate');
            if($addCate_message) {
                echo '<span class="text-alert">'.$addCate_message.'</span>';
                Session::put('messCate', null);
            }
            ?>
            <div class="panel-body">
                <div class="position-center">
                    <form action="{{URL::to('/save-category')}}" role="form" method="post">
                    {{csrf_field() }}
                    <div class="form-group">
                        <label for="categoryName">Tên danh mục</label>
                        <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Chân Váy JK">
                    </div>
                    <div class="form-group">
                        <label for="categoryDescription">Thông tin danh mục</label>
                        <textarea style="resize: none;" rows=9 class="form-control" id="categoryDescription" name="categoryDescription" placeholder="Nhập thông tin"></textarea> 
                    </div>
                    <div class="form-group">
                    	<label for="categoryStatus">Hiển thị danh mục lên website</label>
                        <select class="form-control input-sm m-bot15" name="categoryStatus">
                            <option value="0" style="height: 150px; font-size: 14px;">Ẩn</option>
                            <option value="1" style="height: 150px; font-size: 14px;">Hiển thị</option>
                        </select>
                    </div>
                    <button type="submit" name="addCategory" class="btn btn-info">Thêm danh mục</button>
                	</form>
                </div>
            </div>
        </section>
	</div>
</div>
@endsection