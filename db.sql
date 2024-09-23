
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
    estiloCond VARCHAR(10) NOT NULL ,
    alias VARCHAR(20) NOT NULL,
    escuderia INT,
    salario INT CHECK (salario > 0),
    FOREIGN KEY (escuderia) REFERENCES escuderia(codigo),
    CHECK (estiloCond IN ('Agresivo', 'Conservador'))
);


CREATE TABLE prueba (
  codigo INT PRIMARY KEY,
  distancia INT NOT NULL,
  fecha DATE NOT NULL,
  realizadaPor INT,
  analizadaPor INT,
  FOREIGN KEY (realizadaPor) REFERENCES piloto(numPiloto),
  FOREIGN KEY (analizadaPor) REFERENCES piloto(numPiloto)
);

CREATE TABLE campeonato (
    nombre VARCHAR(50),
    año INT NOT NULL,
    premioCampeon INT NOT NULL,
    categoria VARCHAR(10),
    mapa VARCHAR(10),
    numRepuestos INT,
    numAirbags INT,
    numParadasPits INT,
    gamaNeumaticos VARCHAR(10),
    pesoMaxMonoplaza INT,
    pesoMinPiloto INT,
    PRIMARY KEY (nombre, año),
    CHECK((categoria = 'F1' AND gamaNeumaticos IN ('Blanda', 'Media', 'Dura')  AND pesoMaxMonoplaza IS NOT NULL AND pesoMinPiloto IS NOT NULL) OR
          (categoria = 'MotoGP' AND numAirbags IS NOT NULL AND  numParadasPits IS NOT NULL ) OR
          (categoria = 'Rally' AND mapa IN ('Digital', 'Impreso') AND numRepuestos IS NOT NULL)
    )
);

CREATE TABLE carrera (
    nombre VARCHAR(50) PRIMARY KEY,
    fecha DATE NOT NULL,
    circuito VARCHAR(50) NOT NULL,
    nombreCampeonato VARCHAR(50),
    añoCampeonato INT,
    FOREIGN KEY (nombreCampeonato, añoCampeonato) REFERENCES campeonato(nombre, año),
    UNIQUE(fecha, circuito)
);


CREATE TABLE resultado (
    posicion INT NOT NULL,
    puntosObtenidos INT NOT NULL,
    nombreCarrera VARCHAR(50),
    fechaCarrera DATE,
    numPiloto INT,
    PRIMARY KEY (nombreCarrera, fechaCarrera, numPiloto),
    FOREIGN KEY (nombreCarrera, fechaCarrera) REFERENCES carrera(nombre, fecha),
    FOREIGN KEY (numPiloto) REFERENCES piloto(numPiloto)
);

CREATE TABLE registro (
    escuderia INT,
    campeonato VARCHAR(50),
    año INT,
    PRIMARY KEY (escuderia, campeonato, año),
    FOREIGN KEY (escuderia) REFERENCES escuderia(codigo),
    FOREIGN KEY (campeonato, año) REFERENCES campeonato(nombre, año)
);

CREATE TABLE patrocinador (
    nombre VARCHAR(50) PRIMARY KEY,
    sector VARCHAR(50) NOT NULL,
    contacto VARCHAR(50) NOT NULL
);

CREATE TABLE contrato (
    codigo INT PRIMARY KEY,
    tipo VARCHAR(50) NOT NULL,
    fechaInicio DATE NOT NULL,
    fechaFin DATE NOT NULL,
    patrocinador VARCHAR(50),
    escuderia INT,
    numPiloto INT,
    FOREIGN KEY (patrocinador) REFERENCES patrocinador(nombre),
    FOREIGN KEY (escuderia) REFERENCES escuderia(codigo),
    FOREIGN KEY (numPiloto) REFERENCES piloto(numPiloto),
    CHECK ((escuderia IS NOT NULL AND numPiloto IS NULL) OR (escuderia IS NULL AND numPiloto IS NOT NULL))
);
