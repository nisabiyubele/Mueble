-- Dump de la Base de Datos
-- Fecha: s�bado 02 agosto 2014 - 01:03:54
--
-- Version: 1.1.1, del 18 de Marzo de 2005, insidephp@gmail.com
-- Soporte y Updaters: http://insidephp.sytes.net
--
-- Host: `localhost`    Database: `sistema`
-- ------------------------------------------------------
-- Server version	5.6.17

--
-- Table structure for table `articulos`
--

DROP TABLE IF EXISTS articulos;
CREATE TABLE `articulos` (
  `idarticulos` int(11) NOT NULL AUTO_INCREMENT,
  `articulo` varchar(45) DEFAULT NULL,
  `modelo` varchar(45) DEFAULT NULL,
  `existencia` double DEFAULT NULL,
  `cost_unitario` double DEFAULT NULL,
  `factura` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idarticulos`)
) ENGINE=InnoDB AUTO_INCREMENT=12354 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articulos`
--

LOCK TABLES articulos WRITE;
INSERT INTO articulos VALUES('1', 'Base de Cama de Madera Matrimonial/Individual', 'Madera', '2543', '1', NULL);
INSERT INTO articulos VALUES('3', 'Bicicleta rodado 20 sencilla Mercurio', '', '18', '1248', '');
INSERT INTO articulos VALUES('4', 'Bicicleta rodado doble suspension 26 Mercurio', '', '19', '1323', '');
INSERT INTO articulos VALUES('5', 'Buro Ardica', 'Madera', '2', '1', '');
INSERT INTO articulos VALUES('6', 'Cajonera 10 cajones', 'Madera', '0', '1500', '');
INSERT INTO articulos VALUES('7', 'Cajonera 5 cajones', 'Madera', '4', '1', '');
INSERT INTO articulos VALUES('8', 'Base de Cama Tubular Individual', 'Tubular', '3', '1', '');
INSERT INTO articulos VALUES('9', 'Base de Cama Tubular Matrimonial', 'Tubular', '100', '680', '');
INSERT INTO articulos VALUES('10', 'Centro de Entretenimiento para 21\",29\",32\"', 'Madera', '6', '1950', '');
INSERT INTO articulos VALUES('11', 'Colchon Individual Crayons/Luxury', 'Crayons', '38', '1065.666667', '');
INSERT INTO articulos VALUES('12', 'Colchon King size Mosquito Free', 'Mosquito Free', '3', '2645', '');
INSERT INTO articulos VALUES('13', 'Colchon King size Summer/Olimpo/Crayons', 'Summer/Olimpo', '3', '1873', '');
INSERT INTO articulos VALUES('14', 'Colchon Matrimonial Crayons/Olimpo/Summer/Hot', 'Crayons/Olimpo', '152', '1246', '');
INSERT INTO articulos VALUES('15', 'Comedor Apolo Tubular de 4 sillas', 'Tubular', '1', '1320', '');
INSERT INTO articulos VALUES('16', 'Comedor Borano Tubular de 6 sillas', 'Tubular', '4', '2555', '');
INSERT INTO articulos VALUES('17', 'Comoda Grande', 'Madera', '2', '1350', '');
INSERT INTO articulos VALUES('18', 'Congelador Whirlpool 9 pies 7H090FXRQ', '7H090FXRQ', '1', '1', '');
INSERT INTO articulos VALUES('19', 'DVD LG DV364', '', '2', '1', '');
INSERT INTO articulos VALUES('20', 'DVD Samsung DVD-C550', '', '4', '1', '');
INSERT INTO articulos VALUES('21', 'DVD Phillips DVP3020K/3160K/3005K/3254K/55', 'DVP3020K/3160K/3005K/3254K/55', '51', '445', '');
INSERT INTO articulos VALUES('22', 'DVD Samsung DVD-P270/280/P290/SPPU555', 'DVD-P280/P290', '26', '445', '');
INSERT INTO articulos VALUES('23', 'DVD Samsung DVD-P190', 'DVD-P190', '36', '1', '');
INSERT INTO articulos VALUES('24', 'DVD Sony DVP-NS57PB', 'DVP-NS57PB', '10', '523', '');
INSERT INTO articulos VALUES('25', 'DVD RCA DRC2302/Proton PD800/Mitsu 1555A/Daew', 'DRC2302', '8', '1', '');
INSERT INTO articulos VALUES('26', 'DVD Apex AD-1230/2102', 'AD-1230/2102', '9', '1', '');
INSERT INTO articulos VALUES('27', 'DVD LG V181', 'V181', '9', '938', '');
INSERT INTO articulos VALUES('28', 'Enfriador Whirlpool WK5101Q', 'WK5101Q', '1', '1949', '');
INSERT INTO articulos VALUES('29', 'Estufa Acros 20\" AF20311PV', 'AF20311PV/AW2800M/SF13120PB', '19', '1530', '');
INSERT INTO articulos VALUES('30', 'Estufa Acros AF5311T00/AF4900B/AF3041/Q/Blanc', 'AF2600B00/AF5311T00/AF4900B', '2', '3402', '');
INSERT INTO articulos VALUES('31', 'Estufa de Gabinete 4 Quemadores P-225/226 Fra', 'P-225/226', '3', '1335', '');
INSERT INTO articulos VALUES('32', 'Horno de Microondas LG MS1447G/1742DP/1440SW', 'MS1447G/1742DP', '11', '1189', '');
INSERT INTO articulos VALUES('33', 'Horno de Microondas Panasonic NN-ST657W/ST658', 'NN-ST657W/ST658W', '3', '1277', '');
INSERT INTO articulos VALUES('34', 'Lavadora Supermatic 14K SLG1415RA ', 'SLG1415RA', '1', '1', '');
INSERT INTO articulos VALUES('35', 'Lavadora Acros 8K ALG805RA', 'ALG805RA', '1', '1', '');
INSERT INTO articulos VALUES('36', 'Lavadora Acros 11K ALP1115/ARL1125', 'ALP1115', '13', '1474', '');
INSERT INTO articulos VALUES('37', 'Lavadora Acros 13K ALP1315UP', 'ALP1315UP', '62', '1673', '');
INSERT INTO articulos VALUES('38', 'Lavadora Acros 17K ALP1735UP/LAD-1735WG', 'ALP1735UP', '6', '2097.5', '');
INSERT INTO articulos VALUES('39', 'Lavadora Whirlpool 9-11K 7MWT73500SQ/7MWT9550', '7MWT95500SQ0', '2', '1', '');
INSERT INTO articulos VALUES('40', 'Lavadora Supermatic/General Electric 10K SLG1', 'SLG1015RA', '3', '1', '');
INSERT INTO articulos VALUES('41', 'Lavadora Supermatic/General Electric 12K SLG1', 'SLG1215RA', '10', '1761', '');
INSERT INTO articulos VALUES('42', 'Lavadora Supermatic 20K LSP2015RA', 'LSP2015RA', '1', '1', '');
INSERT INTO articulos VALUES('43', 'Lavadora Acros 14K ALG1425RA/KOBLENZ', 'ALG1425RA', '2', '1', '');
INSERT INTO articulos VALUES('44', 'Horno de Microondas Whirlpool WM1407D 0.7p3 S', 'LPU-9015-507/607', '0', '759', '');
INSERT INTO articulos VALUES('45', 'Licuadora Osterizer 1v Cromada 450-10', '450-10', '6', '846', '');
INSERT INTO articulos VALUES('46', 'Licuadora Osterizer 10v plastico 869-18/869-1', '6662/4108', '18', '318', '');
INSERT INTO articulos VALUES('47', 'Litera Tubular Individual', 'Tubular', '2', '1147', '');
INSERT INTO articulos VALUES('48', 'Litera Tubular Mixta', 'Tubular', '4', '1279', '');
INSERT INTO articulos VALUES('49', 'Maquina de cocer Singer 2868 C505/179173', '2868 C505/179173', '4', '1', '');
INSERT INTO articulos VALUES('50', 'Minicomponente Sony MHC-GTZ2', 'MHC-GTZ2', '12', '1', '');
INSERT INTO articulos VALUES('51', 'Minicomponente Sony MHC-GTZ3', 'MHC-GTZ3', '7', '1', '');
INSERT INTO articulos VALUES('52', 'Minicomponente LG CM-4330', 'HCR-GTR7', '0', '1431', '');
INSERT INTO articulos VALUES('53', 'Minicomponente Sony MHC-EC77/EC78', 'MHC-EC77/EC78', '34', '1912', '');
INSERT INTO articulos VALUES('54', 'Minicomponente Sony MHC-GT555/GT55BP', 'MHC-GT555/GT55BP/RG5905', '17', '1', '');
INSERT INTO articulos VALUES('55', 'Minicomponente Sony MHC-GT222/GT22BP', 'MHC-GT222/GT22BP', '51', '2465', '');
INSERT INTO articulos VALUES('56', 'Minicomponente Sony MHC-GTX88P/GNX77', 'MHC-GTX88P', '5', '3365', '');
INSERT INTO articulos VALUES('57', 'Estufa Acros 30\" AF1800T Bisquit', 'AF-1800T', '1', '1', '');
INSERT INTO articulos VALUES('58', 'Modular Panasonic SA-TM24/TM43/TM53/TM54/TM75', 'SA-TM43/TM53/TM54/TM750', '18', '2389', '');
INSERT INTO articulos VALUES('59', 'Modular Aiwa', 'AIWA', '9', '3032', '');
INSERT INTO articulos VALUES('60', 'Olla a presion acero inoxidable Man OPM-2280/', 'OPM-2280/SPM-262', '2', '558.5', '');
INSERT INTO articulos VALUES('61', 'Parrilla p/sobreponer dos quemadores Fraga P1', 'P104-1/L-009', '3', '1', '');
INSERT INTO articulos VALUES('62', 'Plancha Panasonic NI-F30NR/NI-S550/S270TR/E25', 'NI-F30NR/NI-S550/S270TR/A615NS', '43', '338', '');
INSERT INTO articulos VALUES('63', 'Porta Microondas', 'Madera', '3', '1', '');
INSERT INTO articulos VALUES('64', 'DVD LG DV454', 'Ardica', '6', '1', '');
INSERT INTO articulos VALUES('65', 'Horno de Microondas Whirlpool WM1211D 1.1p3 S', 'Tubular', '3', '1', '');
INSERT INTO articulos VALUES('66', 'Refrigerador Acros 7p ARP07TNXTXLT/ARM07NP/AR', 'ARP07TXLT/ARM07NP/ARP08TXLT', '79', '2472.25', '');
INSERT INTO articulos VALUES('67', 'Refrigerador Acros 10p AT0001T', 'ART09BGCT/AS7501G/AT0001T', '30', '3060', '');
INSERT INTO articulos VALUES('68', 'Refrigerador Acros 11p ART10BGCQ', 'ART10BGCQ', '1', '1', '');
INSERT INTO articulos VALUES('69', 'Refrigerador Acros 9p AT9501G Plata', 'ART11PGCG', '0', '3507', '');
INSERT INTO articulos VALUES('70', 'Refrigerador Acros 16p ART16BKCT/CQ/ART6901Q', 'ART16BKCT', '2', '4709', '');
INSERT INTO articulos VALUES('71', 'Refrigerador Whirlpool 11p WT1020Q Blanco/T B', '', '7', '4140.5', '');
INSERT INTO articulos VALUES('72', 'Refrigerador Whirlpool 14p WRT14YAOT', 'WRT14YAOT', '1', '1', '');
INSERT INTO articulos VALUES('73', 'Refrigerador Whirlpool 13p WT3935S Acero', 'WRT16YAOQ', '0', '6164', '');
INSERT INTO articulos VALUES('74', 'Ropero Maletero 2pzas', 'Madera', '0', '2275', '');
INSERT INTO articulos VALUES('75', 'Ropero Continetal 3pzas', 'Madera', '2', '2500', '');
INSERT INTO articulos VALUES('76', 'Ropero Roma', 'Madera', '79', '1500', '');
INSERT INTO articulos VALUES('77', 'Sillas Individuales Tubulares', 'Tubular', '18', '212', '');
INSERT INTO articulos VALUES('78', 'Televisor Aurus 22\" LED-22X8F', 'PL42B450B1D', '15', '1845', '');
INSERT INTO articulos VALUES('79', 'Televisor LG 20-21\" 21FJ4RB/FJ4A/FJ5AB FALTRO', '21FJ4RB', '46', '1497', '');
INSERT INTO articulos VALUES('80', 'Televisor LG 21\" 21FJ8RL Ultra SLIM', '21FJ8RL', '18', '1522.5', '');
INSERT INTO articulos VALUES('81', 'Televisor Panasonic 21\" CT-F2128S/G2180MB/G21', 'CT-F2128S/G2180MB/G2180MG', '25', '1381', '');
INSERT INTO articulos VALUES('82', 'Televisor Aurus 24\" LED-24X8F', 'CT-F2920S', '5', '2119.5', '');
INSERT INTO articulos VALUES('83', 'Televisor Phillips 20\",21\" 20PT3331/85R 21PT3', '20PT3331/85R 21PT3005', '26', '1', '');
INSERT INTO articulos VALUES('84', 'Televisor Sharp 20\" 20MR10/14MR10', '20MR10/14MR10', '28', '1180', '');
INSERT INTO articulos VALUES('85', 'Televisor Samsung 21\" CL21Z43MJ/CL21B501HJ SL', 'CL21Z43MJ/CL21B501HJ', '59', '1636', '');
INSERT INTO articulos VALUES('86', 'Televisor Phillips 21\" 21PT6447/85/21PT6146/8', '21PT6447/8521PT6146/85', '22', '1349', '');
INSERT INTO articulos VALUES('87', 'Televisor Phillips 21\" 21PT9457/85 SLIM', '21PT9457/85', '27', '1', '');
INSERT INTO articulos VALUES('88', 'Tocador', 'Madera', '5', '1450', '');
INSERT INTO articulos VALUES('89', 'DVD LG DV827', '', '1', '1', '');
INSERT INTO articulos VALUES('90', 'Vajilla 30 pzas Santa anita', '', '2', '328', '');
INSERT INTO articulos VALUES('91', 'Ventilador de Mesa 16\" Man LM-2116/VM6', 'LM-2116/VM6', '4', '453', '');
INSERT INTO articulos VALUES('92', 'Ventilador de Pedestal 16\" Man/Navia VPG-9016', 'LP-2016', '186', '634.1666667', '');
INSERT INTO articulos VALUES('93', 'Ventilador de Piso 20\" Man Freal 2020', '2020', '35', '464.6666667', '');
INSERT INTO articulos VALUES('94', 'Minicomponente LG CM-6520', 'Chica', '1', '2641', '');
INSERT INTO articulos VALUES('95', 'Vitrina o Alacena Reina', 'Reina', '2', '1530', '');
INSERT INTO articulos VALUES('96', 'Minicomponente Sony MHC-EX8/88', 'Completa', '2', '2136', '');
INSERT INTO articulos VALUES('97', 'Colchon Matrimonial Grand Palace', '', '5', '1398', '');
INSERT INTO articulos VALUES('98', 'Colchon King Size Grand Palace', '', '2', '2298', '');
INSERT INTO articulos VALUES('99', 'Radiograbadora Sony CFD-RG880', 'Espa', '13', '2180.5', '');
INSERT INTO articulos VALUES('100', 'Refrigerador Whirlpool 10p WT0350T/WT03501D S', 'WT-0350T/WT-3501D', '9', '3914.75', '');
INSERT INTO articulos VALUES('101', 'Batidora Osterizer de Pedestal 2520 6v', '2520', '3', '1', '');
INSERT INTO articulos VALUES('102', 'Televisor LG 22\" M2241A LCD', 'SBCMD-110', '20', '2462', '');
INSERT INTO articulos VALUES('103', 'Minisplit Whirlpool WA11209/WA1041Q 220v', 'WA11209', '6', '4074', '');
INSERT INTO articulos VALUES('104', 'Radiograbadora SonyMP3 CFD-S03/Nestek CD-6588', 'CD-6588', '3', '989', '');
INSERT INTO articulos VALUES('105', 'Televisor Sony 32\" KDL-32EX340 LED', '2386', '0', '4285', '');
INSERT INTO articulos VALUES('106', 'Juguetero Tubular 3\" 8 postes', 'Tubular', '1', '1240', '');
INSERT INTO articulos VALUES('107', 'Lavadora Whirlpool 12K 7MWT9601WW', '7MWT9601WW/7MWT9899WU', '4', '2939', '');
INSERT INTO articulos VALUES('108', 'Lavadora Whirlpool 14K 7MWT9899WU', '7MWT9899WU', '0', '3202', '');
INSERT INTO articulos VALUES('109', 'Colchon Matrimonial Koller Doble Colchoneta', 'Koller', '6', '1883', '');
INSERT INTO articulos VALUES('110', 'Modular Philips C/MP3 FWM139/55', 'FWM139/55', '7', '1', '');
INSERT INTO articulos VALUES('111', 'Estufa Acros 20\" AW1000T/1001T Bisquit', 'AW1000T', '44', '1851', '');
INSERT INTO articulos VALUES('112', 'Estufa Acros 20\" AW1000B/1001B Negra', 'NAW1000B', '3', '0', '');
INSERT INTO articulos VALUES('113', 'Lavadora Acros 15k ALB1550XN/ALP1515YR', 'ALB1550XN', '79', '1690', '');
INSERT INTO articulos VALUES('114', 'Licuadora Osterizer Industrial B00-013/BPST-0', 'B00-013/BPST-02-B', '1', '922', '');
INSERT INTO articulos VALUES('115', 'Horno de Microondas Samsung MR-123CS 1.4p SI', 'MR-123CS', '3', '913', '');
INSERT INTO articulos VALUES('116', 'Televisor LG 21\" 21FU6/21F9RGG TL/RL Ultra SL', '21FU6/21F9 TL/RL', '7', '1857', '');
INSERT INTO articulos VALUES('117', 'Televisor RCA 24\" DETC-240M4 LED', 'AF3500S/AF3300T/AE3310/AE5320Q', '0', '0', '');
INSERT INTO articulos VALUES('118', 'DVD LG DV586', 'DV586', '15', '520', '');
INSERT INTO articulos VALUES('119', 'Televisor Aurus 32\" DLED-3201XN/3209XN', '32LU25/LD320/350/LH20', '0', '2939', '');
INSERT INTO articulos VALUES('120', 'Refrigerador Acros 11p AT1902G/AT1902T/1903G ', 'AT1902G/1903G', '2', '0', '');
INSERT INTO articulos VALUES('121', 'Estufa Whirlpool 30\" WF5150B/D/Q Negra/Silver', 'Madera', '6', '3932', '');
INSERT INTO articulos VALUES('122', 'Horno de Microondas LG MS-1143BWM 1.1p', '', '0', '1078', '');
INSERT INTO articulos VALUES('123', 'Ventilador 2-1 18\" MY TECK 3315', '', '28', '605', '');
INSERT INTO articulos VALUES('124', 'Lavadora Whirlpool 17k 7MWTW1706YM', '', '2', '0', '');
INSERT INTO articulos VALUES('125', 'Lavadora Whirlpool 17k 7MWTW1712AM', 'Madera', '4', '4614', '');
INSERT INTO articulos VALUES('126', 'Minicomponente Panasonic SC-AKX52/72', 'SF13120PB', '1', '1', '');
INSERT INTO articulos VALUES('127', 'Lavadora Acros 22K LAP2235VG', 'LAP-2235VG', '2', '2363', '');
INSERT INTO articulos VALUES('128', 'DVD LG DV-642/DP-522 C/USB', 'PB-500', '16', '0', '');
INSERT INTO articulos VALUES('129', 'Horno de Microondas Whirlpool WM1114/1214D 1.', 'WM-1111D', '7', '1228.666667', '');
INSERT INTO articulos VALUES('130', 'Televisor Philips 22\" 22PFL3505D LCD', '22PFL3505D', '4', '2486', '');
INSERT INTO articulos VALUES('131', 'Lavadora Whirlpool 16k 7MWTW1602AW/BM', '42PJ250/PJ350', '0', '4313', '');
INSERT INTO articulos VALUES('132', 'Televisor LG 21\" 21SA1RL Ultra SLIM', '21SA1RL', '3', '1889', '');
INSERT INTO articulos VALUES('133', 'Mesa Plegable BSD-Z185', 'BSD-Z185', '1', '502.5', '');
INSERT INTO articulos VALUES('134', 'Bateria de Cocina Luxor 21pzas Acero Inoxidab', 'FS121-1', '24', '747', '');
INSERT INTO articulos VALUES('135', 'Olla de Acero Prof Gourmet #28 14.2LTS 507 WV', 'WV28', '14', '350.25', '');
INSERT INTO articulos VALUES('136', 'Olla Convexa Acero Prof Gourmet 29LTS KM109', 'KM109', '10', '562.5', '');
INSERT INTO articulos VALUES('137', 'Juego de Ollas de 4 Budineras C/Caps y Dif Ca', 'FS104', '3', '264.26', '');
INSERT INTO articulos VALUES('138', 'Juego de Ollas de 4 Budineras #18,20,22 y 24 ', 'FS108-2', '2', '244.55', '');
INSERT INTO articulos VALUES('139', 'Refrigerador Whirlpool 16 pies WT6502N/6505N', 'REY030', '2', '6729', '');
INSERT INTO articulos VALUES('140', 'Refrigerador Acros 9p AT9007T Almendra', 'AT9007T', '3', '3450', '');
INSERT INTO articulos VALUES('141', 'Refrigerador Acros 9p ART09BGCT/ART09NGS/AS75', '', '3', '2766', '');
INSERT INTO articulos VALUES('142', 'Refrigerador Supermatic 7 y 9 pies SRP07TXLT/', '', '2', '1679', '');
INSERT INTO articulos VALUES('143', 'Refrigerador Mabe RML11XHM/Daewoo/IEM', '', '2', '1', '');
INSERT INTO articulos VALUES('144', 'Refrigerador Whirlpool 16p WT6007Q Blanco', '', '0', '5066', '');
INSERT INTO articulos VALUES('145', 'Minicomponente Panasonic SC-AKX16', '', '0', '1761', '');
INSERT INTO articulos VALUES('146', 'Minicomponente Panasonic SC-AKX38', '', '0', '7709', '');
INSERT INTO articulos VALUES('147', 'Minicomponente Sony MHC-EX9/99', '', '11', '2756', '');
INSERT INTO articulos VALUES('148', 'Bateria de Cocina de Acero Inoxidable H-RLM10', '', '26', '1293.21', '');
INSERT INTO articulos VALUES('149', 'Estufa Whirlpool 30\" WF5420D Plata', '', '2', '4019', '');
INSERT INTO articulos VALUES('150', 'Estufa Acros 30\" AF1850B/Q/T Negra/Blanco/Bis', '', '11', '2538', '');
INSERT INTO articulos VALUES('151', 'Estufa Acros 30\" AF5120B/Q/T Negro/Blanco/Bis', '', '6', '2973', '');
INSERT INTO articulos VALUES('152', 'Estufa Acros 30\" AF5200Q Blanco', '', '2', '3030', '');
INSERT INTO articulos VALUES('153', 'Estufa Acros 30\" AF5800M Metalico', '', '3', '4691', '');
INSERT INTO articulos VALUES('154', 'Minicomponente Panasonic SC-AKX36', '', '0', '2191', '');
INSERT INTO articulos VALUES('155', 'Televisor Daewoo 32\" DW32D1', '', '1', '1', '');
INSERT INTO articulos VALUES('156', 'Televisor Daewoo, Sony KV21FW150/RCA/GE/ F203', '', '10', '1', '');
INSERT INTO articulos VALUES('157', 'Televisor Philips 29\" 29PT5431/85', '', '1', '1', '');
INSERT INTO articulos VALUES('158', 'Televisor JVC 14\" AC120V/PILCO/General Electr', '', '2', '1', '');
INSERT INTO articulos VALUES('159', 'DVD Samsung DVD-D360K/E360', '', '45', '457', '');
INSERT INTO articulos VALUES('160', 'DVD Sony DVP-SR220/200/110', '', '31', '428', '');
INSERT INTO articulos VALUES('161', 'DVD LG DP-122/132 con USB', '', '0', '380', '');
INSERT INTO articulos VALUES('162', 'Televisor LG 23\" M2362D-PM LCD FULL HD', '', '1', '3083', '');
INSERT INTO articulos VALUES('163', 'Comoda Infantil', '', '1', '950', '');
INSERT INTO articulos VALUES('164', 'Horno de Microondas LG MS1449CS Silver', '', '7', '1450', '');
INSERT INTO articulos VALUES('165', 'Tocador Infantil', '', '3', '1400', '');
INSERT INTO articulos VALUES('166', 'Colchon Matrimonial Grape', '', '3', '2444', '');
INSERT INTO articulos VALUES('167', 'Estufa Acros 30\" AF3300T Beige', '', '1', '0', '');
INSERT INTO articulos VALUES('168', 'Minicoponente Sony MHC-RG5905', '', '5', '0', '');
INSERT INTO articulos VALUES('169', 'Estufa Whirlpool 30\" WE6250S Acero Inoxidable', '', '0', '4735', '');
INSERT INTO articulos VALUES('170', 'Lavadora Whirlpool 22K 7MWTW5722BC', '', '0', '4427', '');
INSERT INTO articulos VALUES('171', 'Televisor Samsung 22\" B2230HD LCD', '', '1', '0', '');
INSERT INTO articulos VALUES('172', 'Centro de Planchado Man-Navia EPV600', '', '2', '0', '');
INSERT INTO articulos VALUES('173', 'Horno de Microondas LG MS1155KYL/1145KYL ', '', '5', '1270', '');
INSERT INTO articulos VALUES('174', 'Licuadora Man 4v LPU-9014/5041', '', '0', '427', '');
INSERT INTO articulos VALUES('175', 'Licuadora Man 10v LPU-510/507', '', '48', '520.3333333', '');
INSERT INTO articulos VALUES('176', 'Colchon Individual Mosquito Free', '', '2', '1665', '');
INSERT INTO articulos VALUES('177', 'Estufa Acros 30\" AF5300Q Blanca', '', '2', '0', '');
INSERT INTO articulos VALUES('178', 'Horno de Microondas Daewoo DFR9010DN', '', '1', '1', '');
INSERT INTO articulos VALUES('179', 'Andadera con Flautin MY0509/5509', '', '2', '279', '');
INSERT INTO articulos VALUES('180', 'Andadera de Lujo MY5522', '', '8', '335', '');
INSERT INTO articulos VALUES('181', 'Minisplit Aux ASW-12A2/HSA/SK 220V', '', '0', '2753', '');
INSERT INTO articulos VALUES('182', 'Bicicleta Mercurio Bronco R20', '', '1', '1758', '');
INSERT INTO articulos VALUES('183', 'Estufa Acros 30\" AF5000B Negra', '', '0', '0', '');
INSERT INTO articulos VALUES('184', 'Estufa Acros 30\" AF5000Q Blanca', '', '0', '0', '');
INSERT INTO articulos VALUES('185', 'Bicicleta Mercurio Hunter R16 D/S', '', '1', '1270', '');
INSERT INTO articulos VALUES('186', 'Bicicleta Mercurio Magnum R16', '', '1', '1133', '');
INSERT INTO articulos VALUES('187', 'Bicicleta Mercurio Radar R26 6v', '', '1', '1078', '');
INSERT INTO articulos VALUES('188', 'Bicicleta Mercuio Sharpey R26 Mujer', '', '1', '1209', '');
INSERT INTO articulos VALUES('189', 'Bicicleta Mercurio Skiller R20 D/S', '', '1', '1557', '');
INSERT INTO articulos VALUES('190', 'Bicicleta Mercurio Sweetgirl R12', '', '1', '929', '');
INSERT INTO articulos VALUES('191', 'Lavadora Acros 12k ALD-1225AF', '', '0', '0', '');
INSERT INTO articulos VALUES('192', 'Lavadora Acros 19k ALP-1935UG', '', '0', '0', '');
INSERT INTO articulos VALUES('193', 'Carriola para Bebe MY5103', '', '2', '687', '');
INSERT INTO articulos VALUES('194', 'Carriola para Bebe Reversible MY5104', '', '3', '864', '');
INSERT INTO articulos VALUES('195', 'Carrito Baby ATV MY5204', '', '2', '557', '');
INSERT INTO articulos VALUES('196', 'Carrito Bombero MY5504', '', '1', '165', '');
INSERT INTO articulos VALUES('197', 'Carrito Elefante MY0503/5503', '', '3', '176', '');
INSERT INTO articulos VALUES('198', 'Carrito Jeep MY5502', '', '2', '165', '');
INSERT INTO articulos VALUES('199', 'Carrito Locomotora MY5558', '', '3', '420', '');
INSERT INTO articulos VALUES('200', 'Carrito Minimovil MY5205', '', '2', '496', '');
INSERT INTO articulos VALUES('201', 'Carrito Policia Azul MY5561P', '', '1', '246', '');
INSERT INTO articulos VALUES('202', 'Minicomponente Samsung MX-E661', '', '0', '1651', '');
INSERT INTO articulos VALUES('203', 'Minicomponente LG RAD-136/125', '', '1', '1315.5', '');
INSERT INTO articulos VALUES('204', 'Minicomponente LG MDS-715', '', '1', '2973', '');
INSERT INTO articulos VALUES('205', 'Minicomponente Panasonic SC-AKX12', '', '0', '1651', '');
INSERT INTO articulos VALUES('206', 'Minicomponente Panasonic SC-AKX92', '', '1', '4405', '');
INSERT INTO articulos VALUES('207', 'Comedor Barcelona Tubular FCA de 6 Sillas (7 ', '', '1', '2970', '');
INSERT INTO articulos VALUES('208', 'Comedor Mykonos Tubular de 6 Sillas (7 Pzas)', '', '0', '3390', '');
INSERT INTO articulos VALUES('209', 'Refrigerador Whirlpool 12p WT2020D Silver', '', '0', '4357', '');
INSERT INTO articulos VALUES('210', 'Home Theater Sony DVA-TZ135 c/DVD 5.1 Canales', '', '1', '1430', '');
INSERT INTO articulos VALUES('211', 'Horno de Microondas Electrico Taurus TRITON J', '', '1', '321', '');
INSERT INTO articulos VALUES('212', 'Kit Maquina de Coser Singer 15cd C/Muebles', '', '1', '2287', '');
INSERT INTO articulos VALUES('213', 'Lavadora Whirlpool 15k 7MWTW1500AQ', '', '0', '3825', '');
INSERT INTO articulos VALUES('214', 'Lavadora Whirlpool 18k 7MWTW1812AW', '', '0', '6059', '');
INSERT INTO articulos VALUES('215', 'Lavadora Whirlpool 18k 7MWTW1801BQ', '', '0', '5127.5', '');
INSERT INTO articulos VALUES('216', 'Licuadora Osterizer 1v 891-13', '', '1', '351', '');
INSERT INTO articulos VALUES('217', 'Minicomponente LG RAD-226B', '', '0', '1618', '');
INSERT INTO articulos VALUES('218', 'Minisplit LG SJ121CD', '', '2', '4449', '');
INSERT INTO articulos VALUES('219', 'Moto Eagle-Beak MY5619', '', '1', '1691', '');
INSERT INTO articulos VALUES('220', 'Refrigerador Whirlpool 22p WD2003D Silver', '', '0', '9555', '');
INSERT INTO articulos VALUES('221', 'Refrigerador Whirlpool 18p WT8003Q Blanco', '', '0', '4782', '');
INSERT INTO articulos VALUES('222', 'Refrigerador Whirlpool 12p WT2030Q Blanco', '', '0', '4463', '');
INSERT INTO articulos VALUES('223', 'Colchon King Size Oasis', '', '4', '4298', '');
INSERT INTO articulos VALUES('224', 'Refrigerador Acros 13p AT3001G Silver', '', '1', '0', '');
INSERT INTO articulos VALUES('225', 'Batidora Osterizer Chocomilero 440-20/2523', '', '8', '1526', '');
INSERT INTO articulos VALUES('319', 'Tablet Aurus 10\"', 'kkksjjd', '10', '1000', '2154');
INSERT INTO articulos VALUES('12329', NULL, NULL, NULL, NULL, NULL);
INSERT INTO articulos VALUES('12330', NULL, NULL, NULL, NULL, NULL);
INSERT INTO articulos VALUES('12331', NULL, NULL, NULL, NULL, NULL);
INSERT INTO articulos VALUES('12332', NULL, NULL, NULL, NULL, NULL);
INSERT INTO articulos VALUES('12333', NULL, NULL, NULL, NULL, NULL);
INSERT INTO articulos VALUES('12334', NULL, NULL, NULL, NULL, NULL);
INSERT INTO articulos VALUES('12335', NULL, NULL, NULL, NULL, NULL);
INSERT INTO articulos VALUES('12336', NULL, NULL, NULL, NULL, NULL);
INSERT INTO articulos VALUES('12337', NULL, NULL, NULL, NULL, NULL);
INSERT INTO articulos VALUES('12338', NULL, NULL, NULL, NULL, NULL);
INSERT INTO articulos VALUES('12339', NULL, NULL, NULL, NULL, NULL);
INSERT INTO articulos VALUES('12340', NULL, NULL, NULL, NULL, NULL);
INSERT INTO articulos VALUES('12341', NULL, NULL, NULL, NULL, NULL);
INSERT INTO articulos VALUES('12342', NULL, NULL, NULL, NULL, NULL);
INSERT INTO articulos VALUES('12343', NULL, NULL, NULL, NULL, NULL);
INSERT INTO articulos VALUES('12344', NULL, NULL, NULL, NULL, NULL);
INSERT INTO articulos VALUES('12345', NULL, NULL, NULL, NULL, NULL);
INSERT INTO articulos VALUES('12346', NULL, NULL, NULL, NULL, NULL);
INSERT INTO articulos VALUES('12347', NULL, NULL, NULL, NULL, NULL);
INSERT INTO articulos VALUES('12348', NULL, NULL, NULL, NULL, NULL);
INSERT INTO articulos VALUES('12349', NULL, NULL, NULL, NULL, NULL);
INSERT INTO articulos VALUES('12350', NULL, NULL, NULL, NULL, NULL);
INSERT INTO articulos VALUES('12351', NULL, NULL, NULL, NULL, NULL);
INSERT INTO articulos VALUES('12352', NULL, NULL, NULL, NULL, NULL);
INSERT INTO articulos VALUES('12353', NULL, NULL, NULL, NULL, NULL);
UNLOCK TABLES;


--
-- Table structure for table `cobro`
--

DROP TABLE IF EXISTS cobro;
CREATE TABLE `cobro` (
  `idcobro` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_cobro` date DEFAULT NULL,
  `trabajadores_idtrabajadores` int(11) NOT NULL,
  `n_tarjetas` double DEFAULT NULL,
  `cobro` double DEFAULT NULL,
  PRIMARY KEY (`idcobro`),
  KEY `fk_cobro_trabajadores1_idx` (`trabajadores_idtrabajadores`),
  CONSTRAINT `fk_cobro_trabajadores1` FOREIGN KEY (`trabajadores_idtrabajadores`) REFERENCES `trabajadores` (`idtrabajadores`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cobro`
--

LOCK TABLES cobro WRITE;
UNLOCK TABLES;


--
-- Table structure for table `conceptos`
--

DROP TABLE IF EXISTS conceptos;
CREATE TABLE `conceptos` (
  `idconceptos` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `entrada` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idconceptos`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `conceptos`
--

LOCK TABLES conceptos WRITE;
INSERT INTO conceptos VALUES('1', 'Entrada UNO', '1');
INSERT INTO conceptos VALUES('2', 'Baja UNO', '0');
UNLOCK TABLES;


--
-- Table structure for table `cortecaja`
--

DROP TABLE IF EXISTS cortecaja;
CREATE TABLE `cortecaja` (
  `idcortecaja` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_corte` datetime DEFAULT NULL,
  `concepto` varchar(45) DEFAULT NULL,
  `cantidad` double DEFAULT NULL,
  `entrada` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcortecaja`)
) ENGINE=InnoDB AUTO_INCREMENT=566 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cortecaja`
--

LOCK TABLES cortecaja WRITE;
INSERT INTO cortecaja VALUES('457', '2014-07-26 13:04:25', 'Ruta 1 de Carlos Hernandez', '200', '1');
INSERT INTO cortecaja VALUES('460', '2014-07-26 13:17:16', 'Ruta 3 de Abraham', '1750', '1');
INSERT INTO cortecaja VALUES('461', '2014-07-26 13:04:25', 'Vale de Carlos Hernandez', '100', '0');
INSERT INTO cortecaja VALUES('462', '2014-07-26 13:17:28', 'Ruta 4 de Chava', '5730', '1');
INSERT INTO cortecaja VALUES('463', '2014-07-26 13:24:57', 'Ruta 7 de Jorge', '4240', '1');
INSERT INTO cortecaja VALUES('502', '2014-07-28 09:54:05', 'Ruta 300 de Chava', '2000', '1');
INSERT INTO cortecaja VALUES('504', '2014-07-28 10:01:02', 'Ruta 3 de Abraham', '2222222', '1');
INSERT INTO cortecaja VALUES('505', '0000-00-00 00:00:00', 'Vale de Alberto', '2033555', '0');
INSERT INTO cortecaja VALUES('506', '2014-07-28 10:01:29', 'Ruta 32 de Alberto', '2255555', '1');
INSERT INTO cortecaja VALUES('507', '0000-00-00 00:00:00', 'Vale de Alberto', '2033555', '0');
INSERT INTO cortecaja VALUES('508', '2014-07-28 10:01:29', 'Ruta 32 de Alberto', '2255555', '1');
INSERT INTO cortecaja VALUES('509', '0000-00-00 00:00:00', 'Vale de Oficina', '1011', '0');
INSERT INTO cortecaja VALUES('510', '0000-00-00 00:00:00', 'Ruta 44 de Oficina', '2011', '1');
INSERT INTO cortecaja VALUES('511', '0000-00-00 00:00:00', 'Vale de Carlos Hernandez', '188015', '0');
INSERT INTO cortecaja VALUES('512', '2014-07-28 10:09:04', 'Ruta 45 de Carlos Hernandez', '200015', '1');
INSERT INTO cortecaja VALUES('513', '2014-07-28 10:12:00', 'Vale de Jorge', '3000', '0');
INSERT INTO cortecaja VALUES('514', '2014-07-28 10:12:00', 'Ruta 1 de Jorge', '15000', '1');
INSERT INTO cortecaja VALUES('515', '2014-07-28 10:39:10', 'Vale de Oficina', '423', '0');
INSERT INTO cortecaja VALUES('516', '2014-07-28 10:39:10', 'Ruta 54 de Oficina', '1423', '1');
INSERT INTO cortecaja VALUES('517', '2014-07-28 10:47:51', 'Vale de Jorge', '1210111', '0');
INSERT INTO cortecaja VALUES('518', '2014-07-28 10:47:51', 'Ruta 11 de Jorge', '1211111', '1');
INSERT INTO cortecaja VALUES('519', '2014-07-28 11:00:05', 'Vale de Abraham', '1014', '0');
INSERT INTO cortecaja VALUES('520', '2014-07-28 11:00:05', 'Ruta 12 de Abraham', '2014', '1');
INSERT INTO cortecaja VALUES('521', '2014-07-28 11:03:19', 'Vale de Prueba de Modificacion', '200', '0');
INSERT INTO cortecaja VALUES('522', '2014-07-28 11:03:19', 'Ruta 12 de Prueba de Modificacion', '1200', '1');
INSERT INTO cortecaja VALUES('523', '2014-07-28 11:15:02', 'Vale de Cristhian Zapata', '9000', '0');
INSERT INTO cortecaja VALUES('524', '2014-07-28 11:15:02', 'Ruta 23 de Cristhian Zapata', '10000', '1');
INSERT INTO cortecaja VALUES('525', '2014-07-28 11:15:02', 'Vale de Cristhian Zapata', '9000', '0');
INSERT INTO cortecaja VALUES('526', '2014-07-28 11:15:02', 'Ruta 23 de Cristhian Zapata', '10000', '1');
INSERT INTO cortecaja VALUES('527', '2014-07-28 11:25:50', 'Vale de Prueba de Modificacion', '1015', '0');
INSERT INTO cortecaja VALUES('528', '2014-07-28 11:25:50', 'Ruta 2 de Prueba de Modificacion', '2015', '1');
INSERT INTO cortecaja VALUES('529', '2014-07-28 00:00:00', 'Prestamo a Oficina', '4000', '0');
INSERT INTO cortecaja VALUES('530', '2014-07-29 09:48:01', 'Vale de Oficina', '150', '0');
INSERT INTO cortecaja VALUES('531', '2014-07-29 09:48:01', 'Ruta 5 de Oficina', '200', '1');
INSERT INTO cortecaja VALUES('532', '2014-07-29 10:48:49', NULL, '14', NULL);
INSERT INTO cortecaja VALUES('533', '2014-07-29 17:12:02', 'Vale de Abraham', '2010', '0');
INSERT INTO cortecaja VALUES('534', '2014-07-29 17:12:02', 'Ruta 14 de Abraham', '5010', '1');
INSERT INTO cortecaja VALUES('535', '2014-07-29 17:18:37', 'Vale de Oficina', '12', '0');
INSERT INTO cortecaja VALUES('536', '2014-07-29 17:18:37', 'Ruta 222 de Oficina', '3012', '1');
INSERT INTO cortecaja VALUES('537', '2014-07-30 16:06:03', 'Vale de Prueba de Modificacion', '1000', '0');
INSERT INTO cortecaja VALUES('538', '2014-07-30 16:06:03', 'Ruta 13 de Prueba de Modificacion', '2000', '1');
INSERT INTO cortecaja VALUES('539', '2014-07-30 16:12:53', 'Entrada UNO', '12333', '1');
INSERT INTO cortecaja VALUES('540', '2014-07-30 18:13:03', 'Entrada UNO', '1000', '1');
INSERT INTO cortecaja VALUES('541', '2014-07-30 18:18:35', 'Entrada UNO', '1000', '1');
INSERT INTO cortecaja VALUES('542', '2014-07-30 18:19:33', 'Entrada UNO', '1000', '1');
INSERT INTO cortecaja VALUES('543', '2014-07-30 00:00:00', 'Prestamo a Oficina', '1000', '0');
INSERT INTO cortecaja VALUES('544', '2014-07-30 18:43:54', 'Entrada UNO', '400', '1');
INSERT INTO cortecaja VALUES('545', '2014-07-31 08:57:24', 'Entrada UNO', '100', '1');
INSERT INTO cortecaja VALUES('546', '2014-07-31 09:06:43', 'Vale de Sin Seguro', '13000', '0');
INSERT INTO cortecaja VALUES('547', '2014-07-31 09:06:43', 'Ruta 125 de Sin Seguro', '15000', '1');
INSERT INTO cortecaja VALUES('548', '2014-07-31 09:08:56', 'Vale de Cristhian Zapata Cabrera', '136', '0');
INSERT INTO cortecaja VALUES('549', '2014-07-31 09:08:56', 'Ruta 1 de Cristhian Zapata Cabrera', '159', '1');
INSERT INTO cortecaja VALUES('550', '2014-07-31 09:08:56', 'Vale de Cristhian Zapata Cabrera', '99', '0');
INSERT INTO cortecaja VALUES('551', '2014-07-31 09:08:56', 'Ruta 1 de Cristhian Zapata Cabrera', '159', '1');
INSERT INTO cortecaja VALUES('552', '2014-07-31 00:00:00', 'Prestamo a Cuarto Administrativo', '1000', '0');
INSERT INTO cortecaja VALUES('553', '2014-07-31 09:16:01', 'Entrada UNO', '200', '1');
INSERT INTO cortecaja VALUES('554', '2014-07-31 17:39:40', 'Vale de SUPER USER', '89', '0');
INSERT INTO cortecaja VALUES('555', '2014-07-31 17:39:40', 'Ruta 1 de SUPER USER', '112', '1');
INSERT INTO cortecaja VALUES('556', '2014-07-31 17:48:28', 'Vale de Carlos Hernandez', '13', '0');
INSERT INTO cortecaja VALUES('557', '2014-07-31 17:48:28', 'Ruta 2014 de Carlos Hernandez', '113', '1');
INSERT INTO cortecaja VALUES('558', '2014-07-31 16:49:40', 'Enganche de Chava', '1000', '1');
INSERT INTO cortecaja VALUES('559', '2014-08-01 09:38:44', 'Vale de SUPER USER', '200', '0');
INSERT INTO cortecaja VALUES('560', '2014-08-01 09:38:44', 'Ruta 1 de SUPER USER', '1200', '1');
INSERT INTO cortecaja VALUES('561', '2014-08-01 00:00:00', 'Prestamo a SUPER USER', '1000', '0');
INSERT INTO cortecaja VALUES('562', '2014-08-01 11:38:08', 'Vale de Primer Administrativo', '222', '0');
INSERT INTO cortecaja VALUES('563', '2014-08-01 11:38:08', 'Ruta 12 de Primer Administrativo', '10222', '1');
INSERT INTO cortecaja VALUES('564', '2014-08-01 11:40:44', 'Baja UNO', '10000', '0');
INSERT INTO cortecaja VALUES('565', '2014-08-01 00:00:00', 'Enganche de Jorge', '100', '1');
UNLOCK TABLES;


--
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS departamentos;
CREATE TABLE `departamentos` (
  `iddepartamentos` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`iddepartamentos`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departamentos`
--

LOCK TABLES departamentos WRITE;
INSERT INTO departamentos VALUES('1', 'Administración');
INSERT INTO departamentos VALUES('2', 'Crédito y Cobranza');
UNLOCK TABLES;


--
-- Table structure for table `ent_ven`
--

DROP TABLE IF EXISTS ent_ven;
CREATE TABLE `ent_ven` (
  `ident_ven` int(11) NOT NULL AUTO_INCREMENT,
  `articulo` int(11) NOT NULL,
  `vendedor` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`ident_ven`),
  KEY `fk_ent_ven_invendor1_idx` (`articulo`,`vendedor`),
  CONSTRAINT `fk_ent_ven_invendor1` FOREIGN KEY (`articulo`, `vendedor`) REFERENCES `invendor` (`articulos_idarticulos`, `trabajadores_idtrabajadores`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ent_ven`
--

LOCK TABLES ent_ven WRITE;
UNLOCK TABLES;


--
-- Table structure for table `entrada`
--

DROP TABLE IF EXISTS entrada;
CREATE TABLE `entrada` (
  `iddevolucion` int(11) NOT NULL AUTO_INCREMENT,
  `factura` varchar(45) DEFAULT NULL,
  `fecha_devo` datetime DEFAULT NULL,
  `articulos_idarticulos` int(11) NOT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddevolucion`),
  KEY `fk_devolucion_articulos1_idx` (`articulos_idarticulos`),
  CONSTRAINT `fk_devolucion_articulos1` FOREIGN KEY (`articulos_idarticulos`) REFERENCES `articulos` (`idarticulos`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `entrada`
--

LOCK TABLES entrada WRITE;
UNLOCK TABLES;


--
-- Table structure for table `invendor`
--

DROP TABLE IF EXISTS invendor;
CREATE TABLE `invendor` (
  `articulos_idarticulos` int(11) NOT NULL,
  `trabajadores_idtrabajadores` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `ventas_idventas` int(11) NOT NULL,
  PRIMARY KEY (`articulos_idarticulos`,`trabajadores_idtrabajadores`),
  KEY `fk_articulos_has_trabajadores_trabajadores1_idx` (`trabajadores_idtrabajadores`),
  KEY `fk_articulos_has_trabajadores_articulos1_idx` (`articulos_idarticulos`),
  KEY `fk_invendor_ventas1_idx` (`ventas_idventas`),
  CONSTRAINT `fk_articulos_has_trabajadores_articulos1` FOREIGN KEY (`articulos_idarticulos`) REFERENCES `articulos` (`idarticulos`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_articulos_has_trabajadores_trabajadores1` FOREIGN KEY (`trabajadores_idtrabajadores`) REFERENCES `trabajadores` (`idtrabajadores`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_invendor_ventas1` FOREIGN KEY (`ventas_idventas`) REFERENCES `ventas` (`idventas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invendor`
--

LOCK TABLES invendor WRITE;
UNLOCK TABLES;


--
-- Table structure for table `motos`
--

DROP TABLE IF EXISTS motos;
CREATE TABLE `motos` (
  `idmotos` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `cantidad` double DEFAULT NULL,
  `num_sem` int(11) DEFAULT NULL,
  `cob_sem` double DEFAULT NULL,
  `trabajadores_idtrabajadores` int(11) NOT NULL,
  PRIMARY KEY (`idmotos`),
  KEY `fk_motos_trabajadores1_idx` (`trabajadores_idtrabajadores`),
  CONSTRAINT `fk_motos_trabajadores1` FOREIGN KEY (`trabajadores_idtrabajadores`) REFERENCES `trabajadores` (`idtrabajadores`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `motos`
--

LOCK TABLES motos WRITE;
UNLOCK TABLES;


--
-- Table structure for table `nomina_admin`
--

DROP TABLE IF EXISTS nomina_admin;
CREATE TABLE `nomina_admin` (
  `idnomina_admin` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_na` date DEFAULT NULL,
  `nomina_admincol` varchar(45) DEFAULT NULL,
  `cortecaja_idcortecaja` int(11) NOT NULL,
  PRIMARY KEY (`idnomina_admin`),
  KEY `fk_nomina_admin_cortecaja1_idx` (`cortecaja_idcortecaja`),
  CONSTRAINT `fk_nomina_admin_cortecaja1` FOREIGN KEY (`cortecaja_idcortecaja`) REFERENCES `cortecaja` (`idcortecaja`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nomina_admin`
--

LOCK TABLES nomina_admin WRITE;
UNLOCK TABLES;


--
-- Table structure for table `nomina_cobr`
--

DROP TABLE IF EXISTS nomina_cobr;
CREATE TABLE `nomina_cobr` (
  `idnomina_cobr` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_nc` date DEFAULT NULL,
  `cobro_idcobro` int(11) NOT NULL,
  `cortecaja_idcortecaja` int(11) NOT NULL,
  PRIMARY KEY (`idnomina_cobr`),
  KEY `fk_nomina_cobr_cobro1_idx` (`cobro_idcobro`),
  KEY `fk_nomina_cobr_cortecaja1_idx` (`cortecaja_idcortecaja`),
  CONSTRAINT `fk_nomina_cobr_cobro1` FOREIGN KEY (`cobro_idcobro`) REFERENCES `cobro` (`idcobro`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_nomina_cobr_cortecaja1` FOREIGN KEY (`cortecaja_idcortecaja`) REFERENCES `cortecaja` (`idcortecaja`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nomina_cobr`
--

LOCK TABLES nomina_cobr WRITE;
UNLOCK TABLES;


--
-- Table structure for table `nomina_ventas`
--

DROP TABLE IF EXISTS nomina_ventas;
CREATE TABLE `nomina_ventas` (
  `idnom_ventas` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_nv` date DEFAULT NULL,
  `ventas_idventas` int(11) NOT NULL,
  `cortecaja_idcortecaja` int(11) NOT NULL,
  PRIMARY KEY (`idnom_ventas`),
  KEY `fk_nomina_ventas_ventas1_idx` (`ventas_idventas`),
  KEY `fk_nomina_ventas_cortecaja1_idx` (`cortecaja_idcortecaja`),
  CONSTRAINT `fk_nomina_ventas_cortecaja1` FOREIGN KEY (`cortecaja_idcortecaja`) REFERENCES `cortecaja` (`idcortecaja`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_nomina_ventas_ventas1` FOREIGN KEY (`ventas_idventas`) REFERENCES `ventas` (`idventas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nomina_ventas`
--

LOCK TABLES nomina_ventas WRITE;
UNLOCK TABLES;


--
-- Table structure for table `prestamo`
--

DROP TABLE IF EXISTS prestamo;
CREATE TABLE `prestamo` (
  `idprestamo` int(11) NOT NULL AUTO_INCREMENT,
  `efectivo` double DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `num_sem` int(11) DEFAULT NULL,
  `cob_sem` double DEFAULT NULL,
  `trabajadores_idtrabajadores` int(11) NOT NULL,
  `total` double DEFAULT NULL,
  `adeudo` double DEFAULT NULL,
  PRIMARY KEY (`idprestamo`),
  KEY `fk_prestamo_trabajadores1_idx` (`trabajadores_idtrabajadores`),
  CONSTRAINT `fk_prestamo_trabajadores1` FOREIGN KEY (`trabajadores_idtrabajadores`) REFERENCES `trabajadores` (`idtrabajadores`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prestamo`
--

LOCK TABLES prestamo WRITE;
INSERT INTO prestamo VALUES('1', '4000', '2014-07-28', '10', '400', '3', NULL, NULL);
INSERT INTO prestamo VALUES('2', '3600', '2014-08-03', '10', '400', '3', NULL, NULL);
INSERT INTO prestamo VALUES('3', '3200', '2014-08-09', '10', '400', '3', NULL, NULL);
INSERT INTO prestamo VALUES('4', '2800', '2014-08-15', '10', '400', '3', NULL, NULL);
INSERT INTO prestamo VALUES('5', '2400', '2014-08-21', '10', '400', '3', NULL, NULL);
INSERT INTO prestamo VALUES('6', '2000', '2014-08-27', '10', '400', '3', NULL, NULL);
INSERT INTO prestamo VALUES('7', '1600', '2014-09-02', '10', '400', '3', NULL, NULL);
INSERT INTO prestamo VALUES('8', '1200', '2014-09-08', '10', '400', '3', NULL, NULL);
INSERT INTO prestamo VALUES('9', '800', '2014-09-14', '10', '400', '3', NULL, NULL);
INSERT INTO prestamo VALUES('10', '400', '2014-09-20', '10', '400', '3', NULL, NULL);
INSERT INTO prestamo VALUES('11', '1000', '2014-07-30', '10', '100', '3', NULL, NULL);
INSERT INTO prestamo VALUES('12', '900', '2014-08-05', '10', '100', '3', NULL, NULL);
INSERT INTO prestamo VALUES('13', '800', '2014-08-11', '10', '100', '3', NULL, NULL);
INSERT INTO prestamo VALUES('14', '700', '2014-08-17', '10', '100', '3', NULL, NULL);
INSERT INTO prestamo VALUES('15', '600', '2014-08-23', '10', '100', '3', NULL, NULL);
INSERT INTO prestamo VALUES('16', '500', '2014-08-29', '10', '100', '3', NULL, NULL);
INSERT INTO prestamo VALUES('17', '400', '2014-09-04', '10', '100', '3', NULL, NULL);
INSERT INTO prestamo VALUES('18', '300', '2014-09-10', '10', '100', '3', NULL, NULL);
INSERT INTO prestamo VALUES('19', '200', '2014-09-16', '10', '100', '3', NULL, NULL);
INSERT INTO prestamo VALUES('20', '100', '2014-09-22', '10', '100', '3', NULL, NULL);
INSERT INTO prestamo VALUES('21', '1000', '2014-07-31', '10', '100', '448', NULL, NULL);
INSERT INTO prestamo VALUES('22', '900', '2014-08-06', '10', '100', '448', NULL, NULL);
INSERT INTO prestamo VALUES('23', '800', '2014-08-12', '10', '100', '448', NULL, NULL);
INSERT INTO prestamo VALUES('24', '700', '2014-08-18', '10', '100', '448', NULL, NULL);
INSERT INTO prestamo VALUES('25', '600', '2014-08-24', '10', '100', '448', NULL, NULL);
INSERT INTO prestamo VALUES('26', '500', '2014-08-30', '10', '100', '448', NULL, NULL);
INSERT INTO prestamo VALUES('27', '400', '2014-09-05', '10', '100', '448', NULL, NULL);
INSERT INTO prestamo VALUES('28', '300', '2014-09-11', '10', '100', '448', NULL, NULL);
INSERT INTO prestamo VALUES('29', '200', '2014-09-17', '10', '100', '448', NULL, NULL);
INSERT INTO prestamo VALUES('30', '100', '2014-09-23', '10', '100', '448', NULL, NULL);
INSERT INTO prestamo VALUES('31', '1000', '2014-08-01', '10', '100', '1', NULL, NULL);
INSERT INTO prestamo VALUES('32', '900', '2014-08-07', '10', '100', '1', NULL, NULL);
INSERT INTO prestamo VALUES('33', '800', '2014-08-13', '10', '100', '1', NULL, NULL);
INSERT INTO prestamo VALUES('34', '700', '2014-08-19', '10', '100', '1', NULL, NULL);
INSERT INTO prestamo VALUES('35', '600', '2014-08-25', '10', '100', '1', NULL, NULL);
INSERT INTO prestamo VALUES('36', '500', '2014-08-31', '10', '100', '1', NULL, NULL);
INSERT INTO prestamo VALUES('37', '400', '2014-09-06', '10', '100', '1', NULL, NULL);
INSERT INTO prestamo VALUES('38', '300', '2014-09-12', '10', '100', '1', NULL, NULL);
INSERT INTO prestamo VALUES('39', '200', '2014-09-18', '10', '100', '1', NULL, NULL);
INSERT INTO prestamo VALUES('40', '100', '2014-09-24', '10', '100', '1', NULL, NULL);
UNLOCK TABLES;


--
-- Table structure for table `puestos`
--

DROP TABLE IF EXISTS puestos;
CREATE TABLE `puestos` (
  `idpuestos` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `trabajadores_idtrabajadores` int(11) NOT NULL,
  PRIMARY KEY (`idpuestos`),
  KEY `fk_puestos_trabajadores1_idx` (`trabajadores_idtrabajadores`),
  CONSTRAINT `fk_puestos_trabajadores1` FOREIGN KEY (`trabajadores_idtrabajadores`) REFERENCES `trabajadores` (`idtrabajadores`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `puestos`
--

LOCK TABLES puestos WRITE;
INSERT INTO puestos VALUES('1', 'Cobrador', '0');
INSERT INTO puestos VALUES('2', 'Vendedor', '0');
INSERT INTO puestos VALUES('3', 'Administrador', '0');
UNLOCK TABLES;


--
-- Table structure for table `res_cc`
--

DROP TABLE IF EXISTS res_cc;
CREATE TABLE `res_cc` (
  `idres_cc` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT NULL,
  `entradas` double DEFAULT NULL,
  `salidas` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `diferencia` double DEFAULT NULL,
  `total_fisico` double DEFAULT NULL,
  PRIMARY KEY (`idres_cc`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `res_cc`
--

LOCK TABLES res_cc WRITE;
INSERT INTO res_cc VALUES('11', '2014-07-29 16:54:48', '200', '150', '50', '10', '40');
INSERT INTO res_cc VALUES('12', '2014-07-29 17:02:57', '200', '150', '50', '14', '36');
INSERT INTO res_cc VALUES('13', '2014-07-29 17:02:57', '200', '150', '50', '30', '20');
INSERT INTO res_cc VALUES('14', '2014-07-30 16:14:18', '14333', '1000', '13333', '1333', '12000');
UNLOCK TABLES;


--
-- Table structure for table `res_cob`
--

DROP TABLE IF EXISTS res_cob;
CREATE TABLE `res_cob` (
  `idres_cob` int(11) NOT NULL AUTO_INCREMENT,
  `total_tarjetas` double DEFAULT NULL,
  `total_cobro` double DEFAULT NULL,
  `num_tarjetas` int(11) DEFAULT NULL,
  `porcentaje` double DEFAULT NULL,
  `meta` double DEFAULT NULL,
  `diferencia` double DEFAULT NULL,
  `trabajadores_idtrabajadores` int(11) NOT NULL,
  PRIMARY KEY (`idres_cob`),
  KEY `fk_res_cob_trabajadores1_idx` (`trabajadores_idtrabajadores`),
  CONSTRAINT `fk_res_cob_trabajadores1` FOREIGN KEY (`trabajadores_idtrabajadores`) REFERENCES `trabajadores` (`idtrabajadores`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `res_cob`
--

LOCK TABLES res_cob WRITE;
UNLOCK TABLES;


--
-- Table structure for table `salidas`
--

DROP TABLE IF EXISTS salidas;
CREATE TABLE `salidas` (
  `idsalidas` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) DEFAULT NULL,
  `fecha` varchar(45) DEFAULT NULL,
  `num_art` int(11) DEFAULT NULL,
  `articulos_idarticulos` int(11) NOT NULL,
  PRIMARY KEY (`idsalidas`),
  KEY `fk_salidas_articulos1_idx` (`articulos_idarticulos`),
  CONSTRAINT `fk_salidas_articulos1` FOREIGN KEY (`articulos_idarticulos`) REFERENCES `articulos` (`idarticulos`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salidas`
--

LOCK TABLES salidas WRITE;
UNLOCK TABLES;


--
-- Table structure for table `seguros`
--

DROP TABLE IF EXISTS seguros;
CREATE TABLE `seguros` (
  `idseguros` int(11) NOT NULL AUTO_INCREMENT,
  `seguro` int(11) DEFAULT NULL,
  `trabajadores_idtrabajadores` int(11) NOT NULL,
  PRIMARY KEY (`idseguros`),
  KEY `fk_seguros_trabajadores1_idx` (`trabajadores_idtrabajadores`),
  CONSTRAINT `fk_seguros_trabajadores1` FOREIGN KEY (`trabajadores_idtrabajadores`) REFERENCES `trabajadores` (`idtrabajadores`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seguros`
--

LOCK TABLES seguros WRITE;
UNLOCK TABLES;


--
-- Table structure for table `sueldos`
--

DROP TABLE IF EXISTS sueldos;
CREATE TABLE `sueldos` (
  `idsueldos` int(11) NOT NULL AUTO_INCREMENT,
  `sueldo` int(11) DEFAULT NULL,
  `trabajadores_idtrabajadores` int(11) NOT NULL,
  PRIMARY KEY (`idsueldos`),
  KEY `fk_sueldos_trabajadores1_idx` (`trabajadores_idtrabajadores`),
  CONSTRAINT `fk_sueldos_trabajadores1` FOREIGN KEY (`trabajadores_idtrabajadores`) REFERENCES `trabajadores` (`idtrabajadores`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sueldos`
--

LOCK TABLES sueldos WRITE;
INSERT INTO sueldos VALUES('18', '1000', '2');
INSERT INTO sueldos VALUES('19', '120', '448');
INSERT INTO sueldos VALUES('20', '1552', '449');
INSERT INTO sueldos VALUES('21', '12000', '450');
UNLOCK TABLES;


--
-- Table structure for table `trabajadores`
--

DROP TABLE IF EXISTS trabajadores;
CREATE TABLE `trabajadores` (
  `idtrabajadores` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `fecha_termino` date DEFAULT NULL,
  `nss` varchar(45) DEFAULT NULL,
  `puesto` varchar(45) DEFAULT NULL,
  `depto` varchar(45) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `rfc` varchar(45) DEFAULT NULL,
  `curp` varchar(45) DEFAULT NULL,
  `sucursal` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idtrabajadores`)
) ENGINE=InnoDB AUTO_INCREMENT=454 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trabajadores`
--

LOCK TABLES trabajadores WRITE;
INSERT INTO trabajadores VALUES('1', 'SUPER USER', '2014-07-01', '2014-07-03', '11251', 'qweqweqw', 'qweqwe', 'Vendedor', '11241', NULL, 'Uruapan');
INSERT INTO trabajadores VALUES('2', 'Prueba de Modificacion', '1992-01-01', '1999-03-03', '125452', 'Prueba ', 'Prueba', 'Administracion', '1254', NULL, 'Uruapan');
INSERT INTO trabajadores VALUES('3', 'Oficina', '2014-07-01', '2014-07-31', NULL, '0', '0', '0', '0', '0', NULL);
INSERT INTO trabajadores VALUES('25', 'Abraham', '2014-07-09', '2014-07-24', '123123', 'Cobrador', 'Credito y Cobranza', 'cobro', '1231231', '234234234', NULL);
INSERT INTO trabajadores VALUES('123', 'Chava', '2014-07-01', '2014-07-31', '123123', '123123123', '123123', '123123', '123123', '12312312312', NULL);
INSERT INTO trabajadores VALUES('255', 'Carlos Hernandez', '2014-07-01', '2014-07-31', '123123', 'Cobrador', 'Credito y Cobranza', 'cobro', '23123', '1231232', NULL);
INSERT INTO trabajadores VALUES('312', 'Jorge', '2014-07-02', '2014-07-31', '123123', 'Cobrador', 'Credito y Cobranza', 'Cobro', '231231', '23423423', NULL);
INSERT INTO trabajadores VALUES('443', 'Alberto', '2014-07-01', '2014-07-31', '123123', 'Cobrador', 'Credito y Cobranza', 'cobro', '12212', '2323', 'Apatzingan');
INSERT INTO trabajadores VALUES('444', 'Cristhian Zapata Cabrera', '0000-00-00', '0000-00-00', '1254', 'Cobrador', 'Administración', 'a', 'ZACC', 'ZACC', NULL);
INSERT INTO trabajadores VALUES('445', 'Primer Administrativo', '0000-00-00', '0000-00-00', '12541', 'Administrador', 'Administración', 'Administración ', '125412544', '12254', NULL);
INSERT INTO trabajadores VALUES('446', 'Segundo Administracion', '2014-07-01', '2014-07-31', NULL, 'Cobrador', 'Administración', 'Administración ', '1254', '12554', NULL);
INSERT INTO trabajadores VALUES('447', 'Tercer Administracion', '2014-07-02', '2014-07-24', NULL, 'Administrador', 'Administración', 'Administración ', '125411', '12541', NULL);
INSERT INTO trabajadores VALUES('448', 'Cuarto Administrativo', '0000-00-00', '0000-00-00', '452112', 'Administrador', 'Administracion', 'Administracion ', '12554', NULL, NULL);
INSERT INTO trabajadores VALUES('449', 'Sin Seguro-Modificado', '2014-07-01', '2014-07-31', NULL, 'Cobrador', 'Administración', 'Administracion ', '125', '32', 'Apatzingan');
INSERT INTO trabajadores VALUES('450', 'Fecha Moficidad', '2014-07-16', '2014-07-01', NULL, 'Cobrador', 'Administración', 'Administracion ', NULL, NULL, NULL);
INSERT INTO trabajadores VALUES('451', 'Primer Cobrador-Modificado', '2014-06-21', '2014-09-20', '15225', 'Cobrador', 'Crédito y Cobranza', 'Cobranza', '1555', '1255', NULL);
INSERT INTO trabajadores VALUES('452', 'Primero en Joomla', '2014-07-01', '2014-07-31', '1021', 'Vendedor', 'Administración', 'Administracion ', '1232', '12445555', 'Apatzingan');
INSERT INTO trabajadores VALUES('453', 'Primero en Joomla', '2014-07-01', '2014-07-31', '1254', 'Vendedor', 'Administración', 'Administracion ', '1254', '1111111', NULL);
UNLOCK TABLES;


--
-- Table structure for table `vale`
--

DROP TABLE IF EXISTS vale;
CREATE TABLE `vale` (
  `idvale` int(11) NOT NULL AUTO_INCREMENT,
  `ruta` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `efectivo` double DEFAULT NULL,
  `tarjetas` int(11) DEFAULT NULL,
  `trabajadores_idtrabajadores` int(11) NOT NULL,
  PRIMARY KEY (`idvale`),
  KEY `fk_vale_trabajadores1_idx` (`trabajadores_idtrabajadores`),
  CONSTRAINT `fk_vale_trabajadores1` FOREIGN KEY (`trabajadores_idtrabajadores`) REFERENCES `trabajadores` (`idtrabajadores`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vale`
--

LOCK TABLES vale WRITE;
INSERT INTO vale VALUES('1', '1', '2014-07-26 13:04:25', '200', '1', '255');
INSERT INTO vale VALUES('4', '3', '2014-07-26 13:17:16', '1750', '18', '25');
INSERT INTO vale VALUES('5', '4', '2014-07-26 13:17:28', '5730', '51', '123');
INSERT INTO vale VALUES('6', '7', '2014-07-26 13:24:57', '4240', '42', '312');
INSERT INTO vale VALUES('7', '11', '2014-07-26 13:27:48', '4550', '37', '443');
INSERT INTO vale VALUES('8', '23', '2014-07-28 09:42:12', NULL, '2', '1');
INSERT INTO vale VALUES('9', '23', '2014-07-28 09:42:12', NULL, '2', '1');
INSERT INTO vale VALUES('10', '23', '2014-07-28 09:42:12', NULL, '2', '1');
INSERT INTO vale VALUES('11', '23', '2014-07-28 09:48:07', NULL, '23', '1');
INSERT INTO vale VALUES('12', '300', '2014-07-28 09:54:05', '2000', '23', '123');
INSERT INTO vale VALUES('13', '3', '2014-07-28 10:01:02', '2222222', '15', '25');
INSERT INTO vale VALUES('14', '32', '2014-07-28 10:01:29', '2255555', '12', '443');
INSERT INTO vale VALUES('15', '32', '2014-07-28 10:01:29', '2255555', '12', '443');
INSERT INTO vale VALUES('16', '44', '2014-07-28 10:03:56', '2011', '20', '3');
INSERT INTO vale VALUES('17', '45', '2014-07-28 10:09:04', '200015', '15', '255');
INSERT INTO vale VALUES('23', '23', '2014-07-28 11:15:02', '10000', '15', '1');
INSERT INTO vale VALUES('24', '23', '2014-07-28 11:15:02', '10000', '15', '1');
INSERT INTO vale VALUES('25', '2', '2014-07-28 11:25:50', '2015', '9000', '2');
INSERT INTO vale VALUES('26', '5', '2014-07-29 09:48:01', '200', '15', '3');
INSERT INTO vale VALUES('27', '14', '2014-07-29 17:12:02', '5010', '10', '25');
INSERT INTO vale VALUES('28', '222', '2014-07-29 17:18:37', '3012', '1', '3');
INSERT INTO vale VALUES('29', '13', '2014-07-30 16:06:03', '2000', '154', '2');
INSERT INTO vale VALUES('30', '125', '2014-07-31 09:06:43', '15000', '1', '449');
INSERT INTO vale VALUES('31', '1', '2014-07-31 09:08:56', '159', '125', '444');
INSERT INTO vale VALUES('32', '1', '2014-07-31 09:08:56', '159', '125', '444');
INSERT INTO vale VALUES('33', '1', '2014-07-31 17:39:40', '112', '1', '1');
INSERT INTO vale VALUES('34', '2014', '2014-07-31 17:48:28', '113', '123', '255');
INSERT INTO vale VALUES('35', '1', '2014-08-01 09:38:44', '1200', '15', '1');
INSERT INTO vale VALUES('36', '12', '2014-08-01 11:38:08', '10222', '10', '445');
UNLOCK TABLES;


--
-- Table structure for table `venta`
--

DROP TABLE IF EXISTS venta;
CREATE TABLE `venta` (
  `idtable1` int(11) NOT NULL AUTO_INCREMENT,
  `cuenta` varchar(45) DEFAULT NULL,
  `articulos_idarticulos` int(11) NOT NULL,
  `trabajadores_idtrabajadores` int(11) NOT NULL,
  `supervisor` varchar(45) DEFAULT NULL,
  `zona` varchar(45) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `contrato` varchar(45) DEFAULT NULL,
  `nom_c` varchar(45) DEFAULT NULL,
  `dir_c` varchar(45) DEFAULT NULL,
  `calle_c` varchar(45) DEFAULT NULL,
  `mun_c` varchar(45) DEFAULT NULL,
  `col_c` varchar(45) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `modelo` varchar(45) DEFAULT NULL,
  `serie` varchar(45) DEFAULT NULL,
  `enganche` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `d_pago` varchar(45) DEFAULT NULL,
  `abonos` int(11) DEFAULT NULL,
  `tel_c` varchar(45) DEFAULT NULL,
  `dom_aval` varchar(45) DEFAULT NULL,
  `tel_aval` varchar(45) DEFAULT NULL,
  `nombre_aval` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idtable1`),
  KEY `fk_table1_articulos1_idx` (`articulos_idarticulos`),
  KEY `fk_table1_trabajadores1_idx` (`trabajadores_idtrabajadores`),
  CONSTRAINT `fk_table1_articulos1` FOREIGN KEY (`articulos_idarticulos`) REFERENCES `articulos` (`idarticulos`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_table1_trabajadores1` FOREIGN KEY (`trabajadores_idtrabajadores`) REFERENCES `trabajadores` (`idtrabajadores`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `venta`
--

LOCK TABLES venta WRITE;
INSERT INTO venta VALUES('1', NULL, '1', '123', NULL, NULL, '2014-07-31 16:49:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1000', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO venta VALUES('2', NULL, '1', '312', NULL, NULL, '2014-08-01 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
UNLOCK TABLES;


--
-- Table structure for table `ventas`
--

DROP TABLE IF EXISTS ventas;
CREATE TABLE `ventas` (
  `idventas` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT NULL,
  `articulos_idarticulos` int(11) NOT NULL,
  `trabajadores_idtrabajadores` int(11) NOT NULL,
  `serie` varchar(45) DEFAULT NULL,
  `n_articulos` int(11) DEFAULT NULL,
  PRIMARY KEY (`idventas`),
  KEY `fk_ventas_articulos_idx` (`articulos_idarticulos`),
  KEY `fk_ventas_trabajadores1_idx` (`trabajadores_idtrabajadores`),
  CONSTRAINT `fk_ventas_articulos` FOREIGN KEY (`articulos_idarticulos`) REFERENCES `articulos` (`idarticulos`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_ventas_trabajadores1` FOREIGN KEY (`trabajadores_idtrabajadores`) REFERENCES `trabajadores` (`idtrabajadores`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ventas`
--

LOCK TABLES ventas WRITE;
UNLOCK TABLES;



-- Dump de la Base de Datos Completo.