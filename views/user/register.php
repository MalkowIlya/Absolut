<?php include ROOT.'/views/layouts/header.php'; ?>
<head>
	 <title>Регистраци</title>
</head>
<div class="center-block-main clearfix">
	<main class="login">
		<?php if($result): ?>
			<p>Вы зарегистрированы</p>
		<?php else: ?>
			<?php if (isset($errors) && is_array($errors)): ?>
				<ul>
					<?php foreach ($errors as $error): ?>
						<li> - <?php echo $error; ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<h2>Регистрация на сайте</h2>
			<form action="#" method="post">
				<h3>Имя</h3>
				<input type="text" name="name" placeholder="Имя" value="<?php echo $name; ?>">
				<h3>E-mail</h3>
				<input type="email" name="email" placeholder="E-mail" value="<?php echo $email; ?>">
				<h3>Пароль</h3>
				<input type="password" name="password" placeholder="Пароль" value="<?php echo $password; ?>">
				<button type="submit" name="submit" value="Регистрация">Зарегистрироваться</button>
			</form>

		<?php endif; ?>
	</main>

</div>
</div>


<?php include ROOT.'/views/layouts/footer.php'; ?>
</div>