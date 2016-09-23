drop database if exists blog;

create database blog;
use blog;

create table blogs(
  title text not null,
  content text not null,
  bdate date,
  author varchar(10) not null,
  blogid int(11) not null primary key auto_increment
);

    
create table users(
username varchar(10) not null primary key,
password varchar(20) not null,
email varchar(100) not null,
forgot_key int(6) not null 
);

alter table blogs add foreign key(author) references users(username);