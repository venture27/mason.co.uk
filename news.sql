CREATE TABLE news (
	newsId INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	header varchar(100) NOT NULL,
	subheader varchar(100),
	entered TIMESTAMP, 
	body varchar(1000) NOT NULL, 
	image varchar(50)
)