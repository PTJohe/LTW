.mode columns
.headers on
.nullvalue NULL

DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS restaurants;
DROP TABLE IF EXISTS reviews;


-- ######### CREATE TABLES #####################

CREATE TABLE users (
	idUser INTEGER PRIMARY KEY AUTOINCREMENT,
	username NVARCHAR2(30) UNIQUE,
	password NVARCHAR2(20),
	name NVARCHAR2(40),
	photoFileName NVARCHAR2(100)
	);
	
CREATE TABLE restaurants (
	idRestaurant INTEGER PRIMARY KEY AUTOINCREMENT,
	restaurantName NVARCHAR2(30) UNIQUE,
	address NVARCHAR2(70),
	contact INTEGER,
	averageRating FLOAT,
	description TEXT,
	category NVARCHAR2(15),
	-- imagelist dunno how to do it
	lastUpdateDate DATE, 
	idOwner INTEGER REFERENCES users(idUser) NOT NULL
	);
	
CREATE TABLE reviews (
	idReview INTEGER PRIMARY KEY AUTOINCREMENT,
	idOwner	INTEGER REFERENCES users(idUser) NOT NULL,
	idRestaurant INTEGER REFERENCES restaurants(idRestaurant) NOT NULL,
	text TEXT,
	rating FLOAT
	);


	
-- ######### INSERT USERS ##################

INSERT INTO users(username, password, name)
	VALUES("Maxzelik", "21ago96", "José Carlos Coutinho");
INSERT INTO users(username, password, name)
	VALUES("Bolota", "oporquinhofoiahorta", "Francisco Barbosa");
INSERT INTO users(username, password, name)
	VALUES("Joao", "aquelapass", "João Araújo");
	
	

-- ######## TRIGGERS TO UPDATE AVERAGE RESTAURANT RATING ########
CREATE TRIGGER updateAverageinsert AFTER INSERT ON reviews
FOR EACH ROW
BEGIN
	UPDATE restaurants SET averageRating = 
		(SELECT AVG(rating) FROM reviews WHERE reviews.idRestaurant = NEW.idRestaurant)
		WHERE restaurants.idRestaurant = NEW.idRestaurant;
END;

CREATE TRIGGER updateAveragedelete AFTER DELETE ON reviews
FOR EACH ROW
BEGIN
	UPDATE restaurants SET averageRating = 
		(SELECT AVG(rating) FROM reviews WHERE reviews.idRestaurant = OLD.idRestaurant)
		WHERE restaurants.idRestaurant = OLD.idRestaurant;
END;

INSERT INTO restaurants(restaurantName, address, contact, description, category, idOwner)
	VALUES("Tasca do Bino", "Rua do Azevinho, 135", 223456789,
	"A melhor tasca que alguma vez irás experimentar", "Tasco",
	(SELECT idUser FROM users
	WHERE username="Maxzelik"));
INSERT INTO restaurants(restaurantName, address, contact, description, category, idOwner)
	VALUES("Restaurante Boavista", "Avenida da Boavista, 2001", 22555808,
	"Situado numa zona deveras nobre, o Restaurante Boavista é o
	mas adequado para refeiçoes com classe", "Restaurante",
	(SELECT idUser FROM users
	WHERE username="Joao"));
INSERT INTO reviews(idOwner, idRestaurant, text, rating)
	VALUES(	(SELECT idUser FROM users WHERE username="Maxzelik"),
			(SELECT idRestaurant FROM restaurants WHERE restaurantName="Restaurante Boavista"),
			"Restaurante bastante bom, mas demasiado caro",
			4);
INSERT INTO reviews(idOwner, idRestaurant, text, rating)
	VALUES(	(SELECT idUser FROM users WHERE username="Bolota"),
			(SELECT idRestaurant FROM restaurants WHERE restaurantName="Restaurante Boavista"),
			"Gostei bastante,gostaria de repetir a experiencia",
			5);
DELETE FROM reviews
WHERE rating = 5;
