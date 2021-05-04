create user if not exists phpUser@localhost;
alter user phpUser@localhost
identified by 'DanielleAndDorkaAreMyCuddles';

create or replace database fastUserDb;
use fastUserDb;

create table users(
    userName varchar(20) not null primary key,
    passwdHash varchar(255) not null
);

create table tokens(
    pk_tokenId varchar(128) primary key,
    expiryDate datetime not null
);

insert into users (userName, passwdHash)
values ('admin', '$2y$10$M4eKwE5DdI4dr.ecgD14OO3l6C/jZFtlZDKR3/wdegY1YZShZz7iC');

grant all on fastUserDb.* to phpUser@localhost