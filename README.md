# 🚗 API de Gestión de Coches

**Laravel 12 + Sanctum**

API RESTful desarrollada con **Laravel 12** para la gestión de un
inventario de vehículos.\
Implementa autenticación segura mediante **Laravel Sanctum (Tokens)**,
permitiendo a los usuarios registrarse, iniciar sesión y administrar su
propia flota de coches.

------------------------------------------------------------------------

## 📋 Requisitos Previos

Para ejecutar este proyecto localmente necesitas:

-   **PHP** \>= 8.2\
-   **Composer**\
-   **MySQL** (XAMPP, Laragon, Docker, etc.)\
-   **Postman** (para probar los endpoints)

------------------------------------------------------------------------

## 🚀 Guía de Instalación y Configuración

Sigue estos pasos para levantar el proyecto desde cero en un entorno
local.

------------------------------------------------------------------------

### 1️⃣ Instalar dependencias

Clona el repositorio, accede a la carpeta del proyecto y ejecuta:

``` bash
composer install
```

------------------------------------------------------------------------

### 2️⃣ Configurar el entorno (`.env`)

Duplica el archivo `.env.example` y renómbralo a `.env`.

Configura la conexión a la base de datos MySQL:

``` ini
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=api_coches
DB_USERNAME=root
DB_PASSWORD=
```

> ⚠️ Si tu usuario `root` tiene contraseña, añádela en `DB_PASSWORD`.

------------------------------------------------------------------------

### 3️⃣ Generar la clave de aplicación

``` bash
php artisan key:generate
```

------------------------------------------------------------------------

### 4️⃣ Crear la base de datos

Desde tu gestor de base de datos (phpMyAdmin, DBeaver, etc.), crea una
base de datos vacía llamada:

``` text
api_coches
```

------------------------------------------------------------------------

### 5️⃣ Ejecutar migraciones

Esto creará las tablas `users` y `cars`:

``` bash
php artisan migrate
```

------------------------------------------------------------------------

### 6️⃣ Iniciar el servidor

``` bash
php artisan serve
```

📍 La API estará disponible en:\
**http://127.0.0.1:8000**

------------------------------------------------------------------------

## 🔐 Autenticación y Usuarios

La API requiere **Bearer Token** para acceder a las rutas protegidas de
gestión de coches.

### 👤 Usuario de prueba (Demo)

  Campo      Valor
  ---------- ----------------
  Nombre     Ángel
  Email      angel@test.com
  Password   contraseña123

------------------------------------------------------------------------

### 🔑 Obtener Token (Login)

1.  Envía una petición **POST** a `/api/login`\
2.  Copia el token que devuelve la respuesta\
3.  En Postman → **Authorization → Bearer Token** → pega el token

------------------------------------------------------------------------

## 📡 Endpoints y Ejemplos JSON

### Headers requeridos

``` http
Accept: application/json
Content-Type: application/json
```

------------------------------------------------------------------------

### 1️⃣ Registro de usuario

**POST** `/api/register`

``` json
{
  "name": "Ángel",
  "email": "angel@test.com",
  "password": "contraseña123",
  "password_confirmation": "contraseña123"
}
```

------------------------------------------------------------------------

### 2️⃣ Login

**POST** `/api/login`

``` json
{
  "email": "angel@test.com",
  "password": "contraseña123"
}
```

------------------------------------------------------------------------

### 3️⃣ Crear coche (requiere token)

**POST** `/api/cars`

#### Ejemplo A --- Toyota Corolla (Disponible)

``` json
{
  "brand": "Toyota",
  "model": "Corolla",
  "description": "Coche híbrido plateado, perfecto para ciudad. Bajo consumo.",
  "year": 2023,
  "is_available": true
}
```

#### Ejemplo B --- Ford Mustang (Deportivo)

``` json
{
  "brand": "Ford",
  "model": "Mustang GT",
  "description": "Motor V8, color rojo pasión. Tiene algunos arañazos en la puerta.",
  "year": 2020,
  "is_available": true
}
```

#### Ejemplo C --- Tesla Model 3 (No disponible)

``` json
{
  "brand": "Tesla",
  "model": "Model 3",
  "description": "100% eléctrico, autonomía de gran alcance. Actualmente en taller.",
  "year": 2024,
  "is_available": false
}
```

------------------------------------------------------------------------

### 4️⃣ Listar coches

**GET** `/api/cars`

------------------------------------------------------------------------

## 🏗️ Estructura del Proyecto

``` text
routes/api.php
├── Rutas públicas (auth)
├── Rutas protegidas (cars) → auth:sanctum

app/Models/User.php
├── HasApiTokens
├── Relación hasMany con coches

app/Models/Car.php
├── $fillable
├── Relación belongsTo con usuario

app/Http/Controllers/AuthController.php
├── Registro, Login y Logout

app/Http/Controllers/CarController.php
├── CRUD tipo Resource
├── Asigna automáticamente el usuario propietario
```

------------------------------------------------------------------------

## 🛠️ Comandos Útiles

  Comando                       Descripción
  ----------------------------- -------------------------
  `php artisan serve`           Inicia el servidor
  `php artisan migrate`         Ejecuta las migraciones
  `php artisan migrate:fresh`   Borra y recrea la BD ⚠️
  `php artisan route:list`      Lista todas las rutas

------------------------------------------------------------------------
