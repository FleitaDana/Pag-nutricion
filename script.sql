CREATE DATABASE ProyectoMiNutri;

CREATE TABLE Receta (
    id_receta INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(45) NOT NULL,
    subtitulo VARCHAR(100) NOT NULL,
    ingredientes VARCHAR(255) NOT NULL,
    pasos_a_seguir VARCHAR(255) NOT NULL,
    imagen_url VARCHAR(100) NOT NULL
);

CREATE TABLE Servicio (
    id_servicio INT PRIMARY KEY AUTO_INCREMENT,
    tipo VARCHAR(200) NOT NULL
);

CREATE TABLE Consulta (
    id_consulta INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(45) NOT NULL,
    apellido VARCHAR(20) NOT NULL,
    telefono VARCHAR(20) NOT NULL,  
    mensaje_consulta TEXT NOT NULL,
    servicio_id_servicio INT NOT NULL,
    FOREIGN KEY (servicio_id_servicio) REFERENCES Servicio(id_servicio)
);


-- Insercion de recetas
INSERT INTO Receta (titulo, subtitulo, ingredientes, pasos_a_seguir, imagen_url)
VALUES 
('Pancakes Saludables', 'Ideal para comenzar el día',
'2 bananas maduras, 2 huevos, 1/2 taza de harina integral, 1/4 cucharadita de canela, 1/4 cucharadita de polvo de hornear, edulcorante al gusto y aceite vegetal para engrasar la sartén (opcional)',
'Tritura plátanos maduros hasta obtener un puré, Mezcla el puré con huevos - harina integral - canela - polvo de hornear y edulcorante, Cocina en una sartén a fuego medio-bajo por 2-3 min de cada lado, Sirve caliente con tus toppings favoritos',
'img/pancakes.jpg');

INSERT INTO Receta (titulo, subtitulo, ingredientes, pasos_a_seguir, imagen_url)
VALUES 
('Pudding de Chia sin Azucar', 
 'Ideal para un desayuno saludable', 
 '3/4 de banana, 1/2 vaso de leche, Almendras, Fruta, Stevia líquida (opcional)', 
 'Colocar chía - banana y leche en la licuadora, Licuar hasta obtener una crema espesa, Refrigerar por 2 horas, Decorar con duraznos y almendras antes de servir y disfrutar.', 
 'img/chia.jpg');

INSERT INTO Receta (titulo, subtitulo, ingredientes, pasos_a_seguir, imagen_url)
VALUES 
('Blue Smoothie', 
 'Refrescante y lleno de antioxidantes', 
 '1/2 taza de arándanos, 1 banana, 1/2 vaso de leche de almendra, 1 cucharada de chía, Miel (opcional)', 
 'Colocar los arándanos - banana - leche de almendra y chía en la licuadora, Licuar hasta obtener una mezcla suave, Servir frío y decorar con arándanos y hojas de menta si lo deseas.', 
 'img/blueSmoothie.jpg');
 
INSERT INTO Receta (titulo, subtitulo, ingredientes, pasos_a_seguir, imagen_url)
VALUES 
('Tostadas con Palta y Huevo', 
 'Deliciosas y llenas de nutrientes', 
 '2 rebanadas de pan integral, 1 palta madura, 1 huevo, Sal y pimienta, Semillas de sésamo (opcional)', 
 'Tostar el pan hasta que esté dorado, Aplastar la palta y untarla sobre las tostadas, Cocinar el huevo a tu gusto (poché o revuelto) y colocarlo sobre la palta, Sazonar con sal y pimienta, Decorar con semillas de sésamo si lo deseas.', 
 'img/tostadasPaltaHuevo.jpg');
 
INSERT INTO Receta (titulo, subtitulo, ingredientes, pasos_a_seguir, imagen_url)
VALUES 
 ('Green Smoothie', 
 'Energético y lleno de vitaminas', 
 '1/2 taza de espinaca fresca, 1/2 manzana verde, 1/2 vaso de agua de coco, 1 cucharada de semillas de chía, 1/2 pepino, Miel o stevia (opcional)', 
 'Colocar la espinaca, la manzana, el agua de coco, las semillas de chía y el pepino en la licuadora, Licuar hasta obtener una mezcla suave, Servir frío y decorar con rodajas de pepino o una ramita de menta.', 
 'img/greenSmoothie.jpg');
 
INSERT INTO Receta (titulo, subtitulo, ingredientes, pasos_a_seguir, imagen_url)
VALUES 
('Yogurt con Mix de Frutos Rojos, Avena y Coco', 
 'Merienda antioxidante y lleno de nutrientes', 
 '1 taza de yogurt natural sin azúcar, 1/2 taza de mix de frutos rojos (frambuesas, moras, arándanos, fresas), 1/2 banana en rodajas, 2 cucharadas de avena, 1 cucharada de coco rallado sin azúcar, Miel o stevia (opcional)', 
 'En un bowl colocar el yogurt natural, Agregar mix de frutos rojos y las rodajas de banana, Espolvorear la avena y el coco rallado sobre la mezcla, Endulzar con miel a gusto, Mezclar suavemente o servir en capas para disfrutar de todos los sabores.', 
 'img/yogurtFrutosRojos.jpg');

INSERT INTO Receta (titulo, subtitulo, ingredientes, pasos_a_seguir, imagen_url)
VALUES 
('Sándwich Saludable de Pollo, Pepino y Palta', 
 'Ideal para un almuerzo ligero y nutritivo', 
 '2 rebanadas de pan integral, 100g de pechuga de pollo cocida y desmenuzada, 1/4 de pepino en rodajas finas, 1/2 palta madura, Hojas de espinaca o lechuga, Sal y pimienta al gusto', 
 'Tostar las rebanadas de pan integral ligeramente, Untar la palta en una de las rebanadas, Colocar las rodajas de pepino y las hojas de espinaca o lechuga, Agregar el pollo desmenuzado y sazonar con sal y pimienta al gusto, Servir.', 
 'img/sandwichPolloPepinoPalta.jpg');

INSERT INTO Receta (titulo, subtitulo, ingredientes, pasos_a_seguir, imagen_url)
VALUES 
('Ensalada de Quinoa con Verduras y Garbanzos', 
 'Una opción fresca y rica en proteínas vegetales', 
 '1 taza de quinoa cocida, 1/2 taza de garbanzos cocidos, 1/2 pimiento rojo en cubos, 1/2 pepino en cubos, 1 zanahoria rallada, 1 puñado de rúcula, Jugo de limón, Aceite de oliva, Sal y pimienta al gusto', 
 'Mezclar la quinoa cocida con los garbanzos y las verduras, Agregar el jugo de limón, un chorrito de aceite de oliva, y sazonar con sal y pimienta al gusto, Mezclar bien y servir.', 
 'img/ensaladaQuinoaGarbanzos.jpg');
 
INSERT INTO Receta (titulo, subtitulo, ingredientes, pasos_a_seguir, imagen_url)
VALUES 
 ('Wrap de Hummus, Vegetales y Pollo', 
 'Perfecto para una comida ligera y llena de sabor', 
 '1 tortilla integral, 2 cucharadas de hummus, 50g de pechuga de pollo cocida y en tiras, 1/4 de pimiento en tiras, 1/4 de zanahoria en tiras, 1 puñado de rúcula o lechuga, Sal y pimienta al gusto', 
 'Untar el hummus en la tortilla, Colocar las tiras de pollo y los vegetales encima, Sazonar con sal y pimienta al gusto, Enrollar la tortilla para formar el wrap y cortar por la mitad si se desea, Servir.', 
 'img/wrapHummusPollo.jpg');
 
INSERT INTO Receta (titulo, subtitulo, ingredientes, pasos_a_seguir, imagen_url)
VALUES 
('Flan Casero Proteico', 
 'Un postre clásico en versión saludable y alta en proteínas', 
 '500 ml de leche descremada o leche vegetal, 3 huevos, 1 scoop de proteína en polvo sabor vainilla, 1 cucharada de esencia de vainilla, Endulzante al gusto, Caramelo sin azúcar (opcional)', 
 'Precalentar el horno a 180°C. Batir los huevos, proteína en polvo, leche, esencia de vainilla y endulzante. Verter en un molde con caramelo opcional. Hornear a baño maría por 40-50 min hasta que esté firme. Enfriar, desmoldar y servir.', 
 'img/flanProteico.jpg');


-- Insercion de tipos de servicios
INSERT INTO Servicio (tipo)
VALUES 
('Consultas Personalizadas de Nutrición'),
('Nutrición Deportiva'),
('Asesoramiento en Alimentación Vegetariana o Vegana');

INSERT INTO Servicio (tipo)
VALUES 
('Planes de alimentación');


CREATE TABLE Usuario (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    presentacion TEXT NOT NULL
);

INSERT INTO Usuario (username, password, presentacion) VALUES ('Fleita Lara', '$2y$10$HJSgXPy8dQreJiExpSdQTOk9k.q5wkvXy2DHTnYfZFDaXOzxtJHtm', 'Apasionada por la salud y el bienestar, me dedico a ayudar a las personas a alcanzar sus objetivos nutricionales a través de una alimentación equilibrada y personalizada.');



SELECT * FROM usuario;
SELECT * FROM receta;
SELECT * FROM servicio;
SELECT * FROM consulta;


