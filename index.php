<?php

        spl_autoload_register(function($class){
            if(file_exists('./control/' . $class . '.php')){
                require_once('./control/' . $class . '.php');
            }

        });

        //$classe = $_REQUEST['class'];

        $method = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
        $classe = isset($_REQUEST['class']) ? $_REQUEST['class'] : 'Login';

        if(class_exists($classe)){
            $pagina = new $classe($_REQUEST);
            if(!empty($method) AND (method_exists($classe,$method))){
                $pagina->$method($_REQUEST);
            }
            $pagina->show();
        }

        if(empty($classe) AND empty($method)){
            header('Location: index.html');
        }

?>