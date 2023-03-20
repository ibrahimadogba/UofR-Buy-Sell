DROP TABLE IF EXISTS favorites;


CREATE TABLE favorites ( 
    favouriteId int(50) NOT NULL AUTO_INCREMENT, 
    sellId int NOT NULL, 
    userId int NOT NULL, 
    created_dt datetime,
    PRIMARY KEY (favouriteId), 
    FOREIGN KEY (sellId) REFERENCES sellcreation (sellId), 
    FOREIGN KEY (userId) REFERENCES Users (userId) 
    );

    insert into favorites (favouriteId, sellId, userId, created_dt) 
    values ('1','14','1', '2023-03-17 18:24:03');
