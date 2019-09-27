DROP TABLE IF EXISTS userInfo;
 
DROP TABLE IF EXISTS saleProductOffers;
 
CREATE TABLE userInfo
(
userNumber INT UNSIGNED AUTO_INCREMENT UNIQUE NOT NULL,
userName VARCHAR(50) UNIQUE NOT NULL,
passcode VARCHAR(100) NOT NULL,
firstName VARCHAR(25) NOT NULL,
lastName VARCHAR(25) NOT NULL,
phoneNumber VARCHAR(15) UNIQUE NOT NULL,
email VARCHAR(100) UNIQUE,
placeWithoutDivision VARCHAR(25) NOT NULL,
division VARCHAR(25) NOT NULL,
profilePicture VARCHAR(255),
PRIMARY KEY (userName)
);
 
CREATE TABLE saleProductOffers
(
offerNumber INT UNSIGNED AUTO_INCREMENT UNIQUE NOT NULL,
productImage VARCHAR(255),
productName VARCHAR(100) NOT NULL,
productDescription VARCHAR(255) NOT NULL,
productPrice INT UNSIGNED NOT NULL,
productUploadDate DATE NOT NULL,
productUploadTime TIME NOT NULL,
productCategory VARCHAR(50) NOT NULL,
productSubCategory VARCHAR(50),
userName VARCHAR(50),
PRIMARY KEY (offerNumber),
FOREIGN KEY (userName) REFERENCES userInfo(userName)
	ON DELETE SET NULL
	ON UPDATE CASCADE
);

INSERT INTO userInfo (userNumber, userName, passcode, firstName, lastName, phoneNumber, email, placeWithoutDivision, division, profilePicture)
VALUES (NULL,'abdullah','1','hasnat','abdullah','01761900888','hasnat.abdullah@gmail.com','shantinagar','dhaka','abdullah.jpg');

INSERT INTO userInfo (userNumber, userName, passcode, firstName, lastName, phoneNumber, email, placeWithoutDivision, division, profilePicture)
VALUES (NULL,'joy','1','joy','rahman','01761900999','joy.rahman@gmail.com','uttara','dhaka','joy.jpg');

INSERT INTO saleproductoffers(offerNumber,productImage,productName,productDescription,productPrice,productUploadDate,productUploadTime,productCategory,productSubCategory,username)
values (NULL,'a4techKeyboard.jpg','A4TECH keyboard','Brand : A4TECH \n Used : 1 year',100,CURRENT_DATE,CURRENT_TIME,'electronics','keyboard','abdullah');

INSERT INTO saleproductoffers(offerNumber,productImage,productName,productDescription,productPrice,productUploadDate,productUploadTime,productCategory,productSubCategory,username)
values (NULL,'a4techKeyboardAndMouse.jpg','A4TECH keyboard and mouse','Brand : A4TECH \n Used : 1 year',200,CURRENT_DATE,CURRENT_TIME,'electronics','mouse and keyboard','abdullah');

INSERT INTO saleproductoffers(offerNumber,productImage,productName,productDescription,productPrice,productUploadDate,productUploadTime,productCategory,productSubCategory,username)
values (NULL,'a4techMouse.jpg','A4TECH mouse','Brand : A4TECH \n Used : 1 year',100,CURRENT_DATE,CURRENT_TIME,'electronics','mouse','abdullah');

INSERT INTO saleproductoffers(offerNumber,productImage,productName,productDescription,productPrice,productUploadDate,productUploadTime,productCategory,productSubCategory,username)
values (NULL,'adjustable2PinAdapter.jpg','Adjustable 2 pin adapter','Brand : Many \n Used : 1 year',100,CURRENT_DATE,CURRENT_TIME,'electronics','adapter','abdullah');

INSERT INTO saleproductoffers(offerNumber,productImage,productName,productDescription,productPrice,productUploadDate,productUploadTime,productCategory,productSubCategory,username)
values (NULL,'bench.jpg','Bench','Homemade \n Used : 1 year \n Color : Black \n Quantity : 1 piece',1000,CURRENT_DATE,CURRENT_TIME,'furniture','bench','abdullah');

INSERT INTO saleproductoffers(offerNumber,productImage,productName,productDescription,productPrice,productUploadDate,productUploadTime,productCategory,productSubCategory,username)
values (NULL,'blackDuster.jpg','Duster','Brand : Faber Castle \n Color : Black \n Used : 1 month',100,CURRENT_DATE,CURRENT_TIME,'education','duster','abdullah');

INSERT INTO saleproductoffers(offerNumber,productImage,productName,productDescription,productPrice,productUploadDate,productUploadTime,productCategory,productSubCategory,username)
values (NULL,'chairs.jpg','Chair','Homemade \n Quantity : 2 pieces \n Used : 1 year',2000,CURRENT_DATE,CURRENT_TIME,'furniture','chair','abdullah');

INSERT INTO saleproductoffers(offerNumber,productImage,productName,productDescription,productPrice,productUploadDate,productUploadTime,productCategory,productSubCategory,username)
values (NULL,'coolineAC.jpg','Air conditioner','Brand : Cooline \n Type : 1.5 ton \n Used : 1 year',100000,CURRENT_DATE,CURRENT_TIME,'electronics','airconditionter','abdullah');

INSERT INTO saleproductoffers(offerNumber,productImage,productName,productDescription,productPrice,productUploadDate,productUploadTime,productCategory,productSubCategory,username)
values (NULL,'hitachiProjector.jpg','Projector','Brand : Hitachi \n Used : 1 year',10000,CURRENT_DATE,CURRENT_TIME,'electronics','projector','abdullah');

INSERT INTO saleproductoffers(offerNumber,productImage,productName,productDescription,productPrice,productUploadDate,productUploadTime,productCategory,productSubCategory,username)
values (NULL,'hpProbook450G1Laptop.jpg','HP Probook 450 G1 Laptop','Brand : A4TECH \n Used : 1 year',100000,CURRENT_DATE,CURRENT_TIME,'electronics','laptop','joy');

INSERT INTO saleproductoffers(offerNumber,productImage,productName,productDescription,productPrice,productUploadDate,productUploadTime,productCategory,productSubCategory,username)
values (NULL,'logitechMouse.jpg','Logitech mouse','Brand : Logitech \n Type : Bluetooth mouse \n Used : 1 year',2500,CURRENT_DATE,CURRENT_TIME,'electronics','mouse','joy');

INSERT INTO saleproductoffers(offerNumber,productImage,productName,productDescription,productPrice,productUploadDate,productUploadTime,productCategory,productSubCategory,username)
values (NULL,'manyMultiPlug.jpg','Multiplug','Brand : Many \n Used : 1 year',3000,CURRENT_DATE,CURRENT_TIME,'electronics','multiplug','joy');

INSERT INTO saleproductoffers(offerNumber,productImage,productName,productDescription,productPrice,productUploadDate,productUploadTime,productCategory,productSubCategory,username)
values (NULL,'transcend1TBExternalHarddisk.jpg','Transcend Harddisk','Brand : Transcend \n Memory : 1TB Type: External \n Used : 1 year',3000,CURRENT_DATE,CURRENT_TIME,'electronics','harddisk','joy');

INSERT INTO saleproductoffers(offerNumber,productImage,productName,productDescription,productPrice,productUploadDate,productUploadTime,productCategory,productSubCategory,username)
values (NULL,'transcend4GBPendrive.jpg','Transcend 4GB Pendrive','Brand : Transcend \n Memory : 4GB \n Used : 2 year',1000,CURRENT_DATE,CURRENT_TIME,'electronics','pendrive','joy');

INSERT INTO saleproductoffers(offerNumber,productImage,productName,productDescription,productPrice,productUploadDate,productUploadTime,productCategory,productSubCategory,username)
values (NULL,'transend64GBPendrive.jpg','Transcend 64GB Pendrive','Brand : Transcend \n Memory : 64GB \n Used : 2 year',10000,CURRENT_DATE,CURRENT_TIME,'electronics','pendrive','joy');

INSERT INTO saleproductoffers(offerNumber,productImage,productName,productDescription,productPrice,productUploadDate,productUploadTime,productCategory,productSubCategory,username)
values (NULL,'whiteBoard.jpg','Whiteboard','Homemade \n Quantity : 1 piece \n Used : 2 year',100,CURRENT_DATE,CURRENT_TIME,'education','whiteBoard','joy');