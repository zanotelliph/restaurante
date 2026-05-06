 -- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;

/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para restaurante
CREATE DATABASE IF NOT EXISTS `restaurante` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `restaurante`;

-- Copiando estrutura para tabela restaurante.bebidas
CREATE TABLE IF NOT EXISTS `bebidas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preco` decimal(8,2) NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `estoque` int NOT NULL DEFAULT '0',
  `imagem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoria_bebida_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela restaurante.bebidas: ~9 rows (aproximadamente)
INSERT INTO `bebidas` (`id`, `nome`, `preco`, `descricao`, `estoque`, `imagem`, `categoria_bebida_id`, `created_at`, `updated_at`) VALUES
	(2, 'Suco de Goiaba', 21.38, 'Suco rosa naturalmente doce', 51, NULL, 8, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(3, 'Chá de Camomila', 3.71, 'Chá morno e relaxante', 29, NULL, 2, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(4, 'Cerveja Brahma', 6.27, 'Cerveja clássica e refrescante', 93, NULL, 4, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(5, 'Caipirinha de Limão', 6.68, 'Coquetel clássico com cana', 61, NULL, 1, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(6, 'Café Coado', 2.50, 'Café coado fresquinho', 23, NULL, 3, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(7, 'Água Mineral', 7.44, 'Água pura e mineral gelada', 80, NULL, 4, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(8, 'Guaraná Jesus', 6.00, 'Guaraná tradicional e delicioso', 85, NULL, 4, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(9, 'Café Coado', 7.49, 'Café coado fresquinho', 85, NULL, 6, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(10, 'Suco de Abacaxi', 8.07, 'Suco tropical refrescante', 34, NULL, 7, '2026-03-31 19:57:05', '2026-03-31 19:57:05');

-- Copiando estrutura para tabela restaurante.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela restaurante.cache: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela restaurante.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela restaurante.cache_locks: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela restaurante.categorias_bebidas
CREATE TABLE IF NOT EXISTS `categorias_bebidas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela restaurante.categorias_bebidas: ~8 rows (aproximadamente)
INSERT INTO `categorias_bebidas` (`id`, `nome`, `descricao`, `ativo`, `created_at`, `updated_at`) VALUES
	(1, 'Refrigerante', 'Bebidas carbonatadas e refrescantes', 1, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(2, 'Suco', 'Sucos naturais e industrializados', 1, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(3, 'Café', 'Cafés quentes e gelados', 1, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(4, 'Chá', 'Chás de diversos sabores', 1, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(5, 'Vinho', 'Vinhos tintos, brancos e rosés', 1, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(6, 'Cerveja', 'Cervejas artesanais e comerciais', 1, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(7, 'Coquetel', 'Drinks e coquetéis especiais', 1, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(8, 'Água', 'Águas minerais e com gás', 1, '2026-03-31 19:57:05', '2026-03-31 19:57:05');

-- Copiando estrutura para tabela restaurante.categorias_pratos
CREATE TABLE IF NOT EXISTS `categorias_pratos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela restaurante.categorias_pratos: ~5 rows (aproximadamente)
INSERT INTO `categorias_pratos` (`id`, `nome`, `descricao`, `ativo`, `created_at`, `updated_at`) VALUES
	(1, 'Entrada', 'Pratos para começar', 1, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(2, 'Prato Principal', 'Pratos principais', 1, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(3, 'Acompanhamento', 'Acompanhamentos', 1, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(4, 'Sobremesa', 'Doces e sobremesas', 1, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(5, 'Especial do Dia', 'Pratos especiais', 1, '2026-03-31 19:57:05', '2026-03-31 19:57:05');

-- Copiando estrutura para tabela restaurante.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clientes_email_unique` (`email`),
  UNIQUE KEY `clientes_cpf_unique` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela restaurante.clientes: ~5 rows (aproximadamente)
INSERT INTO `clientes` (`id`, `nome`, `email`, `telefone`, `cpf`, `endereco`, `imagem`, `created_at`, `updated_at`) VALUES
	(1, 'Maria Santos', 'maria.santos810@gmail.com', '(11) 95322-3052', '754.005.787-23', 'Avenida Paulista, São Paulo - SP', NULL, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(2, 'Matheus Araujo', 'matheus.araujo475@yahoo.com', '(11) 93705-9689', '417.342.130-86', 'Avenida Paulista, São Paulo - SP', NULL, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(3, 'Francisca Alves', 'francisca.alves721@gmail.com', '(11) 99735-8043', '557.093.188-22', 'Avenida Paulista, São Paulo - SP', NULL, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(4, 'Roberto Gomes', 'roberto.gomes18@yahoo.com', '(11) 98614-8060', '138.667.882-43', 'Rua Barão de Aracati, Fortaleza - CE', NULL, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(5, 'Lúcia Ferreira', 'lúcia.ferreira260@yahoo.com', '(11) 99506-6642', '000.026.027-32', 'Avenida Paulista, São Paulo - SP', NULL, '2026-03-31 19:57:05', '2026-03-31 19:57:05');

-- Copiando estrutura para tabela restaurante.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela restaurante.failed_jobs: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela restaurante.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela restaurante.jobs: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela restaurante.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela restaurante.job_batches: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela restaurante.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela restaurante.migrations: ~0 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_03_04_134202_create_tarefas_table', 1),
	(5, '2026_03_11_014225_create_pratos_table', 1),
	(6, '2026_03_11_014238_create_clientes_table', 1),
	(7, '2026_03_20_000003_create_bebidas_table', 1),
	(8, '2026_03_20_000005_create_pedidos_table', 1),
	(9, '2026_03_20_174026_create_categorias_pratos_table', 1),
	(10, '2026_03_20_174039_create_categorias_bebidas_table', 1);

-- Copiando estrutura para tabela restaurante.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela restaurante.password_reset_tokens: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela restaurante.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cliente_id` bigint unsigned NOT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendente',
  `observacoes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pedidos_cliente_id_foreign` (`cliente_id`),
  CONSTRAINT `pedidos_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela restaurante.pedidos: ~10 rows (aproximadamente)
INSERT INTO `pedidos` (`id`, `cliente_id`, `total`, `status`, `observacoes`, `created_at`, `updated_at`) VALUES
	(1, 4, 91.75, 'pronto', 'Voluptatem aperiam temporibus doloribus et deserunt.', '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(2, 2, 186.37, 'entregue', NULL, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(3, 1, 29.39, 'pronto', NULL, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(4, 1, 122.95, 'pronto', NULL, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(5, 1, 6.00, 'entregue', NULL, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(6, 4, 389.58, 'preparando', NULL, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(7, 2, 250.37, 'pronto', NULL, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(8, 2, 219.93, 'pronto', 'Ullam ut architecto dolorem rerum quos voluptatem.', '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(9, 1, 127.23, 'preparando', 'Similique sed quia porro delectus ipsam.', '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(10, 5, 21.90, 'entregue', NULL, '2026-03-31 19:57:05', '2026-03-31 19:57:05');

-- Copiando estrutura para tabela restaurante.pedido_itens
CREATE TABLE IF NOT EXISTS `pedido_itens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pedido_id` bigint unsigned NOT NULL,
  `prato_id` bigint unsigned DEFAULT NULL,
  `bebida_id` bigint unsigned DEFAULT NULL,
  `quantidade` int NOT NULL,
  `preco_unitario` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pedido_itens_pedido_id_foreign` (`pedido_id`),
  KEY `pedido_itens_prato_id_foreign` (`prato_id`),
  KEY `pedido_itens_bebida_id_foreign` (`bebida_id`),
  CONSTRAINT `pedido_itens_bebida_id_foreign` FOREIGN KEY (`bebida_id`) REFERENCES `bebidas` (`id`) ON DELETE SET NULL,
  CONSTRAINT `pedido_itens_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pedido_itens_prato_id_foreign` FOREIGN KEY (`prato_id`) REFERENCES `pratos` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela restaurante.pedido_itens: ~28 rows (aproximadamente)
INSERT INTO `pedido_itens` (`id`, `pedido_id`, `prato_id`, `bebida_id`, `quantidade`, `preco_unitario`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, 5, 2, 6.68, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(2, 1, 2, NULL, 1, 61.10, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(3, 1, 6, NULL, 1, 17.29, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(4, 2, NULL, 10, 3, 8.07, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(5, 2, NULL, 4, 1, 6.27, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(6, 2, NULL, 5, 2, 6.68, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(7, 2, 8, NULL, 3, 47.51, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(8, 3, NULL, 9, 1, 7.49, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(9, 3, NULL, NULL, 2, 10.95, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(10, 4, 9, NULL, 1, 42.65, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(11, 4, 2, NULL, 1, 61.10, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(12, 4, NULL, 3, 3, 3.71, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(13, 4, NULL, 10, 1, 8.07, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(14, 5, NULL, 8, 1, 6.00, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(15, 6, NULL, 3, 2, 3.71, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(16, 6, 4, NULL, 3, 64.53, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(17, 6, NULL, 9, 1, 7.49, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(18, 6, 7, NULL, 2, 70.85, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(19, 6, 3, NULL, 2, 19.69, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(20, 7, NULL, 9, 1, 7.49, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(21, 7, NULL, 7, 1, 7.44, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(22, 7, 1, NULL, 3, 78.48, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(23, 8, 5, NULL, 3, 73.31, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(24, 9, 9, NULL, 1, 42.65, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(25, 9, NULL, 4, 1, 6.27, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(26, 9, 5, NULL, 1, 73.31, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(27, 9, NULL, 6, 2, 2.50, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(28, 10, NULL, NULL, 2, 10.95, '2026-03-31 19:57:05', '2026-03-31 19:57:05');

-- Copiando estrutura para tabela restaurante.pratos
CREATE TABLE IF NOT EXISTS `pratos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preco` decimal(8,2) NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `estoque` int NOT NULL DEFAULT '0',
  `imagem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoria_prato_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela restaurante.pratos: ~10 rows (aproximadamente)
INSERT INTO `pratos` (`id`, `nome`, `preco`, `descricao`, `estoque`, `imagem`, `categoria_prato_id`, `created_at`, `updated_at`) VALUES
	(1, 'Acarajé', 78.48, 'Bolinha de massa de feijão frita recheada com camarão', 92, NULL, 5, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(2, 'Acarajé', 61.10, 'Bolinha de massa de feijão frita recheada com camarão', 49, NULL, 5, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(3, 'Bolinho de Chuva', 19.69, 'Acompanhamento crocante e macio', 50, NULL, 5, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(4, 'Lasanha Bolonhesa', 64.53, 'Massa fresca com molho caseiro', 89, NULL, 4, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(5, 'Bacalhau à Brás', 73.31, 'Clássico português com batata palha', 68, NULL, 1, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(6, 'Risoto de Cogumelos', 17.29, 'Arroz cremoso com cogumelos frescos', 87, NULL, 5, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(7, 'Frango com Quiabo', 70.85, 'Frango tenro em molho com quiabo macio', 41, NULL, 4, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(8, 'Vatapá', 47.51, 'Caldo de peixe com farinha de mandioca e amendoim', 86, NULL, 1, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(9, 'Vatapá', 42.65, 'Caldo de peixe com farinha de mandioca e amendoim', 95, NULL, 4, '2026-03-31 19:57:05', '2026-03-31 19:57:05'),
	(10, 'Frango com Quiabo', 74.35, 'Frango tenro em molho com quiabo macio', 66, NULL, 5, '2026-03-31 19:57:05', '2026-03-31 19:57:05');

-- Copiando estrutura para tabela restaurante.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela restaurante.sessions: ~3 rows (aproximadamente)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('7zInBW4defvBReX8GmHK6GkVuPcfmpnGGsybCFn7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 OPR/128.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUnc4MGVnb041eWVPendLSGdXcTM1bnRLV1R2bGhSYTRRaDZxU2VwOSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9lc3RvcXVlIjtzOjU6InJvdXRlIjtzOjEzOiJlc3RvcXVlLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1775069469),
	('ja3Dp4WGVhDFs1HOgD8XqnIVfgNOZHa0b9PRUzVo', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 OPR/128.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOXpySDVQWXBkY3FNVXo1ZEprSGJ0UkQyMEJWSWNFMHBtTU5LbFNseSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9lc3RvcXVlIjtzOjU6InJvdXRlIjtzOjEzOiJlc3RvcXVlLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1775070430),
	('qlEhTRstbcS6Kw7h2JQaPAR1cKO2YviwOIKHZqVd', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 OPR/128.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieXNTWXJJblYwVDRhQ2JrNk5GRjRCSnhEUUNsWW5KbUYzV2hHMm5XaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1775069469);

-- Copiando estrutura para tabela restaurante.tarefas
CREATE TABLE IF NOT EXISTS `tarefas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela restaurante.tarefas: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela restaurante.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela restaurante.users: ~0 rows (aproximadamente)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Test User', 'test@example.com', '2026-03-31 19:57:05', '$2y$12$2q.2mpAaUjrmlaPQ2g1XVOuIxVRNSgClGmo0DpSSEiTArd1m0d1qS', '7yoBkpUFOg', '2026-03-31 19:57:05', '2026-03-31 19:57:05');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
