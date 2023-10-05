@extends('admins.layouts.master')

{{-- set page title --}}
@section('title', 'Admin Hotelier')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Quản lý hóa đơn đặt phòng</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
        <li class="breadcrumb-item active">Danh sách hóa đơn đặt phòng</li>
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
                    <h3 class="card-title">Danh sách hóa đơn đặt phòng</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if(!empty($booking_receipts))
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th data-visible="true">ID</th>
                                    <th data-visible="true">Tên khách hàng</th>
                                    <th data-visible="true">SĐT khách hàng</th>
                                    <th data-visible="true">Ngày nhận phòng</th>
                                    <th data-visible="true">Ngày trả phòng</th>
                                    <th data-visible="true">Trạng thái hủy đơn</th>
                                    <th data-visible="true">Trạng thái thanh toán</th>
                                    <th data-visible="true">Tên thẻ</th>
                                    <th data-visible="true">Số thẻ</th>
                                    <th data-visible="true">Số khách</th>
                                    <th data-visible="true">Tổng tiền thanh toán</th>
                                    <th data-visible="true">Giảm giá</th>
                                    <th data-visible="true"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($booking_receipts as $booking_receipt)
                                    <tr>
                                        <td>{{ $booking_receipt->id }}</td>
                                        <td>{{ $booking_receipt->booking->fullname }}</td>
                                        <td>{{ $booking_receipt->booking->phone }}</td>
                                        <td>{{ $booking_receipt->booking->checkin }}</td>
                                        <td>{{ $booking_receipt->checkout }}</td>
                                        @if($booking_receipt->cancel_time_status == 0)
                                            <td>Chưa hủy đơn đặt phòng</td>
                                        @else
                                            <td>Đã hủy đơn đặt phòng</td>
                                        @endif
                                        @if($booking_receipt->payment_status == 0 && $booking_receipt->payment_method_status == 0)
                                            <td>Thanh toán tạm thời</td>
                                        @else
                                            <td>Đã thanh toán bằng VNpay</td>
                                        @endif
                                        <td>{{ $booking_receipt->bank ? 
                                        $booking_receipt->bank->name : 'Đã thanh toán trực tuyến' }}</td>
                                        @if($booking_receipt->number_card)
                                            <td>{{ $booking_receipt->number_card }}</td>
                                        @else
                                            <td>Thanh toán VNpay</td>
                                        @endif
                                        <td>{{ $booking_receipt->booking->num_guest }} người </td>
                                        <td>
                                            <?php    $formattedMoneyold = number_format( $booking_receipt->total_money, 0, ",", ".") . " VNĐ"; ?>
                                            {{ $formattedMoneyold }}
                                        </td>
                                        <td>
                                            {{ $booking_receipt->booking->promotion ? 
                                            $booking_receipt->booking->promotion->reduciton*100 ."%" : '0%' }}
                                        </td>

                                        <td class="project-actions text-right">
                                            <a class="btn btn-info btn-sm" href="{{ route('admin.booking_receipts.edit', [ 'id' => $booking_receipt->id]) }}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Chỉnh sửa
                                            </a>
                                            <form action="{{ route('admin.booking_receipts.destroy', ['id' => $booking_receipt->id]) }}" method="post" class="btn btn-sm">
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