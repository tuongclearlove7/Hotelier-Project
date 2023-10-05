@extends('admins.layouts.master')

{{-- set page title --}}
@section('title', 'Admin Hotelier')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Quản lý chi tiết dịch vụ</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
        <li class="breadcrumb-item active">Danh sách chi tiết dịch vụ</li>
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
                    <h3 class="card-title">Danh sách chi tiết dịch vụ</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if(!empty($service_details))
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th data-visible="true">ID</th>
                                    <th data-visible="true">Mã Booking</th>
                                    <th data-visible="true">Tên khách hàng</th>
                                    <th data-visible="true">Dịch vụ khách hàng chọn</th>
                                    <th data-visible="true">Giá dịch vụ</th>
                                 
                                    <th data-visible="true"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($service_details as $service_detail)
                                    <tr>
                                        <td>{{ $service_detail->id }}</td>
                                        <td>{{ $service_detail->booking_id }}</td>
                                        <td>{{ $service_detail->booking->fullname }}</td>
                                        <td>{{ $service_detail->service->name }}</td>
                                        <?php    $formattedMoneyold = number_format( $service_detail->service->price, 0, ",", ".") . " VNĐ"; ?>

                                        <td>{{  $formattedMoneyold }}</td>

                                        <td class="project-actions text-right">
                                            <a class="btn btn-info btn-sm" href="{{ route('admin.service_details.edit', [ 'id' => $service_detail->id]) }}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Chỉnh sửa
                                            </a>
                                            <form action="{{ route('admin.service_details.destroy', ['id' => $service_detail->id]) }}" method="post" class="btn btn-sm">
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
                                    <th>service_detail</th>
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