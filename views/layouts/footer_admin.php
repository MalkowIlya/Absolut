<footer>
			<div class="ftr center-block-main clearfix">
				<p>© 2017 ЗАО "Абсолют"</p>
			</div>
		</footer>
	</div>

	<!-- Прелоадер -->
	<!--<script>
		$(window).on('load', function () {
			$preloader = $('.loaderArea'),
			$loader = $preloader.find('.loader');
			$loader.fadeOut();
			$preloader.delay(350).fadeOut('slow');
		});
	</script>-->


	<!-- Высота колонок одинаковая -->
	<script>
		function setEqualHeight(columns) { 
			var tallestcolumn = 0; 
			columns.each( function() { 
				currentHeight = $(this).height(); 
				if(currentHeight > tallestcolumn) { tallestcolumn = currentHeight; } } ); 
			columns.height(tallestcolumn); 
		} 

		$(document).ready(function() { setEqualHeight($(".block4-main-content-text")); });

		$(document).ready(function() { setEqualHeight($(".block-last-content-text")); });

		$(document).ready(function() { setEqualHeight($(".content-tovar")); });
	</script>

	<!-- Меню -->
	<script>
		$('.show-menu').click(function () {
			if ($('.mobile-menu').is(':visible'))
				$('.mobile-menu').hide();
			else
				$('.mobile-menu').show();
		});

		window.onresize = function (event) {
			$('.mobileMenu').hide ();
		};
	</script>
	
<!-- Добавление товара в корзину -->
<script>
	$(document).ready(function(){
		$(".add-to-cart").click(function (){
			var id = $(this).attr("data-id");
			$.post("/cart/addAjax/"+id, {}, function (data) {
				$("#cart-count").html(data);
			});
			return false;
		});
	});
</script>

<!-- Для отображения пути файла под кнопкой выгрузки картинки -->
<script>
$(document).ready( function() {
    $(".file-upload input[type=file]").change(function(){
         var filename = $(this).val().replace(/.*\\/, "");
         $("#filename").val(filename);
    });
});
</script>

</body>
</html>