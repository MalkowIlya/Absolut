<?php

class CabinetController
{

	public function actionIndex()
	{   
		//Получаем id пользователя из сессии
		$userId = User::checkLogged();

		//Получаем информацию о пользователе из БД
		$user = User::getUserById($userId);

		//Получаем заказы пользователя для отображения
		$orderList = User::checkOrder($userId);

		//Получаем заказы пользователя, для товаров
		$orders = User::checkOrderById($userId);

		require_once(ROOT . '/views/cabinet/index.php');

		return true;
	}

	public function actionEdit()
	{
		//Получаем id пользователя из сесии
		$userId = User::checkLogged();

		//Получаем информацию о пользователе из БД
		$user = User::getUserByID($userId);

		$name = $user['name'];
		$password = $user['password'];
		$phone = $user['phone_number'];

		$result = false;

		if (isset($_POST['submit'])) {
			$name = $_POST['name'];
			$password = $_POST['password'];
			$phone_number = $_POST['phone'];

			$errors = false;

			
			if (!User::checkName($name)) {
				$errors[] = 'Имя не должно быть короче 2-х символов';
			}

			if (!User::checkPassword($password)) {
				$errors[] = 'Пароль не должен быть короче 6-ти символов';
			}

			if (!User::checkPhone($phone_number)) {
				$errors[] = 'Телефон не должен быть короче 7-ми символов';
			}

			if ($errors == false) {
				//Записать новго пользователя в базу данных
				$result = User::edit($userId, $name, $password, $phone_number);
			}
		}

		require_once(ROOT . '/views/cabinet/edit.php');

		return true;
	}

}
