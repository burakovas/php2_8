<?php
namespace app\models\repositories;

use app\models\Users;

class UsersRepository extends Repository{

  public function getTableName(){
    return 'users';
  }

  public function getEntityClass(){
    return Users::class;
  }

  public function getUserId($user, $password){
      $table = $this->getTableName();
      $sql = "SELECT * FROM {$table} WHERE user = :user AND password = :password";
      return static::getDb()->queryOne($sql, [':user' => $user, ':password' => $password]);
  }

  public function getUserNameById($id){
    $table = $this->getTableName();
    $sql = "SELECT * FROM {$table} WHERE id = :id";
    return static::getDb()->queryOne($sql, [':id' => $id])['userName'];

}

}
