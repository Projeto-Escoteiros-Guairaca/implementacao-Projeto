CREATE TABLE tb_enderecos (
  id_endereco int AUTO_INCREMENT,
  cep CHAR(9) NOT NULL,
  logradouro VARCHAR(255) NOT NULL,
  numero_endereco int NOT NULL,
  bairro VARCHAR(100) NOT NULL,
  cidade VARCHAR(100) NOT NULL,
  pais VARCHAR(45) NOT NULL,
  PRIMARY KEY (id_endereco)
);

CREATE TABLE tb_contatos (
  id_contato int AUTO_INCREMENT,
  telefone CHAR(10),
  celular CHAR(11) NOT NULL,
  email VARCHAR(100),
  PRIMARY KEY (id_contato)
);

CREATE TABLE tb_alcateias (
  id_alcateia int AUTO_INCREMENT,
  nome_alcateia VARCHAR(45),
  PRIMARY KEY (id_alcateia)
);

CREATE TABLE tb_matilhas (
  id_matilha int AUTO_INCREMENT,
  id_alcateia int,
  id_usuario_chefe int,
  id_usuario_primo int,
  nome_matilha VARCHAR(100) NOT NULL,
  PRIMARY KEY (id_matilha),
  FOREIGN KEY (id_alcateia) REFERENCES tb_alcateias (id_alcateia)
);

CREATE TABLE tb_usuarios ( 
  id_usuario int AUTO_INCREMENT, 
  id_endereco int NOT NULL,
  id_contato int NOT NULL,
  id_matilha int ,
  nome varchar(70) NOT NULL, 
  cpf char(11) NOT NULL,
  login varchar(15) NOT NULL,
  senha varchar(15) NOT NULL,
  papeis varchar(255) NOT NULL DEFAULT 'LOBINHO',
  status_usuario varchar(70) NOT NULL DEFAULT 'ATIVO',
  PRIMARY KEY (id_usuario),
  FOREIGN KEY (id_endereco) REFERENCES tb_enderecos (id_endereco),
  FOREIGN KEY (id_contato) REFERENCES tb_contatos (id_contato),
  CONSTRAINT uk_usuarios UNIQUE (login)
);


CREATE TABLE tb_encontros(
  id_encontro int AUTO_INCREMENT,
  id_matilha int NOT NULL,
  data_encontro DATE NOT NULL,
  descricao_encontro TEXT(255) NOT NULL,
  PRIMARY KEY (id_encontro),
  FOREIGN KEY (id_matilha) REFERENCES tb_matilhas (id_matilha)
);

CREATE TABLE tb_frequencias(
  id_frequencia int AUTO_INCREMENT,
  id_usuario int NOT NULL,
  id_encontro int NOT NULL,
  frequencia BOOLEAN NOT NULL NOT NULL DEFAULT true,
  PRIMARY KEY (id_frequencia),
  FOREIGN KEY (id_usuario) REFERENCES tb_usuarios (id_usuario), 
  FOREIGN KEY (id_encontro) REFERENCES tb_encontros (id_encontro)

);
CREATE TABLE tb_atividades(
 
  id_atividade int auto_increment,
  nome_atividade VARCHAR(45) NOT NULL,
  descricao_atividade VARCHAR(255) NOT NULL,
  imagem_atividade VARCHAR(400),
  status_atividade BOOLEAN DEFAULT 0,
  PRIMARY KEY (id_atividade)

);
CREATE TABLE tb_arquivos(
  id_arquivo int auto_increment,
  nome_arquivo VARCHAR(45) NOT NULL,
  caminho VARCHAR(400) NOT NULL,
  texto VARCHAR(255),
  PRIMARY KEY (id_arquivo)

);
CREATE TABLE tb_tarefas(
  id_tarefa int AUTO_INCREMENT,
  id_atividade int NOT NULL,
  nome_tarefa VARCHAR(45) NOT NULL,
  descricao_tarefa VARCHAR(255) NOT NULL,
  PRIMARY KEY (id_tarefa),
  FOREIGN KEY (id_atividade) REFERENCES tb_atividades (id_atividade)

);
CREATE TABLE tb_tarefas_usuarios(
  id_tarefa_usuario int AUTO_INCREMENT,
  id_usuario int NOT NULL,
  id_tarefa int NOT NULL,
  id_arquivo int NOT NULL,  
  status_tarefa_usuario int NOT NULL DEFAULT 0,
  data_tarefa_usuario DATE NOT NULL,
  PRIMARY KEY (id_tarefa_usuario),
  FOREIGN KEY (id_usuario) REFERENCES tb_usuarios (id_usuario), 
  FOREIGN KEY (id_tarefa) REFERENCES tb_tarefas (id_tarefa),
  FOREIGN KEY (id_arquivo) REFERENCES tb_arquivos (id_arquivo)

);

ALTER TABLE tb_matilhas ADD CONSTRAINT fk_usuario_chefe FOREIGN KEY (id_usuario_chefe) REFERENCES tb_usuarios (id_usuario);
ALTER Table tb_matilhas ADD CONSTRAINT fk_usuario_primo FOREIGN KEY (id_usuario_primo) REFERENCES tb_usuarios (id_usuario);


/*Inserts atividades*/
INSERT INTO tb_atividades (nome_atividade, descricao_atividade) VALUES ('Caçador', 'Caçar, obviamente');

/*Inserts arquivos*/
INSERT INTO tb_arquivos (nome_arquivo, caminho, texto) VALUES ('Video', 'https://pin.it/2aYGxms', "");
INSERT INTO tb_arquivos (nome_arquivo, caminho, texto) VALUES ('Imagem', 'asd', "bruh");
INSERT INTO tb_arquivos (nome_arquivo, caminho, texto) VALUES ('Video', 'https://pin.it/2aYGxms', "coelho comido");
/*Inserts de tarefas*/
INSERT INTO tb_tarefas (id_atividade, nome_tarefa, descricao_tarefa) VALUES (1, 'Fogueira', 'Faça uma fogueira sem usar qualquer tipo de acendedor artificial.');
INSERT INTO tb_tarefas (id_atividade, nome_tarefa, descricao_tarefa) VALUES (1, 'Cocinhar', 'Cozinhe uma carne caçada utilizando a fogueira da tarefa anterior.');
INSERT INTO tb_tarefas (id_atividade, nome_tarefa, descricao_tarefa) VALUES (1, 'Cace um coelho', 'Cace um coeho selvagem utilizando as ferramentas aprendidas no encontro anterior.');


/*Inserts enderecos*/
INSERT INTO tb_enderecos (cep, logradouro, numero_endereco, bairro, cidade, pais) VALUES ('00000000', 'Rua 1', 1, 'Bairro 1', 'Cidade 1', 'Pais 1');
INSERT INTO tb_enderecos (cep, logradouro, numero_endereco, bairro, cidade, pais) VALUES ('11111111', 'Rua 2', 2, 'Bairro 2', 'Cidade 2', 'Pais 2');
INSERT INTO tb_enderecos (cep, logradouro, numero_endereco, bairro, cidade, pais) VALUES ('11111111', 'Rua 2', 2, 'Bairro 2', 'Cidade 2', 'Pais 2');
INSERT INTO tb_enderecos (cep, logradouro, numero_endereco, bairro, cidade, pais) VALUES ('11111111', 'Rua 2', 2, 'Bairro 2', 'Cidade 2', 'Pais 2');
INSERT INTO tb_enderecos (cep, logradouro, numero_endereco, bairro, cidade, pais) VALUES ('11111111', 'Rua 2', 2, 'Bairro 2', 'Cidade 2', 'Pais 2');
INSERT INTO tb_enderecos (cep, logradouro, numero_endereco, bairro, cidade, pais) VALUES ('11111111', 'Rua 2', 2, 'Bairro 2', 'Cidade 2', 'Pais 2');


/*Inserts contatos*/
INSERT INTO tb_contatos (telefone, celular, email) VALUES ('11111111', '11111111111', 'emailAdmin@gmail.com');
INSERT INTO tb_contatos (telefone, celular, email) VALUES ('22222222', '22222222222', 'emailRoot@gmail.com');
INSERT INTO tb_contatos (telefone, celular, email) VALUES ('33333333', '33333333333', 'Markinhos@gmail.com');
INSERT INTO tb_contatos (telefone, celular, email) VALUES ('44444444', '44444444444', 'chefinho@gmail.com');
INSERT INTO tb_contatos (telefone, celular, email) VALUES ('55555555', '44444444444', 'chefinho2@gmail.com');
INSERT INTO tb_contatos (telefone, celular, email) VALUES ('66666666', '44444444444', 'chefinho3@gmail.com');

/*Inserts usuarios*/
INSERT INTO tb_usuarios (id_endereco, id_contato, id_matilha, nome, cpf, login, senha, papeis, status_usuario) VALUES
                        (1, 1, 1, 'Sr. Administrador', '11122233344', 'admin', 'admin', 'ADMINISTRADOR', 'ATIVO');
INSERT INTO tb_usuarios (id_endereco, id_contato, id_matilha, nome, cpf, login, senha, papeis, status_usuario) VALUES 
                        (2, 2, 1, 'Sr. Root', '44433322211', 'root', 'root', 'LOBINHO', 'ATIVO');
INSERT INTO tb_usuarios (id_endereco, id_contato, id_matilha, nome, cpf, login, senha, papeis, status_usuario) VALUES 
                        (3, 3, 2, 'Marco', '69669669669', 'marco', 'marco', 'ADMINISTRADOR', 'ATIVO');
INSERT INTO tb_usuarios (id_endereco, id_contato, id_matilha, nome, cpf, login, senha, papeis, status_usuario) VALUES 
                        (4, 4, 1, 'chefe1', '50947509203', 'chefe1', 'chefe1', 'CHEFE', 'ATIVO');
INSERT INTO tb_usuarios (id_endereco, id_contato, id_matilha, nome, cpf, login, senha, papeis, status_usuario) VALUES 
                        (5, 5, 2, 'chefe2', '50947509203', 'chefe2', 'chefe2', 'CHEFE', 'ATIVO');
INSERT INTO tb_usuarios (id_endereco, id_contato, id_matilha, nome, cpf, login, senha, papeis, status_usuario) VALUES 
                        (6, 6, 3, 'chefe3', '50947509203', 'chefe3', 'chefe3', 'CHEFE', 'ATIVO');

INSERT INTO tb_usuarios (id_endereco, id_contato, id_matilha, nome, cpf, login, senha, papeis, status_usuario) VALUES 
                        (6, 6, 3, 'chefe4', '50947509203', 'chefe4', 'chefe4', 'CHEFE', 'ATIVO');


INSERT INTO tb_alcateias (nome_alcateia) VALUES ('Guairacá');
INSERT INTO tb_alcateias (nome_alcateia) VALUES ('Tarobá');

/*Inserts matilhas*/
INSERT INTO tb_matilhas (nome_matilha, id_alcateia, id_usuario_chefe) VALUES ('Preta', '1', '4');
INSERT INTO tb_matilhas (nome_matilha, id_alcateia, id_usuario_chefe) VALUES ('Cinza', '1', '5');
INSERT INTO tb_matilhas (nome_matilha, id_alcateia, id_usuario_chefe) VALUES ('Vermelha', '1', '6');
INSERT INTO tb_matilhas (nome_matilha, id_alcateia, id_usuario_chefe) VALUES ('Branco', '1', '6');



INSERT INTO tb_matilhas (nome_matilha, id_alcateia, id_usuario_chefe) VALUES ('Preta', '2', '4');
INSERT INTO tb_matilhas (nome_matilha, id_alcateia, id_usuario_chefe) VALUES ('Cinza', '2', '5');
INSERT INTO tb_matilhas (nome_matilha, id_alcateia, id_usuario_chefe) VALUES ('Vermelha', '2', '6');
INSERT INTO tb_matilhas (nome_matilha, id_alcateia, id_usuario_chefe) VALUES ('Branco', '2', '6');
ALTER TABLE tb_usuarios ADD FOREIGN KEY (id_matilha) REFERENCES tb_matilhas (id_matilha);

/*Inserts tarefa_usuarios*/
INSERT INTO tb_tarefas_usuarios (id_usuario, id_tarefa, id_arquivo, status_tarefa_usuario, data_tarefa_usuario) VALUES 
('1', '1', '1', '2', '2020-01-01');
INSERT INTO tb_tarefas_usuarios (id_usuario, id_tarefa, id_arquivo, status_tarefa_usuario, data_tarefa_usuario) VALUES 
('2', '2', '2', '2', '2020-01-01');
INSERT INTO tb_tarefas_usuarios (id_usuario, id_tarefa, id_arquivo, status_tarefa_usuario, data_tarefa_usuario) VALUES 
('2', '3', '3', '2', '2020-01-01');
/*Inserts encontros*/
INSERT INTO tb_encontros (id_matilha, data_encontro, descricao_encontro) VALUES (1, '2020-01-01', 'Encontro 1');
INSERT INTO tb_encontros (id_matilha, data_encontro, descricao_encontro) VALUES (2, '2020-01-01', 'Encontro 2');

INSERT INTO tb_frequencias (id_usuario, id_encontro, frequencia) VALUES (1, 1, TRUE);
INSERT INTO tb_frequencias (id_usuario, id_encontro) VALUES (2, 1);

INSERT INTO tb_frequencias (id_usuario, id_encontro) VALUES (3, 2);


