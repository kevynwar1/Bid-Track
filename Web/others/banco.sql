DROP TABLE IF EXISTS `acao`;
CREATE TABLE `acao` (
  `codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(20) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;





DROP TABLE IF EXISTS `status_entrega`;
CREATE TABLE `status_entrega` (
  `codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(20) NOT NULL,
  `situacao` bit(1) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
INSERT INTO `status_entrega`(`codigo`,`descricao`,`situacao`) VALUES (1,'Liberado',''),(2,'Pendente',''),(3,'Em Viagem','');





DROP TABLE IF EXISTS `empresa`;
CREATE TABLE `empresa` (
  `codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `razao_social` varchar(100) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `logradouro` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `nome_fantasia` varchar(100) NOT NULL,
  `complemento` varchar(20) DEFAULT NULL,
  `bairro` varchar(25) NOT NULL,
  `cidade` varchar(25) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `latitude` decimal(11,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `situacao` bit(1) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
INSERT INTO `empresa`(`codigo`,`razao_social`,`cnpj`,`logradouro`,`numero`,`nome_fantasia`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`latitude`,`longitude`,`situacao`) VALUES (1,'Renan Yasmin','80.341.029/0001-76','Rua Seis','396','Renan e Yasmin Marketing Ltda',NULL,'Jardim São Paulo','Petrolina','PE','56314-040','0.00000000','0.00000000','\0'),(3,'Sara Alice','66.875.292/0001-14','Rua Dona Maria de Souza','705','Sara Alice Entregas Expressas Ltda',NULL,'Santo Amaro','Recife','PE','50040-330','0.00000000','0.00000000','\0'),(4,'Ryan Carolina','05.127.366/0001-40','Rua Laranjeira do Sul','237','Ryan e Carolina Entregas Expressas Ltda',NULL,'Nazaré','Camaragibe','PE','54753-115','0.00000000','0.00000000','\0');





DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_empresa` int(10) unsigned NOT NULL,
  `nome` varchar(80) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `senha` varchar(15) NOT NULL,
  `perfil` char(1) NOT NULL,
  `situacao` bit(1) NOT NULL,
  PRIMARY KEY (`codigo`), 
  FOREIGN KEY (`cod_empresa`) REFERENCES `empresa`(`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
INSERT INTO `usuario`(`codigo`,`cod_empresa`,`nome`,`email`,`telefone`,`senha`,`perfil`,`situacao`) VALUES (1,1,'Ikaro Sales','ikarosales7@gmail.com','30763050','34663827','A',''),(2,3,'Kevyn Herbet','kevynh48@gmail.com','34848461','123456','F',''),(3,4,'Carlos Eduardo','kevynh45@gmail.com','988602849','1234567','T','\0'),(4,1,'Maria Júlia Barbosa','mariaj@gmail.com','984567865','5678','M','');





DROP TABLE IF EXISTS `transportadora`;
CREATE TABLE `transportadora` (
  `codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_empresa` int(10) unsigned NOT NULL,
  `razao_social` varchar(100) NOT NULL,
  `nome_fantasia` varchar(100) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `logradouro` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(20) DEFAULT NULL,
  `bairro` varchar(25) NOT NULL,
  `cidade` varchar(25) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `latitude` decimal(11,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `situacao` bit(1) NOT NULL,
  PRIMARY KEY (`codigo`), 
  FOREIGN KEY (`cod_empresa`) REFERENCES `empresa`(`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
INSERT INTO `transportadora`(`codigo`,`cod_empresa`,`razao_social`,`nome_fantasia`,`cnpj`,`logradouro`,`numero`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`latitude`,`longitude`,`situacao`) VALUES (1,4,'Transportadora Asa de Prata','Asa de Prata','82.244.921/0001-64','Rua Cel. Fabriciano','131',NULL,'Imbiribeira','Recife','PE','54100-705','0.00000000','0.00000000','\0'),(2,1,'Transportadora Rocha','Trans Rocha','79.822.134/0001-48','Beco da Aurora','818',NULL,'Nossa Senhora das Graças','Gravatá','PE','55641-696','0.00000000','0.00000000','\0');





DROP TABLE IF EXISTS `status_romaneio`;
CREATE TABLE `status_romaneio` (
  `codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(20) NOT NULL,
  `situacao` bit(1) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
INSERT INTO `status_romaneio`(`codigo`,`descricao`,`situacao`) VALUES (1,'Liberado',''),(2,'Pendente',''),(3,'Em Andamento',''),(4,'Finalizado','\0');





DROP TABLE IF EXISTS `ocorrencia`;
CREATE TABLE `ocorrencia` (
  `codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_empresa` int(10) unsigned NOT NULL,
  `descricao` varchar(20) NOT NULL,
  `situacao` bit(1) NOT NULL,
  PRIMARY KEY (`codigo`), 
  FOREIGN KEY (`cod_empresa`) REFERENCES `empresa`(`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;





DROP TABLE IF EXISTS `tipo_veiculo`;
CREATE TABLE `tipo_veiculo` (
  `codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_empresa` int(10) NOT NULL,
  `descricao` varchar(30) NOT NULL,
  `peso` double NOT NULL,
  `situacao` bit(1) NOT NULL,
  PRIMARY KEY (`codigo`), 
  FOREIGN KEY (`cod_empresa`) REFERENCES `empresa`(`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
INSERT INTO `tipo_veiculo`(`codigo`,`cod_empresa`,`descricao`,`peso`,`situacao`) VALUES (1,1,'Caminhão Leve',3,''),(2,1,'Caminhão Simples',8,''),(3,1,'Toco',0,''),(4,1,'Carreta 2 eixos',0,''),(5,1,'Carreta 3 eixos',1,''),(6,1,'Reboque',0,''),(7,1,'Bitrem ',0,''),(8,1,'Rodotrem',0,''),(9,1,'Cavalo Mecânico Trucado',0,''),(10,1,'Veículo Operacional',0,''),(11,1,'Veículo Urbano de Carga',0,'\0');





DROP TABLE IF EXISTS `motorista`;
CREATE TABLE `motorista` (
  `codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `pontuacao` int(10) unsigned NOT NULL,
  `logradouro` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(20) DEFAULT NULL,
  `bairro` varchar(25) NOT NULL,
  `cidade` varchar(25) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `email` varchar(60) NOT NULL,
  `senha` varchar(15) NOT NULL,
  `latitude` decimal(11,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `tipo_carteira` varchar(5) NOT NULL,
  `validade_carteira` date NOT NULL,
  `disponibilidade` bit(1) NOT NULL,
  `situacao` bit(1) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
INSERT INTO `motorista`(`codigo`,`nome`,`cpf`,`pontuacao`,`logradouro`,`numero`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`email`,`senha`,`latitude`,`longitude`,`tipo_carteira`,`validade_carteira`,`disponibilidade`,`situacao`) 
VALUES (1,'César Lucas Moura','933.375.288-99',0,'Travessa Santa Márcia','814',NULL,'Pici','Fortaleza','CE','60440-572','cesar@gmail.com','1234','0.00000000','0.00000000','CDE','2020-10-08','','\0'),
(4,'Maria Júlia Barbosa','900.750.503-31',0,'Rua Vicente Mota Rodrigues','326',NULL,'Nova Cidade','Boa Vista','RR','69316-224','mariaj@gmail.com','1234','0.00000000','0.00000000','DE','2022-12-08','','\0'),
(9,'Alessandro Lima','704.894.657-00',0,'Rua das Ninfas','12',NULL,'Boa Vista','Recife','PE','50070-050','amlrecife@gmail.com','1234','0.00000000','0.00000000','DE','2018-10-26','\0','\0'),
(10,'Neymar Junior','704.097.894-62',10,'Rua Jack Ayres','170',NULL,'Boa Viagem','Recife','PE','51020-310','meninoney@gmail.com','1234','0.00000000','0.00000000','ABCDE','2035-06-07','','\0');





DROP TABLE IF EXISTS `estabelecimento`;
CREATE TABLE `estabelecimento` (
  `codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_empresa` int(10) unsigned NOT NULL,
  `razao_social` varchar(100) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `logradouro` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(20) DEFAULT NULL,
  `bairro` varchar(25) NOT NULL,
  `cidade` varchar(25) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `latitude` decimal(11,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `situacao` bit(1) NOT NULL,
  PRIMARY KEY (`codigo`), 
  FOREIGN KEY (`cod_empresa`) REFERENCES `empresa`(`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
INSERT INTO `estabelecimento`(`codigo`,`cod_empresa`,`razao_social`,`cnpj`,`logradouro`,`numero`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`latitude`,`longitude`,`situacao`) VALUES (1,1,'Campinense Transportadora','81.002.942/0001-25','Rua Nogueira de Souza','88',NULL,'Pina','Recife','PE','55036-180','0.00000000','0.00000000','\0'),(2,1,'Campinense Transportadora','81.002.942/0001-00','Rua Pôrto Franco','300',NULL,'Prazeres','Jaboatão dos Guararapes','PE','54335-020','0.00000000','0.00000000','\0'),(3,1,'Campinense Transportadora','81.002.942/0001-12','Av. Assis Chateaubriand','3055',NULL,'Distrito Industrial','Campina Grande','PB','58000-000','0.00000000','0.00000000','\0'),(4,1,'Campinense Transportadora','81.002.942/0001-17','Av. Beberibe','1285',NULL,'Arruda','Recife','PE','52120-000','0.00000000','0.00000000','\0'),(5,1,'Campinense Transportadora','81.002.942/0001-07','Rua Professor Eduardo Wanderley Filho','336',NULL,'Boa Viagem','Recife','PE','51020-170','0.00000000','0.00000000','\0');





DROP TABLE IF EXISTS `romaneio`;
CREATE TABLE `romaneio` (
  `codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_status_romaneio` int(10) unsigned NOT NULL,
  `cod_estabelecimento` int(10) unsigned NOT NULL,
  `cod_tipo_veiculo` int(10) unsigned NOT NULL,
  `cod_transportadora` int(11) DEFAULT NULL,
  `cod_motorista` int(11) DEFAULT NULL,
  `data_criacao` date NOT NULL,
  `data_finalizacao` date DEFAULT NULL,
  `ofertar_viagem` bit(1) NOT NULL,
  PRIMARY KEY (`codigo`), 
  FOREIGN KEY (`cod_status_romaneio`) REFERENCES `status_romaneio`(`codigo`), 
  FOREIGN KEY (`cod_estabelecimento`) REFERENCES `estabelecimento`(`codigo`), 
  FOREIGN KEY (`cod_tipo_veiculo`) REFERENCES `tipo_veiculo`(`codigo`), 
  FOREIGN KEY (`cod_transportadora`) REFERENCES `transportadora`(`codigo`), 
  FOREIGN KEY (`cod_motorista`) REFERENCES `motorista`(`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=77779 DEFAULT CHARSET=latin1;
INSERT INTO `romaneio`(`codigo`,`cod_status_romaneio`,`cod_estabelecimento`,`cod_tipo_veiculo`,`cod_transportadora`,`cod_motorista`,`data_criacao`,`data_finalizacao`,`ofertar_viagem`) VALUES (1010,1,1,1,1,9,'2017-09-07',NULL,''),(812,2,4,7,0,NULL,'2017-09-18',NULL,'');





DROP TABLE IF EXISTS `destinatario`;
CREATE TABLE `destinatario` (
  `codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_empresa` int(10) unsigned NOT NULL,
  `razao_social` varchar(100) NOT NULL,
  `nome_fantasia` varchar(100) DEFAULT NULL,
  `tipo_pessoa` char(1) NOT NULL,
  `cnpj_cpf` varchar(18) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `logradouro` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(20) DEFAULT NULL,
  `bairro` varchar(25) NOT NULL,
  `cidade` varchar(25) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `latitude` int(11) NOT NULL,
  `longitude` int(11) NOT NULL,
  `situacao` bit(1) NOT NULL,
  PRIMARY KEY (`codigo`),
  FOREIGN KEY (`cod_empresa`) REFERENCES `empresa`(`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
INSERT INTO `destinatario`(`codigo`,`cod_empresa`,`razao_social`,`nome_fantasia`,`tipo_pessoa`,`cnpj_cpf`,`email`,`telefone`,`logradouro`,`numero`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`latitude`,`longitude`,`situacao`) VALUES (1,1,'Avil Telas Ltda.','Avil Telas','j','10.822.821/0001-67','producao@jenniferericardotelasltda.com.br','(81) 98928-2574','Av. Mal. Mascarenhas de Morais','4900',NULL,'Imbiribeira','Recife','PE','51200-000',0,0,''),(2,1,'Dritz Entregas Expressas ME','Dritz Entregas','j','62.651.272/0001-09','auditoria@enzoehadassaentregasexpressasme.com.br','(81) 99574-0867','R. Leandro Barreto','512',NULL,'Jardim São Paulo','Recife','PE','50790-000',0,0,''),(3,1,'Sultex Climatização Têxtil','Sultex','j','76.779.632/0001-67','contato@sultexclim.com.br','(81) 3465-2805','Av. Deus e Fiel','1','A','Jardim Penedo','São Lourenço da Mata','PE','54710-010',0,0,'\0');





DROP TABLE IF EXISTS `entrega`;
CREATE TABLE `entrega` (
  `seq_entrega` int(10) unsigned NOT NULL,
  `cod_romaneio` int(10) unsigned NOT NULL,
  `cod_destinatario` int(10) unsigned NOT NULL,
  `cod_status_entrega` int(10) unsigned NOT NULL,
  `peso_carga` varchar(10) NOT NULL,
  `nota_fiscal` int(10) unsigned NOT NULL,
  PRIMARY KEY (`seq_entrega`, `cod_romaneio`),
  FOREIGN KEY (`cod_romaneio`) REFERENCES `romaneio`(`codigo`),
  FOREIGN KEY (`cod_destinatario`) REFERENCES `destinatario`(`codigo`),
  FOREIGN KEY (`cod_status_entrega`) REFERENCES `entrega`(`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
INSERT INTO `entrega`(`seq_entrega`,`cod_romaneio`,`cod_destinatario`,`cod_status_entrega`,`peso_carga`,`nota_fiscal`) VALUES (2,1010,1,1,'9 t',1425522),(1,1010,3,1,'10 t',0),(3,1010,2,1,'190 kg',1425529),(1,812,1,1,'10 hg',3245783);





DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_usuario` int(10) unsigned NOT NULL,
  `data_log` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modulo` varchar(30) NOT NULL,
  `acao` varchar(20) NOT NULL,
  `detalhe` text NOT NULL,
  PRIMARY KEY (`codigo`),
  FOREIGN KEY (`cod_usuario`) REFERENCES `usuario`(`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;





CREATE TABLE `empresa_motorista` (
  `cod_empresa` int(10) NOT NULL,
  `cod_motorista` int(10) NOT NULL,
  PRIMARY KEY (`cod_empresa`, `cod_motorista`),
  FOREIGN KEY (`cod_empresa`) REFERENCES `empresa`(`codigo`),
  FOREIGN KEY (`cod_motorista`) REFERENCES `motorista`(`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
INSERT INTO `empresa_motorista`(`cod_empresa`,`cod_motorista`) VALUES (1, 1), (1, 4), (1, 9), (1, 10);





DROP TABLE IF EXISTS `veiculo`;
CREATE TABLE `veiculo` (
  `codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_empresa` int(10) unsigned NOT NULL,
  `cod_motorista` int(10) unsigned NOT NULL,
  `cod_tipo_veiculo` int(10) unsigned NOT NULL,
  `modelo` varchar(20) NOT NULL,
  `placa` varchar(8) NOT NULL,
  `chassi` varchar(17) NOT NULL,
  `proprio` char(1) NOT NULL,
  `capacidade` int(10) unsigned NOT NULL,
  `antt` int(10) unsigned NOT NULL,
  `situacao` bit(1) NOT NULL,
  PRIMARY KEY (`codigo`),
  FOREIGN KEY (`cod_empresa`) REFERENCES `empresa`(`codigo`),
  FOREIGN KEY (`cod_motorista`) REFERENCES `motorista`(`codigo`),
  FOREIGN KEY (`cod_tipo_veiculo`) REFERENCES `tipo_veiculo`(`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
INSERT INTO `veiculo`(`codigo`,`cod_empresa`,`cod_motorista`,`cod_tipo_veiculo`,`modelo`,`placa`,`chassi`,`proprio`,`capacidade`,`antt`,`situacao`) VALUES (1,1,1,1,'Mercedes Benz Accelo','KHY-8566','5FG116GW04C400002','S',15,0,'\0'),(2,1,2,1,'Volkswagen Worker 13','JSC-2512','9BG116GW04C400001','S',10,0,'\0');