<?php
namespace app\controllers;

use app\models\repositories\OrderRepository;
use app\services\Request;

class OrderController extends Controller{

  protected $action;
  protected $defaultAction = "index";
  protected $layout = "main";
  protected $useLayout = true;

  public function actionIndex(){
    session_start();
    $id = $_SESSION['user_id'];
    $data = (new OrderRepository())->getOrderListByUserId($id);
    echo $this->render("order", ['data' => $data]);
  }

  public function actionAdd(){
    session_start();
    $id = $_SESSION['user_id'];
    $data = (new OrderRepository())->createOrderFromCart($id);
    $this->actionIndex();
  }

  public function actionDel(){
    session_start();
    $id = $_SESSION['user_id'];
    (new OrderRepository())->delOrderById($id);
    $this->actionIndex();
  }
}
