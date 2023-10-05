use hotelierdb;

update rooms set rooms.quantity = 1 , rooms.status = 1;
update rooms set rooms.quantity = 1 , rooms.status = 1 where rooms.id = 5;
update rooms set  rooms.status = 0 where id in(1,2,3,4,5);
update rooms set rooms.status = 1 where rooms.quantity = 1 or rooms.quantity = 0;
update promotions set promotions.reduciton = 0.10 where promotions.code = "giamgia10phantram";
update room_types set room_types.room_id = 1 where room_types.id = 2;
update room_types set room_types.capactity = 7;
update rooms set rooms.description = 'Thanh toán khi nhận phòng';
update room_types set room_types.image = 'room-1.jpg';
delete from promotions where promotions.code = "giamgia10phantram";
update hotels set hotels.image = 'hotel.jpeg';
update room_types set room_types.capactity = 10 where room_types.num_bed = 2;
update rooms set rooms.price = 300000 where rooms.id in(1);
update rooms set rooms.price = 280000 where rooms.id in(2,3);
update rooms set rooms.price = 200000 where rooms.id in(4);
update rooms set rooms.price = 330000 where rooms.id in(5);
update rooms set rooms.price = 250000 where rooms.id in(6);
update rooms set rooms.price = 350000 where rooms.id in(7);
update rooms set rooms.price = 450000 where rooms.id in(8,9);
update rooms set rooms.price = 400000 where rooms.id in(10);
update rooms set rooms.price = 505000 where rooms.id in(11);
update rooms set rooms.price = 500000 where rooms.id in(12);

update roles set roles.name = 'admin' where roles.id in(1);
update roles set roles.name = 'staff' where roles.id in(2);

update role_users set role_id  = 2 where admin_id in(2);

update rooms set rooms.num_bed = 2 , rooms.num_bath_room = 1, 
rooms.capactity = 7,rooms.area = 45, 
rooms.view = 'nhìn ra thành phố';

update rooms set rooms.num_bed = 3 , rooms.num_bath_room = 1, 
rooms.capactity = 7,rooms.area = 35, 
rooms.view = 'nhìn ra thành phố' where rooms.id = 13;

update rooms set rooms.num_bed = 2 , rooms.num_bath_room = 1, 
rooms.capactity = 7,rooms.area = 30, 
rooms.view = 'nhìn ra thành phố' where rooms.id in(1,2,3,4,5);

update rooms set rooms.num_bed = 2 , rooms.num_bath_room = 1, 
rooms.capactity = 7,rooms.area = 50, 
rooms.view = 'nhìn ra biển' where rooms.id in(6,7,8,9,10);


update services set services.price = 100000 where services.id in(1);
update services set services.price = 200000 where services.id in(2,3);
update services set services.price = 400000 where services.id in(4);
update services set services.price = 55000 where services.id in(5);


select count(*) from rooms, room_types where rooms.room_type_id = room_types.id and rooms.status = 1;
select * from rooms, room_types where rooms.room_type_id = room_types.id and rooms.status = 1;

select * from rooms, hotels where rooms.hotel_id = hotels.id and rooms.status = 1;

select * from rooms, bookings where bookings.room_id = rooms.ibooking_receiptsbooking_detailsd and rooms.status = 1;

select count(*) from rooms where rooms.id = 1;

select * from rooms, room_types where rooms.room_type_id = room_types.id and room_types.id = 3;

select * from promotions where promotions.code = "giamgia10phantram";

select * from bookings,promotions  where bookings.promotion_id = promotions.id and bookings.promotion_id = 31;

delete from rooms where rooms.id =6;

select * from rooms where rooms.room_type_id = 3;

select * from bookings, promotions where bookings.promotion_id = promotions.id;

select total_money - (total_money*reduciton) from bookings, booking_receipts, promotions where bookings.id = booking_receipts.booking_id and bookings.promotion_id = promotions.id and bookings.id=10;

select * from bookings, booking_receipts, promotions where bookings.id = booking_receipts.booking_id and bookings.promotion_id = promotions.id and bookings.id=10;

select * from bookings, booking_receipts, promotions where bookings.id = booking_receipts.booking_id and bookings.promotion_id = promotions.id and bookings.id=11;

select * from bookings, booking_details where bookings.id = booking_details.booking_id and bookings.id=11;

select * from bookings, service_details where bookings.id = service_details.booking_id and bookings.id = 11;

select sum(price) from services where services.id in(1,2);
select sum(price)+300000 from rooms where rooms.id in(11,5);

select sum(price) from rooms where rooms.id in(11,5);

select sum(price) + 300000 -  (sum(price)*0.25) from rooms where rooms.id in(5,6);

select * from room_types where room_types.hotel_id = 1 and room_types.city_id = 1;

select * from bookings, booking_details where bookings.id = booking_details.booking_id and bookings.id=10;

select * from bookings, promotions where promotions.id = bookings.promotion_id;

select * from bookings, booking_details where bookings.id = booking_details.booking_id;

select * from bookings, booking_receipts where bookings.id = booking_receipts.booking_id;

select * from bookings, booking_receipts, booking_details where bookings.id = booking_receipts.booking_id and booking_details.booking_id = bookings.id;

select * from bookings, booking_details where bookings.id = booking_details.booking_id and booking_details.booking_id = 6;

select * from bookings, service_details, promotions where bookings.id = service_details.booking_id and bookings.promotion_id = promotions.id and bookings.promotion_id=1;

select * from bookings, service_details where bookings.id = service_details.booking_id;

select * from booking_receipts, banks where booking_receipts.bank_id = banks.id;

select count(*) from bookings, booking_details where bookings.id = booking_details.booking_id;

select * from bookings, booking_details where bookings.id = booking_details.booking_id and booking_details.room_id = 4;

select reduciton from promotions where promotions.id = 2;

ALTER TABLE bookings
ADD booking_detail_id int;

ALTER TABLE bookings
drop booking_detail_id;

ALTER TABLE bookings
ADD CONSTRAINT bookings_Fk_booking_details
    FOREIGN KEY (booking_detail_id) REFERENCES booking_details(id);
    
drop database hotelierdb;

select * from cities, hotels, rooms where hotels.city_id = cities.id and rooms.hotel_id = hotels.id;

select * from cities, hotels, room_types, rooms where hotels.city_id = cities.id and  rooms.hotel_id = hotels.id and rooms.room_type_id = room_types.id;

select * from cities, hotels, room_types, rooms where hotels.city_id = cities.id and  rooms.hotel_id = hotels.id and rooms.room_type_id = room_types.id and cities.id like '%1%';

select count(*) from cities, hotels, room_types, rooms where hotels.city_id = cities.id and  rooms.hotel_id = hotels.id and rooms.room_type_id = room_types.id;

select * from bookings where bookings.id = 2;

select * from booking_details, bookings, booking_receipts where booking_details.booking_id = bookings.id and booking_receipts.booking_id = bookings.id;

select * from booking_details, bookings, booking_receipts where booking_details.booking_id = bookings.id and booking_receipts.booking_id = bookings.id and booking_receipts.checkout like '%2023-09-15 12:19:00%';

select * from hotels,room_types, rooms where hotels.id = room_types.hotel_id and rooms.room_type_id = room_types.id;

select count(*) from hotels,room_types, rooms where hotels.id = room_types.hotel_id and rooms.room_type_id = room_types.id and rooms.room_type_id = 5;

select * from hotels,room_types, rooms where hotels.id = room_types.hotel_id and rooms.room_type_id = room_types.id and hotels.hotel_type_id = 4;

update hotel_types set hotel_types.name = 'Giá Bình dân' where hotel_types.id in(1);
update hotel_types set hotel_types.name = 'Giá Bình dân' where hotel_types.id in(2);
update hotel_types set hotel_types.name = 'VIP cao cấp' where hotel_types.id in(3);
update hotel_types set hotel_types.name = 'VIP giá phải chăng' where hotel_types.id in(4);
update hotel_types set hotel_types.name = 'VIP giá cao cấp' where hotel_types.id in(5);

update hotels set hotels.city_id = 1 where hotels.id in(1);
update hotels set hotels.city_id = 2 where hotels.id in(2);
update hotels set hotels.city_id = 3 where hotels.id in(3);
update hotels set hotels.city_id = 4 where hotels.id in(4);
update hotels set hotels.city_id = 5 where hotels.id in(5);
update hotels set hotels.city_id = 6 where hotels.id in(6);

update hotels set hotels.name = 'Majestic Sài Gòn' where hotels.id in(1);
update hotels set hotels.name = 'Sheraton Nha Trang' where hotels.id in(2);
update hotels set hotels.name = 'Hanoi Lion Boutique Hotel' where hotels.id in(3);
update hotels set hotels.name = 'Furama Resort Đà Nẵng' where hotels.id in(4);
update hotels set hotels.name = 'Vinpearl Resort & Spa Hội An' where hotels.id in(5);
update hotels set hotels.name = 'Hotel Grand Saigon' where hotels.id in(6);

update cities set cities.name = 'Đà Nẵng' where cities.id in(1);
update cities set cities.name = 'Hồ Chí Minh' where cities.id in(2);
update cities set cities.name = 'Hội An Quảng Nam' where cities.id in(3);
update cities set cities.name = 'Hà Nội' where cities.id in(4);
update cities set cities.name = 'Buôn Mê Thuật Đắk Lắk' where cities.id in(5);

update room_types set room_types.city_id = 1 where room_types.id in(1);
update room_types set room_types.city_id = 2 where room_types.id in(2);
update room_types set room_types.city_id = 2 where room_types.id in(3);
update room_types set room_types.city_id = 4 where room_types.id in(4);
update room_types set room_types.city_id = 5 where room_types.id in(5);
update room_types set room_types.city_id = 5 where room_types.id in(6);

update room_types set room_types.name = 'sang trọng' where room_types.id in(1);
update room_types set room_types.name = 'cao cấp' where room_types.id in(2);
update room_types set room_types.name = 'cổ điển' where room_types.id in(3);
update room_types set room_types.name = 'dễ thương' where room_types.id in(4);
update room_types set room_types.name = 'vừa' where room_types.id in(5);
update room_types set room_types.name = 'rộng rãi' where room_types.id in(6);
update room_types set room_types.capactity = 5;

update hotels set hotels.address = '1 Đ. Đồng Khởi, Bến Nghé, Quận 1, Thành phố Hồ Chí Minh' where hotels.id in(1);
update hotels set hotels.address = 'City, 28 Trần Phú, Lộc Thọ, Nha Trang, Khánh Hòa 650000' where hotels.id in(2);
update hotels set hotels.address = '22 P. Nguyễn Văn Tố, Cửa Đông, Hoàn Kiếm, Hà Nội' where hotels.id in(3);
update hotels set hotels.address = '105 Võ Nguyên Giáp, Khuê Mỹ, Ngũ Hành Sơn, Đà Nẵng 550000' where hotels.id in(4);
update hotels set hotels.address = 'Block 06, Phước Hải, Cửa Đại, Hội An, Quảng Nam 563800' where hotels.id in(5);
update hotels set hotels.address = '8 Đ. Đồng Khởi, Bến Nghé, Quận 1, Thành phố Hồ Chí Minh' where hotels.id in(6);

update hotels set hotels.description = 'Khách sạn sang trọng đẳng cấp của chúng tôi cung cấp các loại phòng ngủ khác nhau để đáp ứng
 nhu cầu của các khách hàng, từ phòng tiêu chuẩn đến các biệt thự hoặc căn hộ cao cấp.';
update rooms set rooms.description = 'Thanh toán sau khi trả phòng';

select hotels.name,hotels.address,cities.name from 
bookings,booking_details,cities,hotels,room_types,rooms where 
bookings.id=booking_details.booking_id and 
booking_details.room_id = rooms.id and 
room_types.id = rooms.room_type_id and
room_types.hotel_id = hotels.id and 
room_types.city_id = cities.id;

select * from 
bookings,booking_details,cities,hotels,room_types,rooms where 
bookings.id=booking_details.booking_id and 
booking_details.room_id = rooms.id and 
room_types.id = rooms.room_type_id and
room_types.hotel_id = hotels.id and 
room_types.city_id = cities.id;

select count(*) from hotels,room_types,rooms where hotels.id=room_types.hotel_id  and room_types.id = rooms.room_type_id and hotels.id=6;

select * from cities,hotels,room_types,rooms where cities.id= room_types.city_id 
and room_types.hotel_id = hotels.id 
and room_types.id = rooms.room_type_id;


select * from hotel_types,hotels where hotel_types.id = hotels.hotel_type_id and hotels.name like '%Majestic Sài Gòn%';
select cities.name as city_name,cities.*,hotel_types.* from cities,hotel_types where cities.id = hotel_types.city_id and hotel_types.city_id = 1;

select * from cities,hotel_types,hotels where cities.id = hotel_types.city_id
and hotel_types.id = hotels.hotel_type_id;

select * from cities,hotels where cities.id = hotels.city_id;

select * from cities,hotel_types,hotels where cities.id = hotels.city_id and hotel_types.id = hotels.hotel_type_id and cities.id = 1;

select * from hotel_types,hotels where hotel_types.id = hotels.hotel_type_id;

select * from rooms,cities,hotels,room_types where cities.id = room_types.city_id 
and hotels.id = room_types.hotel_id
and room_types.id = rooms.room_type_id;

select * from booking_receipts, bookings where  booking_receipts.booking_id = bookings.id 
and booking_receipts.role_user_key like '%98f053c955beddc54259c794878190a282f73d46_4%';

select * from booking_receipts, bookings where  booking_receipts.booking_id = bookings.id;

select * from booking_receipts, booking_details,
bookings ,promotions, rooms, room_types ,
hotels, cities ,services, service_details
where  booking_receipts.booking_id = bookings.id and 
bookings.id = booking_details.booking_id and
rooms.id = booking_details.room_id and
room_types.id = rooms.room_type_id and 
service_details.booking_id = bookings.id and 
services.id = service_details.service_id and 
hotels.id = room_types.hotel_id and
cities.id =  room_types.city_id and
promotions.id = bookings.promotion_id and
booking_receipts.role_user_key like 
'%9e9fc36c6b6e01b8b819924b73b380708db6b350_81%' group by booking_details.id;

select * from booking_receipts, booking_details,bookings where  
booking_details.booking_id = bookings.id and
booking_receipts.booking_id = bookings.id;

select * from booking_receipts, booking_details,bookings where  
booking_details.booking_id = bookings.id and
booking_receipts.booking_id = bookings.id and booking_receipts.id = 69;


select * from service_details, booking_receipts,bookings, services 
where  service_details.booking_id = bookings.id and
booking_receipts.booking_id = bookings.id and
service_details.service_id = services.id and 
booking_receipts.role_user_key='9e9fc36c6b6e01b8b819924b73b380708db6b350_81';

select * from hotel_types, hotels where hotel_types.id  = hotels.hotel_type_id;

select * from booking_receipts where booking_receipts.id=64; 

select * from promotions where promotions.reduciton = 'khuyenmai10phantram';

select * from admins,roles, role_users where 
admins.id = role_users.admin_id and 
roles.id  = role_users.role_id;

select * from admins;
select * from roles;
select * from role_users;

select * from cities;
select * from promotions;
select * from Banks;
select * from booking_details;
select * from booking_receipts;
select * from bookings;
select * from bookings order by id desc;
select * from hotel_types;
select * from hotels;
select * from room_types;
select * from rooms;
select * from service_details;
select * from service_types;
select * from services;



DELETE FROM promotions;
DELETE FROM room_types;
DELETE FROM rooms;
DELETE FROM hotel_types;
DELETE FROM services;
DELETE FROM service_types;
DELETE FROM service_details;
DELETE FROM booking_details;
DELETE FROM booking_receipts;
DELETE FROM bookings;

DELETE FROM hotels;
DELETE FROM cities;
DELETE FROM Banks;



