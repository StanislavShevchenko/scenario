<?php $this->title = 'Бронирование машин'; ?>
<h1>Календарь бронирования: <i  class="fa fa-car fa-1x" aria-hidden="true"></i> <?=$arCar['brand']?> <?=$arCar['model']?> (<?=$arCar['color']?>) №-<?=$arCar['number']?></h1>
    <hr>
	<div class="row">
		<div class="col-lg-4 ">
			<h4>Авто в строю:<br> <small>(быстрый переход в календарь авто)</small></h4>
			<div class="list-group list-avto">
				<?php foreach($arCarList as $key => $val):?>
				<a href="/reservation/<?=$val['id']?><?=($arCalendar['monthNow']>0) ? '?month='.$arCalendar['monthNow'] : ''?>" class="list-group-item <?=($val['id'] == $id) ? 'active':''?>">
					<i  class="fa fa-car" aria-hidden="true"></i>
						<?=$val['brand']?> <?=$val['model']?> (<?=$val['color']?>) №-<?=$val['number']?>
				</a>
				<?php endforeach;?>
			</div>
		</div>
		<div class="col-lg-8">
			<div class="row">
				<div class="col-lg-12">
					<table class="table_hint_cal">
						<tr>
							<td><span class="glyphicon glyphicon-wrench status_day_wrench"></span>На ремонте</td>
							<td><span class="glyphicon glyphicon-ok status_day_emp"> </span>Можно бронировать</td>						
							<td><span class="glyphicon glyphicon-warning-sign status_day_emp2"> </span>Чатичная бронь</td>						
							<td><span class="glyphicon glyphicon-ban-circle status_day_close"></span>Бронировать нельзя</td>						
						</tr>    
					</table>
				</div>
			</div>
			<div class="input-group">
				<span class="input-group-addon">Выбрать месяц:</span>
				<form>
					<select class="form-control" name="month" onchange="this.form.submit()">								
						<?php foreach($arCalendar['arMonth'] as $num => $name):?>
							<option <?=($num == $arCalendar['monthNow'])?'selected':''?> value="<?=$num?>"><?=$name?></option>
						<?php endforeach;?>
					</select>
				</form>
			</div>							
			<table class="table_cal">
				<thead>
					<tr>
						<th>Пнд.</th>
						<th>Втр.</th>
						<th>Срд.</th>
						<th>Чтв.</th>
						<th>Птн.</th>
						<th class="cal_red">Сбт.</th>
						<th class="cal_red">Вск.</th>
					</tr>
				</thead>
			</table>
			<table class="table_cal">
				<tbody>
					<?php for ($w = 1; $w < count($arCalendar['arMontDay'])+1; $w++):?>
						<tr>
							<span sty></span>
							<?php for ($d = 1; $d < 8; $d++):?>
								<?php if(isset($arCalendar['arMontDay'][$w][$d])):?>
									<td class="cal_day <?=($d>5)?'cal_red':''?>"><?=$arCalendar['arMontDay'][$w][$d]?></td>								
								<?php else:?>
									<td class="default_day"></td>
								<?php endif;?>
							<?php endfor;?>
						<tr>   
					<?php endfor;?>
				</tbody>
			</table>
		</div>
	</div>
	
   