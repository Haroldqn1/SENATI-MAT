USE senatimat;

DELIMITER $$
CREATE PROCEDURE spu_estudiantes_listar()
BEGIN
	SELECT * FROM estudiantes;
		
	SELECT 	EST.idestudiante,
				EST.apellidos, EST.nombres,
				EST.tipodocumento, EST.nrodocumento,
				EST.fechanacimiento,
				ESC.escuela,
				CAR.carrera,
				SED.sede,
				EST.fotografia
		FROM estudiantes EST
		INNER JOIN carreras CAR ON CAR.idcarrera = EST.idcarrera
		INNER JOIN sedes SED ON SED.idsede = EST.idsede
		INNER JOIN escuelas ESC ON ESC.idescuela = CAR.idescuela
		WHERE EST.estado = '1';
END $$

DROP PROCEDURE spu_estudiantes_registrar;

DELIMITER $$
CREATE PROCEDURE spu_estudiantes_registrar
(
	IN _apellidos 			VARCHAR(40),
	IN _nombres 			VARCHAR(40),
	IN _tipodocumento		CHAR(1),
	IN _nrodocumento 		CHAR(8),
	IN _fechanacimiento 	DATE,
	IN _idcarrera 			INT,
	IN _idsede 				INT,
	IN _fotografia 		VARCHAR(100)
)
BEGIN
	-- VALIDAR EL CONTENIDO DE _fotografia
	IF _fotografia = '' THEN
		SET _fotografia = NULL;
	END IF;
	
INSERT INTO estudiantes
	(apellidos,nombres,tipodocumento,nrodocumento,fechanacimiento,idcarrera,idsede,fotografia)VALUES
	(_apellidos,_nombres,_tipodocumento,_nrodocumento,_fechanacimiento,_idcarrera,_idsede,_fotografia);	
END $$

CALL spu_estudiantes_registrar('Quispe Napa','Harold','D','12345678','2004-01-16',5,2,'');
CALL spu_estudiantes_registrar('Munayco','Jose','D','77788844','2003-01-10',3,1, NULL);
CALL spu_estudiantes_registrar('Prada','Teresa','c','12345678','2002-01-23',3,1,'');

SELECT * FROM estudiantes;


DELIMITER $$
CREATE PROCEDURE spu_sedes_listar()
BEGIN
	SELECT * FROM sedes ORDER BY 2;
END $$


DELIMITER $$
CREATE PROCEDURE spu_escuelas_listar()
BEGIN
	SELECT * FROM escuelas ORDER BY 2;
END $$

DELIMITER $$
CREATE PROCEDURE spu_carreras_listar(IN _idescuela INT)
BEGIN
	SELECT idcarrera, carrera
	FROM carreras
	WHERE idescuela = _idescuela;
END $$

CALL spu_carreras_listar(3);


CALL spu_sedes_listar();





















