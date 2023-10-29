<?php

require_once './Control/Connection.php';
require_once './control/Usuarios.php';
require_once './control/UsuariosLogin.php';


class CadastroListagemUsuario {

    public $List;
    public $Cadastro;
    private $items;
    private $data;


    public function __construct() {
        $bootstrapCSS = file_get_contents('./layout/css/bootstrap.min.css');
        $mdiCSS = file_get_contents('./layout/css/materialdesignicons.min.css');
        $tinySliderCSS = file_get_contents('./layout/css/tiny-slider.css');
        $swiperCSS = file_get_contents('./layout/css/swiper.min.css');
        $customCSS = file_get_contents('./layout/css/style.min.css');
        $colorsCSS = file_get_contents('./layout/css/colors/default.css');

        // Carrega o conteúdo do arquivo HTML
        $List = file_get_contents('./html/ListagemUsuarios.html');
        $Cadastro = file_get_contents('./html/FormCadastroUsuario.html');
        $this->data = ['cod_user' => null, 'login' => null, 'password' => null]; // Falta o ponto e vírgula aqui
        // Concatena o conteúdo dos arquivos CSS e HTML
        $styles = "<style>{$bootstrapCSS}{$mdiCSS}{$tinySliderCSS}{$swiperCSS}{$customCSS}{$colorsCSS}</style>";
        $this->List = "{$styles}{$List}";
        $styles = "<style>{$bootstrapCSS}{$mdiCSS}{$tinySliderCSS}{$swiperCSS}{$customCSS}{$colorsCSS}</style>";
        $this->Cadastro = "{$styles}{$Cadastro}";
    }
    public function load() {
        try {
            $pessoas = Usuarios::GetUserTable();
            $items = '';
        foreach ($pessoas as $pessoa) {
            $item = file_get_contents('./html/ItemsUsuario.html');
            $item = str_replace('{cod_user}', $pessoa['cod_user'], $item);
            $item = str_replace('{login}', $pessoa['login'], $item);
            $item = str_replace('{password}', $pessoa['password'], $item);
            $items.= $item;
            }
            $this->List = str_replace('{items}', $items, $this->List);
        }
        catch (Exception $e) {
        print $e->getMessage();
    }
}

        public function loadFormCadastro() {
            $this->Cadastro = str_replace('{cod_user}', $this->data['cod_user'], $this->Cadastro);
            $this->Cadastro = str_replace('{login}', $this->data['login'], $this->Cadastro);
            $this->Cadastro = str_replace('{password}', $this->data['password'], $this->Cadastro);
            }
            
            public function save($param) {
                try {
                
                $this->data = Usuarios::CadastroUsuario($param);

                header("Location: index.php?class=Dashboard&method=CreateUser");

                
                }
                catch (Exception $e) {
                print $e->getMessage();
                }
            }
            public static function delete($param) {
                try {
                $cod_user = (int) $param['cod_user'];
                usuarios::delete($cod_user);
                header("Location: index.php?class=Dashboard&method=CreateUser");

                }
                catch (Exception $e) {
                print $e->getMessage();
                }
                }

                public function editarUsuario($param) {
                    try {
                        $cod_user = (int) $param['cod_user'];
                        $pessoa = Usuarios::find($cod_user);
                        $this->data = $pessoa;
                    }
                    catch (Exception $e) {
                    print $e->getMessage();
                        }
            }

    public function show() {
        $this->load();
        $this->loadFormCadastro();
        print $this->Cadastro;
        print $this->List;

    }


}