CREATE TABLE `ads` (
  `id` int NOT NULL,
  `typology` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `pictures` json DEFAULT NULL,
  `house_size` int DEFAULT NULL,
  `garden_size` int DEFAULT NULL,
  `score` int DEFAULT NULL
) ENGINE=InnoDB;

INSERT INTO `ads` (`id`, `typology`, `description`, `pictures`, `house_size`, `garden_size`, `score`) 
VALUES 
(1, 'CHALET', 'Este piso es una ganga, compra, compra, COMPRA!!!!! Este piso es una ganga, compra, compra, COMPRA!!!!!', '[2, 3]', '300', '150', NULL),
(2, 'FLAT', 'Nuevo Ático céntrico recién reformado. No deje pasar la oportunidad y adquiera este Ático de lujo', '[4]', 300, null, null),
(3, 'CHALET', '', '[2]', 300, null, null),
(4, 'FLAT', 'Ático cèntrico muy luminoso y recién reformado, parece nuevo', '[5]', 300, null, null),
(5, 'FLAT', 'Pisazo,', '[3, 8]', 300, null, null),
(6, 'GARAGE', '', '[6]', 300, null, null),
(7, 'GARAGE', 'Garaje en el centro de Albacete', '[]', 300, null, null),
(8, 'CHALET', 'Maravilloso chalet situado en las afueras de un pequeño pueblo rural. El entorno es espectacular, las vistas magníficas. cómprelo ahora!', '[1, 7]', 300, null, null);


CREATE TABLE `pictures` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `url` VARCHAR(250) NULL DEFAULT NULL , 
  `quality` VARCHAR(250) NULL DEFAULT NULL , 
  PRIMARY KEY (`id`)
  ) ENGINE = InnoDB;


  INSERT INTO `pictures` (`id`, `url`, `quality`) 
  VALUES 
  (1, 'https://www.idealista.com/pictures/1', 'SD'), 
  (2, 'https://www.idealista.com/pictures/2', 'HD'),
  (3, 'https://www.idealista.com/pictures/3', 'SD'),
  (4, 'https://www.idealista.com/pictures/4', 'HD'),
  (5, 'https://www.idealista.com/pictures/5', 'SD'),
  (6, 'https://www.idealista.com/pictures/6', 'SD'),
  (7, 'https://www.idealista.com/pictures/7', 'SD'),
  (8, 'https://www.idealista.com/pictures/8', 'HD');