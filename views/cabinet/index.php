<?php include ROOT.'/views/layouts/header.php'; ?>

<head>
	<title>Личный кабинет</title>
</head>
<div class="center-block-main clearfix">
	<main class="cabinet">
		<h1>Кабинет пользователя</h1>
		<h3>Привет: <?php echo $user['name']; ?></h3>

		<a href="/cabinet/edit">Редактировать данные</a>
		<br><br>

		
		<?php if ($orderList): ?>
			<h3>Ваши заказы:</h3>
			<br>
				<?php foreach($orderList as $order): ?>
					
					<!-- Декодируем Json тип -->
					<?php $productsQuantity = json_decode($order['products'], true); ?>
					<!-- Берем идентификаторы товаров -->
					<?php $productsIds = array_keys($productsQuantity); ?>
					<!-- Ищем продукты по идентификатору и записываем в products -->
					<?php $products = Product::getProductsByIds($productsIds); ?>
					<h3>Заказ № <?php echo $order['id']; ?></h3>
					<h4>Информация о заказе</h4>
					<table class="cabinet-info-oreder">
						<tr>
							<td>Дата заказа:</td>
							<td><?php echo $order['date']; ?></td>
						</tr>
						<tr>
							<td>Статус заказа:</td>
							<td><?php echo $order['status'];?></td>
						</tr>
					</table>

					<h4>Товары в заказе</h4>

						<table>
							<tr>
								<th>Артикул товара</th>
								<th>Название</th>
								<th>Цена</th>
								<th>Количество</th>
							</tr>
							<?php foreach ($products as $product): ?>
								<tr>
									<td><?php echo $product['code']; ?></td>
									<td><a href="/product/<?php echo $product['id'];?>" target="_blank"><?php echo $product['name']; ?></a></td>
									<td><?php echo $product['price']; ?> руб.</td>
									<td><?php echo $productsQuantity[$product['id']]; ?></td>
								</tr>
							<?php endforeach; ?>
						</table>
					<br>
					<hr>
				<?php endforeach; ?>
			<?php else: ?>
				<h3>Вы еще ничего не заказывали</h3>
			<?php endif; ?>

	</main>

</div>
</div>
<?php include ROOT.'/views/layouts/footer.php'; ?>
