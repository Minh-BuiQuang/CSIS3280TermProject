drop database if exists recipe;
create database recipe;
use recipe;

create table users (
	id INT AUTO_INCREMENT PRIMARY KEY,
	full_name VARCHAR(50),	
	username VARCHAR(20),
	email VARCHAR(50),	
	password VARCHAR(250)
) Engine=InnoDB;

create table recipe( 
	uri VARCHAR(250) PRIMARY KEY,
	label VARCHAR(250),
	image VARCHAR(5000),
	ingredient_lines TEXT,
	calories DOUBLE
) Engine=InnoDB;
create table grocery(
	food_id VARCHAR(50) PRIMARY KEY,
	quantity DOUBLE,
	measure VARCHAR(50),
	food VARCHAR(100)
)
