@extends('admin_layout_view')

@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách sản phẩm
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <?php 
        $statusProduct_message = Session::get('messProduct');
        if($statusProduct_message) {
            echo '<span class="status_alert">'.$statusProduct_message.'</span>';
            Session::put('messProduct', null);
        }
      ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:10px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th style="width:20%;">Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Giá niêm yết</th>
            <th>Danh mục</th>
            <th>Brand</th>
            <th>Hiển thị</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_products as $key => $product_item)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$product_item->product_name}}</td>
            <td>
                <img src="{{URL::to('/public/upload/products/'.$product_item->product_image)}}" url="{{$product_item->product_image}}" width="80" height="80"></span>
            </td>
            <td>{{$product_item->price}}</span></td>
            <td>{{$product_item->category_name}}</span></td>
            <td>{{$product_item->brand_name}}</span></td>
            <td>
              <?php
                if($product_item->product_status == 0) {
                ?>
                  <a href="{{URL::to('/admin/product/public-product/'.$product_item->product_id)}}"><span class="fa fa-times text-danger text"></span></a>
                <?php
                }
                else {
                  ?>
                  <a href="{{URL::to('/admin/product/unpublic-product/'.$product_item->product_id)}}"><span class="fa fa-check text-success text-active"></span></a>
                <?php
                }
              ?>
            </td>
            <td>
              <a href="{{URL::to('/admin/product/edit/'.$product_item->product_id)}}" class="edit-product" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-edit"></i>
              </a>
              <a a onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')" href="{{URL::to('/admin/product/delete/'.$product_item->product_id)}}" class="delete-product" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection