-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Jul-2025 às 17:26
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pokedex_cpv`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `pokemons`
--

CREATE TABLE `pokemons` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `localizacao` varchar(100) DEFAULT NULL,
  `data_registro` date DEFAULT NULL,
  `hp` int(11) DEFAULT NULL,
  `ataque` int(11) DEFAULT NULL,
  `defesa` int(11) DEFAULT NULL,
  `observacoes` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pokemons`
--

INSERT INTO `pokemons` (`id`, `nome`, `tipo`, `localizacao`, `data_registro`, `hp`, `ataque`, `defesa`, `observacoes`, `foto`) VALUES
(1, 'Pikachu', 'Elétrico', 'Resenha', '2025-07-16', 200, 500, 300, 'piakchu', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png'),
(2, 'Charizard', 'Fogo', 'Resenha', '2025-07-16', 800, 900, 240, 'Dragão de fogo', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/6.png'),
(6, 'Charmander', 'Fogo', 'Resenha', '2025-07-09', 200, 150, 100, 'Agressivo', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/4.png'),
(7, 'Charmeleon', 'Fogo', 'Moçota', '2025-07-08', 300, 200, 200, 'Bravo', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/5.png'),
(8, 'Bulbassaur', 'Planta', 'Floresta', '2025-07-08', 100, 50, 90, 'Calmo', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1.png'),
(9, 'Ivyssaur', 'Planta', 'Floresta', '2025-07-08', 180, 150, 200, 'Calmo', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/2.png'),
(10, 'Venussaur', 'Planta', 'Floresta', '2025-07-07', 500, 200, 300, 'Perigoso', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/3.png'),
(11, 'Squirtle', 'Água', 'Lago', '2025-07-15', 100, 70, 100, 'Nada', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/7.png'),
(12, 'Blastoise', 'Água', 'Lago', '2025-07-07', 500, 300, 600, 'Nada', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/9.png');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `pokemons`
--
ALTER TABLE `pokemons`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pokemons`
--
ALTER TABLE `pokemons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
