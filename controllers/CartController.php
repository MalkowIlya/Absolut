<?php

class CartController
{

	public function actionAdd($id)
	{   
    //Добавляем товар в корзину
		Cart::addProduct($id);

    //Возвращаем пользователя на страницу
		$referrer = $_SERVER['HTTP_REFERER'];
		header("Location: $referrer");
	}

	public function actionAddAjax($id)
	{
    //Добавляем товар в корзину
		echo Cart::addProduct($id);
		return true;
	}


	//Удаление записи из корзины
	public function actionDelete($id)
	{
		// Удаляем заданный товар из корзины целиком
		Cart::deleteProduct($id);
		
		//Возвращение пользователя на страницу
		header("Location: /cart");
	}


	//Удаление записи из корзины
	public function actionDeleteone($id)
	{
		// Удаляем заданный товар из корзины
		Cart::deleteoneProduct($id);
		
		//Возвращение пользователя на страницу
		header("Location: /cart");
	}


	public function actionAddone($id)
	{
		// Добавляем заданный товар в корзину
		Cart::addoneProduct($id);
		
		//Возвращение пользователя на страницу
		header("Location: /cart");
	}


	public function actionIndex()
	{
		$categories = array();
		$categories = Category::getCategoriesList();

		$productsInCart = false;

		//Получаем данные из корзины
		$productsInCart = Cart::getProducts();

		if ($productsInCart) {
			//Получаем полную информацию о товарах из списка
			$productsIds = array_keys($productsInCart);
			$products = Product::getProductsByIds($productsIds);

			//Получаем общую стоимость товаров
			$totalPrice = Cart::getTotalPrice($products);
		}

		require_once(ROOT.'/views/cart/index.php');

		return true;
	}

	public function actionCheckout()
	{
		//Список категорий для левого меню
		$categories = array();
		$categories = Category::getCategoriesList();

		//Статус успешного оформления заказа
		$result = false;

		//Форма отправлена?
		if (isset ($_POST['submit'])) {
			//Форма отправлена - Да

			//Считываем данные формы
			$userName = $_POST['userName'];
			$userPhone = $_POST['userPhone'];
			$userComment = $_POST['userComment'];

			//Валидация полей
			$errors = false;

			if (!User::checkName($userName))
				$errors[] = 'Проверьте имя';
			if (!User::checkPhone($userPhone))
				$errors[] = 'Проверьте номер телефона';

			//Форма отправлена корректно?
			if ($errors == false) {
				//Форма заполнена корректно? - Да
				//Сохраняем заказ в базе данных

				//Собираем информацию о заказе
				$productsInCart = Cart::getProducts();
				if (User::isGuest()) {
					$userId = false;
				} else {
					$userId = User::checkLogged();
				}

				//Сохраняем заказ в БД
				$result = Order::save($userName, $userPhone, $userComment, $userId, $productsInCart);

				if ($result) {
					//Оповещаем администратора о новом заказе
					$adminEmail = 'malkow_ilya1@mail.ru';
					$message = 'http://absolut.ru/admin/orders';
					$subject = 'Новый заказ';
					mail($message, $subject, $message);

					//Очищаем корзмну
					Cart::clear();
				}
			} else {
				//Форма отправлена корректно? - Нет

				//Итоги, общая стоимость, колличество товаов
				$productsInCart = Cart::getProducts();
				$productsIds = array_keys($productsInCart);
				$products = Product::getProductsByIds($productsIds);
				$totalPrice = Cart::getTotalPrice($products);
				$totalQuantity = Cart::countItems();
			}
		} else {
			//Форма отправлена? - Нет

			//Получаем данные из корзины
			$productsInCart = Cart::getProducts();

			//В корзине есть товары?
			if ($productsInCart == false) {
				//В корзине есть товары? - Нет
				//Отправляем пользователя на главную страницу

				header("Location: /");
			} else {
				//В корзине есть товары? - Да

				//Итоги: общая стоимость, колличество товаров
				$productsIds = array_keys($productsInCart);
				$products = Product::getProductsByIds($productsIds);
				$totalPrice = Cart::getTotalPrice($products);
				$totalQuantity = Cart::countItems();

				$userName = false;
				$userPhone = false;
				$userComment = false;

				//Пользователь авторизован?
				if (User::isGuest()) {
					//Пользователь авторизован? - Нет
					//Форма остается пустой
				} else {
					//Пользователь авторизован? - Да
					//Получаем информацию о пользователе из базы данных по Id
					$userId = User::checkLogged();
					$user = User::getUserById($userId);
					//Подставляем данные пользователя в форму
					$userName = $user['name'];
					$userPhone = $user['phone_number'];
				}
			}
		}

		require_once(ROOT.'/views/cart/checkout.php');

		return true;
	}

}
