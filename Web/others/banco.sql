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





DROP TABLE IF EXISTS `status_romaneio`;
CREATE TABLE `status_romaneio` (
  `codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(20) NOT NULL,
  `situacao` bit(1) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;





DROP TABLE IF EXISTS `tipo_ocorrencia`;
CREATE TABLE tipo_ocorrencia (
  `codigo` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  `cod_empresa` int(10) NOT NULL,
  `descricao` VARCHAR(100) NOT NULL,
  `situacao` BIT NOT NULL,
  PRIMARY KEY(`codigo`),
  FOREIGN KEY(`cod_empresa`) REFERENCES `empresa`(`codigo`)
);





DROP TABLE IF EXISTS `ocorrencia`;
CREATE TABLE `ocorrencia` (
  `codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_empresa` int(10) unsigned NOT NULL,
  `seq_entrega` int(10) unsigned NOT NULL,
  `cod_romaneio` int(10) unsigned NOT NULL,
  `cod_tipo_ocorrencia` int(10) unsigned NOT NULL,
  `descricao` varchar(20) NOT NULL,
  `data` date NOT NULL,
  `situacao` bit(1) NOT NULL,
  PRIMARY KEY (`codigo`), 
  FOREIGN KEY (`cod_empresa`) REFERENCES `empresa`(`codigo`), 
  FOREIGN KEY (`seq_entrega`) REFERENCES `entrega`(`codigo`), 
  FOREIGN KEY (`cod_romaneio`) REFERENCES `romaneio`(`codigo`), 
  FOREIGN KEY (`cod_tipo_ocorrencia`) REFERENCES `tipo_ocorrencia`(`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;





DROP TABLE IF EXISTS `imagem_ocorrencia`;
CREATE TABLE `imagem_ocorrencia` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cod_ocorrencia` int(11) DEFAULT NULL,
  `foto` blob,
  PRIMARY KEY (`codigo`),
  FOREIGN KEY (`cod_ocorrencia`) REFERENCES `ocorrencia`(`codigo`)
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





DROP TABLE IF EXISTS `romaneio`;
CREATE TABLE `romaneio` (
  `codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_empresa` int(10) unsigned NOT NULL,
  `cod_status_romaneio` int(10) unsigned NOT NULL,
  `cod_estabelecimento` int(10) unsigned NOT NULL,
  `cod_tipo_veiculo` int(10) unsigned NOT NULL,
  `cod_transportadora` int(11) DEFAULT NULL,
  `cod_motorista` int(11) DEFAULT NULL,
  `valor` decimal(12,2) NOT NULL,
  `data_criacao` date NOT NULL,
  `data_finalizacao` date DEFAULT NULL,
  `ofertar_viagem` bit(1) NOT NULL,
  PRIMARY KEY (`codigo`), 
  FOREIGN KEY (`cod_empresa`) REFERENCES `empresa`(`codigo`), 
  FOREIGN KEY (`cod_status_romaneio`) REFERENCES `status_romaneio`(`codigo`), 
  FOREIGN KEY (`cod_estabelecimento`) REFERENCES `estabelecimento`(`codigo`), 
  FOREIGN KEY (`cod_tipo_veiculo`) REFERENCES `tipo_veiculo`(`codigo`), 
  FOREIGN KEY (`cod_transportadora`) REFERENCES `transportadora`(`codigo`), 
  FOREIGN KEY (`cod_motorista`) REFERENCES `motorista`(`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=77779 DEFAULT CHARSET=latin1;





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





INSERT INTO `empresa`(`codigo`,`razao_social`,`cnpj`,`logradouro`,`numero`,`nome_fantasia`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`latitude`,`longitude`,`situacao`) VALUES (1,'Cazan Transportes','80.341.029/0001-76','Rua Seis','396','Cazan Transportes Ltda',NULL,'Jardim São Paulo','Petrolina','PE','56314-040','-27.30000000','-46.30000000','\0');
INSERT INTO `empresa`(`codigo`,`razao_social`,`cnpj`,`logradouro`,`numero`,`nome_fantasia`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`latitude`,`longitude`,`situacao`) VALUES (3,'SpeedPak Logística','66.875.292/0001-14','Rua Dona Maria de Souza','705','SpeedPak Transporte e Logística',NULL,'Santo Amaro','Recife','PE','50040-330','-27.85000000','-46.85000000','\0');
INSERT INTO `empresa`(`codigo`,`razao_social`,`cnpj`,`logradouro`,`numero`,`nome_fantasia`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`latitude`,`longitude`,`situacao`) VALUES (4,'Petrymar Transportes','05.127.366/0001-40','Rua Laranjeira do Sul','237','Petrymar Transportes Ltda',NULL,'Nazaré','Camaragibe','PE','54753-115','-27.00000000','-46.65300000','\0');

INSERT INTO `motorista`(`codigo`,`nome`,`cpf`,`pontuacao`,`logradouro`,`numero`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`email`,`senha`,`latitude`,`longitude`,`tipo_carteira`,`validade_carteira`,`disponibilidade`,`situacao`) VALUES (1,'César Lucas Moura','933.375.288-99',0,'Travessa Santa Márcia','814',NULL,'Pici','Fortaleza','CE','60440-572','cesar@gmail.com','1234','0.00000000','0.00000000','CDE','2020-10-08','\0','\0');
INSERT INTO `motorista`(`codigo`,`nome`,`cpf`,`pontuacao`,`logradouro`,`numero`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`email`,`senha`,`latitude`,`longitude`,`tipo_carteira`,`validade_carteira`,`disponibilidade`,`situacao`) VALUES (4,'Maria Júlia Barbosa','900.750.503-31',0,'Rua Vicente Mota Rodrigues','326',NULL,'Nova Cidade','Boa Vista','RR','69316-224','mariaj@gmail.com','1234','0.00000000','0.00000000','DE','2022-12-08','','\0');
INSERT INTO `motorista`(`codigo`,`nome`,`cpf`,`pontuacao`,`logradouro`,`numero`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`email`,`senha`,`latitude`,`longitude`,`tipo_carteira`,`validade_carteira`,`disponibilidade`,`situacao`) VALUES (9,'David Beckham','704.894.657-00',0,'Rua das Ninfas','12',NULL,'Boa Vista','Recife','PE','50070-050','david@gmail.com','1234','0.00000000','0.00000000','DE','2018-10-26','','\0');
INSERT INTO `motorista`(`codigo`,`nome`,`cpf`,`pontuacao`,`logradouro`,`numero`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`email`,`senha`,`latitude`,`longitude`,`tipo_carteira`,`validade_carteira`,`disponibilidade`,`situacao`) VALUES (10,'Neymar Junior','704.097.894-62',10,'Rua Jack Ayres','170',NULL,'Boa Viagem','Recife','PE','51020-310','ikarosales7@gmail.com','3466','0.00000000','0.00000000','ABCDE','2035-06-07','\0','\0');
INSERT INTO `motorista`(`codigo`,`nome`,`cpf`,`pontuacao`,`logradouro`,`numero`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`email`,`senha`,`latitude`,`longitude`,`tipo_carteira`,`validade_carteira`,`disponibilidade`,`situacao`) VALUES (12,'Kevyn Herbet','702.393.264-07',0,'Rua Vitor Meireles','13',NULL,'Timbi','Camaragibe','PE','54768-432','kevynh49@gmail.com','54321','0.00000000','0.00000000','E','2020-09-18','\0','\0');
INSERT INTO `motorista`(`codigo`,`nome`,`cpf`,`pontuacao`,`logradouro`,`numero`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`email`,`senha`,`latitude`,`longitude`,`tipo_carteira`,`validade_carteira`,`disponibilidade`,`situacao`) VALUES (13,'Marco Asensio','704.097.894-61',0,'Rua Nogueira de Souza','88',NULL,'Pina','Recife','PE','51010-660','marco_asensio@gmail.com','12345','0.00000000','0.00000000','AB','2020-09-18','\0','\0');

INSERT INTO `destinatario`(`codigo`,`cod_empresa`,`razao_social`,`nome_fantasia`,`tipo_pessoa`,`cnpj_cpf`,`email`,`telefone`,`logradouro`,`numero`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`latitude`,`longitude`,`situacao`) VALUES (1,1,'Avil Telas Ltda.','Avil Telas','j','10.822.821/0001-67','producao@avil.com.br','(81) 98928-2574','Av. Mal. Mascarenhas de Morais','4900',NULL,'Imbiribeira','Recife','PE','51200-000','-8.12706170','-34.91559980','');
INSERT INTO `destinatario`(`codigo`,`cod_empresa`,`razao_social`,`nome_fantasia`,`tipo_pessoa`,`cnpj_cpf`,`email`,`telefone`,`logradouro`,`numero`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`latitude`,`longitude`,`situacao`) VALUES (2,1,'Dritz Entregas Expressas ME','Dritz Entregas','j','62.651.272/0001-09','auditoria@dritz.com.br','(81) 99574-0867','R. Leandro Barreto','512',NULL,'Jardim São Paulo','Recife','PE','50790-000','-8.08404040','-34.94932750','');
INSERT INTO `destinatario`(`codigo`,`cod_empresa`,`razao_social`,`nome_fantasia`,`tipo_pessoa`,`cnpj_cpf`,`email`,`telefone`,`logradouro`,`numero`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`latitude`,`longitude`,`situacao`) VALUES (3,1,'Sultex Climatização Têxtil','Sultex','j','76.779.632/0001-67','contato@sultexclim.com.br','(81) 3465-2805','Av. Deus e Fiel','1','A','Jardim Penedo','São Lourenço da Mata','PE','54710-010','-8.04064960','-35.00820490','\0');

INSERT INTO `empresa_motorista`(`cod_empresa`,`cod_motorista`) VALUES (1,1);
INSERT INTO `empresa_motorista`(`cod_empresa`,`cod_motorista`) VALUES (1,4);
INSERT INTO `empresa_motorista`(`cod_empresa`,`cod_motorista`) VALUES (1,9);
INSERT INTO `empresa_motorista`(`cod_empresa`,`cod_motorista`) VALUES (1,10);
INSERT INTO `empresa_motorista`(`cod_empresa`,`cod_motorista`) VALUES (1,12);
INSERT INTO `empresa_motorista`(`cod_empresa`,`cod_motorista`) VALUES (1,13);
INSERT INTO `empresa_motorista`(`cod_empresa`,`cod_motorista`) VALUES (3,13);
INSERT INTO `empresa_motorista`(`cod_empresa`,`cod_motorista`) VALUES (4,12);

INSERT INTO `estabelecimento`(`codigo`,`cod_empresa`,`razao_social`,`cnpj`,`logradouro`,`numero`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`latitude`,`longitude`,`situacao`) VALUES (1,1,'Cazan Transportadora','81.002.942/0001-25','Rua Nogueira de Souza','88',NULL,'Pina','Recife','PE','55036-180','-8.08549300','-34.88771510','\0');
INSERT INTO `estabelecimento`(`codigo`,`cod_empresa`,`razao_social`,`cnpj`,`logradouro`,`numero`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`latitude`,`longitude`,`situacao`) VALUES (2,1,'Cazan Transportadora','81.002.942/0001-00','Rua Pôrto Franco','300',NULL,'Prazeres','Jaboatão dos Guararapes','PE','54335-020','-8.16804500','-34.94106190','\0');
INSERT INTO `estabelecimento`(`codigo`,`cod_empresa`,`razao_social`,`cnpj`,`logradouro`,`numero`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`latitude`,`longitude`,`situacao`) VALUES (3,1,'Cazan Transportadora','81.002.942/0001-12','R. Rufino Gonçalves','2',NULL,'Jaguaribe','Ilha de Itamaracá','PE','53900-000','-7.74030160','-34.82479160','\0');
INSERT INTO `estabelecimento`(`codigo`,`cod_empresa`,`razao_social`,`cnpj`,`logradouro`,`numero`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`latitude`,`longitude`,`situacao`) VALUES (4,1,'Cazan Transportadora','81.002.942/0001-17','Av. Beberibe','1285',NULL,'Arruda','Recife','PE','52120-000','-8.02643480','-34.89307530','\0');
INSERT INTO `estabelecimento`(`codigo`,`cod_empresa`,`razao_social`,`cnpj`,`logradouro`,`numero`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`latitude`,`longitude`,`situacao`) VALUES (5,1,'Cazan Transportadora','81.002.942/0001-07','Rua Professor Eduardo Wanderley Filho','336',NULL,'Boa Viagem','Recife','PE','51020-170','-8.11031870','-34.89472150','\0');

INSERT INTO `status_entrega`(`codigo`,`descricao`,`situacao`) VALUES (1,'Liberado','');
INSERT INTO `status_entrega`(`codigo`,`descricao`,`situacao`) VALUES (2,'Pendente','');
INSERT INTO `status_entrega`(`codigo`,`descricao`,`situacao`) VALUES (3,'Em Viagem','');
INSERT INTO `status_entrega`(`codigo`,`descricao`,`situacao`) VALUES (4,'Finalizado','');

INSERT INTO `status_romaneio`(`codigo`,`descricao`,`situacao`) VALUES (1,'Liberado','');
INSERT INTO `status_romaneio`(`codigo`,`descricao`,`situacao`) VALUES (2,'Pendente','');
INSERT INTO `status_romaneio`(`codigo`,`descricao`,`situacao`) VALUES (3,'Em Processo','');
INSERT INTO `status_romaneio`(`codigo`,`descricao`,`situacao`) VALUES (4,'Finalizado','\0');
INSERT INTO `status_romaneio`(`codigo`,`descricao`,`situacao`) VALUES (5,'Aceito','');

INSERT INTO `tipo_ocorrencia`(`codigo`,`cod_empresa`,`descricao`,`situacao`) VALUES (1,1,'Atraso','\0');
INSERT INTO `tipo_ocorrencia`(`codigo`,`cod_empresa`,`descricao`,`situacao`) VALUES (2,1,'Deifeito na mercadoria','');

INSERT INTO `tipo_veiculo`(`codigo`,`cod_empresa`,`descricao`,`peso`,`situacao`) VALUES (1,1,'Caminhão Leve',3000,'');
INSERT INTO `tipo_veiculo`(`codigo`,`cod_empresa`,`descricao`,`peso`,`situacao`) VALUES (2,1,'Caminhão Simples',8000,'');
INSERT INTO `tipo_veiculo`(`codigo`,`cod_empresa`,`descricao`,`peso`,`situacao`) VALUES (3,1,'Toco',6000,'');
INSERT INTO `tipo_veiculo`(`codigo`,`cod_empresa`,`descricao`,`peso`,`situacao`) VALUES (4,1,'Carreta 2 eixos',23000,'');
INSERT INTO `tipo_veiculo`(`codigo`,`cod_empresa`,`descricao`,`peso`,`situacao`) VALUES (5,1,'Carreta 3 eixos',25000,'');
INSERT INTO `tipo_veiculo`(`codigo`,`cod_empresa`,`descricao`,`peso`,`situacao`) VALUES (7,1,'Bitrem ',38000,'');
INSERT INTO `tipo_veiculo`(`codigo`,`cod_empresa`,`descricao`,`peso`,`situacao`) VALUES (8,1,'Rodotrem',48000,'');
INSERT INTO `tipo_veiculo`(`codigo`,`cod_empresa`,`descricao`,`peso`,`situacao`) VALUES (9,1,'Cavalo Mecânico Trucado',30000,'');
INSERT INTO `tipo_veiculo`(`codigo`,`cod_empresa`,`descricao`,`peso`,`situacao`) VALUES (11,1,'Veículo Urbano de Carga',3000,'');

INSERT INTO `transportadora`(`codigo`,`cod_empresa`,`razao_social`,`nome_fantasia`,`cnpj`,`logradouro`,`numero`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`latitude`,`longitude`,`situacao`) VALUES (1,1,'Transportadora Asa de Prata','Trans. Asa de Prata','82.244.921/0001-64','Rua Cel. Fabriciano','131',NULL,'Imbiribeira','Recife','PE','54100-705','0.00000000','0.00000000','\0');
INSERT INTO `transportadora`(`codigo`,`cod_empresa`,`razao_social`,`nome_fantasia`,`cnpj`,`logradouro`,`numero`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`latitude`,`longitude`,`situacao`) VALUES (2,1,'Transportadora Rocha','Trans. Rocha','79.822.134/0001-48','Beco da Aurora','818',NULL,'Nossa Senhora das Graças','Gravatá','PE','55641-696','0.00000000','0.00000000','\0');
INSERT INTO `transportadora`(`codigo`,`cod_empresa`,`razao_social`,`nome_fantasia`,`cnpj`,`logradouro`,`numero`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`latitude`,`longitude`,`situacao`) VALUES (3,1,'Transportadora Campinense','Trans. Campinense','08.706.145/0007-00','Rua Porto Franco','300',NULL,'Prazeres','Jaboatão dos Guararapes','PE','54335-020','0.00000000','0.00000000','\0');

INSERT INTO `usuario`(`codigo`,`cod_empresa`,`nome`,`email`,`telefone`,`senha`,`perfil`,`situacao`) VALUES (1,1,'Ikaro Sales','ikarosales7@gmail.com','30763050','34663827','A','');
INSERT INTO `usuario`(`codigo`,`cod_empresa`,`nome`,`email`,`telefone`,`senha`,`perfil`,`situacao`) VALUES (11,1,'Kevyn Herbet','kevynh49@gmail.com','','1234','F','');
INSERT INTO `usuario`(`codigo`,`cod_empresa`,`nome`,`email`,`telefone`,`senha`,`perfil`,`situacao`) VALUES (13,1,'Luis Calabria','lfcalabria@gmail.com','','1234','F','');

INSERT INTO `veiculo`(`codigo`,`cod_empresa`,`cod_motorista`,`cod_tipo_veiculo`,`modelo`,`placa`,`chassi`,`proprio`,`capacidade`,`antt`,`situacao`) VALUES (1,1,1,1,'Mercedes Benz Accelo','KHY-8566','5FG116GW04C400002','S',15,0,'\0');
INSERT INTO `veiculo`(`codigo`,`cod_empresa`,`cod_motorista`,`cod_tipo_veiculo`,`modelo`,`placa`,`chassi`,`proprio`,`capacidade`,`antt`,`situacao`) VALUES (2,1,2,1,'Volkswagen Worker 13','JSC-2512','9BG116GW04C400001','S',10,0,'\0');
INSERT INTO `veiculo`(`codigo`,`cod_empresa`,`cod_motorista`,`cod_tipo_veiculo`,`modelo`,`placa`,`chassi`,`proprio`,`capacidade`,`antt`,`situacao`) VALUES (3,1,9,2,'Delivery 8.160','AAA-0000','5FG116GW04C400009','N',10,0,'\0');

INSERT INTO `romaneio`(`codigo`,`cod_empresa`,`cod_status_romaneio`,`cod_estabelecimento`,`cod_tipo_veiculo`,`cod_transportadora`,`cod_motorista`,`valor`,`data_criacao`,`data_finalizacao`,`ofertar_viagem`) VALUES (4141,1,4,5,1,1,13,'2563.41','2017-09-24',NULL,'\0');
INSERT INTO `romaneio`(`codigo`,`cod_empresa`,`cod_status_romaneio`,`cod_estabelecimento`,`cod_tipo_veiculo`,`cod_transportadora`,`cod_motorista`,`valor`,`data_criacao`,`data_finalizacao`,`ofertar_viagem`) VALUES (705,1,1,5,1,1,10,'102.45','2017-09-29',NULL,'');
INSERT INTO `romaneio`(`codigo`,`cod_empresa`,`cod_status_romaneio`,`cod_estabelecimento`,`cod_tipo_veiculo`,`cod_transportadora`,`cod_motorista`,`valor`,`data_criacao`,`data_finalizacao`,`ofertar_viagem`) VALUES (1234,1,1,2,2,2,1,'1500.52','2017-09-24',NULL,'');
INSERT INTO `romaneio`(`codigo`,`cod_empresa`,`cod_status_romaneio`,`cod_estabelecimento`,`cod_tipo_veiculo`,`cod_transportadora`,`cod_motorista`,`valor`,`data_criacao`,`data_finalizacao`,`ofertar_viagem`) VALUES (4321,1,2,3,2,NULL,NULL,'385.00','2017-09-25',NULL,'');
INSERT INTO `romaneio`(`codigo`,`cod_empresa`,`cod_status_romaneio`,`cod_estabelecimento`,`cod_tipo_veiculo`,`cod_transportadora`,`cod_motorista`,`valor`,`data_criacao`,`data_finalizacao`,`ofertar_viagem`) VALUES (2566,1,1,4,8,1,12,'200.00','2017-09-27',NULL,'');

INSERT INTO `entrega`(`seq_entrega`,`cod_romaneio`,`cod_destinatario`,`cod_status_entrega`,`peso_carga`,`nota_fiscal`) VALUES (2,1234,2,1,'200 kg',3332221);
INSERT INTO `entrega`(`seq_entrega`,`cod_romaneio`,`cod_destinatario`,`cod_status_entrega`,`peso_carga`,`nota_fiscal`) VALUES (1,1234,1,1,'800 kg',3332220);
INSERT INTO `entrega`(`seq_entrega`,`cod_romaneio`,`cod_destinatario`,`cod_status_entrega`,`peso_carga`,`nota_fiscal`) VALUES (2,4141,3,1,'785 kg',0);
INSERT INTO `entrega`(`seq_entrega`,`cod_romaneio`,`cod_destinatario`,`cod_status_entrega`,`peso_carga`,`nota_fiscal`) VALUES (1,4141,2,3,'2,5 kg',0);
INSERT INTO `entrega`(`seq_entrega`,`cod_romaneio`,`cod_destinatario`,`cod_status_entrega`,`peso_carga`,`nota_fiscal`) VALUES (1,2,0,1,'10 kg',1212121);
INSERT INTO `entrega`(`seq_entrega`,`cod_romaneio`,`cod_destinatario`,`cod_status_entrega`,`peso_carga`,`nota_fiscal`) VALUES (1,3,1,1,'1212 kg',1212121);
INSERT INTO `entrega`(`seq_entrega`,`cod_romaneio`,`cod_destinatario`,`cod_status_entrega`,`peso_carga`,`nota_fiscal`) VALUES (1,4,0,1,'1000 kg',1212121);
INSERT INTO `entrega`(`seq_entrega`,`cod_romaneio`,`cod_destinatario`,`cod_status_entrega`,`peso_carga`,`nota_fiscal`) VALUES (1,4321,1,1,'250 kg',5277902);
INSERT INTO `entrega`(`seq_entrega`,`cod_romaneio`,`cod_destinatario`,`cod_status_entrega`,`peso_carga`,`nota_fiscal`) VALUES (3,2566,2,1,'9600 kg',1255648);
INSERT INTO `entrega`(`seq_entrega`,`cod_romaneio`,`cod_destinatario`,`cod_status_entrega`,`peso_carga`,`nota_fiscal`) VALUES (2,2566,3,1,'24890 kg',2566501);
INSERT INTO `entrega`(`seq_entrega`,`cod_romaneio`,`cod_destinatario`,`cod_status_entrega`,`peso_carga`,`nota_fiscal`) VALUES (1,705,1,2,'250 kg',0);
INSERT INTO `entrega`(`seq_entrega`,`cod_romaneio`,`cod_destinatario`,`cod_status_entrega`,`peso_carga`,`nota_fiscal`) VALUES (1,2566,1,2,'2500 kg',0);