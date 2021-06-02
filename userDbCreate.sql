create user if not exists phpUser@localhost;
alter user phpUser@localhost
identified by 'DanielleAndDorkaAreMyCuddles';
-- :::::::::::::::::::::::::::::::::::::::::::::
-- :::::::::::::::::::::::::::::::::::::::::::::
-- :::::::::::::::::::::::::::::::::::::::::::::
-- ::::: TODO: Change Secret before deploy :::::
-- :::::::::::::::::::::::::::::::::::::::::::::
-- :::::::::::::::::::::::::::::::::::::::::::::
-- :::::::::::::::::::::::::::::::::::::::::::::

DROP DATABASE IF EXISTS fastUserDb;
CREATE DATABASE IF NOT EXISTS fastUserDb;

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
values ('admin', '$2y$10$/YbSCrdNktKjUWPi.ocQuuDAdB5yLtAuAzl16CzzxeUxovHTLCZcG');

grant all on fastUserDb.* to phpUser@localhost;