<?php

require_once('config/connection.php');
require_once('includes/register.php');
require_once('includes/products.php');
require_once('includes/purchase.php');
require_once('includes/clientProfile.php');
require_once('includes/managerProfile.php');
require_once('includes/logueo.php');
require_once('includes/logout.php');


class controller{

    function init(){
        $pagina=$this->load_template('VCO - Página Principal');
        $html2 = $this->load_page('view/options.php');
        $html3 = $this->load_page('view/home.php');
        $html4 = $this->load_page('view/smallLogin.php');
        $pagina = $this->replace_content('/\#OPCIONES\#/ms' ,$html2 , $pagina);
        $html3 = $this->replace_content('/\#LOGIN\#/ms' ,$html4 , $html3);
        $html3 = $this->replace_content('/\#POPUP\#/ms' ,$html4 , $html3);
        $html3 = $this->replace_content('/\#MODALHEADER\#/ms' ,"VCO - Café Colombiano" , $html3);
        $html3 = $this->replace_content('/\#MODALFOOTER\#/ms' ,"Inicia Sesión para continuar" , $html3);
        $pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,$html3 , $pagina);
        $this->view_page($pagina);
    }

    function registerPage(){
        $pagina=$this->load_template('VCO - Registro');
        $html = $this->load_page('view/register.php');
        $html2 = $this->load_page('view/optionsRegister.php');
        $pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,$html , $pagina);
        $pagina = $this->replace_content('/\#OPCIONES\#/ms' ,$html2 , $pagina);
        $this->view_page($pagina);
    }

    function validateRegisterController(){
        $responseRegister = new register();
        $pagina=$this->load_template('Pagina Principal MVC');
        $html = $this->load_page('view/register.php');
        ob_start();
        $tsArray = $responseRegister->validateRegister();
        if($tsArray!=''){
            include 'view/register.php';
            $table = ob_get_clean();
            $pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
            $html2 = $this->load_page('view/optionsRegister.php');
            $pagina = $this->replace_content('/\#OPCIONES\#/ms', $html2 , $pagina);
        }
        $this->view_page($pagina);
    }

    function loginPage(){
        $pagina=$this->load_template('VCO - Iniciar Sesión');
        $html = $this->load_page('view/logueo.php');
        $html2 = $this->load_page('view/optionsLogin.php');
        $pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,$html , $pagina);
        $pagina = $this->replace_content('/\#OPCIONES\#/ms' ,$html2 , $pagina);
        $this->view_page($pagina);
    }

    function validateLogueoController(){
        $responseLogueo = new logueo();

        ob_start();
        $tsArray = $responseLogueo->validateLogueo();
        if(($tsArray=="Todos los campos son requeridos!") || ($tsArray=="Nombre de usuario ó contraseña invalida!")){
            $pagina=$this->load_template('Pagina Principal');
            $html = $this->load_page('view/logueo.php');
            include 'view/logueo.php';
            $table = ob_get_clean();
            $pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
            $pagina = $this->replace_content('/\#OPCIONES\#/ms' ,"" , $pagina);
            $this->view_page($pagina);
        }
        else {
            $this->initLogin();
        }
    }

    function initLogin(){
        $responseProducts = new products();
        $tsArray = $responseProducts->latestCoffee();
        $pagina=$this->load_template('VCO - Página Principal');
        $html2 = $this->load_page('view/optionsClient.php');
        $sub = "<p>Si deseas modificar tu suscripción para acceder a más beneficios dirígete a la pestaña <b>Perfil->Suscripción</b> y diligencia el formulario</p>";
        if($_SESSION['session_role'] == 'admin')
            $html2 = $this->load_page('view/optionsAdmin.php');
        $pagina = $this->replace_content('/\#OPCIONES\#/ms' ,$html2 , $pagina);
        $html3 = $this->load_page('view/home.php');
        $html3 = $this->replace_content('/\#LOGIN\#/ms' ,$tsArray , $html3);
        $pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,$html3 , $pagina);
        $pagina = $this->replace_content('/\#POPUP\#/ms' ,$sub, $pagina);
        $pagina = $this->replace_content('/\#MODALHEADER\#/ms' ,"VCO - Café Colombiano" , $pagina);
        $pagina = $this->replace_content('/\#MODALFOOTER\#/ms' ,"Suscripciones" , $pagina);
        $this->view_page($pagina);
    }

    function reloadManager($page){
        $responseManager = new managerProfile();
        $responseProducts = new products();
        $producers = $responseManager->producers();
        $coffees = $responseManager->coffeesSold();
        $articles = $responseManager->articlesSold();
        $wishlist = $responseManager->wishlistTotal();
        $comments = $responseManager->commentsTotal();
        $monthly = $responseManager->monthlySales();
        $list = $responseManager->possibleSales();
        $newcof = $responseManager->newCoffees();
        $tradcof = $responseManager->tradCoffees();
        $releases = $responseManager->releases();
        $allProducers = $responseManager->allProducers();
        $coffeeModal = $responseProducts->coffeeDescrip();
        $html1 = $this->load_page('view/optionsAdmin.php');
        $page = $this->replace_content('/\#OPCIONES\#/ms' ,$html1 , $page);
        $page = $this->replace_content('/\#TOTALCAFES\#/ms' ,$coffees , $page);
        $page = $this->replace_content('/\#POSVENTAS\#/ms' ,$list , $page);
        $page = $this->replace_content('/\#TOTALARTICULOS\#/ms' ,$articles , $page);
        $page = $this->replace_content('/\#TOTALPOSVENTAS\#/ms' ,$wishlist , $page);
        $page = $this->replace_content('/\#TOTALCOMENTARIOS\#/ms' ,$comments , $page);
        $page = $this->replace_content('/\#PRODUCTORES\#/ms' ,$producers , $page);
        $page = $this->replace_content('/\#COLUMNAS\#/ms' ,$monthly , $page);
        $page = $this->replace_content('/\#NUEVOS\#/ms' ,$newcof , $page);
        $page = $this->replace_content('/\#TRADICIONALES\#/ms' ,$tradcof , $page);
        $page = $this->replace_content('/\#LANZAMIENTOS\#/ms' ,$releases , $page);
        $page = $this->replace_content('/\#PRODUCTOR_LISTA\#/ms' ,$allProducers , $page);
        $page = $this->replace_content('/\#MODALCOFFEES\#/ms' ,$coffeeModal , $page);
        return $page;
    }

    function managerProfile(){
        $pagina = $this->load_page('view/admin.php');
        $pagina = $this->reloadManager($pagina);
        $this->view_page($pagina);
    }

    function updateProfileManager($option){
        $responseManager = new managerProfile();
        $pagina = $this->load_page('view/admin.php');
        ob_start();
        $tsArray="";
        if ($option == "coffee")
            $tsArray = $responseManager->updateCoffee();
        if($option == "article")
            $tsArray = $responseManager->updateArticle();
        if($option == "producer")
            $tsArray = $responseManager->updateProducer();
        if ($tsArray != '') {
            include 'view/admin.php';
            $pagina = ob_get_clean();
            $pagina = $this->reloadManager($pagina);
        }
        $this->view_page($pagina);
    }

    function reloadClient($page){
        $responseClient = new clientProfile();
        $responseProducts = new products();
        $userName = $_SESSION['session_username'];
        $list = $responseClient->wishlistCoffees();
        $myCoffee = $responseClient->myCoffees();
        $depts = $responseClient->departments();
        $cities = $responseClient->cities();
        $coffeeModal = $responseProducts->coffeeDescrip();
        $html1 = $this->load_page('view/optionsClient.php');
        $page = $this->replace_content('/\#NOMBRE\#/ms' ,$userName , $page);
        $page = $this->replace_content('/\#DEPARTAMENTO\#/ms' ,$depts , $page);
        $page = $this->replace_content('/\#CIUDAD\#/ms' ,$cities, $page);
        $page = $this->replace_content('/\#XPROBAR\#/ms' ,$list , $page);
        $page = $this->replace_content('/\#PROBADOS\#/ms' ,$myCoffee , $page);
        $page = $this->replace_content('/\#OPCIONES\#/ms' ,$html1 , $page);
        $page = $this->replace_content('/\#MODALCOFFEES\#/ms' ,$coffeeModal , $page);
        return $page;
    }

    function clientProfile(){
        $pagina = $this->load_page('view/client.php');
        $pagina = $this->reloadClient($pagina);
        $this->view_page($pagina);
    }

    function updateProfileClient($option){
        $responseClient = new clientProfile();
        $pagina = $this->load_page('view/client.php');
        ob_start();
        $tsArray="";
        if ($option == "profile")
            $tsArray = $responseClient->updateProfile();
        if($option == "password")
            $tsArray = $responseClient->updatePassword();
        if ($tsArray != '') {
            include 'view/client.php';
            $pagina = ob_get_clean();
            $pagina = $this->reloadClient($pagina);
        }
        $this->view_page($pagina);
    }

    function updateSub(){
        $responseClient = new clientProfile();
        $pagina="";
        ob_start();
        $tsArray = $responseClient->updateSub();
        if ($tsArray != '') {
            include 'view/client.php';
            $pagina = ob_get_clean();
            $pagina = $this->reloadClient($pagina);
        }
        $this->view_page($pagina);
    }

    function reloadCart($page){
        $responseProducts = new products();

        $cart = $responseProducts->cartProduct();
        $total = $responseProducts->totalPrice();
        $items = $responseProducts->items();
        $header = "VCO - Café Colombiano";
        $opt = $this->load_page('view/options.php');
        $modal = $this->load_page('view/smallLogin.php');
        $footer = "Debes Iniciar Sesión para continuar";

        $page = $this->replace_content('/\#CARRITO\#/ms', $cart , $page);
        $page = $this->replace_content('/\#TOTAL\#/ms', $total , $page);
        $page = $this->replace_content('/\#NUM_ITEMS\#/ms', $items , $page);
        $page = $this->replace_content('/\#MODALHEADER\#/ms' ,$header , $page);

        if($_SESSION['session_role'] == 'cliente'){
            $responsePurchase = new purchase();
            $opt = $this->load_page('view/optionsClient.php');
            $modal = "<p>Haga clic en <b>'REALIZAR PEDIDO'</b> si desea hacer la compra</p>";
            $footer = "<div id=\"purchase\"><a href=\"index.php?action=purchaseNow\" target='_blank' style=\"color:#FFE4BA;\">REALIZAR PEDIDO</a></div>";
            if(!$responsePurchase->isSubscribed()){
                $modal = "<p>Si deseas modificar tu suscripción para acceder a más beneficios dirígete a la pestaña <b>Perfil->Suscripción</b> y diligencia el formulario</p>";
                $footer = "Perfil->Suscripción";
            }
            if($total==0){
                $modal = "<p>Su carrito está <b>Vacío</b></p>";
                $footer = "";
            }
        }
        if($_SESSION['session_role'] == 'admin')
            $opt = $this->load_page('view/optionsAdmin.php');

        $page = $this->replace_content('/\#OPCIONES\#/ms' ,$opt , $page);
        $page = $this->replace_content('/\#POPUP\#/ms' ,$modal , $page);
        $page = $this->replace_content('/\#MODALFOOTER\#/ms' ,$footer , $page);
        return $page;
    }

    function filterCoffee($filter){
        $responseProducts = new products();
        $html = $this->load_page('view/coffees.php');
        $tsArray = $responseProducts->filterCoffee($filter);
        $coffeeModal = $responseProducts->coffeeDescrip();

        $html = $this->replace_content('/\#CAFES\#/ms', $tsArray , $html);
        $html = $this->replace_content('/\#MODALCOFFEES\#/ms' ,$coffeeModal , $html);
        $html = $this->reloadCart($html);

        $this->view_page($html);
    }

    function showArticles(){
        $responseProducts = new products();
        $html = $this->load_page('view/articles.php');
        $tsArray = $responseProducts->showArticles();
        $articleModal = $responseProducts->articleDescrip();

        $html = $this->replace_content('/\#ARTICULOS\#/ms', $tsArray , $html);
        $html = $this->replace_content('/\#MODALPRODUCTS\#/ms' ,$articleModal , $html);
        $html = $this->reloadCart($html);

        $this->view_page($html);
    }

    function purchaseAll(){
        $responseProducts = new products();
        $total = $responseProducts->totalPrice();
        $responsePurchase = new purchase();
        $html = $this->load_page('view/purchasing.php');
        $message = $responsePurchase->purchaseCart();
        $footer = $responsePurchase->buttonBuy($total);
        $html = $this->replace_content('/\#POPUP\#/ms', $message , $html);
        $html = $this->replace_content('/\#FOOTER\#/ms' ,$footer , $html);

        $this->view_page($html);
    }

    function addToCart($id,$filter){
        $responseProducts = new products();
        $html="";
        if($_SESSION['product']=="coffees"){
            $filter_ = $responseProducts->filterCoffee($filter);
            $html = $this->load_page('view/coffees.php');
            $html = $this->replace_content('/\#CAFES\#/ms', $filter_, $html);
            $responseProducts->addToCart($id);
            header("Location:index.php?action=coffees");
        }
        if($_SESSION['product']=="articles"){
            $filter_ = $responseProducts->showArticles();
            $html = $this->load_page('view/articles.php');
            $html = $this->replace_content('/\#ARTICULOS\#/ms', $filter_, $html);
            $responseProducts->addToCartArticle($id);
            header("Location:index.php?action=articles");

        }


        $this->view_page($html);

    }

    function deleteProducts(){
        $responseProducts = new products();
        $responseProducts->emptyCart();
        if($_SESSION['product']=="articles")
            $this->showArticles();
        else
            $this->filterCoffee($_SESSION['filter']);
    }

    function addWishedCoffee($id){
        $responseClient = new clientProfile();
        $responseClient->addWishedCoffee($id);
    }

    function deleteFromWishlist($id){
        $responseClient = new clientProfile();
        $responseClient->deleteWishedCoffee($id);
    }

    function logoutController(){
        $responseLogout = new logout();
        $responseLogout->logoutSession();
        $this->init();
    }

    private function load_page($page){
        return file_get_contents($page);
    }

    private function view_page($html){
        echo $html;
    }

    private function replace_content($in='/\#CONTENIDO\#/ms', $out,$pagina){
        return preg_replace($in, $out, $pagina);
    }

    function load_template($title='Sin Titulo'){
        $pagina = $this->load_page('page.php');
        $pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);
        return $pagina;
    }

    function loadMessages($message='Response'){
        $pagina = $this->load_page('page.php');
        $pagina = $this->replace_content('/\#HEADER\#/ms', $message, $pagina);
        return $pagina;
    }
}

?>
