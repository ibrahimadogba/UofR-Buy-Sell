DROP TABLE IF EXISTS sellcreation;

CREATE TABLE sellcreation ( 
    sellId int(11) NOT NULL AUTO_INCREMENT, 
    selltitle varchar (100), 
    sellauthor varchar (100), 
    sellisbn varchar (100), 
    sellclassnum varchar (100), 
    sellimage varchar (10000), 
    selldescription varchar (600), 
    created_dt DATETIME, 
    userId int(11) NOT NULL, 
    PRIMARY KEY (sellId), 
    FOREIGN KEY (userId) REFERENCES Users (userId)
    );

    insert into sellcreation (sellId, selltitle, sellauthor, sellisbn, sellclassnum, sellimage, selldescription,created_dt) 
    values ('15','The Norton','Kelly J. Mays','','9780393911640','CS210','uploads/norton.jpg ','A classic introduction to literary theory and analysis, featuring a wide selection of poems, plays, and short stories from around the world. 
    Perfect for English majors and anyone interested in exploring the power of language and storytelling.', '43 ','2023-03-18 16:53:41','16');