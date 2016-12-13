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
	password	NVARCHAR2(60),
	name	TEXT
);
INSERT INTO users (idUser,username,password,name) VALUES (1,'Maxzelik','$2y$10$TkEw3q91xPQL4SpdbDIZ6OEYszHKhQ.FePlZaTBgrMQiDiZHaXxme','José Carlos Coutinho'); -- password = 21ago96
INSERT INTO users (idUser,username,password,name) VALUES (2,'Bolota','$2y$10$WwUPZGuVgrU7BFJ8RFgd0.rByVM9.V7p5unPNROnOz3VssPg63jxq','Francisco Barbosa'); -- password = oporquinhofoiahorta
INSERT INTO users (idUser,username,password,name) VALUES (3,'PTJohe','$2y$10$C3NZyv/uiXYhs/DW1CaT..KXf5HsMqizY1h/cNeH.6LC5pYB0Myb2','João Araújo'); -- password = aquelapass
INSERT INTO users (idUser,username,password,name) VALUES (4,'testando','$2y$10$9eiDUr7w5oX4HMuTTJlyFeJt4NPIr3g2zv2lLmpdUcFle0F1Fvnem','Francisco'); -- pasword = barbosa
INSERT INTO users (idUser,username,password,name) VALUES (5,'barbosa','$2y$10$9eiDUr7w5oX4HMuTTJlyFeJt4NPIr3g2zv2lLmpdUcFle0F1Fvnem','Francisco'); -- password = barbosa
INSERT INTO users (idUser,username,password,name) VALUES (6,'Francisco96','$2y$10$ZBkyM3sV1vjYOsdcxMbJLexKREZLHm85K1CT4u3e57zPMRQcng36i','Francisco Barbosa'); -- password = lamares12
INSERT INTO users (idUser,username,password,name) VALUES (7,'ZeCarlosCoutinho','$2y$10$TkEw3q91xPQL4SpdbDIZ6OEYszHKhQ.FePlZaTBgrMQiDiZHaXxme','José Carlos Coutinho'); -- password = 21ago96
INSERT INTO users (idUser,username,password,name) VALUES (8,'Toni','$2y$10$VG03bZm9bQRBhBfHnNqO6Oy9uJB5alnxKNTLJ39HxhwO14U/djbAK','António Maria Silva'); --pasword = 123456

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
INSERT INTO restaurants (idRestaurant,restaurantName,address,contact,averageRating,description,category,idOwner) VALUES (2,'Fork, Knife & Glass','Avenida da Boavista, 2001','22555808',3.5,'Situado numa zona deveras nobre, o Restaurante Boavista é o
	mais adequado para refeições com classe.','Restaurante',3);
INSERT INTO restaurants (idRestaurant,restaurantName,address,contact,averageRating,description,category,idOwner) VALUES (3,'Café Majestic','Rua Santa Catarina 112','222003887',4.0,'Um dos cafés mais tradicionais do Porto e um cartão de visitas da cidade.','Café',2);
INSERT INTO restaurants (idRestaurant,restaurantName,address,contact,averageRating,description,category,idOwner) VALUES (4,'Café Santiago','Rua de Passos Manuel 226','255123432',4.2,'Avaliada como a melhor francesinha do mundo!','Café',4);
INSERT INTO restaurants (idRestaurant,restaurantName,address,contact,averageRating,description,category,idOwner) VALUES (5,'O Brouas','Rua de S. Brás 535','255781887',4.5,'Cozinha tradicional de excelente qualidade. Possui uma boa carta de vinhos e sobremesas variadas.','Restaurante',4);
INSERT INTO restaurants (idRestaurant,restaurantName,address,contact,averageRating,description,category,idOwner) VALUES (6,'O Sapo','Rua Almeida Garret 182','255298312',3.8,'Um dos restaurantes mais conhecidos na zona, se vens a Penafiel tens de passar no Sapo','Restaurante',5);
INSERT INTO restaurants (idRestaurant,restaurantName,address,contact,averageRating,description,category,idOwner) VALUES (7,'Pinheiral dos Leitoes','Rua da Senhora do Monte 77','255781300',2.0,'O melhor leitão da zona e nao só!','Restaurante',6);
INSERT INTO restaurants (idRestaurant,restaurantName,address,contact,averageRating,description,category,idOwner) VALUES (8,'Animar','Rua da Linda 21','25578354',3.0,'Vem provar a nossa comida caseira, nao te vais arrepender!','Tasco',7);
INSERT INTO restaurants (idRestaurant,restaurantName,address,contact,averageRating,description,category,idOwner) VALUES (9,'Tricana','Rua da Igreja Velha','255787363',3.7,'Ambiente calmo e acolhedor para tomares o teu café','Café',6);
INSERT INTO restaurants (idRestaurant,restaurantName,address,contact,averageRating,description,category,idOwner) VALUES (10,'O Piolho','Praça de Parada Leitão 45','215781340',4.1,'Local emblemático para os universitários com ambiente muito descontraído e jovem.','Café',8);
INSERT INTO restaurants (idRestaurant,restaurantName,address,contact,averageRating,description,category,idOwner) VALUES (11,'Lusíada','Rua dos Lusiadas','287477633',3.2,'Local acolhedor com boas refeições diarias','Restaurante',6);
INSERT INTO restaurants (idRestaurant,restaurantName,address,contact,averageRating,description,category,idOwner) VALUES (12,'Mensagem','Rua Fernando Pessoa','212343225',3.8,'Restaurante luxuoso muito bem decorado, refeições gourmet e preços acessiveis','Restaurante',1);
INSERT INTO restaurants (idRestaurant,restaurantName,address,contact,averageRating,description,category,idOwner) VALUES (13,'Tasca do Zé','Rua Jose Almirante','298475876',3.4,'Vem as Tasca do Zé experimentar as tradições de Penafiel!','Tasco',1);
INSERT INTO restaurants (idRestaurant,restaurantName,address,contact,averageRating,description,category,idOwner) VALUES (14,'Maus Hábitos','Rua de Passos Manuel 178','213456789',4.4,'Espaço de intervenção cultural com vários espaços distintos. Galeria de arte, bar, restaurante e discoteca.','Bar',3);
INSERT INTO restaurants (idRestaurant,restaurantName,address,contact,averageRating,description,category,idOwner) VALUES (15,'Cave 45','Rua das Oliveiras 45','221456789',4.1,'Concertos de todo o tipo de Metal no andar de baixo. Rapidamente se tornou um local de referencia para os apreciadores do estilo.','Bar',3);

INSERT INTO reviews (idReview,idUser,idRestaurant,text,rating) VALUES (1,1,2,'Restaurante bastante bom, mas demasiado caro',4.0);
INSERT INTO reviews (idReview,idUser,idRestaurant,text,rating) VALUES (3,1,1,'Deveras terrível',1.0);
INSERT INTO reviews (idReview,idUser,idRestaurant,text,rating) VALUES (4,1,1,'Muito bonitinho',5.0);
INSERT INTO reviews (idReview,idUser,idRestaurant,text,rating) VALUES (5,1,2,'Oi, tudo bem?',3.0);

INSERT INTO responses (idResponse,text,idReview,idUser) VALUES (1,'Em quais pratos acha que o custo esta demasiado caro?',1,3);
INSERT INTO responses (idResponse,text,idReview,idUser) VALUES (2,'Em todos biatch',1,1);
INSERT INTO responses (idResponse,text,idReview,idUser) VALUES (3,'Ah, pois comigo não brincas',1,1);

INSERT INTO photos (idPhoto, idRestaurant, idUser, uploadDate) VALUES (1,3,3,'2016-12-01');
INSERT INTO photos (idPhoto, idRestaurant, idUser, uploadDate) VALUES (2,3,1,'2016-12-02');
INSERT INTO photos (idPhoto, idRestaurant, idUser, uploadDate) VALUES (3,14,3,'2016-12-02');
INSERT INTO photos (idPhoto, idRestaurant, idUser, uploadDate) VALUES (4,14,1,'2016-12-02');
INSERT INTO photos (idPhoto, idRestaurant, idUser, uploadDate) VALUES (5,15,3,'2016-12-02');
INSERT INTO photos (idPhoto, idRestaurant, idUser, uploadDate) VALUES (6,4,2,'2016-12-02');
INSERT INTO photos (idPhoto, idRestaurant, idUser, uploadDate) VALUES (7,10,2,'2016-12-02');
INSERT INTO photos (idPhoto, idRestaurant, idUser, uploadDate) VALUES (8,4,3,'2016-12-02');
INSERT INTO photos (idPhoto, idRestaurant, idUser, uploadDate) VALUES (9,8,2,'2016-12-02');
INSERT INTO photos (idPhoto, idRestaurant, idUser, uploadDate) VALUES (10,7,1,'2016-12-02');