# Sistema Web para la Trazabilidad del Entrenamiento Deportivo 🛼

## Proyecto de Título - TNS en Informática
**Institución:** IACC  
**Estudiante:** AMC

**Caso de Estudio:** Club Deportivo Municipal de Patín Carrera  

---

## 📝 Descripción del Proyecto
Este sistema es un **Producto Mínimo Viable (MVP)** diseñado para digitalizar y centralizar la gestión de entrenamientos del Club Deportivo Municipal de Patín Carrera. Su objetivo principal es eliminar los registros manuales y fragmentados, permitiendo una trazabilidad real del progreso de los atletas para optimizar la toma de decisiones técnicas.

## 🚀 Funcionalidades (MVP Nivel 1)
- **Dashboard de Atletas:** Visualización centralizada de los deportistas registrados.
- **Registro de Entrenamientos:** Formulario técnico para capturar fecha, tipo de sesión, duración y observaciones.
- **Conectividad con Base de Datos:** Persistencia de información mediante MySQL.
- **Arquitectura de Capas:** Separación clara entre Presentación (Frontend), Negocio (Backend) y Datos.

## 🛠️ Tecnologías Utilizadas
- **Backend:** PHP 8 (Arquitectura MVC)
- **Base de datos:** MySQL
- **Frontend:** HTML5, CSS3, Bootstrap
- **Entorno de desarrollo:** XAMPP, Visual Studio Code
- **Control de versiones:** GitHub

## 📁 Estructura del Proyecto
```text
Gestion_Deportiva/
│
├── config/
│   ├── database.php
├── controllers/
│   ├── AuthController.php
│   └── EntrenamientoController.php
├── models/
│   ├── Entrenamiento.php
│   └── Usuario.php
├── public/
├── views/
│   ├── auth/
│   │   ├── login.php
│   ├── entrenador/
│   │   ├── panel.php
│   │   └── registrar_entrenamiento.php
│   │   └── ver_entrenamientos.php
│   └── atleta/
│       └── panel.php
│
├── index.php
│
└── README.md
