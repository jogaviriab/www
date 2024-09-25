
CREATE TABLE escuderia(
  codigo INT PRIMARY KEY,
  nombre VARCHAR(20) NOT NULL,
  paisOrigen VARCHAR(20) NOT NULL,
  sede VARCHAR(20) NOT NULL,
  presupuestoAnual INT NOT NULL,
  motorista INT REFERENCES escuderia
);


CREATE TABLE piloto(
    numPiloto INT PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL,
    fechaNacimiento DATE NOT NULL,
    nacionalidad VARCHAR(20) NOT NULL,
    estiloCond VARCHAR(10) NOT NULL CHECK (estiloCond IN ('Agresivo', 'Conservador')),
    alias VARCHAR(20) NOT NULL,
    escuderia INT REFERENCES escuderia,
    salario INT CHECK (salario > 0)
);


CREATE TABLE prueba (
  codigo INT PRIMARY KEY,
  distancia INT NOT NULL,
  fecha DATE NOT NULL,
  realizadaPor INT NOT NULL REFERENCES piloto,
  analizadaPor INT REFERENCES piloto
);