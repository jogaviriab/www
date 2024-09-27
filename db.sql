CREATE TABLE escuderia(
  codigo INT PRIMARY KEY,
  nombre VARCHAR(30) NOT NULL,
  paisOrigen VARCHAR(20) NOT NULL,
  sede VARCHAR(20) NOT NULL,
  presupuestoAnual INT NOT NULL,
  motorista INT REFERENCES escuderia(codigo)
);


CREATE TABLE piloto(
    numPiloto INT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL,
    fechaNacimiento DATE NOT NULL,
    nacionalidad VARCHAR(20) NOT NULL,
    estiloCond VARCHAR(11) NOT NULL CHECK (estiloCond IN ('Agresivo', 'Conservador')),
    alias VARCHAR(20) NOT NULL,
    escuderia INT NOT NULL REFERENCES escuderia(codigo),
    salario INT NOT NULL CHECK (salario > 0)
);


CREATE TABLE prueba (
  codigo INT PRIMARY KEY,
  distancia INT NOT NULL,
  fecha DATE NOT NULL,
  realizadaPor INT NOT NULL REFERENCES piloto(numPiloto),
  analizadaPor INT REFERENCES piloto(numPiloto)
);