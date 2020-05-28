<?php include ROOT.'/views/layouts/header.php'; ?>
<head>
	 <title>Калькулятор</title>
</head>

<div class="center-block-main clearfix">
	<div class="calculator">
		<h2>Калькулятор расчета стоимости монтажа пожарной сигнализации</h2>
		<p>Площадь объекта</p>
		<input type="text" placeholder="Площадь объекта" id="place" value="" required="required">
		<p>Колличество помещений (кроме санузлов)</p>
		<input type="text" placeholder="Колличество помещений" id="numberRoom" value="" required="required">
		<p>Колличество выходов</p>
		<input type="text" placeholder="Колличество выходов" id="exit" value="" required="required">
		<br>
		<p>Высота потолка</p>
		<select id="heighted">
			<option value="min">до 3.5 м</option>
			<option value="mid">от 3.5 м до 6 м</option>
			<option value="max">Более 6 м</option>
		</select>
		<br>
		<button onClick="pojarniyAlert();">Рассчитать</button>
		<div id="rezFire"></div>
		<br>
		<br>

		<h2>Калькулятор расчета стоимости технического обслуживания пожарной сигнализации</h2>
		<p>Колличество извещателей (дымовые,тепловые, ручные)</p>
		<input type="text" placeholder="Колличество извещателей" id="kolSensor" value="" required>
		<p>Количество оповещателей (световые, звуковые, речевые)</p>
		<input type="text" placeholder="Колличество оповещателей" id="kolNotif" value="" required>
		<br>
		<p>Высота потолка</p>
		<select id="heighted2">
			<option value="min">до 3.5 м</option>
			<option value="mid">от 3.5 м до 6 м</option>
			<option value="max">Более 6 м</option>
		</select>
		<br>
		<button onClick="serviceFire();">Рассчитать</button>
		<div id="rezSerFire"></div>



	</div>

</div>

<script>
	function pojarniyAlert() {
		place  = document.getElementById('place').value;
		exit  = document.getElementById('exit').value;
		numberRoom  = document.getElementById('numberRoom').value;

		heighted  = document.getElementById('heighted').value;
		switch (heighted) {
		   case "min":
		      cena = 400;
		      break
		   case "mid":
		      cena = 450;
		      break   
		    case "max":
		      cena = 500;
		      break   
		   default:
		      cena = 400;
		      break
		}
		priceExit = exit * 1200;
		priceCabel = (4*(Math.sqrt(place)) * 50);
		priceCabel=Math.round(priceCabel);
		countSensor = 0;
		if (numberRoom >= 1) {
			countSensor = numberRoom;
		}
		countSensor2 = 0;
		//forCountSensor = place / numberRoom;
		while (place>55) {
			countSensor++;
			place-=55;

			if (numberRoom >= 1) {
				countSensor2++;
			}
			numberRoom--;
		}

		if (countSensor == 0) {
			result = (countSensor2 * cena) + priceExit +  priceCabel + 2500;
		} else {
			result = (countSensor * cena) + priceExit + priceCabel +2500;
		}
		
		//400 рублей 1 датчик
		//450 рублей
		//500 рублей

		//установка прибора любого 2.5к
		//прокладка гофры  40 рублей метра
		//прокладка кабеля  50 рублей метр затягивание кабеля
		document.getElementById('rezFire').innerHTML = '<h3 class="rezultCalc">Стоимость установки оборудования '+ result + " руб. </h3>"+ "<span>*Цена указана без учета стоимости оборудования</span>";
	}

	function serviceFire() {

		countSensor  = document.getElementById('kolSensor').value;
		countNotif  = document.getElementById('kolNotif').value;
		heighted  = document.getElementById('heighted2').value;
		switch (heighted) {
		   case "min":
		      cena = 300;
		      break
		   case "mid":
		      cena = 350;
		      break   
		    case "max":
		      cena = 400;
		      break   
		   default:
		      cena = 300;
		      break
		}

		sensor = countSensor * cena;
		notif = (countNotif * cena) + (countNotif * 40);
		rezult = sensor + notif + 2000;

		document.getElementById('rezSerFire').innerHTML = '<h3 class="rezultCalc">Стоимость технического обслуживания оборудования '+ rezult + " руб. </h3>";

	}
</script>

</div>
<?php include ROOT.'/views/layouts/footer.php'; ?>