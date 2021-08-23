@extends('admin_layout_view')

@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách người dùng
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
        $statusUser_message = Session::get('messUser');
        if($statusUser_message) {
            echo '<span class="status_alert">'.$statusUser_message.'</span>';
            Session::put('messUser', null);
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
            <th style="width:15%;">Tên đăng nhập</th>
            <th>Ảnh đại diện</th>
            <th>Họ tên</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Loại tài khoản</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_users as $key => $user)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$user->username}}</td>
            <td>
                <img src="{{URL::to('/public/upload/avatar/'.$user->avatar)}}" url="{{$user->avatar}}" width="80" height="80"></span>
            </td>
            <td>{{$user->first_name}} {{$user->last_name}}</span></td>
            <td>{{$user->phone}}</span></td>
            <td style="width:10%;">{{$user->address}}</span></td>
            <td>{{$user->role_name}}</span></td>
            <td>
              <a href="{{URL::to('/admin/user/edit/'.$user->user_id)}}" class="edit-product" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-edit"></i>
              </a>
              <a a onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')" href="{{URL::to('/admin/user/delete/'.$user->user_id)}}" class="delete-product" ui-toggle-class="">
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