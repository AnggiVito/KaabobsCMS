/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100428 (10.4.28-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : db_base_code

 Target Server Type    : MySQL
 Target Server Version : 100428 (10.4.28-MariaDB)
 File Encoding         : 65001

 Date: 16/05/2025 07:34:51
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_menu
-- ----------------------------
DROP TABLE IF EXISTS `tbl_menu`;
CREATE TABLE `tbl_menu`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `menu_label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `urutan` int NULL DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` enum('INACTIVE','ACTIVE','HIST','CLOSE') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_menu
-- ----------------------------
INSERT INTO `tbl_menu` VALUES (1, 'Dashboard', 1, 'nav-icon fas fa-tachometer-alt', 'ACTIVE', '2024-06-06 21:20:17', '2024-06-06 21:20:20');
INSERT INTO `tbl_menu` VALUES (2, 'Pegawai', 2, 'nav-icon fas fa-users', 'ACTIVE', '2024-06-23 22:37:16', '2024-06-23 22:37:19');

-- ----------------------------
-- Table structure for tbl_menu_role_mapping
-- ----------------------------
DROP TABLE IF EXISTS `tbl_menu_role_mapping`;
CREATE TABLE `tbl_menu_role_mapping`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_menu` int NOT NULL,
  `id_sub_menu` int NOT NULL,
  `code_role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `action` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('INACTIVE','ACTIVE','HIST','CLOSE') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'ACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_menu_role_mapping
-- ----------------------------
INSERT INTO `tbl_menu_role_mapping` VALUES (1, 1, 1, 'SUPERADMIN', 'c,r,u,d,a', 'ACTIVE', '2024-06-06 21:01:22', '2024-06-06 21:01:25');
INSERT INTO `tbl_menu_role_mapping` VALUES (2, 2, 2, 'SUPERADMIN', 'c,r,u,d,a', 'ACTIVE', '2024-06-06 21:01:22', '2024-06-06 21:01:25');

-- ----------------------------
-- Table structure for tbl_menu_sub
-- ----------------------------
DROP TABLE IF EXISTS `tbl_menu_sub`;
CREATE TABLE `tbl_menu_sub`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_menu` int NOT NULL,
  `sub_menu_label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('INACTIVE','ACTIVE','HIST','CLOSE') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_menu_sub
-- ----------------------------
INSERT INTO `tbl_menu_sub` VALUES (1, 1, 'Grafik performa bisnis', '/dashboard/grafikPerformaBisnis', 'ACTIVE', '2024-06-06 20:42:34', '2024-06-06 20:42:36');
INSERT INTO `tbl_menu_sub` VALUES (2, 2, 'Daftar Pegawai', '/pegawai/daftarPegawai', 'ACTIVE', '2024-06-06 20:42:34', '2024-06-06 20:42:36');

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nip` int(5) UNSIGNED ZEROFILL NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('STAFF','ADMIN','SUPERADMIN') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `jenis_kelamin` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'L',
  `tempat_lahir` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_lahir` date NULL DEFAULT NULL,
  `alamat` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_telpon` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_bergabung` date NULL DEFAULT NULL,
  `tanggal_berakhir` date NULL DEFAULT NULL,
  `departemen` enum('PEMASARAN','PENGADAAN','IT') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'PEMASARAN',
  `status_pekerjaan` enum('KONTRAK','PERMANEN') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status_register_finger` enum('FALSE','TRUE') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT 'FALSE',
  `status` enum('INACTIVE','ACTIVE','CLOSE','HIST') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'INACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `tbl_kasir_username_unique`(`username` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES (1, 10001, 'admin', '$2y$10$9Xj2Whag.NryHN7.xTGAJe7CK4vOwRiEZlsZ9a/oXviN.6e4P3P7C', 'SUPERADMIN', 'Admin', 'L', NULL, NULL, NULL, NULL, NULL, NULL, 'IT', 'PERMANEN', NULL, 'TRUE', 'ACTIVE', '2023-12-20 22:10:55', '2023-12-20 22:10:55');

SET FOREIGN_KEY_CHECKS = 1;
