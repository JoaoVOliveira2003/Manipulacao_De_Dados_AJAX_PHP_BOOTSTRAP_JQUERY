-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/07/2024 às 14:19
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cartaovistoria`
--

----------------------------------------------------------
CREATE schema cartaovistoria;
----------------------------------------------------------

--
-- Estrutura para tabela `cep`
--

CREATE TABLE `cep` (
  `id_cep` int(11) NOT NULL,
  `codigo_cep` int(8) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `bairro` varchar(25) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `id_municipio` int(11) DEFAULT NULL,
  `id_uf` int(11) DEFAULT NULL,
  `complemento` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cep`
--

INSERT INTO `cep` (`id_cep`, `codigo_cep`, `endereco`, `bairro`, `numero`, `id_municipio`, `id_uf`, `complemento`) VALUES
(1, 83410030, 'Rua Andirá', 'Guaraituba', '23', 11, 4, 'tem'),
(2, 83405188, 'Rua Benigna Costa Fortes', 'Campo Pequeno', '53', 11, 4, 'tem'),
(3, 83415220, 'Avenida Brasil', 'Centro', '90', 11, 4, 'tem'),
(4, 83420310, 'Rua das Flores', 'Maracanã', '1', 11, 4, 'tem'),
(5, 83430410, 'Rua das Palmeiras', 'Capanema', '43', 11, 4, 'tem'),
(6, 83440500, 'Avenida das Nações', 'Guaraituba', '32', 11, 4, 'tem'),
(7, 83450600, 'Rua das Acácias', 'Fatima', '12', 11, 4, 'tem'),
(8, 1326000, 'R. São Domingos, ', 'Bela Vista', '223', 16, 1, 'é no subsolo'),
(10, 83410030, 'Avenida das Flores', 'Jardim Primavera', '100', 16, 2, 'Apto 1'),
(11, 83405188, 'Rua dos Lírios', 'Parque das Rosas', '200', 16, 2, 'Casa 2'),
(12, 83010010, 'Alameda dos Ipês', 'Bosque Encantado', '300', 16, 2, 'Bloco 3'),
(13, 83020020, 'Travessa dos Jacarandás', 'Vila Verde', '400', 16, 2, 'Sala 4'),
(14, 83030030, 'Estrada dos Pinheiros', 'Recanto das Árvores', '500', 16, 2, 'Loja 5'),
(77, 77777777, 'Rua Norte Francisco', 'Boa Visita', '77', 11, 4, '4Ap');

-- --------------------------------------------------------

--
-- Estrutura para tabela `municipio`
--

CREATE TABLE `municipio` (
  `id_municipio` int(11) NOT NULL,
  `nome_municipio` varchar(100) NOT NULL,
  `id_uf` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `municipio` (`id_municipio`, `nome_municipio`, `id_uf`) VALUES
(10, 'Campinas', 1),
(11, 'Colombo', 4),
(12, 'Paraná', 4),
(13, 'Foz do Iguaçu', 4),
(14, 'Ivaiporã', 4),
(15, 'Curitiba', 4),
(16, 'São Paulo', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `orgao`
--

CREATE TABLE `orgao` (
  `id_orgao` int(10) NOT NULL,
  `nome_orgao` varchar(100) NOT NULL,
  `url` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `orgao` (`id_orgao`, `nome_orgao`, `url`) VALUES
(0, ' ', ' '),
(1, 'Casa Civil', 'https://www.gov.br/casacivil/pt-br'),
(2, '\nMinistério da Agricultura e Pecuária', 'https://www.gov.br/agricultura/pt-br'),
(3, '\nMinistério das Comunicações', 'https://www.gov.br/mcom/pt-br'),
(4, 'Ministério da Cultura', 'https://www.gov.br/cultura/pt-br'),
(5, '\nMinistério da Ciência, Tecnologia e Inovação', 'https://www.gov.br/mcti/pt-br');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `id_pessoa` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone_pessoal` varchar(100) NOT NULL,
  `telefone_comercial` varchar(100) NOT NULL,
  `codigo_cep` varchar(10) NOT NULL,
  `nome_orgao` varchar(25) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `endereco` varchar(50) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `complemento` varchar(50) NOT NULL,
  `bairro` varchar(25) NOT NULL,
  `nome_uf` varchar(25) NOT NULL,
  `nome_municipio` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pessoa`
--

INSERT INTO `pessoa` (`id_pessoa`, `nome`, `cargo`, `email`, `telefone_pessoal`, `telefone_comercial`, `codigo_cep`, `nome_orgao`, `url`, `endereco`, `numero`, `complemento`, `bairro`, `nome_uf`, `nome_municipio`) VALUES
(286, 'Ana Silva', 'Gerente de Vendas', 'ana.silva@example.com', '11987654321', '1134567890', '01001-000', '1', 'https://www.desenvolvimentosocial.pr.gov.br/', 'Rua A', '123', 'Apt 101', 'Centro', 'SP', 'São Paulo'),
(287, 'Bruno Souza', 'Analista de TI', 'bruno.souza@example.com', '11987654322', '1134567891', '02002-000', '2', 'https://www.seic.pr.gov.br/', 'Rua B', '456', 'Sala 202', 'Vila Nova', 'RJ', 'Rio de Janeiro'),
(288, 'Carla Ferreira', 'Coordenadora de RH', 'carla.ferreira@example.com', '11987654323', '1134567892', '03003-000', '3', 'https://www.sedest.pr.gov.br/', 'Rua C', '789', 'Casa 303', 'Bela Vista', 'MG', 'Belo Horizonte'),
(289, 'Daniel Oliveira', 'Diretor Financeiro', 'daniel.oliveira@example.com', '11987654324', '1134567893', '04004-000', '4', 'https://www.fazenda.pr.gov.br/', 'Rua D', '101', 'Conj 404', 'Jardins', 'RS', 'Porto Alegre'),
(290, 'José Rapazi Comunit', 'Supervisora de Marketing', 'elisa.costa@example.com', '11987654325', '1134567894', '05005-000', '5', 'https://www.vicegovernadoria.pr.gov.br/', 'Rua E', '202', 'Bloco B', 'Centro', 'PR', 'Curitiba'),
(315, 'Daniel Oliveira', 'Diretor Financeiro', 'daniel.oliveira@example.com', '11987654324', '1134567893', '04004-000', '', 'https://www.fazenda.pr.gov.br/', 'Rua D', '101', 'Conj 404', 'Jardins', 'RS', 'Porto Alegre');

-- --------------------------------------------------------

--
-- Estrutura para tabela `uf`
--

CREATE TABLE `uf` (
  `id_uf` int(11) NOT NULL,
  `nome_uf` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `uf`
--

INSERT INTO `uf` (`id_uf`, `nome_uf`) VALUES
(1, 'São Paulo'),
(2, 'Rio de Janeiro'),
(3, 'Minas Gerais'),
(4, 'Paraná');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cep`
--
ALTER TABLE `cep`
  ADD PRIMARY KEY (`id_cep`),
  ADD KEY `id_municipio` (`id_municipio`),
  ADD KEY `fk_cep_uf` (`id_uf`);

--
-- Índices de tabela `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`id_municipio`,`id_uf`),
  ADD KEY `id_uf` (`id_uf`);

--
-- Índices de tabela `orgao`
--
ALTER TABLE `orgao`
  ADD PRIMARY KEY (`id_orgao`);

--
-- Índices de tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`id_pessoa`);

--
-- Índices de tabela `uf`
--
ALTER TABLE `uf`
  ADD PRIMARY KEY (`id_uf`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id_pessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=316;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `cep`
--
ALTER TABLE `cep`
  ADD CONSTRAINT `cep_ibfk_1` FOREIGN KEY (`id_municipio`) REFERENCES `municipio` (`id_municipio`),
  ADD CONSTRAINT `fk_cep_uf` FOREIGN KEY (`id_uf`) REFERENCES `uf` (`id_uf`);

--
-- Restrições para tabelas `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `municipio_ibfk_1` FOREIGN KEY (`id_uf`) REFERENCES `uf` (`id_uf`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


update 'nome_orgao' where