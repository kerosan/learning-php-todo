<?php

class View
{
    //public $template_view; // здесь можно указать общий вид по умолчанию.

    function generate($content_view, $template_view, $data = null)
    {

        /*if(!is_null($data)) {
            // преобразуем элементы массива в переменные
            var_dump(extract($data));
        }*/


        include 'application/views/' . $template_view;
    }
}
