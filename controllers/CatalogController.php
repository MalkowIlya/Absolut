<?php

include_once ROOT.'/models/Category.php';
include_once ROOT.'/models/Product.php';
include_once ROOT.'/components/Pagination.php';

class CatalogController
{

	public function actionIndex()
	{  
		//Список категорий для левого меню
		$categories = array();
		$categories = Category::getCategoriesList();

		//Список последних товаров
		$latestProduct = array();
		$latestProduct = Product::getLatestProducts(9); 

		//Список товаров для слайдера
		$sliderProducts = Product::getRecommendedProducts();

		require_once(ROOT . '/views/catalog/index.php');

		return true;
	}

	public function actionCategory($categoryId, $page = 1, $type_sort = 0)
	{
		//Список категорий для левого меню
		$categories = array();
		$categories = Category::getCategoriesList();

		//Проверка селектора, на то какая сортировка выбрана
		/*if (isset($_POST['sort'])) {
			$type_sort = $_POST['sort'];
			echo "<script> alert('".$type_sort."')</script>";
			//header ('Location: /category/'.$categoryId);
		}*/

		if (isset($_SESSION['type_sort'])) {
			$type_sort = $_SESSION['type_sort'];
			//echo "<script> alert('".$_SESSION['type_sort']."')</script>";
			
		}



		$categoryProduct = array();
		$categoryProduct = Product::getProductListByCategory($categoryId, $page);

		$total = Product::getTotalProductInCategory($categoryId);

		//Создаем объект Pagination для постраничной навигации
		$pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

		if (isset($_POST['sort'])) {
			header ('Location: /category/'.$categoryId.'/page-'.$page);
		}

		require_once(ROOT . '/views/catalog/category.php');

		return true;
	}

}
