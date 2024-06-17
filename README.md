# Instrucciones para correr el proyecto

### Requisitos

- Composer y PHP.
- Git.
- Node JS ( como mínimo en su versión más estable - LTS).

Los verificamos con:

```bash
# Composer
composer --version
# Git
git --version
# Node JS
node --version
```

### Pasos

1. ‘Jalamos’ el proyecto con:

```html
git clone https://github.com/igidio/lrvl-inertia-crud.git
```

2. Nos dirigimos al directorio del proyecto:

```html
cd lrvl-inertia-crud
```

3. Ejecutamos Composer para instalar las dependencias:

```html
composer install
```

4. Luego hacemos lo propio con las librerías de Javascript:

```html
npm i
```

5. Definimos las variables de entorno en un archivo 📄 **.env**, donde establecemos los accesos a la base de datos, tenemos un ejemplar de como debe verse el archivo en 📄 **.env.example**.
6. Realizamos las migraciones con:

```bash
php artisan migrate:fresh --seed
```

7. Corremos el proyecto:

```bash
php artisan serve
```