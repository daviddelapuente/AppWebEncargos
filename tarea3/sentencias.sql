-- Encargos
-- Insertar una nueva
INSERT INTO encargo (descripcion, origen, destino, espacio, kilos, foto, email_encargador, celuar_encargador) VALUES (?,?,?,?,?,?,?,?)

-- obtener los 5 primeros encargos
SELECT id, descripcion, origen, destino, espacio, kilos, foto, email_encargador, celuar_encargador FROM encargo ORDER BY id DESC LIMIT 5
-- obtener los siguientes 5
SELECT id, descripcion, origen, destino, espacio, kilos, foto, email_encargador, celuar_encargador FROM encargo ORDER BY id DESC LIMIT 5, 5
-- obtener información de un encargo por ID
SELECT id, descripcion, origen, destino, espacio, kilos, foto, email_encargador, celuar_encargador FROM encargo WHERE id=?

-- Encargos
-- Insertar viaje asociada a un encargo
INSERT INTO viaje (fecha_ida, fecha_regreso, origen, destino, kilos_disponible, espacio_disponible, email_viajero, celular_viajero) VALUES (?,?,?,?,?,?,?,?)
-- informacion de 1 viaje
SELECT id, fecha_ida, fecha_regreso, origen, destino, kilos_disponible, espacio_disponible, email_viajero, celular_viajero FROM viaje WHERE id=?

