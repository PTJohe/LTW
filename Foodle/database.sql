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
	rating FLOAT,
	creationDate DATE
);


CREATE TABLE restaurants (
	idRestaurant INTEGER PRIMARY KEY AUTOINCREMENT,
	restaurantName	NVARCHAR2(30) UNIQUE,
	address	NVARCHAR2(70),
	contact	TEXT,
	averageRating	FLOAT,
	description	TEXT,
	category	NVARCHAR2(15),
	creationDate DATE,
	updateDate DATE,
	idOwner	INTEGER NOT NULL,
	FOREIGN KEY(idOwner) REFERENCES users(idUser)
);


CREATE TABLE responses (
	idResponse INTEGER PRIMARY KEY AUTOINCREMENT,
	text TEXT,
	idReview INTEGER REFERENCES reviews(idReview) NOT NULL,
	idUser INTEGER REFERENCES users(idUser) NOT NULL,
	creationDate DATE
);

CREATE TABLE photos (
	idPhoto	INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE,
	idRestaurant INTEGER REFERENCES restaurants(idRestaurant),
	idUser	INTEGER REFERENCES users(idUser),
	uploadDate DATE
);


-- ######## TRIGGERS TO UPDATE DATES #########

CREATE TRIGGER createDateReview AFTER INSERT ON reviews
FOR EACH ROW
BEGIN
	UPDATE reviews SET creationDate = CURRENT_TIMESTAMP
	WHERE reviews.idReview = NEW.idReview;
END;

CREATE TRIGGER createDateRestaurant AFTER INSERT ON restaurants
FOR EACH ROW
BEGIN
	UPDATE restaurants SET creationDate = CURRENT_TIMESTAMP
	WHERE restaurants.idRestaurant = NEW.idRestaurant;
END;

CREATE TRIGGER createDateResponse AFTER INSERT ON responses --TODO Also change the lastupdateDate on Reviews
FOR EACH ROW
BEGIN
	UPDATE responses SET creationDate = CURRENT_TIMESTAMP
	WHERE responses.idResponse = NEW.idResponse;
END;

CREATE TRIGGER createDatePhoto AFTER INSERT ON photos
FOR EACH ROW
BEGIN
	UPDATE photos SET uploadDate = CURRENT_TIMESTAMP
	WHERE photos.idPhoto = NEW.idPhoto;
END;

CREATE TRIGGER updateDateRestaurant AFTER UPDATE ON restaurants
FOR EACH ROW
BEGIN
	UPDATE restaurants SET updateDate = CURRENT_TIMESTAMP
	WHERE idRestaurant = NEW.idRestaurant;
END;


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

INSERT INTO restaurants (idRestaurant,restaurantName,address,contact,averageRating,description,category,idOwner) VALUES (1,'Gondola','Rua do Azevinho, 135','223456789',3.0,'A melhor tasca que alguma vez irás experimentar','Tasco',1);
INSERT INTO restaurants (idRestaurant,restaurantName,address,contact,averageRating,description,category,idOwner) VALUES (2,'Fork, Knive & Glass','Avenida da Boavista, 2001','22555808',3.5,'Situado numa zona deveras nobre, o Restaurante Boavista é o
	mais adequado para refeições com classe.','Restaurante',3);
INSERT INTO restaurants (idRestaurant,restaurantName,address,contact,averageRating,description,category,idOwner) VALUES (3,'Café Majestic','Rua Santa Catarina 112','222003887',4.0,'Um dos cafés mais tradicionais do Porto e um cartão de visitas da cidade.','Café',2);

INSERT INTO reviews (idReview,idUser,idRestaurant,text,rating) VALUES (1,1,2,'Restaurante bastante bom, mas demasiado caro',4.0);
INSERT INTO reviews (idReview,idUser,idRestaurant,text,rating) VALUES (3,1,1,'Deveras terrível',1.0);
INSERT INTO reviews (idReview,idUser,idRestaurant,text,rating) VALUES (4,1,1,'Muito bonitinho',5.0);
INSERT INTO reviews (idReview,idUser,idRestaurant,text,rating) VALUES (5,1,2,'Oi, tudo bem?',3.0);

INSERT INTO responses (idResponse,text,idReview,idUser) VALUES (1,'Em quais pratos acha que o custo esta demasiado caro?',1,3);
INSERT INTO responses (idResponse,text,idReview,idUser) VALUES (2,'Em todos biatch',1,1);
INSERT INTO responses (idResponse,text,idReview,idUser) VALUES (3,'Ah, pois comigo não brincas',1,1);

INSERT INTO photos (idPhoto, idRestaurant, idUser, uploadDate) VALUES (1,3,3,'2016-12-01');
INSERT INTO photos (idPhoto, idRestaurant, idUser, uploadDate) VALUES (2,3,3,'2016-12-02');