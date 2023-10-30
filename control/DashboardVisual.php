<?php

require_once './control/Connection.php';
require_once './control/Usuarios.php';
require_once './control/UsuariosLogin.php';


class DashboardVisual {

    public $List;
    public $Cadastro;
    private $items;
    private $data;
    private $teste;




            public function PuxarDashboard() {
                $cadastroListagemUsuario = new Dashboard();
                $this->teste = $cadastroListagemUsuario->show();
            }

    public function show() {
    $this->PuxarDashboard();

    $conteudo = '<div style="display: flex; flex-direction: column;">';
    $conteudo .= $this->teste;   
    $conteudo .= '</div>';

    print $conteudo;
}
}