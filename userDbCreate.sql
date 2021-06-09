create user if not exists phpUser@localhost;
alter user phpUser@localhost
identified by '^Dz,:2-%W?uF_)/;';
-- :::::::::::::::::::::::::::::::::::::::::::::
-- :::::::::::::::::::::::::::::::::::::::::::::
-- :::::::::::::::::::::::::::::::::::::::::::::
-- ::::: TODO: Change Secret before deploy :::::
-- :::::::::::::::::::::::::::::::::::::::::::::
-- :::::::::::::::::::::::::::::::::::::::::::::
-- :::::::::::::::::::::::::::::::::::::::::::::

DROP DATABASE IF EXISTS fastUserDb;
CREATE DATABASE IF NOT EXISTS fastUserDb;

ALTER DATABASE fastUserDb CHARACTER SET utf8 COLLATE utf8_general_ci;

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