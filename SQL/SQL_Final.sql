create database urna;
use urna;

create table tbcidadao(
idCid int(3) auto_increment primary key,
nome varchar(80) not null,
cpf char(14) not null,
senha varchar(8) not null,
vtVereador varchar(30),
vtPrefeito VARCHAR(30),
adm char(3)
);
/*RENAME TABLE candidato TO tbCandidato;*/

/*ALTER TABLE tbCandidato ADD COLUMN id;*/

CREATE TABLE tbCandidato(
	idCand INT(3) auto_increment primary KEY,
    nome_candidato VARCHAR(80) NOT NULL,
    partido VARCHAR(30),
    numero INT(5) NOT NULL,
    cargo varchar(20)
);
INSERT INTO tbcidadao (nome, cpf, senha, adm) VALUES ('Administrador', '56040199860', 'adm123', 'Sim');
/* 5 VEREADORES */
INSERT INTO tbCandidato (nome_candidato, partido, numero, cargo)
VALUES ('Maria', 'JC', 12345, 'Vereador');

INSERT INTO tbCandidato (nome_candidato, partido, numero, cargo)
VALUES ('João Carlos', 'HT', 23456, 'Vereador');

INSERT INTO tbCandidato (nome_candidato, partido, numero, cargo)
VALUES ('João Lucas', 'EW', 34567, 'Vereador');

INSERT INTO tbCandidato (nome_candidato, partido, numero, cargo)
VALUES ('João Tiago', 'QW', 45678, 'Vereador');

INSERT INTO tbCandidato (nome_candidato, partido, numero, cargo)
VALUES ('João João', 'AS', 56789, 'Vereador');
/************************************************************/
/* 5 PREFEITOS */
INSERT INTO tbCandidato (nome_candidato, partido, numero, cargo)
VALUES ('João Silva', 'JC', 12, 'Prefeito');

INSERT INTO tbCandidato (nome_candidato, partido, numero, cargo)
VALUES ('João', 'HT', 23, 'Prefeito');

INSERT INTO tbCandidato (nome_candidato, partido, numero, cargo)
VALUES ('Eduarda', 'EW', 34, 'Prefeito');

INSERT INTO tbCandidato (nome_candidato, partido, numero, cargo)
VALUES ('Luciana', 'QW', 45, 'Prefeito');

INSERT INTO tbCandidato (nome_candidato, partido, numero, cargo)
VALUES ('Marlon', 'AS', 56, 'Prefeito');

/************************************************************/
/* 5 CIDADOES */
INSERT INTO tbcidadao (nome, cpf, senha, adm) 
VALUES ('joao', '12378945685', 'eu123', 'Não');

INSERT INTO tbcidadao (nome, cpf, senha, adm) 
VALUES ('mateus', '78945612325', 'eu123', 'Não');

INSERT INTO tbcidadao (nome, cpf, senha, adm) 
VALUES ('lucas', '45612378996', 'eu123', 'Não');

INSERT INTO tbcidadao (nome, cpf, senha, adm) 
VALUES ('pedro', '98765432114', 'eu123', 'Não');

INSERT INTO tbcidadao (nome, cpf, senha, adm) 
VALUES ('gustavo', '14725836985', 'eu123', 'Não');

/******************************************************************/





