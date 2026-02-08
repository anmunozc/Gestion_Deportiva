# 🏅 Sistema Web para la Trazabilidad del Entrenamiento Deportivo

## Proyecto de Título - TNS en Informática
**Institución:** IACC  
**Estudiante:** AMC  
**Caso de Estudio:** Club Deportivo Municipal de Patín Carrera  

---

## 📝 Descripción del Proyecto
Este sistema es un **Producto Mínimo Viable (MVP)** diseñado para digitalizar y centralizar la gestión de entrenamientos del Club Deportivo Municipal de Patín Carrera. Su objetivo principal es eliminar los registros manuales y fragmentados, permitiendo una trazabilidad real del progreso de los atletas para optimizar la toma de decisiones técnicas y mejorar el rendimiento deportivo.

## 🚀 Funcionalidades (MVP Nivel 1)
- **Gestión de Roles:** Acceso diferenciado mediante login para **Entrenadores** y **Atletas**.
- **Biblioteca de Sesiones:** Módulo para que el entrenador cree plantillas de entrenamiento reutilizables, permitiendo estandarizar la preparación física.
- **Asignación de Entrenamientos:** Sistema dinámico para asignar sesiones de la biblioteca a atletas específicos con metas personalizadas de distancia y tiempo.
- **Dashboard del Atleta:** Panel exclusivo donde el deportista visualiza su cronograma de entrenamientos y las observaciones técnicas de su preparador.
- **Arquitectura de Capas:** Implementación robusta mediante el patrón **MVC (Modelo-Vista-Controlador)** para garantizar escalabilidad.

## 🛠️ Tecnologías Utilizadas
- **Backend:** PHP 8.x
- **Base de Datos:** MySQL
- **Frontend:** HTML5, CSS3 (Custom Figma Style), Bootstrap 5, FontAwesome
- **Entorno de Desarrollo:** XAMPP, Visual Studio Code
- **Control de Versiones:** Git & GitHub

## 📁 Estructura del Proyecto
```text
Gestion_Deportiva/
│
├── config/
│   └── database.php           # Conexión a la BD mediante PDO
├── controllers/
│   ├── AuthController.php     # Gestión de sesiones y seguridad
│   └── EntrenamientoController.php # Lógica de biblioteca y asignaciones
├── models/
│   ├── Entrenamiento.php      # CRUD de entrenamientos y sesiones
│   └── Usuario.php            # Gestión de perfiles y roles
├── views/
│   ├── auth/
│   │   └── login.php          # Interfaz de acceso
│   ├── entrenador/
│   │   ├── panel.php          # Dashboard principal del coach
│   │   ├── biblioteca.php     # Gestión de plantillas de sesión
│   │   ├── registrar_entrenamiento.php # Formulario de asignación
│   │   └── ver_entrenamientos.php      # Reporte global
│   └── atleta/
│       └── dashboard.php      # Vista personalizada para el deportista
├── index.php                  # Enrutador principal del sistema
└── README.md                  # Documentación del proyecto