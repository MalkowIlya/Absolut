<?php include ROOT.'/views/layouts/header.php'; ?>
<head>
	 <title>Авторизация</title>
</head>
<div class="center-block-main clearfix">
	<main class="login">
		<?php if (isset($errors) && is_array($errors)): ?>
			<ul>
				<?php foreach ($errors as $error): ?>
					<li> - <?php echo $error; ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<h2>Вход</h2>
		<form action="" method="post">
			<h3>E-mail</h3>
			<input type="email" name="email" placeholder="E-mail" value="<?php echo $email; ?>">
			<h3>Пароль</h3>
			<input type="password" name="password" placeholder="Пароль" value="<?php echo $password; ?>">
			<button type="submit" name="submit">Войти</button>
		</form>
		<p><a href="/user/register">Регистрация</a>, если у вас еще нет учетной записи</p>

	</main>

</div>
</div>


<?php include ROOT.'/views/layouts/footer.php'; ?>
</div>