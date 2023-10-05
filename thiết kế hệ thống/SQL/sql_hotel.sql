create database if not exists hotelierdb collate utf8_unicode_ci;

use hotelierdb;

drop table admins;
drop table roles;
drop table role_users;
drop table permissions;
drop table permission_roles;

ALTER TABLE role_users
MODIFY COLUMN admin_id BIGINT(20);
ALTER TABLE admins MODIFY COLUMN id INT AUTO_INCREMENT;
ALTER TABLE role_users MODIFY COLUMN id INT AUTO_INCREMENT;
ALTER TABLE role_users DROP FOREIGN KEY fk_role_users_admins;
ALTER TABLE role_users ADD created_at TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE role_users ADD updated_at TIMESTAMP NULL DEFAULT NULL;

CREATE TABLE admins (
    id INT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
	email_verified_at timestamp,
    remember_token VARCHAR(100),
	created_at datetime ,
	updated_at datetime
);


CREATE TABLE roles (
    id INT PRIMARY KEY,
    name VARCHAR(50)
);

CREATE TABLE role_users (
    id INT PRIMARY KEY,
    admin_id INT null,
    role_id INT
   
);

CREATE TABLE permissions (
    id INT PRIMARY KEY,
    name VARCHAR(50)
);

CREATE TABLE permission_roles (
    id INT PRIMARY KEY,
    role_id INT,
    permission_id INT
);

ALTER TABLE role_users
ADD CONSTRAINT fk_role_users_admins
FOREIGN KEY (admin_id) REFERENCES admins(id);

ALTER TABLE role_users
ADD CONSTRAINT fk_role_users_roles
FOREIGN KEY (role_id) REFERENCES roles(id);

ALTER TABLE permission_roles
ADD CONSTRAINT fk_permission_roles_roles
FOREIGN KEY (role_id) REFERENCES roles(id);

ALTER TABLE permission_roles
ADD CONSTRAINT fk_permission_roles_permissions
FOREIGN KEY (permission_id) REFERENCES permissions(id);

CREATE TABLE cities(
    id     int PRIMARY KEY,
    name     NVARCHAR(255)
    
);

CREATE TABLE hotel_types(
    id     int PRIMARY KEY,
    name     NVARCHAR(255),
    star int
);

CREATE TABLE hotels(
    id     int PRIMARY KEY,
    name   VARCHAR(255),
    address       VARCHAR(50),
    city_id int,
    hotel_type_id int,
    description text
);


CREATE TABLE room_types(
    id     int PRIMARY KEY,
    name   VARCHAR(50),
    num_bed       int,
    num_bath_room int,
    image text,
    capactity int
    
);

CREATE TABLE rooms(
    id   int PRIMARY KEY,
    name varchar(55),
    price  decimal,
    description text,
    quantity int,
    status tinyint,
    area int,
    view VARCHAR(255),
    hotel_id int,
    room_type_id int
);

CREATE TABLE service_types(
    id     int PRIMARY KEY,
	name   VARCHAR(255),
    description text
);

CREATE TABLE services(
    id     int PRIMARY KEY,
	name   VARCHAR(255),
    image text,
    price decimal,
    service_type_id int
);

CREATE TABLE bookings(
    id     int PRIMARY KEY,
    full_name VARCHAR(255),
    email       VARCHAR(255),
    phone VARCHAR(50),
    address VARCHAR(500),
    check_in datetime,
    note text,
    service_id int,
    promotion_id int,
    room_id int
);

CREATE TABLE promotions(
    id     int PRIMARY KEY,
    code     varchar(255),
    reduciton decimal
);

CREATE TABLE booking_receipts(
    id     int PRIMARY KEY,
    check_out datetime,
	cancel_time_status tinyint,
	payment_status tinyint,
    booking_id     int
);


ALTER TABLE rooms
ADD CONSTRAINT rooms_Fk_room_types
    FOREIGN KEY (room_type_id) REFERENCES room_types(id);


ALTER TABLE rooms
ADD CONSTRAINT rooms_Fk_hotels
    FOREIGN KEY (hotel_id) REFERENCES hotels(id);
    

ALTER TABLE hotels
ADD CONSTRAINT hotels_Fk_hotel_types
    FOREIGN KEY (hotel_type_id) REFERENCES hotel_types(id);

ALTER TABLE hotels
ADD CONSTRAINT hotels_Fk_cities
    FOREIGN KEY (city_id) REFERENCES cities(id);

ALTER TABLE services
ADD CONSTRAINT services_Fk_service_types
    FOREIGN KEY (service_type_id) REFERENCES service_types(id);

ALTER TABLE bookings
ADD CONSTRAINT bookings_Fk_rooms
    FOREIGN KEY (room_id) REFERENCES rooms(id);

ALTER TABLE bookings
ADD CONSTRAINT bookings_Fk_services
    FOREIGN KEY (service_id) REFERENCES services(id);
    
ALTER TABLE bookings
ADD CONSTRAINT bookings_Fk_promotions
    FOREIGN KEY (promotion_id) REFERENCES promotions(id);

ALTER TABLE booking_receipts
ADD CONSTRAINT booking_receipts_Fk_bookings
    FOREIGN KEY (booking_id) REFERENCES bookings(id);
    
ALTER TABLE role_user
ADD CONSTRAINT role_user_Fk_users
    FOREIGN KEY (user_id) REFERENCES users(id);
    
ALTER TABLE role_user
ADD CONSTRAINT role_user_Fk_roles
    FOREIGN KEY (role_id) REFERENCES roles(id);

ALTER TABLE permission_role
ADD CONSTRAINT permission_role_Fk_roles
    FOREIGN KEY (role_id) REFERENCES roles(id);

ALTER TABLE permission_role
ADD CONSTRAINT permission_role_Fk_permissions
    FOREIGN KEY (permission_id) REFERENCES permissions(id);
    
ALTER TABLE rooms
DROP FOREIGN KEY rooms_Fk_servive_types;   

ALTER TABLE room_types
ADD image text;

ALTER TABLE booking_receipts
ADD role_user_key text;

ALTER TABLE booking_receipts
ADD booking_now datetime;

ALTER TABLE booking_receipts
ADD payment_method_status int;

ALTER TABLE booking_receipts
ADD flag_status int;

ALTER TABLE hotels
ADD image text;

ALTER TABLE rooms
add num_bath_room int null;
ALTER TABLE rooms
add num_bed int null;
ALTER TABLE rooms
add area int null;
ALTER TABLE rooms
add view text null;
ALTER TABLE rooms
add capactity int null;

ALTER TABLE hotels MODIFY COLUMN image VARCHAR(255) DEFAULT 'hotel.jpeg';
ALTER TABLE booking_receipts MODIFY expiry_date DATETIME NULL;
ALTER TABLE booking_receipts MODIFY number_card varchar(255) NULL;
ALTER TABLE cities MODIFY image varchar(255) NULL;
ALTER TABLE hotels MODIFY COLUMN image VARCHAR(255) NULL;

drop database hotelierdb;
drop database hotelier;
drop table roles;
drop table role_users;
drop table permissions;
drop table permission_role;

INSERT INTO roles (id, name)
VALUES
    (1, 'admin'),
    (2, 'staff'),
    (3, 'management'),
    (4, 'staff4'),
    (5, 'staff5');
    
INSERT INTO role_users(id, admin_id, role_id)
VALUES
    (1, 11,1),
    (2, 2, 2),
    (3, 3, 2),
    (4, 4, 2),
    (5, 5, 2);

-- cities
INSERT INTO cities (id, name,image, created_at, updated_at)
VALUES
    (1, 'New York','danang.jpg', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (2, 'Los Angeles','danang.jpg', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (3, 'Chicago','danang.jpg', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (4, 'Houston','danang.jpg', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (5, 'Miami','danang.jpg', '2023-08-23 09:25:55', '2023-08-23 09:25:55');

INSERT INTO cities (id, name,image, created_at, updated_at)
VALUES
    (6, 'Nha Trang','danang.jpg', '2023-08-23 09:25:55', '2023-08-23 09:25:55');

INSERT INTO cities (id, name, image, created_at, updated_at)
VALUES (7, 'Vũng Tàu', 'vungtau.jpg', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (8, 'Phan Thiết', 'phanthiet.jpg', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (9, 'Quy Nhơn', 'quynhon.jpg', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (10, 'Huế', 'hue.jpg', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (11, 'Quảng Ninh', 'quangninh.jpg', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (12, 'Hạ Long', 'halong.jpg', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (13, 'Ninh Bình', 'ninhbinh.jpg', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (14, 'Thanh Hóa', 'thanhhoa.jpg', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (15, 'Hà Tĩnh', 'hatinh.jpg', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (16, 'Quảng Bình', 'quangbinh.jpg', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (17, 'Đà Lạt', 'dalat.jpg', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (18, 'Vinh', 'vinh.jpg', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (19, 'Cà Mau', 'camau.jpg', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (20, 'Nam Định', 'caobang.jpg', '2023-08-23 09:25:55', '2023-08-23 09:25:55');


-- hotel_types
INSERT INTO hotel_types (id, name, star,created_at, updated_at)
VALUES
    (1, 'Budget Hotel', 2, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (2, 'Mid-range Hotel', 3, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (3, 'Luxury Hotel', 5, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (4, 'Boutique Hotel', 4, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (5, 'Resort', 4, '2023-08-23 09:25:55', '2023-08-23 09:25:55');


-- hotels
INSERT INTO hotels (id, name,image, address, description, hotel_type_id, city_id, created_at, updated_at)
VALUES
    (1, 'Downtown Suites','hotel.jpeg', '123 Main St', '', 3,2 ,'2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (2, 'Sunset Resort','hotel.jpeg', '456 Beach Rd', '', 5,6 ,'2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (3, 'Cityscape Hotel','hotel.jpeg', '789 Skyline Ave', '' , 2, 4, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (4, 'Garden Plaza Inn','hotel.jpeg', '101 Garden Rd', '',  1, 1, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (5, 'Elegant Manor','hotel.jpeg', '555 Grand Ave', '',4, 3, '2023-08-23 09:25:55', '2023-08-23 09:25:55');


INSERT INTO hotels (id, name,image, address, description, hotel_type_id, city_id, created_at, updated_at)
VALUES
    (6, 'Downtown Suites','hotel.jpeg', '123 Main St', '',3, 2, '2023-08-23 09:25:55', '2023-08-23 09:25:55');

INSERT INTO hotels (id, name,image, address, description, hotel_type_id, city_id, created_at, updated_at)
VALUES
    (7, 'SOJO Hotel Nam Dinh','hotel.jpeg', '272 Trần Hưng Đạo, Bà Triệu, TP. Nam Định, Nam Định 07000', 
    'Khách sạn 3.5 sao với nhà hàng, gần Cột cờ Nam Định',6, 20, '2023-08-23 09:25:55', '2023-08-23 09:25:55');
    
-- rooms

-- service_types
INSERT INTO service_types (id, name, description, created_at, updated_at)
VALUES
    (1, 'Room Service', 'In-room dining and services', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (2, 'Spa', 'Relaxing spa treatments', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (3, 'Fitness Center', 'Access to the hotel fitness center', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (4, 'Transportation', 'Airport shuttle and transportation services', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (5, 'Concierge', 'Personalized concierge services', '2023-08-23 09:25:55', '2023-08-23 09:25:55');

-- services
INSERT INTO services (id, name, image, price, service_type_id, created_at, updated_at)
VALUES
    (1, 'Gourmet Breakfast', 'breakfast.jpg', 200000.00, 1, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (2, 'Deep Tissue Massage', 'massage.jpg', 800000.00, 2, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (3, 'Gym Access', 'gym.jpg', 1500000.00, 3, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (4, 'Airport Shuttle', 'shuttle.jpg', 300000.00, 4, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (5, 'Personal Assistant', 'concierge.jpg', 500000.00, 5, '2023-08-23 09:25:55', '2023-08-23 09:25:55');

-- promotions
INSERT INTO promotions (id, code, reduciton, created_at, updated_at)
VALUES
    (1, 'SUMMER25', 0.25, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (2, 'FALL15', 0.15, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (3, 'WINTER30', 0.30, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (4, 'SPRING20', 0.20, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (5, 'EARLYBIRD10', 0.10, '2023-08-23 09:25:55', '2023-08-23 09:25:55');

INSERT INTO room_types (id, name, num_bed, num_bath_room, image, capactity, area, view, hotel_id,city_id, created_at, updated_at)
VALUES
    (1, 'Standard Room', 2, 1, 'room-1.jpg', 10, 30, 'City View', 1, 2, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (2, 'Deluxe Room', 2, 1,'room-1.jpg', 10, 40,'Ocean View',  2, 6,'2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (3, 'Suite Room', 2, 1,'room-1.jpg', 10,45,'Skyline View',  2, 6, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (4, 'Family Room', 2, 1,'room-1.jpg', 10,35,'Big View',  4, 1,'2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (5, 'Penthouse Suite', 2, 1, 'room-1.jpg', 10, 50,'Skyscraper view', 5, 3, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (6, 'Big Penthouse', 2, 1, 'room-1.jpg', 10, 50,'Skyscraper view', 3, 4, '2023-08-23 09:25:55', '2023-08-23 09:25:55');

INSERT INTO rooms (id, name, price, description, quantity, status, room_type_id, created_at, updated_at)
VALUES
    (1, 'Standard Room', 250000, 'Thanh toán sau khi nhận phòng', 1, 1, 1, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (2, 'Deluxe Room', 300000, 'Thanh toán sau khi nhận phòng', 1, 1,  2, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (3, 'Suite Room', 350000, 'Thanh toán sau khi nhận phòng', 1, 1, 3, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (4, 'Family Room', 280000, 'Thanh toán sau khi nhận phòng', 1, 1, 4, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (5, 'Penthouse Suite', 500000, 'Thanh toán sau khi nhận phòng', 1, 1, 5, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (6, 'Penthouse Suite222222', 290000, 'Thanh toán sau khi nhận phòng', 1, 1, 5, '2023-08-23 09:25:55', '2023-08-23 09:25:55');

INSERT INTO rooms (id, name, price, description, quantity, status, room_type_id, created_at, updated_at)
VALUES
    (10, 'Standard Room2', 520000, 'Thanh toán sau khi nhận phòng', 1, 1, 2, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (7, 'Deluxe Room3', 333000, 'Thanh toán sau khi nhận phòng', 1, 1, 3, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (8, 'Suite Room4', 355000, 'Thanh toán sau khi nhận phòng', 1, 1, 2, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (9, 'Family Room5', 550000, 'Thanh toán sau khi nhận phòng', 1, 1 , 2, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (11, 'Penthouse Suite6666', 600000, 'Thanh toán sau khi nhận phòng', 1, 1, 5, '2023-08-23 09:25:55', '2023-08-23 09:25:55');

INSERT INTO rooms (id, name, price, description, quantity, status, room_type_id, created_at, updated_at)
VALUES (12, 'Standard Room555', 300000, 'Thanh toán sau khi nhận phòng', 1, 1, 6, '2023-08-23 09:25:55', '2023-08-23 09:25:55');

INSERT INTO booking_details (id, room_id, service_id, booking_id, created_at, updated_at)
VALUES
(1, 1, 2, 1, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
(2, 1, 2, 1,'2023-08-23 09:25:55', '2023-08-23 09:25:55'),
(3, 4, 1, 1,'2023-08-23 09:25:55', '2023-08-23 09:25:55'),
(4, 3, 2, 1,'2023-08-23 09:25:55', '2023-08-23 09:25:55'),
(5, 5, 2, 1,'2023-08-23 09:25:55', '2023-08-23 09:25:55');
-- bookings
INSERT INTO bookings (id, fullname, email, phone, address, checkin, note, promotion_id, created_at, updated_at)
VALUES(1, 'John Smith', 'john@example.com', '123-456-7890', '456 Park St', '2023-08-25', 'Early check-in requested',  1,  '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (2, 'Emily Johnson', 'emily@example.com', '987-654-3210', '789 Lake Rd', '2023-09-05', 'Special dietary preferences',  2,  '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (3, 'Michael Davis', 'michael@example.com', '555-555-5555', '101 Pine Ave', '2023-08-30', 'Special dietary preferences',  2,  '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (4, 'Sophia Williams', 'sophia@example.com', '111-222-3333', '222 Maple Ln', '2023-09-15', 'Late check-out requested', 2,   '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (5, 'Daniel Brown', 'daniel@example.com', '444-444-4444', '333 Oak Dr', '2023-08-27',  'Late check-out requesteddsds' , 2,  '2023-08-23 09:25:55', '2023-08-23 09:25:55');

INSERT INTO bookings (id, fullname, email, phone, address, checkin, note, booking_detail_id, promotion_id, created_at, updated_at)
VALUES (1, 'John Smith', 'john@example.com', '123-456-7890', '456 Park St', '2023-08-25', 'Early check-in requested', 1,  '2023-08-23 09:25:55', '2023-08-23 09:25:55');

-- booking_receipts
INSERT INTO booking_receipts (id, checkout, cancel_time_status, payment_status, booking_id, created_at, updated_at)
VALUES
    (1, '2023-09-02', 0, 1, 1, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (2, '2023-09-10', 1, 0, 2, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (3, '2023-09-01', 0, 1, 3, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (4, '2023-09-18', 0, 0, 4, '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (5, '2023-09-05', 0, 1, 5, '2023-08-23 09:25:55', '2023-08-23 09:25:55');
    
INSERT INTO banks (id, name , created_at, updated_at)
VALUES
    (1, 'Visa', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (2, 'BIDV', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (3, 'SacomBank', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (4, 'VP Bank', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (5, 'ViettinBank', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (6, 'AgriBank', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (7, 'MB Bank', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (8, 'SaiGon Bank', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (9, 'VietCom Bank', '2023-08-23 09:25:55', '2023-08-23 09:25:55'),
    (10, 'Techcom Bank', '2023-08-23 09:25:55', '2023-08-23 09:25:55');





