CREATE PROCEDURE check_lib (IN id INT)
BEGIN
    IF (select cantidad from libro where IdLibro = id ) <= 1 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Libro No Disponible';
    END IF;
END;

CREATE PROCEDURE check_castigo (IN est INT)
BEGIN
    IF (select count(*) from castigo_estudiante where id_estudiante = est AND fecha_fin > CURDATE()) > 0 THEN
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Alumno Castigado';
   END IF;
END;


CREATE TRIGGER `check_prestamo_insert` BEFORE INSERT ON `prestamo`
FOR EACH ROW
BEGIN
    -- Preguntar si el Lector no esta Castigado
        call check_castigo(new.IdLector);
    -- Preguntar si hay disponibilidad del Libro
        call check_lib(new.IdLibro);    
END; 

CREATE TRIGGER `check_prestamo_update` BEFORE UPDATE ON `prestamo`
FOR EACH ROW
BEGIN
    -- Preguntar si el Lector no esta Castigado
        call check_castigo(new.IdLector);
    -- Preguntar si hay disponibilidad del Libro
        call check_lib(new.IdLibro);    
END;


DROP PROCEDURE IF EXISTS pedido;
CREATE PROCEDURE pedido (IN user INTEGER, IN emp INTEGER)
BEGIN   
    START TRANSACTION;
	    insert into order (user,IdLibro,FechaPrestamo) values (lector, lib, CURDATE());
        UPDATE libro
        SET cantidad = (cantidad-1)
        WHERE IdLibro = lib;
    COMMIT;
END;


DROP PROCEDURE IF EXISTS pedido;
CREATE PROCEDURE pedido (IN user INTEGER, )
BEGIN   
    START TRANSACTION;
	    insert into order (user,IdLibro,FechaPrestamo) values (lector, lib, CURDATE());
        UPDATE libro
        SET cantidad = (cantidad-1)
        WHERE IdLibro = lib;
    COMMIT;
END;