<?php
/**********************************************************************
index.php
Шаблон страницы
Версия: 2.5.01
**********************************************************************/
?>

<!--<body>-->

<!-- главная таблица, в которой сидят все элементы: меню, реестр записей и т.д.-->
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
				<td class="header_1" rowspan=2></td>
				<td class="header_2">
					<span id="user_welcome_area"></span>
					<span id="user_styleselect_area"></span>
					<span id="quickadd_area"></span>
				</td>
			</tr>
			<tr>
				<td>
					<table>
						<tbody>
							<tr>
								<td class="header" width="50px">&nbsp;</td>
								<td class="header_3">
									<span id="current_time_area"></span>
									<span id="remind_area"></span>
								</td>
								<td class="header" width="50px">&nbsp;</td>
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
	
	<tr><td height="10"><!-- Отступ от меню --></td></tr>
	
	<tr><td>
		<!-- таблица, содержащая 3 столбца: (1) панель меню и фильтров, (2) разделитель, (3) панель гридов-->
		<table style="width: 100%; height: 100%;">
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
<!--</body>-->
