CREATE TABLE movies(
	pKMovieID mediumint(8) NOT NULL auto_increment,
	title VARCHAR(100) NOT NULL,
	genre VARCHAR(50) NOT NULL,
	platform VARCHAR(50) NOT NULL,
	rentalPrice decimal(15,2) NOT NULL,
    available BOOLEAN NOT NULL,
    videoLink VARCHAR(50) NOT NULL,
    Constraint PRIMARY KEY  (pKMovieID)
);

CREATE TABLE users
(
   pKUserID mediumint(8) NOT NULL auto_increment,
   first_name varchar(20) NOT NULL,
   last_name varchar(40) NOT NULL,
   email varchar(40) NOT NULL,
   userName varchar(40) NOT NULL,
   pass char(255) NOT NULL,
   userType VARCHAR(8) NOT NULL,
   Constraint PRIMARY KEY  (pKUserID)
);


CREATE TABLE transactions(
    pKOrderNumber MEDIUMINT(8) NOT NULL AUTO_INCREMENT,
    transctionType VARCHAR(50) NOT NULL,
    lastUpdate DATETIME NOT NULL,
    fkMovieID MEDIUMINT(8) NOT NULL,
    fkUserID MEDIUMINT(8) NOT NULL,
    CONSTRAINT PRIMARY KEY(pKOrderNumber),
    CONSTRAINT FOREIGN KEY(fkMovieID) REFERENCES movies(pKMovieID),
    CONSTRAINT FOREIGN KEY(fkUserID) REFERENCES users(pKUserID)
)