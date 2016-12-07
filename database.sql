.mode columns
.headers on
.nullvalue NULL

DROP TABLE IF EXISTS photos;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS restaurants;
DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS responses;


CREATE TABLE users (
	idUser	INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE,
	username	NVARCHAR2(20) UNIQUE,
	password	NVARCHAR2(20),
	name	TEXT
);
INSERT INTO users (idUser,username,password,name) VALUES (1,'Maxzelik','21ago96','José Carlos Coutinho');
INSERT INTO users (idUser,username,password,name) VALUES (2,'Bolota','oporquinhofoiahorta','Francisco Barbosa');
INSERT INTO users (idUser,username,password,name) VALUES (3,'PTJohe','aquelapass','João Araújo');
INSERT INTO users (idUser,username,password,name) VALUES (4,'testando','barbosa','Francisco');
INSERT INTO users (idUser,username,password,name) VALUES (5,'barbosa','barbosa','Francisco');
INSERT INTO users (idUser,username,password,name) VALUES (6,'Francisco96','lamares12','Francisco Barbosa');
INSERT INTO users (idUser,username,password,name) VALUES (7,'ZeCarlosCoutinho','21ago96','José Carlos Coutinho');
INSERT INTO users (idUser,username,password,name) VALUES (8,'Toni','1234','António Maria Silva');

CREATE TABLE reviews (
	idReview INTEGER PRIMARY KEY AUTOINCREMENT,
	idUser INTEGER REFERENCES users(idUser) NOT NULL,
	idRestaurant INTEGER REFERENCES restaurants(idRestaurant) NOT NULL,
	text TEXT,
	rating FLOAT
	);
INSERT INTO reviews (idReview,idUser,idRestaurant,text,rating) VALUES (1,1,2,'Restaurante bastante bom, mas demasiado caro',4.0);
INSERT INTO reviews (idReview,idUser,idRestaurant,text,rating) VALUES (3,1,1,'Deveras terrível',1.0);
INSERT INTO reviews (idReview,idUser,idRestaurant,text,rating) VALUES (4,1,1,'Muito bonitinho',5.0);
INSERT INTO reviews (idReview,idUser,idRestaurant,text,rating) VALUES (5,1,2,'Oi, tudo bem?',3.0);

CREATE TABLE restaurants (
	idRestaurant	INTEGER PRIMARY KEY AUTOINCREMENT,
	restaurantName	NVARCHAR2(30) UNIQUE,
	address	NVARCHAR2(70),
	contact	INTEGER,
	averageRating	FLOAT,
	description	TEXT,
	category	NVARCHAR2(15),
	lastUpdateDate	DATE,
	idOwner	INTEGER NOT NULL,
	FOREIGN KEY(idOwner) REFERENCES users(idUser)
);
INSERT INTO restaurants (idRestaurant,restaurantName,address,contact,averageRating,description,category,lastUpdateDate,idOwner) VALUES (1,'Gondola','Rua do Azevinho, 135',223456789,3.0,'A melhor tasca que alguma vez irás experimentar','Tasco',NULL,1);
INSERT INTO restaurants (idRestaurant,restaurantName,address,contact,averageRating,description,category,lastUpdateDate,idOwner) VALUES (2,'Fork, Knive & Glass','Avenida da Boavista, 2001',22555808,3.5,'Situado numa zona deveras nobre, o Restaurante Boavista é o
	mais adequado para refeições com classe.','Restaurante',NULL,3);
INSERT INTO restaurants (idRestaurant,restaurantName,address,contact,averageRating,description,category,lastUpdateDate,idOwner) VALUES (3,'Café Majestic','Rua Santa Catarina 112',222003887,4.0,'Um dos cafés mais tradicionais do Porto e um cartão de visitas da cidade.','Café',NULL,2);


CREATE TABLE responses (
	idResponse INTEGER PRIMARY KEY AUTOINCREMENT,
	text TEXT,
	idReview INTEGER REFERENCES reviews(idReview) NOT NULL,
	idUser INTEGER REFERENCES users(idUser) NOT NULL
	);
INSERT INTO responses (idResponse,text,idReview,idUser) VALUES (1,'Em quais pratos acha que o custo esta demasiado caro?',1,3);
INSERT INTO responses (idResponse,text,idReview,idUser) VALUES (2,'Em todos biatch',1,1);
INSERT INTO responses (idResponse,text,idReview,idUser) VALUES (3,'Ah, pois comigo não brincas',1,1);

CREATE TABLE photos (
	idPhoto	INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE,
	idRestaurant	INTEGER,
	idUser	INTEGER,
	uploadDate	INTEGER
);


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


-- ######## TRIGGERS TO ALSO DELETE RESTAURANT ENTRIES #########
CREATE TRIGGER deleteReviewAndResponses BEFORE DELETE ON reviews
FOR EACH ROW
BEGIN
	DELETE FROM responses
	WHERE responses.idReview = OLD.idReview;
END;
	
CREATE TRIGGER deleteRestaurantAndReviews BEFORE DELETE ON restaurants
FOR EACH ROW
BEGIN
	DELETE FROM reviews
	WHERE reviews.idRestaurant = OLD.idRestaurant;
END;
	
CREATE TRIGGER deleteUserAndRestaurants BEFORE DELETE ON users
FOR EACH ROW
BEGIN
	DELETE FROM restaurants
	WHERE restaurants.idOwner = OLD.idUser;
END;