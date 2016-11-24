CREATE TABLE users (
	username NVARCHAR2(30) PRIMARY KEY,
	password NVARCHAR2(20),
	name NVARCHAR2(40),
	photoFileName NVARCHAR2(100),
	);
	
CREATE TABLE restaurants (
	restaurantName NVARCHAR2(30) PRIMARY KEY,
	address NVARCHAR2(70),
	contact INTEGER,
	averageRating FLOAT,
	description TEXT,
	category NVARCHAR2(15),
	-- imagelist dunno how to do it
	lastUpdateDate DATE, 
	-- TODO ref to user
	)