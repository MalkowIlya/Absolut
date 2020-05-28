<?php include ROOT.'/views/layouts/header.php'; ?>
<head>
	<title>Изменение данных</title>
</head>
<div class="center-block-main clearfix">
	<main class="login">
		<?php if($result): ?>
			<p>Данные отредактированны</p>
		<?php else: ?>
			<?php if (isset($errors) && is_array($errors)): ?>
				<ul>
					<?php foreach ($errors as $error): ?>
						<li> - <?php echo $error; ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<h2>Редактировать данные</h2>
			<form action="#" method="post">
				<h3>Имя</h3>
				<input type="text" name="name" placeholder="Имя" value="<?php echo $name; ?>">
				<h3>Пароль</h3>
				<input type="password" name="password" placeholder="Пароль" value="<?php echo $password; ?>">
				<h3>Номер телефона</h3>
				<input type="text" name="phone" placeholder="Телефон" value="<?php echo $phone; ?>">
				<button type="submit" name="submit">Сохранить</button>
			</form>

		<?php endif; ?>
	</main>

</div>
</div>

<?php include ROOT.'/views/layouts/footer.php'; ?>
</div>