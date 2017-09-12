CREATE TABLE `acao` (
  `codigo` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `descricao` varchar(20) NOT NULL,
  PRIMARY KEY(`codigo`)
);

CREATE TABLE `empresa` (
  `codigo` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `razao_social` varchar(100) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `logradouro` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `nome_fantasia` varchar(100) NOT NULL,
  `complemento` varchar(20) NULL,
  `bairro` varchar(25) NOT NULL,
  `cidade` varchar(25) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `latitude` decimal(11,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `situacao` BIT NOT NULL,
  PRIMARY KEY(`codigo`)
);

CREATE TABLE `destinatario` (
  `codigo` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `cod_empresa` int UNSIGNED NOT NULL,
  `razao_social` varchar(100) NOT NULL,
  `nome_fantasia` varchar(100) NULL,
  `tipo_pessoa` CHAR NOT NULL,
  `cnpj_cpf` varchar(18) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `logradouro` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(20) NULL,
  `bairro` varchar(25) NOT NULL,
  `cidade` varchar(25) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `latitude` int NOT NULL,
  `longitude` int NOT NULL,
  `situacao` BIT NOT NULL,
  PRIMARY KEY(`codigo`)
);

CREATE TABLE `estabelecimento` (
  `codigo` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `cod_empresa` int UNSIGNED NOT NULL,
  `razao_social` varchar(100) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `logradouro` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(20) NULL,
  `bairro` varchar(25) NOT NULL,
  `cidade` varchar(25) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `latitude` decimal(11,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `situacao` BIT NOT NULL,
  PRIMARY KEY(`codigo`)
);

CREATE TABLE `motorista` (
  `codigo` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `cod_empresa` int UNSIGNED NOT NULL,
  `nome` varchar(80) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `pontuacao` int UNSIGNED NOT NULL,
  `logradouro` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(20) NULL,
  `bairro` varchar(25) NOT NULL,
  `cidade` varchar(25) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `latitude` decimal(11,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `tipo_carteira` varchar(5) NOT NULL,
  `validade_carteira` DATE NOT NULL,
  `situacao` BIT NOT NULL,
  PRIMARY KEY(`codigo`)
);

CREATE TABLE `ocorrencia` (
  `codigo` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `cod_empresa` int UNSIGNED NOT NULL,
  `descricao` varchar(20) NOT NULL,
  `situacao` BIT NOT NULL,
  PRIMARY KEY(`codigo`)
);

CREATE TABLE `tipo_veiculo` (
  `codigo` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `cod_empresa` int UNSIGNED NOT NULL,
  `descricao` varchar(30) NOT NULL,
  `peso` DOUBLE NOT NULL,
  `situacao` BIT NOT NULL,
  PRIMARY KEY(`codigo`)
);

CREATE TABLE `transportadora` (
  `codigo` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `cod_empresa` int UNSIGNED NOT NULL,
  `razao_social` varchar(100) NOT NULL,
  `nome_fantasia` varchar(100) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `logradouro` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(20) NULL,
  `bairro` varchar(25) NOT NULL,
  `cidade` varchar(25) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `latitude` decimal(11,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `situacao` BIT NOT NULL,
  PRIMARY KEY(`codigo`)
);

CREATE TABLE `usuario` (
  `codigo` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `cod_empresa` int UNSIGNED NOT NULL,
  `nome` varchar(80) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `senha` varchar(15) NOT NULL,
  `perfil` CHAR NOT NULL,
  `situacao` BIT NOT NULL,
  PRIMARY KEY(`codigo`)
);

CREATE TABLE `veiculo` (
  `codigo` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `cod_empresa` int UNSIGNED NOT NULL,
  `cod_motorista` int UNSIGNED NOT NULL,
  `cod_tipo_veiculo` int UNSIGNED NOT NULL,
  `modelo` varchar(20) NOT NULL,
  `placa` varchar(8) NOT NULL,
  `chassi` varchar(17) NOT NULL,
  `proprio` CHAR NOT NULL,
  `capacidade` int UNSIGNED NOT NULL,
  `antt` int UNSIGNED NOT NULL,
  `situacao` BIT NOT NULL,
  PRIMARY KEY(`codigo`)
);

CREATE TABLE `log` (
  `codigo` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  `cod_usuario` INTEGER UNSIGNED NOT NULL,
  `data_log` DATE NOT NULL,
  `modulo` VARCHAR(30) NOT NULL,
  `acao` VARCHAR(20) NOT NULL,
  `detalhe` TEXT NOT NULL,
  PRIMARY KEY(`codigo`)
);

CREATE TABLE `romaneio` (
  `codigo` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `cod_status_romaneio` int UNSIGNED NOT NULL,
  `cod_estabelecimento` int UNSIGNED NOT NULL,
  `cod_veiculo` int UNSIGNED NOT NULL,
  `cod_transportadora` int NULL,
  `cod_motorista` int NULL,
  `data_criacao` DATE NOT NULL,
  `data_finalizacao` DATE,
  `ofertar_viagem` BIT NOT NULL,
  PRIMARY KEY(`codigo`)
);

CREATE TABLE `status_romaneio` (
  `codigo` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(20) NOT NULL,
  `situacao` BIT NOT NULL,
  PRIMARY KEY(`codigo`)
);

CREATE TABLE `entrega` (
  `seq_entrega` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `cod_romaneio` int UNSIGNED NOT NULL,
  `cod_destinatario` int UNSIGNED NOT NULL,
  `cod_status_entrega` int UNSIGNED NOT NULL,
  `peso_carga` VARCHAR(10) NOT NULL,
  `nota_fiscal` int UNSIGNED NOT NULL,
  PRIMARY KEY(`seq_entrega`, `cod_romaneio`)
);

CREATE TABLE `status_entrega` (
  `codigo` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(20) NOT NULL,
  `situacao` BIT NOT NULL,
  PRIMARY KEY(`codigo`)
);



ALTER TABLE `destinatario` ADD FOREIGN KEY (`cod_empresa`) REFERENCES `empresa`(`codigo`);

ALTER TABLE `estabelecimento` ADD FOREIGN KEY (`cod_empresa`) REFERENCES `empresa`(`codigo`);

ALTER TABLE `motorista` ADD FOREIGN KEY (`cod_empresa`) REFERENCES `empresa`(`codigo`);

ALTER TABLE `ocorrencia` ADD FOREIGN KEY (`cod_empresa`) REFERENCES `empresa`(`codigo`);

ALTER TABLE `tipo_veiculo` ADD FOREIGN KEY (`cod_empresa`) REFERENCES `empresa`(`codigo`);

ALTER TABLE `usuario` ADD FOREIGN KEY (`cod_empresa`) REFERENCES `empresa`(`codigo`);

ALTER TABLE `transportadora` ADD FOREIGN KEY (`cod_empresa`) REFERENCES `empresa`(`codigo`);

ALTER TABLE `veiculo` ADD FOREIGN KEY (`cod_empresa`) REFERENCES `empresa`(`codigo`);
ALTER TABLE `veiculo` ADD FOREIGN KEY (`cod_motorista`) REFERENCES `motorista`(`codigo`);
ALTER TABLE `veiculo` ADD FOREIGN KEY (`cod_tipo_veiculo`) REFERENCES `tipo_veiculo`(`codigo`);

ALTER TABLE `entrega` ADD FOREIGN KEY (`cod_romaneio`) REFERENCES `romaneio`(`codigo`);
ALTER TABLE `entrega` ADD FOREIGN KEY (`cod_destinatario`) REFERENCES `destinatario`(`codigo`);
ALTER TABLE `entrega` ADD FOREIGN KEY (`cod_status_entrega`) REFERENCES `status_entrega`(`codigo`);

ALTER TABLE `log` ADD FOREIGN KEY (`cod_usuario`) REFERENCES `usuario`(`codigo`);

ALTER TABLE `romaneio` ADD FOREIGN KEY (`cod_status_romaneio`) REFERENCES `status_romaneio`(`codigo`);
ALTER TABLE `romaneio` ADD FOREIGN KEY (`cod_estabelecimento`) REFERENCES `estabelecimento`(`codigo`);
ALTER TABLE `romaneio` ADD FOREIGN KEY (`cod_veiculo`) REFERENCES `veiculo`(`codigo`);
ALTER TABLE `romaneio` ADD FOREIGN KEY (`cod_transportadora`) REFERENCES `transportadora`(`codigo`);
ALTER TABLE `romaneio` ADD FOREIGN KEY (`cod_motorista`) REFERENCES `motorista`(`codigo`);




INSERT INTO `destinatario`(`codigo`, `cod_empresa`, `razao_social`, `nome_fantasia`, `tipo_pessoa`, `cnpj_cpf`, `email`, `telefone`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `cep`, `latitude`, `longitude`, `situacao`) values 
(1,1,'Avil Telas Ltda.','Avil Telas','j','10.822.821/0001-67','producao@jenniferericardotelasltda.com.br','(81) 98928-2574','Rua Professor Joaquim Cavalcanti','820',NULL,'Iputinga','Recife','PE','50800-010',0,0,''),
(2,1,'Dritz Entregas Expressas ME','Dritz Entregas','j','62.651.272/0001-09','auditoria@enzoehadassaentregasexpressasme.com.br','(81) 99574-0867','Rua João XXIII','315',NULL,'Planalto','Abreu e Lima','PE','53550-350',0,0,'');

INSERT INTO `empresa` (`codigo`, `razao_social`, `cnpj`, `logradouro`, `numero`, `nome_fantasia`, `complemento`, `bairro`, `cidade`, `uf`, `cep`, `latitude`, `longitude`, `situacao`) VALUES
(1, 'Renan Yasmin', '80.341.029/0001-76', 'Rua Seis', '396', 'Renan e Yasmin Marketing Ltda', NULL, 'Jardim São Paulo', 'Petrolina', 'PE', '56314-040', 0, 0, b'0'),
(3, 'Sara Alice', '66.875.292/0001-14', 'Rua Dona Maria de Souza', '705', 'Sara Alice Entregas Expressas Ltda', NULL, 'Santo Amaro', 'Recife', 'PE', '50040-330', 0, 0, b'0'),
(4, 'Ryan Carolina', '05.127.366/0001-40', 'Rua Laranjeira do Sul', '237', 'Ryan e Carolina Entregas Expressas Ltda', NULL, 'Nazaré', 'Camaragibe', 'PE', '54753-115', 0, 0, b'0');

INSERT INTO `entrega`(`seq_entrega`, `cod_romaneio`, `cod_destinatario`, `cod_status_entrega`, `peso_carga`, `nota_fiscal`) values 
(1, 1599, 1, 1, '450', 10278600),
(2, 1599, 2, 1, '110', 10278601);

insert  into `estabelecimento`(`codigo`,`cod_empresa`,`razao_social`,`cnpj`,`logradouro`,`numero`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`latitude`,`longitude`,`situacao`) values 
(1,1,'Campinense Transportadora','81.002.942/0001-25','Rua Nogueira de Souza','88',NULL,'Pina','Recife','PE','55036-180',0.00000000,0.00000000,'\0'),
(2,1,'Campinense Transportadora','81.002.942/0001-00','Rua Pôrto Franco','300',NULL,'Prazeres','Jaboatão dos Guararapes','PE','54335-020',0.00000000,0.00000000,'\0'),
(3,1,'Campinense Transportadora','81.002.942/0001-12','Av. Assis Chateaubriand','3055',NULL,'Distrito Industrial','Campina Grande','PB','58000-000',0.00000000,0.00000000,'\0'),
(4,1,'Campinense Transportadora','81.002.942/0001-17','Av. Beberibe','1285',NULL,'Arruda','Recife','PE','52120-000',0.00000000,0.00000000,'\0');

INSERT INTO `motorista` (`codigo`, `cod_empresa`, `nome`, `cpf`, `pontuacao`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `cep`, `latitude`, `longitude`, `tipo_carteira`, `validade_carteira`, `situacao`) VALUES
(1, 1, 'César Lucas Moura', '933.375.288-99', 0, 'Travessa Santa Márcia', '814', NULL, 'Pici', 'Fortaleza', 'CE', '60440-572', 0, 0, 'CDE', '2020-10-08', b'0'),
(2, 4, 'Stefany Sophia Barbosa', '900.750.503-31', 0, 'Rua Vicente Mota Rodrigues', '326', NULL, 'Nova Cidade', 'Boa Vista', 'RR', '69316-224', 0, 0, 'DE', '2022-12-08', b'0');

INSERT INTO `tipo_veiculo` (`codigo`, `cod_empresa`, `descricao`, `peso`, `situacao`) VALUES
(1, 1, 'Caminhão Leve', 3, '0'), 
(2, 1, 'Caminhão Simples', 8, '0'), 
(3, 1, 'Caminhão Trator', 0, '0'), 
(4, 1, 'Caminhão Trator Especial', 0, '0'), 
(5, 1, 'Caminhonete / Furgão', 1, '0'), 
(6, 1, 'Reboque', 0, '0'), 
(7, 1, 'Semi Reboque - 5 Rodas', 0, '0'), 
(8, 1, 'Semi Reboque Especial', 0, '0'), 
(9, 1, 'Utilitário', 0, '0'), 
(10, 1, 'Veículo Operacional', 0, '0');

INSERT INTO `transportadora`(`codigo`,`cod_empresa`,`razao_social`,`nome_fantasia`,`cnpj`,`logradouro`,`numero`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`latitude`,`longitude`,`situacao`) values 
(1,4,'Transportadora Asa de Prata','Asa de Prata','82.244.921/0001-64','Rua Cel. Fabriciano','131',NULL,'Imbiribeira','Recife','PE','54100-705',0.00000000,0.00000000,'\0'),
(2,1,'Transportadora Rocha','Trans Rocha','79.822.134/0001-48','Beco da Aurora','818',NULL,'Nossa Senhora das Graças','Gravatá','PE','55641-696',0.00000000,0.00000000,'\0');

INSERT INTO `veiculo` (`codigo`, `cod_empresa`, `cod_motorista`, `cod_tipo_veiculo`, `modelo`, `placa`, `chassi`, `proprio`, `capacidade`, `antt`, `situacao`) VALUES
(1 ,1 ,1 ,1 , 'Mercedes Benz Accelo', 'KHY-8566', '5FG116GW04C400002', 'S', 15, 0, b'0'), 
(2 ,1 ,2 ,1 , 'Volkswagen Worker 13', 'JSC-2512', '9BG116GW04C400001', 'S', 10, 0, b'0');

insert into `veiculo` (`codigo`, `cod_empresa`, `cod_motorista`, `cod_tipo_veiculo`, `modelo`, `placa`, `chassi`, `proprio`, `capacidade`, `antt`, `situacao`) values('1','1','1','1','Mercedes Benz Accelo','KHY-8566','5FG116GW04C400002','S','15','0','');
insert into `veiculo` (`codigo`, `cod_empresa`, `cod_motorista`, `cod_tipo_veiculo`, `modelo`, `placa`, `chassi`, `proprio`, `capacidade`, `antt`, `situacao`) values('2','1','2','1','Volkswagen Worker 13','JSC-2512','9BG116GW04C400001','S','10','0','');

INSERT INTO `status_entrega`(`codigo`,`descricao`,`situacao`) values 
(1, 'Liberado', '\0');

INSERT INTO `status_romaneio`(`codigo`,`descricao`,`situacao`) values 
(1, 'Liberado', '\0'),
(2, 'Pendente', '\0');

INSERT INTO `romaneio`(`codigo`, `cod_status_romaneio`, `cod_estabelecimento`, `cod_veiculo`, `cod_transportadora`, `cod_motorista`, `data_criacao`, `data_finalizacao`, `ofertar_viagem`) values 
(1599, 1, 2, 1, 1, 2, '2017-09-07', NULL, '\0'),
(2563, 1, 1, 1, 2, 1, '2017-09-07', NULL, '\0'),
(77778, 0, 0, 0, 0, 0, '0000-00-00', NULL, '\0');

INSERT INTO `usuario`(`codigo`,`cod_empresa`,`nome`,`email`,`telefone`,`senha`,`perfil`,`situacao`) values 
(1,1,'Ikaro Sales','ikarosales7@gmail.com','30763050','34663827','A','\0'),
(2,3,'Kevyn Herbet','kevynh48@gmail.com','34848461','123456','F','\0'),
(3,4,'Carlos Eduardo','kevynh47@gmail.com','988602849','1234567','T','\0'),
(4,3,'Paulo Roberto','kevynh49@gmail.com','984567865','12345678','AU','\0');