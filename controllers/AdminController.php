<?php

class AdminController extends AdminBase
{
	//Action для стартовой страницы Панели администратора
	public function actionIndex()
	{   
		//Проверка прав доступа
		self::checkAdmin();

		//Подключаем вид
		require_once(ROOT.'/views/admin/index.php');
		return true;
	}

}
