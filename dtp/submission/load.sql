
DROP TABLE IF EXISTS Laureates;
DROP TABLE IF EXISTS Birth;
DROP TABLE IF EXISTS Founded;
DROP TABLE IF EXISTS NobelPrizes;
DROP TABLE IF EXISTS Affiliations;


create table Laureates(id int primary key, givenName VARCHAR(30), familyName VARCHAR(30), gender VARCHAR(6), orgName VARCHAR(60));
create table Birth(id int primary key, birthdate VARCHAR(10), birthcity VARCHAR(30), birthcountry VARCHAR(35));
create table Founded(id int primary key, foundingdate VARCHAR(10), foundingcity VARCHAR(30), foundingcountry VARCHAR(35));
create table NobelPrizes(id int, awardYear int, category VARCHAR(30), sortOrder int, primary key(awardYear, category, sortOrder));
create table Affiliations(awardYear int, category VARCHAR(30), sortOrder int, affname VARCHAR(120), affcity VARCHAR(35), affcountry VARCHAR(35), primary key(awardYear, category, sortOrder, affname));



LOAD DATA LOCAL INFILE './Laureates.del' INTO TABLE Laureates FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';
LOAD DATA LOCAL INFILE './Birth.del' INTO TABLE Birth FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';
LOAD DATA LOCAL INFILE './Founded.del' INTO TABLE Founded FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';
LOAD DATA LOCAL INFILE './NobelPrizes.del' INTO TABLE NobelPrizes FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';
LOAD DATA LOCAL INFILE './Affiliations.del' INTO TABLE Affiliations FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';