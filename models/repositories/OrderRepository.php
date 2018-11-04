<?php
namespace app\models\repositories;

use app\models\Order;

class OrderRepository extends Repository{

  public function getTableName(){
    return 'orders';
  }

  public function getEntityClass(){
    return Order::class;
  }

  public function getOrderListByUserId($id){
      $table = $this->getTableName();
      $sql = "SELECT * FROM {$table} WHERE buyerId = :buyerId";
      return static::getDb()->queryAll($sql, [':buyerId' => $id]);
  }

  public function createOrderFromCart($id){

    // добавление корзины в таблицу заказ-покупатель - статус заказа 0-новый 
    $sql = "INSERT INTO orders (buyerId, tovId, quantity) 
    SELECT '$id', tovId, SUM(quantity) 
    FROM cart 
    GROUP BY tovId;";
    static::getDb()->execute($sql);

    // очистка корзины
    $sql = "DELETE FROM cart;";
    static::getDb()->execute($sql);

   }

  public function delOrderById($id){
      $table = $this->getTableName();
      $sql = "DELETE FROM {$table} WHERE buyerId = :buyerId ";
      static::getDb()->execute($sql, [':buyerId' => $id]);
  }

}
