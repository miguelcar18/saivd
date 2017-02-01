ALTER TABLE `saivd`.`estadisticas` 
CHANGE COLUMN `fecha` `fecha` DATETIME NULL DEFAULT NULL;
ALTER TABLE `saivd`.`estadisticas` 
CHANGE COLUMN `idestadisticas` `idestadistica` INT(11) NOT NULL AUTO_INCREMENT ,
CHANGE COLUMN `usuarios` `usuario` INT(11) NOT NULL ,
CHANGE COLUMN `modulos` `modulo` INT(11) NOT NULL ,
CHANGE COLUMN `departamentos` `departamento` INT(11) NOT NULL ,
CHANGE COLUMN `Resultado` `resultado` INT(11) NOT NULL;
