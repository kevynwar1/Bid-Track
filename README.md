# Bid & Track

## Começando

Essas instruções fornecerão uma cópia do projeto em funcionamento em sua máquina local para fins de desenvolvimento e teste. Consulte a implantação de notas sobre como implantar o projeto em um sistema.

## Web

### Instalando
Mude a constante *$config['base_url']* no arquivo **config.php**, para o CI saber onde fica a pasta raiz na sua máquina local.
```
Bid-Track/Web/application/config/config.php
```

### Controller
Local de acesso ao Controller
```
Bid-Track/Web/application/controllers/
```

### Model
Local de acesso ao Model
```
Bid-Track/Web/application/model/
```

## Web Service

O arquivo do Web Service está dentro da pasta controller, esse arquivo *Ws.php* servi como uma fachada para implementação do *REST_Controller*.
```
Bid-Track/Web/application/controllers/Ws.php
```

### Listar
Para listar todos os registros de uma tabela/entidade.
* Coloque o endereço url do sistema -> *http://coopera.pe.hu/*
* Coloque o controller do Web Service -> *ws/*
* Coloque qual entidade você quer listar -> *empresa/* 
```
http://coopera.pe.hu/ws/empresa/
```

### Item Específico
Para listar capturar um registro específico de uma tabela/entidade.
* Coloque o endereço url do sistema -> *http://coopera.pe.hu/*
* Coloque o controller do Web Service -> *ws/* 
* Coloque qual entidade você quer listar -> *empresa/*
* Coloque PK -> *id/*, o WS saberá qual a PK da entidade selecionada
* Coloque o Id do registro -> *1/*
```
http://coopera.pe.hu/ws/empresa/id/1/
```

### Formato de Retorno
Caso você não queira utilizar o JSON como retorno do Web Service.
* Coloque o endereço url do sistema -> *http://coopera.pe.hu/*
* Coloque o controller do Web Service -> *ws/*
* Coloque qual entidade você quer listar -> *empresa/* 
* Coloque o parâmetro -> *format/*
* Coloque o formato desejado de retorno, podendo ser: *XML | JSON | HTML | CSV | PHP | SERIALIZED | ARRAY*
```
http://coopera.pe.hu/ws/empresa/format/xml
```
```
http://coopera.pe.hu/ws/empresa/id/1/format/xml
```

### Métodos
Métodos de Listagem
```
http://coopera.pe.hu/ws/empresa/
```
```
http://coopera.pe.hu/ws/entrega/
```
```
http://coopera.pe.hu/ws/motorista/
```
```
http://coopera.pe.hu/ws/romaneio/
```
```
http://coopera.pe.hu/ws/usuario/
```

Métodos Mobile
```
http://coopera.pe.hu/ws/romaneio_motorista/1
```
```
http://coopera.pe.hu/ws/romaneio_ofertavel/1/1
```
```
http://coopera.pe.hu/ws/entrega_motorista/1
```
```
http://coopera.pe.hu/ws/login/mariaj%40gmail.com/5678
```