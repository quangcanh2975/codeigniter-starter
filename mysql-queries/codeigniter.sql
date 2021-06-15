CREATE TABLE user (
        id int UNSIGNED auto_increment primary key,
        username varchar(128) NOT NULL,
        password varchar(128) NOT NULL,
        email VARCHAR(50),
		firstname VARCHAR(30) ,
        lastname VARCHAR(30)
);