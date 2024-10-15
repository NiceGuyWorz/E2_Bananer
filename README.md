# E2_Bananer

# Aplicación Web Académica

Este documento proporciona una guía completa para entender y modificar el código de la aplicación web académica. Aquí encontrarás información sobre la estructura del proyecto, la función de cada archivo y cómo se relacionan entre sí. Además, se incluyen instrucciones para configurar el entorno y poner en marcha la aplicación.

## Tabla de Contenidos

* [Descripción General](#descripci%C3%B3n-general)
* [Estructura del Proyecto](#estructura-del-proyecto)
  * [/app](#app)
    * [/config](#config)
    * [/controllers](#controllers)
    * [/models](#models)
    * [/views](#views)
      * [/auth](#auth)
      * [/reports](#reports)
      * [/users](#users)
    * [layout.php](#layoutphp)
  * [index.php](#indexphp)
  * [.htaccess](#htaccess)
* [Guía de Configuración](#gu%C3%ADa-de-configuraci%C3%B3n)
  * [Requisitos Previos](#requisitos-previos)
  * [Configuración de la Base de Datos](#configuraci%C3%B3n-de-la-base-de-datos)
  * [Configuración de la Aplicación](#configuraci%C3%B3n-de-la-aplicaci%C3%B3n)
* [Descripción de Archivos y Directorios](#descripci%C3%B3n-de-archivos-y-directorios)
  * [/config/db.php](#configdbphp)
  * [/controllers](#controllers-1)
    * [AuthController.php](#authcontrollerphp)
    * [ReportController.php](#reportcontrollerphp)
    * [UserController.php](#usercontrollerphp)
  * [/models](#models-1)
    * [User.php](#userphp)
    * [Student.php](#studentphp)
    * [Course.php](#coursephp)
    * [AcademicRecord.php](#academicrecordphp)
  * [/views](#views-1)
    * [/auth/login.php](#authloginphp)
    * [/reports](#reports-1)
      * [student_level_report.php](#student_level_reportphp)
      * [course_approval_report.php](#course_approval_reportphp)
      * [student_history.php](#student_historyphp)
    * [/users/register.php](#usersregisterphp)
    * [layout.php](#layoutphp-1)
  * [index.php](#indexphp-1)
  * [.htaccess](#htaccess-1)
* [Flujo de la Aplicación](#flujo-de-la-aplicaci%C3%B3n)
* [Cómo Contribuir](#c%C3%B3mo-contribuir)
* [Contacto](#contacto)

## Descripción General

Esta es una aplicación web académica desarrollada en PHP que permite gestionar información académica de una universidad. La aplicación permite a los usuarios autenticarse, generar reportes y administrar usuarios. Está diseñada siguiendo el patrón Modelo-Vista-Controlador (MVC) para facilitar el mantenimiento y la escalabilidad.

## Estructura del Proyecto

El proyecto está organizado de la siguiente manera:

<pre class="!overflow-visible"><div class="dark bg-gray-950 contain-inline-size rounded-md border-[0.5px] border-token-border-medium relative"><div class="flex items-center text-token-text-secondary bg-token-main-surface-secondary px-4 py-2 text-xs font-sans justify-between rounded-t-md h-9">bash</div><div class="sticky top-9 md:top-[5.75rem]"><div class="absolute bottom-0 right-2 flex h-9 items-center"><div class="flex items-center rounded bg-token-main-surface-secondary px-2 font-sans text-xs text-token-text-secondary"><span class="" data-state="closed"><button class="flex gap-1 items-center py-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon-sm"><path fill-rule="evenodd" clip-rule="evenodd" d="M7 5C7 3.34315 8.34315 2 10 2H19C20.6569 2 22 3.34315 22 5V14C22 15.6569 20.6569 17 19 17H17V19C17 20.6569 15.6569 22 14 22H5C3.34315 22 2 20.6569 2 19V10C2 8.34315 3.34315 7 5 7H7V5ZM9 7H14C15.6569 7 17 8.34315 17 10V15H19C19.5523 15 20 14.5523 20 14V5C20 4.44772 19.5523 4 19 4H10C9.44772 4 9 4.44772 9 5V7ZM5 9C4.44772 9 4 9.44772 4 10V19C4 19.5523 4.44772 20 5 20H14C14.5523 20 15 19.5523 15 19V10C15 9.44772 14.5523 9 14 9H5Z" fill="currentColor"></path></svg>Copiar código</button></span></div></div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="!whitespace-pre hljs language-bash">/app
  /config
    db.php
  /controllers
    AuthController.php
    ReportController.php
    UserController.php
  /models
    User.php
    Student.php
    Course.php
    AcademicRecord.php
  /views
    /auth
      login.php
    /reports
      student_level_report.php
      course_approval_report.php
      student_history.php
    /users
      register.php
    layout.php
  index.php
  .htaccess
</code></div></div></pre>

### /app

Directorio raíz de la aplicación que contiene todos los archivos y subdirectorios necesarios para su funcionamiento.

#### /config

Contiene archivos de configuración global de la aplicación.

* **db.php** : Archivo de configuración para la conexión a la base de datos.

#### /controllers

Contiene los controladores que manejan la lógica de la aplicación y la interacción entre los modelos y las vistas.

* **AuthController.php** : Maneja la autenticación de usuarios (inicio y cierre de sesión).
* **ReportController.php** : Gestiona las funcionalidades relacionadas con los reportes.
* **UserController.php** : Administra las operaciones relacionadas con los usuarios, como el registro.

#### /models

Contiene las clases que representan los datos y la lógica de negocio de la aplicación.

* **User.php** : Modelo que representa a los usuarios y maneja operaciones relacionadas con ellos.
* **Student.php** : Modelo que representa a los estudiantes y sus operaciones.
* **Course.php** : Modelo que representa a los cursos y sus operaciones.
* **AcademicRecord.php** : Modelo que gestiona el historial académico de los estudiantes.

#### /views

Contiene las vistas que presentan la información al usuario.

##### /auth

* **login.php** : Vista del formulario de inicio de sesión.

##### /reports

* **student_level_report.php** : Vista del reporte de estudiantes dentro y fuera de nivel.
* **course_approval_report.php** : Vista del reporte de porcentaje de aprobación por curso y período.
* **student_history.php** : Vista del historial académico de un estudiante.

##### /users

* **register.php** : Vista del formulario de registro de nuevos usuarios.

#### layout.php

Plantilla base para las vistas, que incluye elementos comunes como el encabezado y el pie de página.

### index.php

Punto de entrada de la aplicación. Gestiona las solicitudes iniciales y redirige al usuario según su estado de autenticación.

### .htaccess

Archivo de configuración del servidor Apache que maneja reglas de reescritura de URL y otras configuraciones.

## Guía de Configuración

### Requisitos Previos

* **Servidor Web** : Apache o compatible.
* **PHP** : Versión 7.x o superior.
* **Base de Datos** : PostgreSQL.
* **Extensiones de PHP** :
* `pdo_pgsql` habilitado.

### Configuración de la Base de Datos

1. **Instalar PostgreSQL** : Asegúrate de tener PostgreSQL instalado y en funcionamiento.
2. **Crear la Base de Datos** :

* Nombre de la base de datos: `academia_db`.
* Puedes usar pgAdmin4 o la línea de comandos `psql` para crear la base de datos.

1. **Crear un Usuario para la Aplicación** :

* Usuario: `app_user`.
* Contraseña: Una contraseña segura de tu elección.
* Otorga los privilegios necesarios al usuario sobre la base de datos `academia_db`.

1. **Crear las Tablas** :

* Ejecuta las sentencias SQL necesarias para crear las tablas según el esquema de tu aplicación.

1. **Insertar Datos Iniciales** :

* Inserta los datos necesarios para probar la aplicación, como el usuario especial `bananer@lamejor.com`.

### Configuración de la Aplicación

1. **Clonar o Descargar el Proyecto** : Copia los archivos de la aplicación en el directorio deseado del servidor web.
2. **Configurar la Conexión a la Base de Datos** :

* Edita el archivo `/app/config/db.php` con las credenciales de tu base de datos.
  <pre class="!overflow-visible"><div class="dark bg-gray-950 contain-inline-size rounded-md border-[0.5px] border-token-border-medium relative"><div class="flex items-center text-token-text-secondary bg-token-main-surface-secondary px-4 py-2 text-xs font-sans justify-between rounded-t-md h-9">php</div><div class="sticky top-9 md:top-[5.75rem]"><div class="absolute bottom-0 right-2 flex h-9 items-center"><div class="flex items-center rounded bg-token-main-surface-secondary px-2 font-sans text-xs text-token-text-secondary"><span class="" data-state="closed"><button class="flex gap-1 items-center py-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon-sm"><path fill-rule="evenodd" clip-rule="evenodd" d="M7 5C7 3.34315 8.34315 2 10 2H19C20.6569 2 22 3.34315 22 5V14C22 15.6569 20.6569 17 19 17H17V19C17 20.6569 15.6569 22 14 22H5C3.34315 22 2 20.6569 2 19V10C2 8.34315 3.34315 7 5 7H7V5ZM9 7H14C15.6569 7 17 8.34315 17 10V15H19C19.5523 15 20 14.5523 20 14V5C20 4.44772 19.5523 4 19 4H10C9.44772 4 9 4.44772 9 5V7ZM5 9C4.44772 9 4 9.44772 4 10V19C4 19.5523 4.44772 20 5 20H14C14.5523 20 15 19.5523 15 19V10C15 9.44772 14.5523 9 14 9H5Z" fill="currentColor"></path></svg>Copiar código</button></span></div></div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="!whitespace-pre hljs language-php"><?php
  // config/db.php

  $host     = 'localhost';
  $db       = 'academia_db';
  $user     = 'app_user';
  $pass     = 'tu_contraseña';
  $port     = '5432';
  $charset  = 'utf8';

  $dsn = "pgsql:host=$host;port=$port;dbname=$db;user=$user;password=$pass";

  $options = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false,
  ];

  try {
      $pdo = new PDO($dsn, null, null, $options);
  } catch (\PDOException $e) {
      echo 'Error de conexión: ' . $e->getMessage();
      exit;
  }
  ?>
  </code></div></div></pre>

1. **Configurar el Servidor Web** :

* Asegúrate de que el servidor web esté configurado para interpretar archivos `.php`.
* Habilita el módulo `mod_rewrite` si utilizas Apache, necesario para las reglas de `.htaccess`.

1. **Probar la Aplicación** :

* Accede a la aplicación desde el navegador para verificar que funcione correctamente.

## Descripción de Archivos y Directorios

### /config/db.php

Archivo de configuración de la conexión a la base de datos. Define las credenciales y las opciones de conexión utilizando PDO (PHP Data Objects).

### /controllers

Contiene los controladores que manejan la lógica de negocio y la interacción entre los modelos y las vistas.

#### AuthController.php

* **Funcionalidad** : Maneja la autenticación de usuarios, incluyendo el inicio y cierre de sesión.
* **Métodos Principales** :
* `showLoginForm()`: Muestra el formulario de inicio de sesión.
* `login()`: Procesa el formulario de inicio de sesión y autentica al usuario.
* `logout()`: Cierra la sesión del usuario.

#### ReportController.php

* **Funcionalidad** : Gestiona las funcionalidades relacionadas con los reportes solicitados.
* **Métodos Principales** :
* `showMenu()`: Muestra el menú principal con las opciones de reportes.
* `reportStudentLevel()`: Genera el reporte de estudiantes dentro y fuera de nivel.
* `reportCourseApprovalByPeriod()`: Genera el reporte de porcentaje de aprobación por curso y período.
* `reportAcademicHistory()`: Genera el historial académico de un estudiante.

#### UserController.php

* **Funcionalidad** : Administra las operaciones relacionadas con los usuarios, como el registro de nuevos usuarios.
* **Métodos Principales** :
* `showRegistrationForm()`: Muestra el formulario de registro.
* `registerUser()`: Procesa el registro de un nuevo usuario.

### /models

Contiene las clases que representan los datos y la lógica de negocio.

#### User.php

* **Funcionalidad** : Modelo que representa a los usuarios.
* **Métodos Principales** :
* `getUserByEmail($email)`: Obtiene un usuario por su correo electrónico.
* `registerBananerUser($email, $hashedPassword, $role)`: Registra un nuevo usuario en el sistema.

#### Student.php

* **Funcionalidad** : Modelo que representa a los estudiantes.
* **Métodos Principales** :
* `getStudentByNumber($studentNumber)`: Obtiene un estudiante por su número.
* `isActiveInPeriod($studentNumber, $period)`: Verifica si un estudiante está activo en un período específico.

#### Course.php

* **Funcionalidad** : Modelo que representa a los cursos.
* **Métodos Principales** :
* `getCourseByCode($courseCode)`: Obtiene un curso por su código.
* `getCourseApprovalByPeriod($period)`: Obtiene el porcentaje de aprobación de cursos en un período.

#### AcademicRecord.php

* **Funcionalidad** : Gestiona el historial académico de los estudiantes.
* **Métodos Principales** :
* `getAcademicHistory($studentNumber)`: Obtiene el historial académico de un estudiante.
* `getStudentStatus($studentNumber)`: Determina el estado actual de un estudiante.

### /views

Contiene las vistas que presentan la información al usuario.

#### /auth/login.php

* **Funcionalidad** : Vista del formulario de inicio de sesión.
* **Elementos Clave** :
* Formulario con campos para el correo electrónico y la contraseña.
* Muestra mensajes de error si la autenticación falla.

#### /reports

Vistas relacionadas con los reportes de la aplicación.

##### student_level_report.php

* **Funcionalidad** : Muestra el reporte de estudiantes dentro y fuera de nivel.
* **Contenido** :
* Tabla con el total de estudiantes, y la cantidad dentro y fuera de nivel.

##### course_approval_report.php

* **Funcionalidad** : Muestra el porcentaje de aprobación por curso y período.
* **Contenido** :
* Tabla con el código del curso, nombre, profesor y porcentaje de aprobación.

##### student_history.php

* **Funcionalidad** : Muestra el historial académico de un estudiante.
* **Contenido** :
* Información del estudiante.
* Listado de cursos agrupados por período con notas y calificaciones.
* Resúmenes por período y total.

#### /users/register.php

* **Funcionalidad** : Vista del formulario de registro de nuevos usuarios.
* **Elementos Clave** :
* Formulario con campos para el correo electrónico, contraseña y rol.
* Muestra mensajes de éxito o error tras el registro.

#### layout.php

* **Funcionalidad** : Plantilla base para las vistas.
* **Contenido** :
* Estructura HTML común, incluyendo encabezado, navegación y pie de página.
* Utiliza variables como `$title` y `$content` para insertar contenido específico de cada vista.

### index.php

* **Funcionalidad** : Punto de entrada de la aplicación.
* **Lógica** :
* Verifica si el usuario está autenticado.
* Redirige al controlador correspondiente o al formulario de inicio de sesión.

### .htaccess

* **Funcionalidad** : Configura reglas de servidor para Apache.
* **Contenido** :
* Habilita la reescritura de URLs para rutas limpias.
* Configura la codificación por defecto.
* Protege archivos sensibles de accesos no autorizados.

## Flujo de la Aplicación

1. **Inicio** :

* El usuario accede a `index.php`.
* Si está autenticado, es redirigido al menú principal.
* Si no, es redirigido al formulario de inicio de sesión.

1. **Autenticación** :

* El usuario ingresa sus credenciales en `login.php`.
* `AuthController` procesa la solicitud y autentica al usuario.
* Al autenticarse, se almacenan datos en la sesión y se redirige al menú.

1. **Menú Principal** :

* `ReportController` muestra las opciones disponibles.
* El usuario selecciona la funcionalidad deseada.

1. **Generación de Reportes** :

* Según la opción elegida, `ReportController` llama al método correspondiente.
* Los modelos recuperan datos de la base de datos.
* Las vistas presentan los datos al usuario.

1. **Registro de Usuarios (Solo Usuario Especial)** :

* El usuario especial `bananer@lamejor.com` puede acceder a `register.php`.
* `UserController` maneja el registro de nuevos usuarios.

1. **Cierre de Sesión** :

* El usuario puede cerrar sesión a través de `AuthController`.

## Cómo Contribuir

Si deseas contribuir al desarrollo de esta aplicación:

1. **Clona el Repositorio** : Realiza un fork del proyecto y clónalo en tu máquina local.
2. **Crea una Rama** : Crea una nueva rama para tus cambios.

<pre class="!overflow-visible"><div class="dark bg-gray-950 contain-inline-size rounded-md border-[0.5px] border-token-border-medium relative"><div class="flex items-center text-token-text-secondary bg-token-main-surface-secondary px-4 py-2 text-xs font-sans justify-between rounded-t-md h-9">bash</div><div class="sticky top-9 md:top-[5.75rem]"><div class="absolute bottom-0 right-2 flex h-9 items-center"><div class="flex items-center rounded bg-token-main-surface-secondary px-2 font-sans text-xs text-token-text-secondary"><span class="" data-state="closed"><button class="flex gap-1 items-center py-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon-sm"><path fill-rule="evenodd" clip-rule="evenodd" d="M7 5C7 3.34315 8.34315 2 10 2H19C20.6569 2 22 3.34315 22 5V14C22 15.6569 20.6569 17 19 17H17V19C17 20.6569 15.6569 22 14 22H5C3.34315 22 2 20.6569 2 19V10C2 8.34315 3.34315 7 5 7H7V5ZM9 7H14C15.6569 7 17 8.34315 17 10V15H19C19.5523 15 20 14.5523 20 14V5C20 4.44772 19.5523 4 19 4H10C9.44772 4 9 4.44772 9 5V7ZM5 9C4.44772 9 4 9.44772 4 10V19C4 19.5523 4.44772 20 5 20H14C14.5523 20 15 19.5523 15 19V10C15 9.44772 14.5523 9 14 9H5Z" fill="currentColor"></path></svg>Copiar código</button></span></div></div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="!whitespace-pre hljs language-bash">git checkout -b feature/nueva-funcionalidad
   </code></div></div></pre>

1. **Realiza Cambios** : Modifica el código según sea necesario. Asegúrate de seguir la estructura y estándares existentes.
2. **Prueba tus Cambios** : Verifica que tus modificaciones funcionan correctamente y no introducen errores.
3. **Realiza un Commit** : Guarda tus cambios con un mensaje descriptivo.

<pre class="!overflow-visible"><div class="dark bg-gray-950 contain-inline-size rounded-md border-[0.5px] border-token-border-medium relative"><div class="flex items-center text-token-text-secondary bg-token-main-surface-secondary px-4 py-2 text-xs font-sans justify-between rounded-t-md h-9">sql</div><div class="sticky top-9 md:top-[5.75rem]"><div class="absolute bottom-0 right-2 flex h-9 items-center"><div class="flex items-center rounded bg-token-main-surface-secondary px-2 font-sans text-xs text-token-text-secondary"><span class="" data-state="closed"><button class="flex gap-1 items-center py-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon-sm"><path fill-rule="evenodd" clip-rule="evenodd" d="M7 5C7 3.34315 8.34315 2 10 2H19C20.6569 2 22 3.34315 22 5V14C22 15.6569 20.6569 17 19 17H17V19C17 20.6569 15.6569 22 14 22H5C3.34315 22 2 20.6569 2 19V10C2 8.34315 3.34315 7 5 7H7V5ZM9 7H14C15.6569 7 17 8.34315 17 10V15H19C19.5523 15 20 14.5523 20 14V5C20 4.44772 19.5523 4 19 4H10C9.44772 4 9 4.44772 9 5V7ZM5 9C4.44772 9 4 9.44772 4 10V19C4 19.5523 4.44772 20 5 20H14C14.5523 20 15 19.5523 15 19V10C15 9.44772 14.5523 9 14 9H5Z" fill="currentColor"></path></svg>Copiar código</button></span></div></div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="!whitespace-pre hljs language-sql">git commit -am "Agrega nueva funcionalidad X"
   </code></div></div></pre>

1. **Haz un Push** : Envía tus cambios a tu repositorio remoto.

<pre class="!overflow-visible"><div class="dark bg-gray-950 contain-inline-size rounded-md border-[0.5px] border-token-border-medium relative"><div class="flex items-center text-token-text-secondary bg-token-main-surface-secondary px-4 py-2 text-xs font-sans justify-between rounded-t-md h-9">bash</div><div class="sticky top-9 md:top-[5.75rem]"><div class="absolute bottom-0 right-2 flex h-9 items-center"><div class="flex items-center rounded bg-token-main-surface-secondary px-2 font-sans text-xs text-token-text-secondary"><span class="" data-state="closed"><button class="flex gap-1 items-center py-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon-sm"><path fill-rule="evenodd" clip-rule="evenodd" d="M7 5C7 3.34315 8.34315 2 10 2H19C20.6569 2 22 3.34315 22 5V14C22 15.6569 20.6569 17 19 17H17V19C17 20.6569 15.6569 22 14 22H5C3.34315 22 2 20.6569 2 19V10C2 8.34315 3.34315 7 5 7H7V5ZM9 7H14C15.6569 7 17 8.34315 17 10V15H19C19.5523 15 20 14.5523 20 14V5C20 4.44772 19.5523 4 19 4H10C9.44772 4 9 4.44772 9 5V7ZM5 9C4.44772 9 4 9.44772 4 10V19C4 19.5523 4.44772 20 5 20H14C14.5523 20 15 19.5523 15 19V10C15 9.44772 14.5523 9 14 9H5Z" fill="currentColor"></path></svg>Copiar código</button></span></div></div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="!whitespace-pre hljs language-bash">git push origin feature/nueva-funcionalidad
   </code></div></div></pre>

1. **Crea un Pull Request** : Solicita que tus cambios sean incorporados al proyecto principal.
