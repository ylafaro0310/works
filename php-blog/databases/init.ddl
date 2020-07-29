CREATE DATABASE IF NOT EXISTS php_blog;

CREATE USER IF NOT EXISTS 'default' IDENTIFIED BY 'default';

GRANT ALL ON *.* TO 'default';

CREATE TABLE blogs (
    id int AUTO_INCREMENT,
    title varchar(255),
    content varchar(255),
    created_at datetime,
    updated_at datetime,
    index(id)
);

CREATE TABLE users (
    id int AUTO_INCREMENT,
    username varchar(255),
    password varchar(255),
    index(id)
);