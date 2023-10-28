<?php

        spl_autoload_register(function ($class) {
            $classPath = '/control/' . $class . '.php';
            if (file_exists(__DIR__ . $classPath)) {
                require_once __DIR__ . $classPath;
            }
        });



        $method = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
        $classe = isset($_REQUEST['class']) ? $_REQUEST['class'] : 'Login';

        if(class_exists($classe)){
            $pagina = new $classe($_REQUEST);
            if(!empty($method) AND (method_exists($classe,$method))){
                $pagina->$method($_REQUEST);
            }
            $pagina->show();
        }
        else{
            header('Location: ./model/class=Preference.php&method=saudacao');
        }

?>