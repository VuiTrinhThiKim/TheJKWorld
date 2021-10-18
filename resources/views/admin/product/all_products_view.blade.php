@extends('admin_layout_view')

@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách sản phẩm
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <form action="{{URL::to('/admin/product/filter')}}">
          {{csrf_field()}}

          <select class="input-sm form-control w-sm inline v-middle" name="filter">
            <option value="0">Xem tất cả</option>
            <option value="1">Sắp xếp theo tên từ A-Z </option>
            <option value="2">Sắp xếp theo tên từ Z-A</option>
            <option value="3">Sắp xếp theo giá tăng</option>
            <option value="4">Sắp xếp theo giá giảm</option>
            <option value="5">Đang hiển thị trên web</option>
            <option value="6">Đang bị ẩn khỏi web</option>
          </select>
          <button class="btn btn-sm btn-default" type="submit">Áp dụng</button>
        </form>        
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Tên sản phẩm">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Tìm!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <?php 
        $statusProduct_message = Session::get('messProduct');
        if($statusProduct_message) {
            echo '<div class="status_alert">'.$statusProduct_message.'</div>';
            Session::put('messProduct', null);
        }
      ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:5%;">ID</th>
            <th style="width:20%;">Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Giá niêm yết</th>
            <th>Tồn kho</th>
            <th>Danh mục</th>
            <th>Brand</th>
            <th>Hiển thị</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($products as $key => $product_item)
          <tr>
            <td>{{$product_item->product_id}}</td>
            <td>{{$product_item->product_name}}</td>
            <td>
                <img src="{{URL::to('/upload/products/'.$product_item->product_image)}}" url="{{$product_item->product_image}}" width="80" height="80"></span>
            </td>
            <td>{{$product_item->price}}</span></td>
            <td>
              {{$product_item->product_qty}}
              @if($product_item->product_qty <= 5)
              <i class="fa fa-exclamation" style="color: red;"></i>
              @endif
            </td>
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
              <a onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')" href="{{URL::to('/admin/product/delete/'.$product_item->product_id)}}" class="delete-product" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <!--Pagination-->
      {{ $products->links('admin.pagination') }}
    </footer>
  </div>
</div>
@endsection