<?php
namespace app\controllers;

use app\base\App;
use app\models\repositories\UsersRepository;
use app\services\Request;

class UsersController extends Controller{

  protected $action;
  protected $defaultAction = "index";
  protected $layout = "main";
  protected $useLayout = true;

  public function actionIndex(){

    session_start();

    if($_SERVER['REQUEST_METHOD'] == "POST"){
      $id = null;
      $params = App::call()->request->getParams();
      $user = $params['post']['user'];
      $password =$params['post']['password'];
        ini_set("display_errors", 1); // выключение notice
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
      $id = (new UsersRepository())->getUserId($user, $password)['id'];
      if (!is_null($id)){
        $_SESSION['user_id'] = $id;
        //успешная авторизация
        echo (new UsersRepository())->getUserNameById($id);
        header('Location: /order/');
      } else {
        echo "Ошибка!!! введите логин и пароль";
        echo $this->render("login");
      }
    } elseif (isset($_SESSION['user_id'])){
      echo "открыты заказы клиента ";
      echo (new UsersRepository())->getUserNameById($_SESSION['user_id']);
      header('Location: /order/');
      } else {
        echo "введите логин и пароль : ";
        echo $this->render("login");
    }
  }

  public function actionLogout(){
    session_start();
    unset($_SESSION['user_id']);
    echo $this->render("login");
  }

}
