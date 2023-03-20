DROP TABLE IF EXISTS Users;

CREATE TABLE Users ( 
    userId int(11) NOT NULL AUTO_INCREMENT, 
    email varchar (50) NOT NULL, 
    photo_img  varchar(10000) NOT NULL, 
    pswd varchar (50)NOT NULL, 
    username varchar (50) NOT NULL, 
    PRIMARY KEY (userId) 
    );