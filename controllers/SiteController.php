<?php

include_once ROOT.'/models/Category.php';
include_once ROOT.'/models/Product.php';

class SiteController
{

	//Главная страница
	public function actionIndex()
	{   
		$categories = array();
		$categories = Category::getCategoriesList();

		$latestProduct = array();
		$latestProduct = Product::getLatestProducts(3); 

		require_once(ROOT . '/views/site/index.php');
  	//echo "<br>SiteController actionIndex";
		return true;
	}

	//Страница с контактами
	public static function actionContact()
	{	

		//Пользователь авторизован?
		if (User::isGuest()) {
			//Пользователь авторизован? - Нет
			//Форма остается пустой
			$userEmail = '';
		} else {
			//Пользователь авторизован? - Да
			//Получаем информацию о пользователе из базы данных по Id
			$userId = User::checkLogged();
			$user = User::getUserById($userId);
			//Подставляем данные пользователя в форму
			$userEmail = $user['email'];
		}

		$userText = '';
		$result = false;

		if(isset($_POST['submit'])) {

			$userEmail = $_POST['userEmail'];
			$userText = $_POST['userText'];

			$errors = false;

			//Валидация полей
			if (!User::checkEmail($userEmail)) {
				$errors[] = 'Проверьте ваш Email';
			}

			if ($errors == false) {
				$to = "malkow_ilya1@mail.ru";
				$from = $userEmail;
				$subject = "Контактная форма";
				$message = "Текст: {$userText}. От {$userEmail}";
				mail($to, $subject, $message);
				$result = true;
			}
		}

		require_once(ROOT . '/views/site/contact.php');
		return true;
	}

	//Страница о компании
	public function actionAbout()
	{   
		require_once(ROOT . '/views/site/about.php');
		return true;
	}

	//Страница с лицензиями
	public function actionLicense()
	{   
		require_once(ROOT . '/views/site/license.php');
		return true;
	}

	//Страница с реквизитами
	public function actionRequisites()
	{   
		require_once(ROOT . '/views/site/requisites.php');
		return true;
	}

	//Страница с калькулятором
	public function actionCalculator()
	{
		require_once(ROOT .'/views/site/calculator.php');
		return true;
	}

}
