USE senatimat;

DELIMITER $$
CREATE PROCEDURE spu_estudiantes_listar()
BEGIN

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


UPDATE estudiantes
	SET fotografia = NULL
	WHERE fotografia = 'unafoto.jpg' OR
			fotografia='';
			
		
CALL spu_estudiantes_listar();

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





-- PROCEDIMIENTO SDE LA TAREA

DELIMITER $$
CREATE PROCEDURE spu_colaboradores_listar()
BEGIN
			SELECT COL.idcolaborador,
						COL.apellidos , COL.nombres,
						CARG.cargo , SED.sede,
						COL.tipocontrato,
						COL.telefono,
						COL.direccion,
						COL.cv
				FROM colaboradores COL
				INNER JOIN cargos CARG ON CARG.idcargo = COL.idcargo
				INNER JOIN sedes SED ON SED.idsede = COL.idsede
				WHERE COL.estado= '1';	
END$$



CALL spu_colaboradores_listar()


-- REGISTRAR
DELIMITER $$
CREATE PROCEDURE spu_colaboradores_registrar
(
	IN _apellidos 				VARCHAR(40),
	IN _nombres 				VARCHAR(40),
	IN _idcargo 				INT,
	IN _idsede 					INT,
	IN _tipocontrato 			CHAR(1),
	IN _telefono 				CHAR(9),
	IN _direccion 				VARCHAR (50),
	IN _cv 						VARCHAR (100)
)
BEGIN

	-- VALIDAMOS EL CONTENIDO 	
	IF _cv = '' THEN
		SET _cv = NULL;
	END  IF;

INSERT INTO colaboradores
	(apellidos,nombres,idcargo,idsede,tipocontrato,telefono,direccion,cv) VALUES
	(_apellidos,_nombres,_idcargo,_idsede,_tipocontrato,_telefono,_direccion,_cv);
END $$

CALL spu_colaboradores_registrar('Manzanita Morada','Azul',1,3,'P','992932132','Av. Sol Caliente ','');


CALL spu_colaboradores_listar()



-- ELIMINAR 

DELIMITER $$
CREATE PROCEDURE spu_colaborador_eliminar(
	_idcolaborador INT 
)
BEGIN
	DELETE FROM colaboradores WHERE idcolaborador = _idcolaborador;
END$$

CALL spu_colaborador_eliminar(2)
CALL spu_colaboradores_listar()










