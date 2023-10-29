<?php

        spl_autoload_register(function($class){
            if(file_exists('./control/' . $class . '.php')){
                require_once('./control/' . $class . '.php');
            }

        });

        $method = isset($_REQUEST['method']) ? $_REQUEST['method'] : 'show';
        $classe = isset($_REQUEST['class']) ? $_REQUEST['class'] : 'LandingLoad';

        if(class_exists($classe)){
            $pagina = new $classe($_REQUEST);
            //echo $method ."<br>";
            if(!empty($method) AND (method_exists($classe,$method))){
                //echo "INDEX METODO E CLASSE";
                $pagina->$method($_REQUEST);
            }
            $pagina->show();
        }else{
            header('Location: ./control/class=LandingLoad&method=show');
        }
?>