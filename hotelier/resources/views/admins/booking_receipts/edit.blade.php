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
        <li class="breadcrumb-item active">Chỉnh sửa hóa đơn đặt phòng</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('content')
<!-- general form elements -->
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Chỉnh sửa hóa đơn đặt phòng</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('admin.booking_receipts.update', ['id'=> $booking_receipt->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">

            <div class="form-group">
                <label for="payment_status">Trạng thái thanh toán</label>
                 <select class="form-control" id="payment_status" name="payment_status">
                        @if(old('payment_status', $booking_receipt->payment_status) == 0)
                            <option value="{{ old('payment_status', $booking_receipt->payment_status) }}">
                                Thanh toán tạm thời
                            </option>
                        @else
                             <option value="{{ old('payment_status', $booking_receipt->payment_status) }}">
                                Thanh toán VNpay
                            </option>
                        @endif
            
                        @for ($i = 0; $i<=1; $i++)
                            @if($i == 0)
                                <option value="{{ $i }}">Thanh toán tạm thời</option>
                            @else
                                <option value="{{ $i }}">Thanh toán VNpay</option>
                            @endif
                        @endfor
                </select>
                @error('payment_status')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="cancel_time_status">Trạng thái hủy đơn đặt phòng</label>
                <select class="form-control" id="cancel_time_status" name="cancel_time_status">
                        @if(old('cancel_time_status', $booking_receipt->cancel_time_status) == 0)
                            <option value="{{ old('cancel_time_status', $booking_receipt->cancel_time_status) }}">
                                Chưa hủy đơn đặt phòng
                            </option>
                        @else
                             <option value="{{ old('cancel_time_status', $booking_receipt->cancel_time_status) }}">
                                Đã hủy đơn đặt phòng
                            </option>
                        @endif
            
                        @for ($i = 0; $i<=1; $i++)
                            @if($i == 0)
                                <option value="{{ $i }}">Chưa hủy đơn đặt phòng</option>
                            @else
                                <option value="{{ $i }}">Đã hủy đơn đặt phòng</option>
                            @endif
                        @endfor
                </select>
                @error('cancel_time_status')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <a href="{{ route('admin.booking_receipts.index') }}" class="btn btn-secondary" >Danh sách hóa đơn đặt phòng</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
</div>
<!-- /.card -->
@endsection