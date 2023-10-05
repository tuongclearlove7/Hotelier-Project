create database if not exists vanphongpham collate utf8_unicode_ci;
use vanphongpham;
drop database vanphongpham;

create table khachhang (

	makh int  primary key,
    hoten varchar(255),
    diachi varchar(255),
	sdt varchar(255)
);

create table vanphongpham (

	ma_vpp int  primary key,
    ten_vpp varchar(255),
    ngaysx datetime,
	noisx varchar(255),
    dvt varchar(255),
    han_dung datetime
);



create table phieuxuat (

	ma_px int  primary key,
    makh varchar(255),
    ngay_lap_px datetime
	
);

create table chitiet_phieuxuat (

	ma_px int  primary key,
    ma_vpp int,
    so_luong int,
    dongia decimal
	
);


CREATE TABLE khachhang (
    makh INT PRIMARY KEY,
    hoten VARCHAR(255),
    diachi VARCHAR(255),
    sdt VARCHAR(255)
);

CREATE TABLE vanphongpham (
    ma_vpp INT PRIMARY KEY,
    ten_vpp VARCHAR(255),
    ngaysx DATETIME,
    noisx VARCHAR(255),
    dvt VARCHAR(255),
    han_dung DATETIME
);

CREATE TABLE phieuxuat (
    ma_px INT PRIMARY KEY,
    makh int,
    ngay_lap_px DATETIME,
    FOREIGN KEY (makh) REFERENCES khachhang(makh)
);

CREATE TABLE chitiet_phieuxuat (
    ma_px INT,
    ma_vpp INT,
    so_luong INT,
    dongia DECIMAL,
    PRIMARY KEY (ma_px, ma_vpp),
    FOREIGN KEY (ma_px) REFERENCES phieuxuat(ma_px),
    FOREIGN KEY (ma_vpp) REFERENCES vanphongpham(ma_vpp)
);




ALTER TABLE phieuxuat
ADD CONSTRAINT FK_phieuxuat_khachhang
FOREIGN KEY (makh) REFERENCES khachhang(makh);

ALTER TABLE chitiet_phieuxuat
ADD CONSTRAINT FK_chitiet_phieuxuat_phieuxuat
FOREIGN KEY (ma_px) REFERENCES phieuxuat(ma_px);

ALTER TABLE chitiet_phieuxuat
ADD CONSTRAINT FK_chitiet_phieuxuat_vanphongpham
FOREIGN KEY (ma_vpp) REFERENCES vanphongpham(ma_vpp);









