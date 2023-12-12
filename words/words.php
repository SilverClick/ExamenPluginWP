<?php

/*
Plugin Name: Cambio de numeros
Plugin URI: http://wordpress.org/plugins/hello-dolly/n
Author: Gonzalo Arca
Version: 1.7.2
Author URI: http://ma.tt/
*/




    //array de numeros
    $nums = array(
        1,
        2,
        3,
        4,
        5,
        6,
        7,
        8,
        9,
        10);

    //array de sus correpondientes palabras.
    $num_Letras = array(
        'uno',
        'dos',
        'tres',
        'cuatro',
        'cinco',
        'seis',
        'siete',
        'ocho',
        'nueve',
        'diez');











function cambiarNumeros($text){


    // coge los números de la tabla
    $words = seleccionarDatos();
    foreach ($words as $result){
        $nums[] = $result->nums; // -> para seleccionar que columna escoger
        $num_Letras[] = $result->num_Letras;


    }
    return str_replace($nums,$num_Letras, $text);


}

add_filter('the_content', 'cambiarNumeros');
add_filter('the_title', 'cambiarNumeros');




function crearTabla()
{
    global $wpdb; // asi es como accedes a la base de datos
    $table_name = $wpdb->prefix . 'damGonzalo';

    $charset_collate = $wpdb->get_charset_collate();
    // SQL sentence
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
      nums mediumint(9) NOT NULL,
       num_Letras varchar(255) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";
    // incluimos el archivo para ejecutar la sentencia SQL
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    // ejecutamos la sentencia SQL
    dbDelta($sql);
}

// cuando el plugin se activa, creamos la tabla
add_action('plugins_loaded', 'crearTabla');

// ahora insertamos los datos
function insertarDatos()
{
    global $wpdb, $nums, $num_Letras;
    $table_name = $wpdb->prefix . 'damGonzalo';
    //vemos si la tabla tiene algo
    $hasSomething = $wpdb->get_results("SELECT * FROM $table_name");
    if (count($hasSomething) == 0) {
        // if it is empty, we insert the words
        for ($i = 0; $i < count($nums); $i++) {
            $wpdb->insert(
                $table_name,
                array(
                    'nums' => $nums[$i],
                    'num_Letras' => $num_Letras[$i]
                )



            );

        }
    }
}

// cuando el plugin se activa, insertamos los datos
add_action('plugins_loaded', 'insertarDatos');

// seleccionamos los datos de la tabla
function seleccionarDatos()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'damGonzalo';
    $results = $wpdb->get_results("SELECT * FROM $table_name");
    return $results;
}

















