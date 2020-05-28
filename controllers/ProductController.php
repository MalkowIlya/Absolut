<?php

include_once ROOT.'/models/Category.php';
include_once ROOT.'/models/Product.php';

class ProductController
{

	public function actionView($productId)
	{  
		$categories = array();
		$categories = Category::getCategoriesList();

		$product = Product::getProductById($productId);

		$commentAll = Comment::getComment($productId);

		/*foreach($commentAll as $comment) {
			$id = $comment['id'];
		};*/

		$options = array();
		//Добавление комментария
		if (!User::isGuest()) {
			//Обработка формы
			if (isset($_POST['send_comment'])) {
				//Если форма отправлена
				//Получаем данные из формы
				$options['text_comment'] = $_POST['text_comment'];
				$options['user_id'] = $_SESSION['user'];
				$options['id_product'] = $productId;

				//Оибки в форме
				$errors = false;

				//Валидация комментария
				if (Comment::checkMinComment($options['text_comment'])) {
					$errors[] = 'Комментарий должен быть больше 5 символов';
				}
				if (Comment::checkMaxComment($options['text_comment'])) {
					$errors[] = 'Комментарий должен быть меньше 450 символов';
				}

				if ($errors == false) {
				//Если ошибок нет
				//Добавляем новый комментарий
					$id = Comment::createComment($options);

					//Обновляем страницу, что бы избежать повторной отправки формы
					header ('Location: /product/'.$options['id_product']);
				}
			}
		}

		//Удаление комментария
		if(isset($_POST['delete'])) {

			//Если кнопка нажата
			//Удаляем комментарий
			$id_comment = (int)$_POST['delete'];
			Comment::deleteCommentById($id_comment);

			//Обновляем страницу, что бы избежать повторной отправки формы
			header ('Location: /product/'.$productId);
		}

		//Добавление в корзину
		if (isset($_POST['add-to-cart'])) {
			$count_tov = $_POST['count-tov'];

			Cart::addToCartByProduct($productId, $count_tov);

			header ('Location: /product/'.$productId);
		}

		require_once(ROOT.'/views/product/view.php');

		return true;
	}


}
