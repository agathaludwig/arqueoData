<?php

$query = "CREATE TABLE IF NOT EXISTS `arqueoData`.`tipoDeArtefato` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `tipo` VARCHAR(40) NULL,
    `ordem` INT NULL)
  ENGINE = InnoDB";
$enviado = $conexao->query($query) or exit($conexao->error);
//echo "<p> tabela tipodeartefato criada </p>";

$query = "CREATE TABLE IF NOT EXISTS `arqueoData`.`inclinacao` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `inclinacao` VARCHAR(40) NULL,
    `ordem` INT NULL)
    ENGINE = InnoDB";
$enviado = $conexao->query($query) or exit($conexao->error);
//echo "<p> tabela inclinacao criada </p>";

$query = "CREATE TABLE IF NOT EXISTS `arqueoData`.`porcentagemTemp` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `porcentagem` VARCHAR(40) NULL,
  `ordem` INT NULL)
ENGINE = InnoDB";
$enviado = $conexao->query($query) or exit($conexao->error);
//echo "<p> tabela porcentagemTemp criada </p>";

$query = "CREATE TABLE IF NOT EXISTS `arqueoData`.`distribuicaoTemp` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `distribuicao` VARCHAR(40) NULL,
  `ordem` INT NULL)
ENGINE = InnoDB";
$enviado = $conexao->query($query) or exit($conexao->error);
//echo "<p> tabela distribuicaoTemp criada </p>";

$query = "CREATE TABLE IF NOT EXISTS `arqueoData`.`tipoQueima` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `tipo` VARCHAR(40) NULL,
  `ordem` INT NULL)
ENGINE = InnoDB";
$enviado = $conexao->query($query) or exit($conexao->error);
//echo "<p> tabela tipoQueima criada </p>";

$query = "CREATE TABLE IF NOT EXISTS `arqueoData`.`analise` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `numFrag` INT NULL,
    `idTipo` INT NULL,
    `espMin` INT NULL,
    `espMax` INT NULL,
    `espBorda` INT NULL,
    `peso` DECIMAL(8,3) NULL,
    `diametro` INT NULL,
    `idInclinacao` INT NULL,
    `idPorcentagemTemp` INT NULL,
    `idDistribuicaoTemp` INT NULL,
    `idTipoQueima` INT NULL,
    `porcentagemQueima` DECIMAL(6,3) NULL,
    CONSTRAINT `fk_analise_tipoDeArtefato`
    FOREIGN KEY (`idTipo`)
    REFERENCES `arqueoData`.`tipoDeArtefato` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_analise_inclinacao1`
    FOREIGN KEY (`idInclinacao`)
    REFERENCES `arqueoData`.`inclinacao` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_analise_porcentagemTemp1`
    FOREIGN KEY (`idPorcentagemTemp`)
    REFERENCES `arqueoData`.`porcentagemTemp` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_analise_distribuicaoTemp1`
    FOREIGN KEY (`idDistribuicaoTemp`)
    REFERENCES `arqueoData`.`distribuicaoTemp` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_analise_tipoQueima1`
    FOREIGN KEY (`idTipoQueima`)
    REFERENCES `arqueoData`.`tipoQueima` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB";
$enviado = $conexao->query($query) or exit($conexao->error);
//echo "<p> tabela analise criada </p>";

$query = "CREATE TABLE IF NOT EXISTS `arqueoData`.`categoria` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `categoria` VARCHAR(40) NULL,
    `ordem` INT NULL)
  ENGINE = InnoDB";
$enviado = $conexao->query($query) or exit($conexao->error);
//echo "<p> tabela categoria criada </p>";

$query = "CREATE TABLE IF NOT EXISTS `arqueoData`.`analiseCategoria` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `idAnalise` INT NOT NULL,
  `idCategoria` INT NOT NULL,
  CONSTRAINT `fk_table1_analise1`
    FOREIGN KEY (`idAnalise`)
    REFERENCES `arqueoData`.`analise` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_table1_categoria1`
    FOREIGN KEY (`idCategoria`)
    REFERENCES `arqueoData`.`categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB";
$enviado = $conexao->query($query) or exit($conexao->error);
//echo "<p> tabela analiseCategoria criada </p>";

$query = "CREATE TABLE IF NOT EXISTS `arqueoData`.`manufatura` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `manufatura` VARCHAR(40) NULL,
    `ordem` INT NULL)
  ENGINE = InnoDB";
$enviado = $conexao->query($query) or exit($conexao->error);
//echo "<p> tabela manufatura criada </p>";

$query = "CREATE TABLE IF NOT EXISTS `arqueoData`.`analiseManufatura` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `idAnalise` INT NOT NULL,
  `idManufatura` INT NOT NULL,
  INDEX `fk_analiseManufatura_analise1_idx` (`idAnalise` ASC),
  INDEX `fk_analiseManufatura_manufatura1_idx` (`idManufatura` ASC),
  CONSTRAINT `fk_analiseManufatura_analise1`
    FOREIGN KEY (`idAnalise`)
    REFERENCES `arqueoData`.`analise` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_analiseManufatura_manufatura1`
    FOREIGN KEY (`idManufatura`)
    REFERENCES `arqueoData`.`manufatura` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB";
$enviado = $conexao->query($query) or exit($conexao->error);
//echo "<p> tabela analiseManufatura criada </p>";

$query = "CREATE TABLE IF NOT EXISTS `arqueoData`.`tempero` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `tempero` VARCHAR(40) NULL,
    `ordem` INT NULL)
  ENGINE = InnoDB";
$enviado = $conexao->query($query) or exit($conexao->error);
//echo "<p> tabela tempero criada </p>";

$query = "CREATE TABLE IF NOT EXISTS `arqueoData`.`analiseTempero` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `idAnalise` INT NOT NULL,
  `idTempero` INT NOT NULL,
  INDEX `fk_analiseTempero_analise1_idx` (`idAnalise` ASC),
  INDEX `fk_analiseTempero_tempero1_idx` (`idTempero` ASC),
  CONSTRAINT `fk_analiseTempero_analise1`
    FOREIGN KEY (`idAnalise`)
    REFERENCES `arqueoData`.`analise` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_analiseTempero_tempero1`
    FOREIGN KEY (`idTempero`)
    REFERENCES `arqueoData`.`tempero` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB";
$enviado = $conexao->query($query) or exit($conexao->error);
//echo "<p> tabela analiseTempero criada </p>";

// INSERTS ANOMALIAS

$query = "SELECT * FROM inclinacao";
$enviado = $conexao->query($query) or exit($conexao->error);
$row = $enviado->fetch_array();

if (empty($row)) {
	$query = "INSERT INTO `arqueoData`.`inclinacao` (`id`, `inclinacao`, `ordem`) VALUES
      (default, 'Muito fechada: 0 a 45°', 1),
      (default, 'Fechada: 46° a 89°', 2),
      (default, 'Reta: 90°', 3),
      (default, 'Aberta: 91 a 135°', 4),
      (default, 'Muito aberta: 136° a 180°', 5),
      (default, 'Não identificado', 6)";
	$enviado = $conexao->query($query) or exit($conexao->error);
}

$query = "SELECT * FROM tipoDeArtefato";
$enviado = $conexao->query($query) or exit($conexao->error);
$row = $enviado->fetch_array();

if (empty($row)) {
	$query = "INSERT INTO `arqueoData`.`tipoDeArtefato` (`id`, `tipo`, `ordem`) VALUES
      (default, 'Vasilha', 1),
      (default, 'Bolota', 2),
      (default, 'Rolete', 3),
      (default, 'Adorno', 4),
      (default, 'Roda de fuso', 5),
      (default, 'Cachimbo', 6),
      (default, 'Aplique', 7),
      (default, 'Outro', 8)";
	$enviado = $conexao->query($query) or exit($conexao->error);
}

$query = "SELECT * FROM categoria";
$enviado = $conexao->query($query) or exit($conexao->error);
$row = $enviado->fetch_array();

if (empty($row)) {
	$query = "INSERT INTO `arqueoData`.`categoria` (`id`, `categoria`, `ordem`)  VALUES
      (default, 'Lábio', 1),
      (default, 'Borda', 2),
      (default, 'Pescoço/Gargalo', 3),
      (default, 'Bojo Superior', 4),
      (default, 'Bojo Inferior', 6),
      (default, 'Carena', 7),
      (default, 'Rolete', 12),
      (default, 'Base', 11),
      (default, 'Ombro', 10),
      (default, 'Aplique', 13),
      (default, 'Asa', 14),
      (default, 'Alça', 15),
      (default, 'Vasilha Inteira', 19),
      (default, 'Perfil Superior', 17),
      (default, 'Perfil Inferior', 18),
      (default, 'Flange', 16),
      (default, 'Carena Interna (Invertida)', 8),
      (default, 'Inflexão', 9),
      (default, 'Não identificado', 20),
      (default, 'Bojo', 5)";
	$enviado = $conexao->query($query) or exit($conexao->error);
}

$query = "SELECT * FROM manufatura";
$enviado = $conexao->query($query) or exit($conexao->error);
$row = $enviado->fetch_array();

if (empty($row)) {
	$query = "INSERT INTO `arqueoData`.`manufatura` (`id`, `manufatura`, `ordem`) VALUES
      (DEFAULT, 'Acordelado', 1),
      (DEFAULT, 'Modelado', 2),
      (DEFAULT, 'Placa', 3),
      (DEFAULT, 'Não identificado', 4)";
	$enviado = $conexao->query($query) or exit($conexao->error);
}

$query = "SELECT * FROM tempero";
$enviado = $conexao->query($query) or exit($conexao->error);
$row = $enviado->fetch_array();

if (empty($row)) {
	$query = "INSERT INTO `arqueoData`.`tempero` (`id`, `tempero`, `ordem`) VALUES
      (DEFAULT, 'Quartzo anguloso <2mm', 01),
      (DEFAULT, 'Quartzo anguloso >2mm', 02),
      (DEFAULT, 'Quartzo rolado <2mm', 03),
      (DEFAULT, 'Quartzo rolado >2mm', 04),
      (DEFAULT, 'Quartzo triturado', 05),
      (DEFAULT, 'Mica ponto', 06),
      (DEFAULT, 'Mica placa', 07),
      (DEFAULT, 'Caco moído anguloso <2mm', 08),
      (DEFAULT, 'Caco moído anguloso >2mm', 09),
      (DEFAULT, 'Óxido de ferro rolado <2mm',10),
      (DEFAULT, 'Óxido de ferro rolado >2mm',11),
      (DEFAULT, 'Argila <1mm',12),
      (DEFAULT, 'Argila >1mm',13),
      (DEFAULT, 'Granito <1mm',14),
      (DEFAULT, 'Granito >1mm',15),
      (DEFAULT, 'Feldspato <1mm',16),
      (DEFAULT, 'Feldspato >1mm',17),
      (DEFAULT, 'Cariapé <1mm',18),
      (DEFAULT, 'Cariapé >1mm',19),
      (DEFAULT, 'Carvão',20),
      (DEFAULT, 'Cauixi',21),
      (DEFAULT, 'Minerais silicatos diversos <2mm',22),
      (DEFAULT, 'Minerais silicatos diversos >2mm',23)";

	$enviado = $conexao->query($query) or exit($conexao->error);
}

$query = "SELECT * FROM porcentagemTemp";
$enviado = $conexao->query($query) or exit($conexao->error);
$row = $enviado->fetch_array();

if (empty($row)) {
	$query = "INSERT INTO `arqueoData`.`porcentagemTemp` (`id`, `porcentagem`, `ordem`) VALUES
      (DEFAULT, '5% até 1.0mm', 1),
      (DEFAULT, '5% até 2.0mm', 5),
      (DEFAULT, '5% até 3.0mm', 9),
      (DEFAULT, '10% até 1.0mm', 2),
      (DEFAULT, '10% até 2.0mm', 6),
      (DEFAULT, '10% até 3.0mm', 10),
      (DEFAULT, '20% até 1.0mm', 3),
      (DEFAULT, '20% até 2.0mm', 7),
      (DEFAULT, '20% até 3.0mm', 11),
      (DEFAULT, '30% até 1.0mm', 4),
      (DEFAULT, '30% até 2.0mm', 8),
      (DEFAULT, '30% até 3.0mm', 12)";
	$enviado = $conexao->query($query) or exit($conexao->error);
}

$query = "SELECT * FROM distribuicaoTemp";
$enviado = $conexao->query($query) or exit($conexao->error);
$row = $enviado->fetch_array();

if (empty($row)) {
	$query = "INSERT INTO `arqueoData`.`distribuicaoTemp` (`id`, `distribuicao`, `ordem`) VALUES
      (DEFAULT, 'Homogênea', 1),
      (DEFAULT, 'Intenso em porção', 4),
      (DEFAULT, 'Intenso na FI', 2),
      (DEFAULT, 'Intenso na FE', 3),
      (DEFAULT, 'Intenso no núcleo', 5),
      (DEFAULT, 'Não identificado', 6)";
	$enviado = $conexao->query($query) or exit($conexao->error);
}

$query = "SELECT * FROM tipoQueima";
$enviado = $conexao->query($query) or exit($conexao->error);
$row = $enviado->fetch_array();

if (empty($row)) {
	$query = "INSERT INTO `arqueoData`.`tipoQueima` (`id`, `tipo`, `ordem`) VALUES
      (DEFAULT, 'Completamente oxidado', 1),
      (DEFAULT, 'Redução Face Interna', 10),
      (DEFAULT, 'Núcleo reduzido<50%', 2),
      (DEFAULT, 'Núcleo reduzido entre 50% e 80%', 5),
      (DEFAULT, 'Núcleo reduzido>80%', 8),
      (DEFAULT, 'Núcleo oxidado<50%', 3),
      (DEFAULT, 'Núcleo oxidado entre 50% e 80%', 6),
      (DEFAULT, 'Núcleo oxidado>80%', 9),
      (DEFAULT, 'Oxidação Face Interna', 4),
      (DEFAULT, 'Completamente reduzido', 7),
      (DEFAULT, 'Não identificado', 11)";
	$enviado = $conexao->query($query) or exit($conexao->error);
}
?>
