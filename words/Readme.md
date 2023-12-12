# Cambio de Números WordPress Plugin

Este plugin de WordPress, llamado "Cambio de Números", te permite reemplazar automáticamente los números en el contenido y los títulos de tus publicaciones con sus equivalentes en palabras. Además, incluye una funcionalidad para personalizar las palabras asociadas a cada número y para actualizar manualmente la tabla en la base de datos con nuevos pares de números y palabras.

## Instalación

1. Descarga el archivo zip del plugin.
2. Accede al panel de administración de WordPress.
3. Ve a la sección "Plugins" y selecciona "Añadir nuevo".
4. Haz clic en "Subir plugin" y selecciona el archivo zip previamente descargado.
5. Activa el plugin después de la instalación.

## Uso

Una vez activado el plugin, los números del 1 al 10 en tus publicaciones se reemplazarán automáticamente por sus equivalentes en palabras. Por ejemplo:

- **Antes:** "Hoy es el 3 de diciembre."
- **Después:** "Hoy es el tres de diciembre."

## Configuración

El plugin utiliza una tabla en la base de datos de WordPress para almacenar los pares de números y palabras. Esta tabla se crea y llena automáticamente cuando activas el plugin por primera vez.

### Personalización de Palabras

Si deseas personalizar las palabras asociadas a cada número, puedes hacerlo editando el archivo del plugin. Busca las variables `$nums` y `$num_Letras` al principio del archivo y modifica las palabras según tus preferencias.

```php
$nums = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
$num_Letras = array('uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve', 'diez');
```

### Actualización de la Tabla

Si necesitas actualizar la tabla en la base de datos con nuevos pares de números y palabras, puedes hacerlo ejecutando el siguiente código en el archivo del plugin:

```php
// Ejecuta la función de inserción de datos
insertarDatos();
```

Este código se encarga de insertar los datos en la tabla y puedes ejecutarlo manualmente cuando sea necesario.

## Operaciones en la Base de Datos

El plugin realiza varias operaciones en la base de datos. A continuación, se explica cada una de ellas:

### Creación de la Tabla en la Base de Datos

La tabla en la base de datos se crea automáticamente cuando activas el plugin. Si necesitas entender o modificar esta operación, revisa el código del método `crearTabla` en el archivo del plugin.

```php
// Crea la tabla cuando el plugin se activa
add_action('plugins_loaded', 'crearTabla');
```

Este código crea una tabla en la base de datos con tres columnas: `id`, `nums`, `num_Letras`, y `palabraCambio`.

### Inserción de Datos en la Tabla

El método `insertarDatos` se encarga de insertar datos en la tabla de la base de datos. Este método se ejecuta automáticamente cuando activas el plugin por primera vez.

```php
// Cuando el plugin se activa, inserta los datos
add_action('plugins_loaded', 'insertarDatos');
```

Si necesitas ejecutar manualmente la inserción de datos, puedes hacerlo con el siguiente código:

```php
// Ejecuta la función de inserción de datos
insertarDatos();
```

Este código se asegura de que los datos iniciales se inserten en la tabla si está vacía.

### Selección de Datos desde la Tabla

El método `seleccionarDatos` obtiene todos los datos almacenados en la tabla de la base de datos.

```php
function seleccionarDatos()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'damGonzalo';
    $results = $wpdb->get_results("SELECT * FROM $table_name");
    return $results;
}
```

- Este método se utiliza para obtener los pares de números y palabras que luego se 
utilizan en la función `cambiarNumeros` para realizar el reemplazo.

