create table assets
(
    id int auto_increment
        primary key,
    asset_type varchar(255) not null,
    asset_name varchar(255) not null,
    asset_rehearsal_charge decimal(6,2) not null,
    asset_availability tinyint(1) default 1 not null
);


create table asset_usages
(
    id int auto_increment
        primary key,
    asset_id int not null,
    asset_usages_date date not null,
    asset_usages_session char(2) not null,
    constraint asset_usages_assets_id_fk
        foreign key (asset_id) references assets (id)
);



create table assets_bookings
(
    id int auto_increment
        primary key,
    assets_bookings_session char(2) null,
    assets_bookings_date date null,
    asset_id int not null,
    booking_id int not null,
    constraint assets_bookings_assets_id_fk
        foreign key (asset_id) references assets (id),
    constraint assets_bookings_bookings_id_fk
        foreign key (booking_id) references bookings (id)
);

create table bands
(
    id int auto_increment
        primary key,
    band_name varchar(255) not null
);

create table bands_clients
(
    id int auto_increment
        primary key,
    band_id int not null,
    client_id int not null,
    constraint bands_clients_bands_id_fk
        foreign key (band_id) references bands (id),
    constraint bands_clients_clients_id_fk
        foreign key (client_id) references clients (id)
);

create table bookings
(
    id int auto_increment
        primary key,
    booking_type varchar(255) not null,
    booking_total_charge decimal(6,2) not null,
    booking_date_from date not null,
    booking_date_to date not null,
    room_id int null,
    studio_id int null,
    booking_session char(2) not null,
    booking_notes varchar(1000) default '' not null,
    staff_code char(4) null,
    display_name varchar(255) not null,
    status varchar(255) null,
    constraint bookings_rooms_id_fk
        foreign key (room_id) references rooms (id),
    constraint bookings_studios_id_fk
        foreign key (studio_id) references studios (id)
);



create table bookings_clients
(
    id int auto_increment
        primary key,
    booking_id int not null,
    client_id int not null,
    user_id int null,
    constraint bookings_clients_bookings_id_fk
        foreign key (booking_id) references bookings (id),
    constraint bookings_clients_clients_id_fk
        foreign key (client_id) references clients (id)
);

create table checkout
(
    id int auto_increment
        primary key,
    checkout_code varchar(255) not null,
    booking_id int null,
    transaction_code varchar(255) null,
    payment_code varchar(255) null,
    location_code varchar(255) null,
    idempotency_key varchar(255) null,
    status varchar(255) null,
    refund_code varchar(255) null
);



create table clients
(
    id int auto_increment
        primary key,
    client_fname varchar(255) not null,
    client_lname varchar(255) not null,
    client_phone varchar(10) not null,
    client_email varchar(255) null
);
create table events
(
    id int auto_increment
        primary key,
    title varchar(255) null,
    start_event date null,
    end_event date null
);

create table locations
(
    id int auto_increment
        primary key,
    location_name varchar(255) not null
);

create table quote
(
    id int auto_increment
        primary key,
    client_fname varchar(255) null,
    client_lname varchar(255) null,
    Phone varchar(11) null,
    Email varchar(255) null,
    From_date date null,
    To_date date null,
    Details varchar(255) null,
    Booking_name varchar(255) null
);

create table register
(
    id int auto_increment
        primary key,
    client_fname varchar(255) null,
    client_lname varchar(255) null,
    band_name varchar(255) null,
    client_display_name varchar(255) null
);

create table request_assets_bookings
(
    id int auto_increment
        primary key,
    assets_id int not null,
    bookings_id int not null,
    extra_charge decimal(6,2) null
);

create table room_usages
(
    id int auto_increment
        primary key,
    room_id int not null,
    room_usages_date date not null,
    room_usages_session char(2) not null,
    booking_id int not null,
    constraint room_usages_rooms_id_fk
        foreign key (room_id) references rooms (id)
);



create table rooms
(
    id int auto_increment
        primary key,
    room_number int not null,
    session_id int not null,
    location_id int not null,
    constraint rooms_locations_id_fk
        foreign key (location_id) references locations (id)
);

create table sessions
(
    id int auto_increment
        primary key,
    session_day_start time not null,
    session_day_end time not null,
    session_day_charge decimal(6,2) not null,
    session_night_start time not null,
    session_night_end time not null,
    session_night_charge decimal(6,2) not null
);

create table staffs
(
    id int auto_increment
        primary key,
    staff_fname varchar(255) not null,
    staff_lname varchar(255) not null,
    staff_phone char(10) not null,
    staff_email varchar(255) null,
    staff_code char(4) not null,
    staff_token varchar(255) null,
    constraint staff_staff_code_uindex
        unique (staff_code)
);

create table studio_usages
(
    id int auto_increment
        primary key,
    studio_id int not null,
    studio_usages_date date not null,
    studio_usages_session char(2) not null,
    constraint studio_usages_studios_id_fk
        foreign key (studio_id) references studios (id)
);

create table studios
(
    id int auto_increment
        primary key,
    studio_number int not null,
    location_id int not null,
    constraint studios_locations_id_fk
        foreign key (location_id) references locations (id)
);

create table users
(
    id int auto_increment
        primary key,
    email varchar(255) not null,
    fname varchar(255) not null,
    lname varchar(255) not null,
    password varchar(255) null,
    phone varchar(255) null,
    type varchar(50) not null,
    created datetime null,
    token varchar(255) null,
    constraint users_email_uindex
        unique (email)
);



