<?php

return array( 

	//Управление блогом
	'admin/blog/create' => 'adminBlog/create',
	'admin/blog/update/([0-9]+)' => 'adminBlog/update/$1',
	'admin/blog/delete/([0-9]+)' => 'adminBlog/delete/$1',
	'admin/blog' => 'adminBlog/index',

	//Товар
	'product/([0-9]+)' => 'product/view/$1', //actionView в ProductController
	//Каталог
	'catalog' => 'catalog/index', //actionIndex в CatalogController
	//Категории товаров
	'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', //actionCategory в CatalogController 
	'category/([0-9]+)' => 'catalog/category/$1', //actionCategory в CatalogController

	//Блог
	'blog/post/([0-9]+)' => 'blog/view/$1', //actionView в BlogController
	'blog' => 'blog/index', //actionIndex в BlogController

	//Карзина
	'cart/checkout' => 'cart/checkout', //actionCheckout в cartController

	'cart/delete/([0-9]+)' => 'cart/delete/$1',
	'cart/deleteone/([0-9]+)' => 'cart/deleteone/$1',
	'cart/addone/([0-9]+)' => 'cart/addone/$1',

	'cart/add/([0-9]+)' => 'cart/add/$1', //actionAdd в CartController
	'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1', //actionAdd в CartController
	'cart' => 'cart/index', //actionIndex в CartController

	//Пользователь
	'user/register' => 'user/register',
	'user/login' => 'user/login',
	'user/logout' => 'user/logout',
	'cabinet/edit' => 'cabinet/edit',
	'cabinet' => 'cabinet/index',

	//Управление товарами
	'admin/product/create' => 'adminProduct/create',
	'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
	'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
	'admin/product' => 'adminProduct/index',

	//Управление категориями
	'admin/category/create' => 'adminCategory/create',
	'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
	'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
	'admin/category' => 'adminCategory/index',

	//Управление заказами:    
	'admin/order/update/([0-9]+)' => 'adminOrder/update/$1',
	'admin/order/delete/([0-9]+)' => 'adminOrder/delete/$1',
	'admin/order/view/([0-9]+)' => 'adminOrder/view/$1',
	'admin/order' => 'adminOrder/index',

	//О магазине
	'calc' => 'site/calculator',
	'contacts' => 'site/contact',
	'about' => 'site/about',
	'license' => 'site/license',
	'requisites' => 'site/requisites',

	//Админпанель
	'admin' => 'admin/index',

	//Главная страница
	'' => 'site/index', //actionIndex в SiteController
	);