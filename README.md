
# Mars Rover Project

Este proyecto simula el control de un rover en Marte utilizando un frontend desarrollado en **Vue 3** con **Vite** y un backend en **PHP** con **Docker**. A través de este proyecto, podrás mover el rover dentro de una cuadrícula, girar y comprobar su posición actual.

## Estructura del Proyecto

- **Frontend (Vue 3 y Vite)**: Interfaz gráfica para controlar el rover y visualizar su posición en un mapa.
- **Backend (PHP)**: Lógica de control y cálculo del movimiento del rover, implementado en PHP.
- **Docker**: Configuración para ejecutar ambos el backend y el frontend dentro de contenedores Docker.

## Requisitos

- **Docker**: Para ejecutar los contenedores de desarrollo y producción.
- **Node.js** y **npm**: Necesarios para ejecutar el frontend.
- **PHP**: Utilizado en el backend para manejar la lógica de control del rover.

## Configuración

### 1. Clonar el Repositorio

Primero, clona este repositorio en tu máquina local.

```bash
git clone <URL_DEL_REPOSITORIO>
cd mars-rover
```

### 2. Configurar el Backend con Docker

Este proyecto usa **Docker** para ejecutar el backend. Sigue estos pasos para configurar y ejecutar el backend en contenedores Docker:

1. Asegúrate de tener **Docker** instalado en tu máquina.
2. Dirigete a donde se encuentra el archivo `docker-compose.yml`.
3. Levanta los contenedores usando Docker Compose.

```bash
docker compose up -d
```

Esto iniciará el contenedor de PHP y su servidor, y se encargará de ejecutar el backend del proyecto.

### 3. Configurar el Frontend con Vite

1. Navega al directorio del frontend.

```bash
cd frontend
```

2. Instala las dependencias del proyecto.

```bash
npm install
```

3. Inicia el servidor de desarrollo.

```bash
npm run dev
```

Esto ejecutará el frontend en modo de desarrollo, y podrás acceder a la aplicación en tu navegador en `http://localhost:5173`.

> **Nota**: El backend debe estar en funcionamiento para que el frontend pueda comunicarse con él.

### 4. Enlace entre Frontend y Backend

En el archivo `frontend/src/api.js`, se establece la URL base para las peticiones al backend:

```javascript
baseURL: 'http://localhost:8080/index.php', // Backend API URL
```

Asegúrate de que la URL base coincida con la dirección de tu servidor backend.

## Uso de Docker para Desarrollo y Producción

El proyecto utiliza Docker para ejecutar tanto el **frontend** como el **backend**. Si deseas levantar ambos contenedores de una sola vez, puedes hacerlo desde el directorio raíz utilizando el siguiente comando:

```bash
docker compose up --build
```

Esto construirá y levantará ambos contenedores (frontend y backend). Una vez levantado, podrás acceder al frontend en `http://localhost:5173` y la API del backend estará disponible en `http://localhost:8080`.

### Detalles de los Contenedores Docker

- **Backend (PHP-FPM)**: Un contenedor basado en PHP 8.2 que ejecuta el servidor backend.
- **Frontend (Vite)**: Un contenedor que ejecuta el proyecto de Vue 3 usando Vite como servidor de desarrollo.

Para detener ambos contenedores, puedes ejecutar:

```bash
docker compose down
```

## Estructura de Archivos

### **Backend**

- **index.php**: Punto de entrada principal para las solicitudes HTTP.
- **ApiController.php**: Controlador para manejar las solicitudes relacionadas con el movimiento y la posición del rover.
- **Grid.php**: Define la cuadrícula en la que se mueve el rover y la validación de las posiciones.
- **Rover.php**: Define la lógica del rover, como el movimiento, la orientación y las acciones como avanzar, girar a la izquierda y girar a la derecha.
- **RoverTest.php**: Pruebas unitarias para validar el comportamiento del rover.

### **Frontend**

- **App.vue**: Componente raíz de la aplicación.
- **RoverControl.vue**: Componente para controlar el rover (mover, girar y ver la posición).
- **router/index.js**: Configuración de rutas para el frontend (Vue Router).
  
### **Docker**

- **Dockerfile**: Define el contenedor de backend PHP.
- **docker-compose.yml**: Define y configura los contenedores Docker para el backend y frontend.
- **default.conf**: Configuración de Nginx para el servidor backend.

## Comandos Principales

### Backend

- Levantar contenedores de backend:

```bash
docker compose up -d
```

- Detener contenedores:

```bash
docker compose down
```

### Frontend

- Instalar dependencias:

```bash
npm install
```

- Iniciar el servidor de desarrollo:

```bash
npm run dev
```

## Pruebas

Este proyecto utiliza **PHPUnit** para las pruebas del backend. Puedes ejecutar las pruebas desde el contenedor de PHP:

```bash
docker exec -it <container_id> php ./vendor/bin/phpunit
```
Listado de los contenedores:

```bash
docker ps
```
## Autor

Este proyecto fue desarrollado como parte de una prueba técnica.
