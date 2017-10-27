<?php

//esto no es obligatorio pero por un tema de seguridad que nos dice si BASEPATH no esta definido no va a cargar
if (!defined('BASEPATH')){exit('No direct script access allowed');}
//aqui es simple preguntamos si no existe la funcion urls_amigables la podemos crear de lo contrario no se crea
if (!function_exists('codigo_orden'))
{
    function codigo_orden()
    {
        //para poder usar la base de datos en el helper debemos instanciar al core de codeigniter
        $CI= & get_instance();
        //al ser instanciado es el equivalente a $this que se tiene en control
        //el siguiente proceso facil de entender igual no va al caso
        if ($CI->db->get("order")->num_rows()>0)
        {
            $num=$CI->db->order_by("id","desc")->get("order")->row_array();
            $num= (int) $num["code"];
            return str_pad($num+1, 8, "0", STR_PAD_LEFT);

        }
        else
        {
            return str_pad(1, 10, "0", STR_PAD_LEFT);
        }
    }
}

 ?>
