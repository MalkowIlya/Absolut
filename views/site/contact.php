<?php include ROOT.'/views/layouts/header.php'; ?>
<head>
	 <title>Контакты</title>
</head>

<div class="center-block-main clearfix">
	<div class="site-contact">
	<h2>Контакты</h2>
		<div class="site-contact-left">
			<p><span>Адрес: </span>Санкт-Петербург, ул. Бухарестская, д.118, к.1, пом. 70Н</p>
			<br>
			<p><span>Телефон: </span>(812) 453-33-34 или +7(981)745-90-50</p>
			<br>
			<p><span>Факс: </span>(812) 453-30-53</p>
			<br>
			<p><span>E-mail: </span>admgf@yandex.ru</p>
		</div>

		<div class="site-contact-right">
			<iframe src="https://yandex.ru/map-widget/v1/-/CBQ5RWqjcB" frameborder="0"></iframe>
		</div>

		<div class="clearfix"></div>

		<?php if ($result): ?>
			<p>Сообщение отправлено, мы скоро вам ответим.</p>
		<?php else: ?>

			<?php if (isset($errors) && is_array($errors)): ?>
				<ul>
					<?php foreach ($errors as $error): ?>
						<li> - <?php echo $error; ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<h2>Обратная связь</h2>
			<h5>У вас есть вопрос? Напишите нам</h5>
			<br>
			<form action="#" method="post">
				<p>Ваш Email</p>
				<input type="email" name="userEmail" placeholder="E-mail" value="<?php echo $userEmail; ?>">
				<p>Ваше сообщение</p>
				<input type="text" name="userText" placeholder="Сообщение" value="<?php echo $userText; ?>">
				<br>
				<button type="submit" name="submit" class="btn btn-default" value="Отправить">Отправить</button>
			</form>

		</div>

	<?php endif; ?>

</div>


</div>
<?php include ROOT.'/views/layouts/footer.php'; ?>