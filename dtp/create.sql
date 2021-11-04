create table Laureates(id int primary key, givenName VARCHAR(30), familyName VARCHAR(30), gender VARCHAR(6), orgName VARCHAR(60));
create table Birth(id int primary key, date VARCHAR(10), city VARCHAR(30), country VARCHAR(35));
create table Founded(id int primary key, date VARCHAR(10), city VARCHAR(30), country VARCHAR(35));
create table NobelPrizes(id int, awardYear int, category VARCHAR(30), sortOrder int, primary key(awardYear, category, sortOrder));
create table Affiliations(awardYear int, category VARCHAR(30), sortOrder int, name VARCHAR(120), city VARCHAR(35), country VARCHAR(35), primary key(awardYear, category, sortOrder, name));