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
```
Bid-Track/Web/application/controllers/
```

### Model
```
Bid-Track/Web/application/model/
```

### Web Service
O Web Service está dentro da pasta controller, ele arquivo *Ws.php* servi como uma fachada para implementação do *REST_Controller*.
```
Bid-Track/Web/application/controllers/Ws.php
```