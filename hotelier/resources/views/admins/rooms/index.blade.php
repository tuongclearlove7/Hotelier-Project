@extends('admins.layouts.master')

{{-- set page title --}}
@section('title', 'Admin Hotelier')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Quản lý phòng</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
        <li class="breadcrumb-item active">Danh sách phòng</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('content')
    {{-- show message --}}
    @if(Session::has('success'))
        <p class="text-success">{{ Session::get('success') }}</p>
    @endif

    {{-- show error message --}}
    @if(Session::has('error'))
        <p class="text-danger">{{ Session::get('error') }}</p>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách phòng</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if(!empty($rooms))
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th data-visible="true">ID</th>
                                    <th data-visible="true">Tên phòng</th>
                                    <th data-visible="true">Số lượng phòng</th>
                                    <th data-visible="true">Ảnh phòng</th>
                                    <th data-visible="true">Trạng thái</th>
                                    <th data-visible="true">Số giường</th>
                                    <th data-visible="true">Số phòng tắm</th>
                                    <th data-visible="true">Khung nhìn</th>
                                    <th data-visible="true">Giá phòng</th>
                                    <th data-visible="true">Diện tích</th>
                                    <th data-visible="true">Khách sạn</th>
                                    <th data-visible="true">Thành phố</th>

                                    <th data-visible="true"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rooms as $room)
                                    <tr>
                                        <td>{{ $room->id }}</td>
                                        <td>{{ $room->name }}</td>
                                        <td>{{ $room->quantity }}</td>
                                       
                                        <td>
                                        <img width="100%" height="70%" src="{{asset('customer/img/' .$room->room_type->image)}}" alt="{{$room->room_type->image}}">
                                        </td>
                                        @if($room->status == 0)
                                            <td>Hết phòng</td>
                                        @else
                                            <td>Còn trống</td>
                                        @endif
                                        <td>{{ $room->num_bed }}</td>
                                        <td>{{ $room->num_bath_room }}</td>
                                        <td>{{ $room->view }}</td>
                                        <?php    $formattedMoneyold = number_format( $room->price, 0, ",", ".") . " VNĐ"; ?>

                                        <td>{{ $formattedMoneyold }}</td>
                                        <td>{{ $room->area ." m2"}}</td>
                                        <td>{{ $room->room_type->hotel->name}}</td>
                                        <td>{{ $room->room_type->hotel->city->name}}</td>

                                        <td class="project-actions text-right">
                                            <a class="btn btn-info btn-sm" href="{{ route('admin.rooms.edit', [ 'id' => $room->id]) }}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Chỉnh sửa
                                            </a>
                                            <form action="{{ route('admin.rooms.destroy', ['id' => $room->id]) }}" method="post" class="btn btn-sm">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirm delete ?')"><i class="fas fa-trash"></i> Xóa</button>
                                            </form>
                                        </td>
                                    </tr>                                
                                @endforeach 
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Phòng</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>


                                </tr>
                            </tfoot>
                        </table>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection