<HTML>
<?php
/**
 * Шаблон страницы
 */
?>
<head>
  <title>Iris CRM</title>
  <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=<?php echo $data['encoding']; ?>"/>

  <meta http-equiv="Content-Language" content="ru">
  <meta http-equiv="X-UA-Compatible" content="chrome=1">

  <?php echo $data['javascript']; ?>
  
  <?php echo $data['css']; ?>

  <link rel="SHORTCUT ICON" href="<?php echo url('build/themes/' . $data['name'] . '/images/favicon.png'); ?>" type="image/png">
</head>
<body onkeyup="ActivateHotKeys(event)">

<?php /* Главная таблица, в которой содержатся все элементы: 
  меню, реестр записей и т.д. */ ?>
<table id='maintable' style="width: 100%; height: 100%;"><tbody>

	<!-- Панель для сворачивания окон -->
	<tr><td class="dock">
	<div id="dock"> 
	</div>
	</td></tr>

	<tr style="height: 70px;"><td>
		<!-- таблица, в которой находится заголовок и прветствие-->
		<table class="header">
		<tbody>
		
		<tr class="header"><td>
		<table class="header">
		<tbody>
		
			<tr>
				<td class="miv_h_1"></td>
				<td class="miv_h_2">
					<span id="user_welcome_area"></span>
					<span id="user_styleselect_area" style="margin-left: 10px; display: none;"></span>
					<span id="quickadd_area" style="margin-left: 10px;"></span>
				</td>
			</tr>
			<tr>
				<td class="miv_h_1"></td>
				<td class="miv_h_3">

				<table>
					<tbody>
						<tr>
							<td width=200>
					<span id="current_time_area"></span>
							</td>
							<td style="text-align: center;">
					<span id="remind_area"></span>
							</td>
						</tr>
					</tbody>
				</table>


				</td>
			</tr>
		</tbody>
		</table>
		</td></tr>
		
			
		</tbody>
		</table>
	</td></tr>

	<tr style="height: 32px"><td>
		<!-- маленькая табличка, выполняющая функцию меню-->
		<table width=100% height=32px>
		<tbody>
			<tr><td id="menu_panel"><!-- панель меню--></td></tr>
		</tbody>
		</table>
	</td></tr>
	
	<tr><td class="menu-spcae h_div"><!-- Отступ от меню --></td></tr>
	
	<tr><td>
		<!-- таблица, содержащая 3 столбца: (1) панель меню и фильтров, (2) разделитель, (3) панель гридов-->
		<table style="width: 100%; height: 100%; border: 0;">
		<tbody>
			<tr>
				<!-- (1) панель меню и фильтров -->
				<td class="left">
					<table class="left" style="height: 100%;">
						<tr style="height: 100%;">
							<td class="left">
								<div id='filters_area' style="overflow-x: hidden; overflow-y: auto; height: 200px;"><!-- ### панель фильтров ### --></div>
							</td>
						</tr>
						</table>
				</td>
				<!-- (2) разделитель -->
				<td width=10 class="vert_div">
				</td>
				<!-- (3) панель гридов -->
				<td>
					<table style="height: 100%;" >
					<tbody>
						<tr style="height: 100%;">
							<td id='grid_area' align=center valign=top><!--содержимое реестра записей формируется через javascript--></td>
						</tr>
						<!-- TODO: если нужно отображать закладки, то нужно убрать этот комментарий и у предыдущего tr сделать высоту 60%
						<tr style="height: auto">
							<td align=center valign=top>
								<table style="height: 100%">
								<tbody>
									<tr>
										<td id='tabs_area'></td>
									</tr>
									<tr>
										<td id='detail_area'><br></td>
									</tr>
								</tbody>
								</table>
							</td>
						</tr>
						-->
					</tbody>
					</table>
				</td>
			</tr>
		</tbody>
		</table>
	</td></tr>
</tbody></table>

<?php echo $data['javascript_bottom']; ?>

</body>
</HTML>