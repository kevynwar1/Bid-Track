package com.rgames.guilherme.bidtruck.model.dao.database;

/**
 * Created by Kevyn on 18/10/2017.
 */

public class ScriptSql {

    // Table: empresa (DropTable)
    public static String getDropTableEmpresa() {
        StringBuilder sqlBuilder = new StringBuilder();

        sqlBuilder.append("DROP TABLE IF EXISTS empresa;");

        return sqlBuilder.toString();
    }

    // Table: empresa (CreateTable)
    public static String getCreateTableEmpresa() {
        StringBuilder sqlBuilder = new StringBuilder();

        sqlBuilder.append("CREATE TABLE IF NOT EXISTS empresa ( ");
        sqlBuilder.append("codigo INTEGER NOT NULL, ");
        //sqlBuilder.append("latitude NUMERIC(11,8), ");
        //sqlBuilder.append("longitude NUMERIC(11,8), ");
        sqlBuilder.append("nome_fantasia TEXT NOT NULL, ");
        sqlBuilder.append("PRIMARY KEY (codigo) ");
        sqlBuilder.append(");");

        return sqlBuilder.toString();
    }

    // Table: empresa_motorista (DropTable)
    public static String getDropTableEmpresaMotorista() {
        StringBuilder sqlBuilder = new StringBuilder();

        sqlBuilder.append("DROP TABLE IF EXISTS empresa_motorista;");

        return sqlBuilder.toString();
    }
    // Table: empresa_motorista (CreateTable)

    public static String getCreateTableEmpresaMotorista() {
        StringBuilder sqlBuilder = new StringBuilder();

        sqlBuilder.append("CREATE TABLE IF NOT EXISTS empresa_motorista ( ");
        sqlBuilder.append("cod_empresa INTEGER NOT NULL, ");
        sqlBuilder.append("cod_motorista INTEGER NOT NULL, ");
        sqlBuilder.append("PRIMARY KEY (cod_empresa, cod_motorista) ");
       // sqlBuilder.append("FOREIGN KEY (cod_motorista) REFERENCES motorista (codigo) ");
        sqlBuilder.append(");");

        return sqlBuilder.toString();
    }

    // Table: entrega (DropTable)
    public static String getDropTableEntrega() {
        StringBuilder sqlBuilder = new StringBuilder();

        sqlBuilder.append("DROP TABLE IF EXISTS entrega;");

        return sqlBuilder.toString();
    }

    // Table: entrega (CreateTable)
    public static String getCreateTableEntrega() {
        StringBuilder sqlBuilder = new StringBuilder();

        sqlBuilder.append("CREATE TABLE IF NOT EXISTS entrega ( ");
        sqlBuilder.append("seq_entrega INTEGER NOT NULL, ");
        sqlBuilder.append("cod_romaneio INTEGER NOT NULL, ");

        sqlBuilder.append("cod_status_entrega INTEGER,");
        sqlBuilder.append("descricao_status TEXT,");

        sqlBuilder.append("cod_destinatario INTEGER, ");
        sqlBuilder.append("nome_fantasia_destinatario TEXT,");
        sqlBuilder.append("razao_social_destinatario TEXT,");
        sqlBuilder.append("latitude INTEGER,");
        sqlBuilder.append("longitude INTEGER,");


        sqlBuilder.append("telefone TEXT,");
        sqlBuilder.append("cep TEXT,");
        sqlBuilder.append("uf TEXT,");
        sqlBuilder.append("cidade TEXT,");
        sqlBuilder.append("bairro TEXT,");
        sqlBuilder.append("logradouro TEXT,");
        sqlBuilder.append("numero TEXT,");
        sqlBuilder.append("complemento TEXT,");

        sqlBuilder.append("peso_carga TEXT,");
        sqlBuilder.append("nota_fiscal INTEGER,");
        sqlBuilder.append("PRIMARY KEY (seq_entrega, cod_romaneio) ");
     /*   sqlBuilder.append("FOREIGN KEY (cod_romaneio) REFERENCES romaneio (codigo), ");
        sqlBuilder.append("FOREIGN KEY (cod_destinatario) REFERENCES destinatario (codigo), ");
        sqlBuilder.append("FOREIGN KEY (cod_status_entrega) REFERENCES status_entrega (codigo) ");*/
        sqlBuilder.append(");");

        return sqlBuilder.toString();
    }

    // Table: status_entrega (DropTable)
    public static String getDropTableStatusEntrega() {
        StringBuilder sqlBuilder = new StringBuilder();

        sqlBuilder.append("DROP TABLE IF EXISTS status_entrega;");

        return sqlBuilder.toString();
    }
    // Table: status_entrega (CreateTable)
    public static String getCreateTableStatusEntrega() {
        StringBuilder sqlBuilder = new StringBuilder();

        sqlBuilder.append("CREATE TABLE IF NOT EXISTS status_entrega ( ");
        sqlBuilder.append("codigo INTEGER NOT NULL, ");
        sqlBuilder.append("descricao TEXT NOT NULL, ");
        sqlBuilder.append("situacao INTEGER DEFAULT 0, ");
        sqlBuilder.append("PRIMARY KEY (codigo) ");
        sqlBuilder.append(");");

        return sqlBuilder.toString();
    }

    // Table: ocorrencia (DropTable)
    public static String getDropTableOcorrencia() {
        StringBuilder sqlBuilder = new StringBuilder();

        sqlBuilder.append("DROP TABLE IF EXISTS ocorrencia;");

        return sqlBuilder.toString();
    }

    // Table: ocorrencia (CreateTable)
    public static String getCreateTableOcorrencia() {
        StringBuilder sqlBuilder = new StringBuilder();

        sqlBuilder.append("CREATE TABLE IF NOT EXISTS ocorrencia ( ");
        sqlBuilder.append("codigo INTEGER NOT NULL AUTOINCREMENT, ");
        sqlBuilder.append("cod_empresa INTEGER NOT NULL, ");
        sqlBuilder.append("seq_entrega INTEGER NOT NULL, ");
        sqlBuilder.append("cod_romaneio INTEGER NOT NULL, ");
        sqlBuilder.append("cod_tipo_ocorrencia INTEGER NOT NULL, ");
        sqlBuilder.append("descricao TEXT NOT NULL, ");
        sqlBuilder.append("foto TEXT NOT NULL, ");
        sqlBuilder.append("situacao INTEGER DEFAULT 0, ");
        sqlBuilder.append("PRIMARY KEY (codigo) ");
      /* sqlBuilder.append("FOREIGN KEY (cod_empresa) REFERENCES empresa (codigo), ");
        sqlBuilder.append("FOREIGN KEY (seq_entrega) REFERENCES entrega (seq_entrega), ");
        sqlBuilder.append("FOREIGN KEY (cod_romaneio) REFERENCES romaneio (codigo), ");
        sqlBuilder.append("FOREIGN KEY (cod_tipo_ocorrencia) REFERENCES tipo_ocorrencia (codigo) ");*/
        sqlBuilder.append(");");

        return sqlBuilder.toString();
    }

    // Table: tipo_ocorrencia (DropTable)
    public static String getDropTableTipoOcorrencia() {
        StringBuilder sqlBuilder = new StringBuilder();

        sqlBuilder.append("DROP TABLE IF EXISTS tipo_ocorrencia;");

        return sqlBuilder.toString();
    }

    // Table: tipo_ocorrencia (CreateTable)
    public static String getCreateTableTipoOcorrencia() {
        StringBuilder sqlBuilder = new StringBuilder();

        sqlBuilder.append("CREATE TABLE IF NOT EXISTS tipo_ocorrencia ( ");
        sqlBuilder.append("codigo INTEGER NOT NULL, ");
        sqlBuilder.append("cod_empresa INTEGER NOT NULL, ");
        sqlBuilder.append("descricao TEXT NOT NULL, ");
        sqlBuilder.append("situacao INTEGER DEFAULT 0, ");
        sqlBuilder.append("PRIMARY KEY (codigo) ");
      //  sqlBuilder.append("FOREIGN KEY (cod_empresa) REFERENCES empresa (codigo) ");
        sqlBuilder.append(");");

        return sqlBuilder.toString();
    }

    // Table: romaneio (DropTable)
    public static String getDropTableRomaneio() {
        StringBuilder sqlBuilder = new StringBuilder();

        sqlBuilder.append("DROP TABLE IF EXISTS romaneio;");

        return sqlBuilder.toString();
    }

    // Table: romaneio (CreateTable)
    public static String getCreateTableRomaneio() {
        StringBuilder sqlBuilder = new StringBuilder();

        sqlBuilder.append("CREATE TABLE IF NOT EXISTS romaneio ( ");
        sqlBuilder.append("codigo INTEGER NOT NULL, ");
        sqlBuilder.append("cod_empresa INTEGER NOT NULL, ");
        sqlBuilder.append("cod_status_romaneio INTEGER NOT NULL, ");
        sqlBuilder.append("cod_estabelecimento INTEGER NOT NULL, ");
       //sqlBuilder.append("cod_tipo_veiculo INTEGER NOT NULL, ");
       //sqlBuilder.append("cod_transportadora INTEGER NOT NULL, ");
        sqlBuilder.append("cod_motorista INTEGER NOT NULL, ");
      //sqlBuilder.append("valor NUMERIC(12,2) NOT NULL, ");
      //sqlBuilder.append("data_criacao NUMERIC NOT NULL, ");
      //sqlBuilder.append("data_finalizacao NUMERIC, ");
        sqlBuilder.append("PRIMARY KEY (codigo) ");
      /* sqlBuilder.append("FOREIGN KEY (cod_empresa) REFERENCES empresa (codigo), ");
        sqlBuilder.append("FOREIGN KEY (cod_status_romaneio) REFERENCES status_romaneio (codigo), ");
        sqlBuilder.append("FOREIGN KEY (cod_estabelecimento) REFERENCES estabelecimento (codigo), ");
        sqlBuilder.append("FOREIGN KEY (cod_tipo_veiculo) REFERENCES tipo_veiculo (codigo), ");
        sqlBuilder.append("FOREIGN KEY (cod_transportadora) REFERENCES transportadora (codigo), ");
        sqlBuilder.append("FOREIGN KEY (cod_motorista) REFERENCES motorista (codigo), ");*/
        sqlBuilder.append(");");

        return sqlBuilder.toString();
    }

    // Table: status_romaneio (DropTable)
    public static String getDropTableStatusRomaneio() {
        StringBuilder sqlBuilder = new StringBuilder();

        sqlBuilder.append("DROP TABLE IF EXISTS status_romaneio;");

        return sqlBuilder.toString();
    }

    // Table: status_romaneio (CreateTable)
    public static String getCreateTableStatusRomaneio() {
        StringBuilder sqlBuilder = new StringBuilder();

        sqlBuilder.append("CREATE TABLE IF NOT EXISTS status_romaneio ( ");
        sqlBuilder.append("codigo INTEGER NOT NULL, ");
        sqlBuilder.append("descricao TEXT NOT NULL, ");
        sqlBuilder.append("situacao INTEGER DEFAULT 0, ");
        sqlBuilder.append("PRIMARY KEY (codigo) ");
        sqlBuilder.append(");");

        return sqlBuilder.toString();
    }

    // Table: destinatario (DropTable)
    public static String getDropTableDestinatario() {
        StringBuilder sqlBuilder = new StringBuilder();

        sqlBuilder.append("DROP TABLE IF EXISTS destinatario;");

        return sqlBuilder.toString();
    }

    // Table: destinatario (CreateTable)
    public static String getCreateTableDestinatario() {
        StringBuilder sqlBuilder = new StringBuilder();

        sqlBuilder.append("CREATE TABLE IF NOT EXISTS destinatario ( ");
        sqlBuilder.append("codigo INTEGER NOT NULL, ");
        sqlBuilder.append("cod_empresa INTEGER NOT NULL, ");
        sqlBuilder.append("razao_social TEXT NOT NULL, ");
        sqlBuilder.append("nome_fantasia TEXT NOT NULL, ");
        sqlBuilder.append("tipo_pessoa TEXT NOT NULL, ");
        sqlBuilder.append("cnpj_cpf TEXT NOT NULL, ");
        sqlBuilder.append("email TEXT NOT NULL, ");
        sqlBuilder.append("telefone TEXT NOT NULL, ");
        sqlBuilder.append("logradouro TEXT NOT NULL, ");
        sqlBuilder.append("numero TEXT NOT NULL, ");
        sqlBuilder.append("complemento TEXT NOT NULL, ");
        sqlBuilder.append("bairro TEXT NOT NULL, ");
        sqlBuilder.append("cidade TEXT NOT NULL, ");
        sqlBuilder.append("uf TEXT NOT NULL, ");
        sqlBuilder.append("cep TEXT NOT NULL, ");
        sqlBuilder.append("latitude INTEGER NOT NULL, ");
        sqlBuilder.append("longitude TEXT NOT NULL, ");
        sqlBuilder.append("situacao INTEGER DEFAULT 0, ");
        sqlBuilder.append("PRIMARY KEY (codigo) ");
   //     sqlBuilder.append("FOREIGN KEY (cod_empresa) REFERENCES empresa (codigo) ");
        sqlBuilder.append(");");

        return sqlBuilder.toString();
    }
}
