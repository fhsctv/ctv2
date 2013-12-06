-- *********************************************
-- * SQL PostgreSQL generation                 
-- *--------------------------------------------
-- * DB-MAIN version: 9.1.6              
-- * Generator date: Feb 25 2013              
-- * Generation date: Mon Dec  2 22:01:49 2013 
-- * LUN file: /studium/7_Semester/CTV.lun 
-- * Schema: SEM_LOG/1-3-1 
-- ********************************************* 

create database ctv3 owner ctv;

\c ctv3 ctv;

create schema ctv;


-- Tables Section
-- _____________ 

create table bildschirm (
     bildschirm_id serial not null,
     beschreibung varchar(100) not null,
     constraint IDbildschirm primary key (bildschirm_id));

comment on column bildschirm.beschreibung is 'Im wesentlichen Name des Bildschirmstandorts:  Mensa Hörsaal Büro';

create table ctv.user (
     user_id serial not null,
     username varchar(50) not null,
     email varchar(50) not null,
     display_name varchar(50) not null,
     password varchar(255) not null,
     state char(1) not null,
     constraint IDuser primary key (user_id),
     constraint IDuser_1 unique (username),
     constraint IDuser_2 unique (email));

create table fachhochschule (
     user_id integer not null,
     name varchar(255) not null,
     constraint IDfachhochschule primary key (user_id),
     constraint IDfachhochschule_1 unique (name));

create table infobeschreibung (
     id serial not null,
     beschreibung varchar(255) not null,
     inserat_id integer not null,
     constraint IDinfobeschreibung primary key (id));

create table infobild (
     id serial not null,
     inserat_id integer not null,
     constraint IDinfobild primary key (id));

create table infoliste (
     id serial not null,
     liste varchar(500) not null,
     inserat_id integer not null,
     constraint IDinfoliste primary key (id));

create table infoscript (
     inserat_id integer not null,
     headline varchar(255),
     description varchar(255),
     fk_fh_id integer not null,
     constraint IDinfoscript primary key (inserat_id));

create table infospalte (
     id serial not null,
     title varchar(60) not null,
     text varchar(300) not null,
     inserat_id integer not null,
     constraint IDinfospalte primary key (id));

create table inserat (
     inserat_id serial not null,
     url varchar(255) not null,
     start date not null,
     ende date not null,
     aktiv char not null,
     constraint IDurl primary key (inserat_id),
     constraint IDurl_1 unique (url));

create table inserat_bildschirm_linker (
     inserat_id integer not null,
     bildschirm_id integer not null,
     constraint IDinserat_bildschirm_linker primary key (inserat_id, bildschirm_id));

create table user_role (
     role_id varchar(50) not null,
     is_default char not null,
     parent varchar(50),
     constraint IDuser_role_1 primary key (role_id));

create table user_role_linker (
     user_id integer not null,
     role_id varchar(50) not null);

create table user_signup_email_verification (
     request_key varchar(32) not null,
     email_address varchar(255) not null,
     request_time timestamp not null,
     constraint IDuser_signup_enail_verification primary key (request_key),
     constraint IDuser_signup_enail_verification_1 unique (email_address));


-- Constraints Section
-- ___________________ 

alter table fachhochschule add constraint GRfachhochschule
     foreign key (user_id)
     references ctv.user on delete cascade;

alter table infobeschreibung add constraint GRinfobeschreibung
     foreign key (inserat_id)
     references infoscript on delete cascade;

alter table infobild add constraint GRinfobild
     foreign key (inserat_id)
     references infoscript on delete cascade;

alter table infoliste add constraint GRinfoliste
     foreign key (inserat_id)
     references infoscript on delete cascade;

alter table infoscript add constraint GRinfoscript
     foreign key (inserat_id)
     references inserat on delete cascade;

alter table infoscript add constraint GRinfoscript_1
     foreign key (fk_fh_id)
     references fachhochschule on delete cascade;

alter table infospalte add constraint GRinfospalte
     foreign key (inserat_id)
     references infoscript on delete cascade;

alter table inserat_bildschirm_linker add constraint GRinserat_bildschirm_linker
     foreign key (bildschirm_id)
     references bildschirm on delete cascade;

alter table inserat_bildschirm_linker add constraint GRinserat_bildschirm_linker_1
     foreign key (inserat_id)
     references inserat on delete cascade;

alter table user_role_linker add constraint GRuser_role_linker
     foreign key (user_id)
     references ctv.user on delete cascade;

alter table user_role_linker add constraint GRuser_role_linker_1
     foreign key (role_id)
     references user_role on delete cascade;


-- Index Section
-- _____________ 

