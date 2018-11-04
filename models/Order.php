<?php
namespace app\models;

Class Order extends DataEntity{
  
  public $id;
  public $buyerId;
  public $tovId;
  public $quantity;
  public $status;
}
