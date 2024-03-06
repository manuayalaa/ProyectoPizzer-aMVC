<?php
namespace App\Controllers;
class IndexController extends BaseController
{
    public function indexAction()
    {
        $this->renderHTML('../app/Views/index_view.php');
    }
    public function bebidaAction()
    {
        $this->renderHTML('../app/Views/bebidas_view.php');
    }
    
    public function postresAction()
    {
        $this->renderHTML('../app/Views/postres_view.php');
    }
    public function cerrarsesionAction()
    {
        $this->renderHTML('../app/Views/cierresesion_view.php');
    }

    public function carritoAction()
    {
        $this->renderHTML('../app/Views/carrito_view.php');
    }
    public function loginAction()
    {
        $this->renderHTML('../app/Views/login_view.php');
    }
    public function gestioncomandasAction()
    {
        $this->renderHTML('../app/Views/gestioncomandas_view.php');
    }
    public function cerrarSesionComandasAction()
    {
        $this->renderHTML('../app/Views/cierresesioncomandas_view.php');
    }
}