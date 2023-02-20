create table users
(
    id       serial,
    username varchar(100) not null,
    email    varchar(100) not null,
    password varchar(100) not null,
    role     integer      not null,
    constraint users_pk
        primary key (id),
    unique (id)
);

alter table users
    owner to dbuser;

create table band
(
    id_band          serial,
    username         varchar(100) not null,
    email            varchar(100) not null,
    password         varchar(100) not null,
    schedule_link    text         not null,
    yt_link          text         not null,
    fb_link          text         not null,
    band_description text         not null,
    likes            integer,
    constraint table_name_pk
        primary key (id_band)
);

alter table band
    owner to dbuser;


