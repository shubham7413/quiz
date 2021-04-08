CREATE DATABASE quiz_database;
CREATE TABLE quiz(
    id INT,
    ques TEXT,
    option_1 varchar(30),
    option_2 varchar(30),
    option_3 varchar(30),
    option_4 varchar(30),
    ans TINYINT
)

-- populate sql file

INSERT INTO quiz VALUES(0,'The International Literacy Day is observed on','Sep 8','Nov 28','May 2','Sep 22','A');
INSERT INTO quiz VALUES(0,' 
The language of Lakshadweep. a Union Territory of India, is','Tamil','Hindi','Malayalam','Telugu','C');
INSERT INTO quiz VALUES(0,'Bahubali festival is related to','Islam','Hinduism','Buddhism','Jainism','D');
INSERT INTO quiz VALUES(0,'Which day is observed as the World Standards  Day?','June 26','Oct 14','Nov 15','Dec 2','B');
INSERT INTO quiz VALUES(0,'September 27 is celebrated every year as','Teachers Day','National Integration Day','World Tourism Day','International Literacy Day','C');
