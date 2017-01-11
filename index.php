<?php

	session_start();

	require_once("controllers/controllers.php");
 	$mvc = new controller();
    $_SESSION['filter'] = "all";

 	if(($_SESSION["session_username"])=="") {
 		if(isset($_POST['register'])){
			$mvc->validateRegisterController();
		}
		else if(isset($_POST['login'])){
			$mvc->validateLogueoController();
		}
		else if(isset($_POST['add'])){
            $id=intval($_GET['id']);
            $mvc->addToCart($id,$_SESSION['filter']);
        }
		else if(isset($_GET['action'])){
			if($_GET['action'] == 'linkRegister'){
				$mvc->registerPage();
			}
			if ($_GET['action'] == 'linkLogin'){
                $mvc->loginPage();
			}
			if ($_GET['action'] == 'coffees'||$_GET['action'] == 'addlist'){
                $_SESSION['product'] = "coffees";
                $mvc->filterCoffee($_SESSION['filter']);
            }
            if ($_GET['action'] == 'articles') {
                $_SESSION['product'] = "articles";
                $mvc->showArticles();
            }
            if ($_GET['action'] == 'filterCoffee'){
                $_SESSION['filter']=$_GET['id'];
                $mvc->filterCoffee($_SESSION['filter']);
            }
            if ($_GET['action'] == 'emptyCart') {
                $mvc->deleteProducts();
            }
		}
		else{
			$mvc->init();
		}

	}
	else{
		if($_SESSION['session_role'] == 'admin'){

			if(isset($_POST['saveCoffee'])){
				$mvc->updateProfileManager("coffee");
			}
			else if(isset($_POST['saveArticle'])){
                $mvc->updateProfileManager("article");
            }
            else if(isset($_POST['saveProducer'])){
                $mvc->updateProfileManager("producer");
            }
			else if(isset($_GET['action'])){
                if($_GET['action'] == 'profileUpdate'){
                    $mvc->managerProfile();
                }
                if ($_GET['action'] == 'coffees'){
                    $_SESSION['product'] = "coffees";
                    $mvc->filterCoffee($_SESSION['filter']);
                }
                if ($_GET['action'] == 'filterCoffee'){
                    $_SESSION['filter']=$_GET['id'];
                    $mvc->filterCoffee($_SESSION['filter']);
                }
                if ($_GET['action'] == 'articles') {
                    $_SESSION['product'] = "articles";
                    $mvc->showArticles();
                }
                if ($_GET['action'] == 'logout'){
                    $mvc->logoutController();
                }
			}
			else{
				$mvc->initLogin();
			}
		}

		else if($_SESSION['session_role'] == 'cliente'){
		if(isset($_POST['add'])){
            $id=intval($_GET['id']);
            $mvc->addToCart($id,$_SESSION['filter']);
		}
		else if(isset($_POST['saveProfile'])){
			$mvc->updateProfileClient("profile");
		}
        else if(isset($_POST['saveSub1'])){
            $mvc->updateSub();
        }
        else if(isset($_POST['changePassword'])){
            $mvc->updateProfileClient("password");
        }
        else if(isset($_GET['action'])){
            if($_GET['action'] == 'profileUpdate'){
                $mvc->clientProfile();
            }
            if ($_GET['action'] == 'purchaseNow'){
                $mvc->purchaseAll();
            }
            if ($_GET['action'] == 'coffees'){
                $_SESSION['product'] = "coffees";
                $mvc->filterCoffee($_SESSION['filter']);
            }
            if ($_GET['action'] == 'addlist'){
                $id=$_GET['id'];
                $mvc->addWishedCoffee($id);
                header("location:index.php?action=coffees");
            }
            if ($_GET['action'] == 'delete'){
                $id=$_GET['id'];
                $mvc->deleteFromWishlist($id);
                header("location:index.php?action=profileUpdate");
            }
            if ($_GET['action'] == 'articles') {
                $_SESSION['product'] = "articles";
                $mvc->showArticles();
            }
            if ($_GET['action'] == 'filterCoffee'){
                $_SESSION['filter']=$_GET['id'];
                $mvc->filterCoffee($_SESSION['filter']);
            }
            if ($_GET['action'] == 'emptyCart') {
                $mvc->deleteProducts();
            }
            if ($_GET['action'] == 'logout'){
                $mvc->logoutController();
            }
        }
		else{
			$mvc->initLogin();
		}

		}


	}
?>

