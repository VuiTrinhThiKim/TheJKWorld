@extends('admin_layout_view')

@section('admin_content')
<div class="row">
	<div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Chỉnh sửa sản phẩm
            </header>
            <?php 
            $editProduct_message = Session::get('messProduct');
            if($editProduct_message) {
                echo '<span class="text-alert">'.$editProduct_message.'</span>';
                Session::put('messProduct', null);
            }
            ?>
            <div class="panel-body">
                @foreach($edit_product as $key => $edit_product)
                <div class="position-center">
                    <form role="form" action="{{URL::to('/admin/product/update/'.$edit_product->product_id)}}" method="post" enctype="multipart/form-data">
                    {{csrf_field() }}
                    <div class="form-group">
                        <label for="productName">Tên sản phẩm</label>
                        <input type="text" value="{{$edit_product->product_name}}" class="form-control" id="productName" name="productName" placeholder="Chân Váy JK" required>
                    </div>
                    <div class="form-group">
                        <label for="productImage">Hình ảnh</label>
                        <input type="file" class="" id="productImage" name="productImage" onload="imagesFileAsURL()">
                    </div>
                    <div class="form-group" id="showImage">
                        <img src="{{URL::to('/public/upload/products/'.$edit_product->product_image)}}" alt="{{('$edit_product->product_name')}}" width="250" height="250">
                    </div>
                    <script type="text/javascript">
                       
                        function imagesFileAsURL(){

                            var removeImage = document.getElementById('showImage');
                            removeImage.parentNode.remove(removeImage);

                            var fileSelected = document.getElementById('productImage').files;

                            if(fileSelected.length > 0){
                                
                                for(var i = 0; i < fileSelected.length; i++){
                                    var fileToLoad = fileSelected[i];

                                    var fileReader = new FileReader();
                                    fileReader.onload = function(fileLoaderEvent){

                                        var srcImage = fileLoaderEvent.target.result;

                                        var newImage = document.createElement('img');
                                        newImage.src = srcImage;
                                        newImage.class = "fileImage"
                                        newImage.style.height = "200px";
                                        newImage.style.width = "200px";

                                        document.getElementById('showImage').innerHTML += newImage.outerHTML;
                                    }

                                    fileReader.readAsDataURL(fileToLoad);
                                }
                            }
                        }
                    </script>
                    <div class="form-group">
                        <label for="productPrice">Giá niêm yết</label>
                        <input type="text" class="form-control" id="productPrice" name="productPrice" placeholder="Chân Váy JK" required value="{{$edit_product->price}}" >
                    </div>
                    <div class="form-group">
                        <label for="productDescription">Mô tả sản phẩm</label>
                        <textarea style="resize: none;" rows=4 class="form-control" id="productDescription" name="productDescription" placeholder="Nhập thông tin" >{{$edit_product->product_description}}</textarea> 
                    </div>
                    <div class="form-group">
                        <label for="productContent">Chi tiết sản phẩm</label>
                        <textarea style="resize: none;" rows=9 class="form-control" id="brandDescription" name="productContent" required placeholder="Nhập thông tin" >{{$edit_product->content}}</textarea> 
                    </div>

                    <div class="form-group">
                        <label for="categoryID">Chọn danh mục</label>
                        <select class="form-control input-sm m-bot15" name="categoryID" required>
                            @foreach($category_list as $key => $category)
                                @if($category->category_id == $edit_product->category_id)
                                <option selected value="{{$category->category_id}}" style="height: 150px; font-size: 14px;">{{$category->category_name}}</option>
                                @else
                                <option value="{{$category->category_id}}" style="height: 150px; font-size: 14px;">{{$category->category_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="brandID">Chọn brand</label>
                        <select class="form-control input-sm m-bot15" name="brandID" >
                            @foreach($brand_list as $key => $brand)
                                @if($brand->brand_id == $edit_product->brand_id)
                                <option selected value="{{$brand->brand_id}}" style="height: 150px; font-size: 14px;">{{$brand->brand_name}}</option>
                                @else
                                <option value="{{$brand->brand_id}}" style="height: 150px; font-size: 14px;">{{$brand->brand_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" name="updateProduct" class="btn btn-info">Cập nhật</button>
                	</form>
                </div>
                @endforeach
            </div>
        </section>
	</div>
</div>
@endsection