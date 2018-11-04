<div class="myCart" >
    <br><br><br>
    <a href="/order/add/">СОЗДАТЬ ЗАКАЗ ИЗ ТОВАРОВ В КОРЗИНЕ</a>

    <p>Это заказы пользователя №<?=$data[0]['buyerId']?></p>
    <p>Номер заказа <?=$data[0]['id']?></p>
    <a href="/order/del?id=<?=$data[0]['id']?>">УДАЛИТЬ ЗАКАЗЫ</a>
    <p>Состав заказа :</p>
    <?php foreach ($data as $order): ?>
      <p><?= $order['id'] ?> = <?= $order['tovId'] ?><span> = <?= $order['quantity'] ?></span></p>
    <?php endforeach; ?>
  </div>
