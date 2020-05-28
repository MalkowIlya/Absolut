<?php

//Управление закаазми в панели администратора
class AdminOrderController extends AdminBase
{

	//Action для страницы управление заказами
	public function actionIndex()
	{   
		//Проверка прав доступа
		self::checkAdmin();

		//Получаем список категорий
		$ordersList = Order::getOrdersList();

		//Подключаем вид
		require_once(ROOT.'/views/admin_order/index.php');
		return true;
	}

	
	//Action для страницы редактировать заказ
	public function actionUpdate($id)
	{
		//Проверка прав доступа
		self::checkAdmin();

		//Получаем данные о конкретном заказе
		$order = Order::getOrderById($id);

		//Обработка формы
		if (isset($_POST['submit'])) {
			//Если форма отправлена
			//Получаем данные из формы редактирования
			$userName = $_POST['userName'];
			$userPhone = $_POST['userPhone'];
			$userComment = $_POST['userComment'];
			$date = $_POST['date'];
			$status = $_POST['status'];
			
			//Сохраняем изменения
			Order::updateOrderById($id, $userName, $userPhone, $userComment, $date, $status);

			//Пернаправляем пользователя на страницу просмотра заказа
			header("Location: /admin/order/view/$id");
		}
		//Подключаем вид
		require_once(ROOT.'/views/admin_order/update.php');
		return true;	
	}

	//Action для страницы просмотр заказов
	public function actionView($id)
	{
   	// Проверка доступа
		self::checkAdmin();

    // Получаем данные о конкретном заказе
		$order = Order::getOrderById($id);

   	 // Получаем массив с идентификаторами и количеством заказов
		$productsQuantity = json_decode($order['products'], true);

  	// Получаем массив с индентификаторами заказов
		$productsIds = array_keys($productsQuantity);

   	 // Получаем список товаров в заказе
		$products = Product::getProductsByIds($productsIds);
    // Подключаем вид
		require_once(ROOT . '/views/admin_order/view.php');
		return true;
	}

	//Action для страницы удаления заказов
	public function actionDelete($id)
	{
		//Проверка прав доступа
		self::checkAdmin();

		//Обработка формы
		if(isset($_POST['submit'])) {
			//Если форма отправлена
			//Удаляем заказ
			Order::deleteOrderById($id);

			//Перенаправляем пользователя на страницу управления заказами
			header("Location: /admin/order");
		}

		//Подключаем вид
		require_once(ROOT.'/views/admin_order/delete.php');
		return true;
	}
}
