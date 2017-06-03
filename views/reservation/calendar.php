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
							<td style="background-color: #56B3C8;">На ремонте</td>
							<td style="background-color: #91E65F;">Можно бронировать</td>						
							<td style="background-color: #F5EB65;">Чатичная бронь</td>						
							<td style="background-color: #F57065;">Бронировать нельзя</td>						
							<td style="background-color: #DDDDDD;">Ожидается подтверждения</td>						
						</tr>    
					</table>
				</div>
				<hr>
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
			<table class="table_cal" >
				<tbody>
					<?php
					for ($w = 1; $w < count($arCalendar['arMontDay'])+1; $w++):?>
						<tr>							
							<?php for ($d = 1; $d < 8; $d++):?>
								<?php if(isset($arCalendar['arMontDay'][$w][$d])):?>
									<?php if(date('m') > $arCalendar['monthNow']):?>
										<td class="<?=($d>5)?'cal_red':''?>">
											<span class="status_icon red"></span>
											<?=$arCalendar['arMontDay'][$w][$d]?>
										</td>
									<?php else:?>
										<?php if(date('m') == $arCalendar['monthNow'] && date('d') > $arCalendar['arMontDay'][$w][$d]):?>
											<td class="<?=($d>5)?'cal_red':''?>">
												<span class="status_icon red"></span>
												<?=$arCalendar['arMontDay'][$w][$d]?>
											</td>
										<?php else:?>
											<?php
												$date = (strlen($arCalendar['arMontDay'][$w][$d]) == 1) ? '0' . $arCalendar['arMontDay'][$w][$d] .'.' : $arCalendar['arMontDay'][$w][$d] . '.';
												$date .= (strlen($arCalendar['monthNow']) == 1 ? '0'.$arCalendar['monthNow'] : $arCalendar['monthNow']);												
												$date .= '.' . date('Y');
											?>
											<?php if(isset($arListReserv[$arCalendar['arMontDay'][$w][$d]])):?>
												<td class="<?=($d>5)?'cal_red':''?> c_info" data-date="<?=$date?>" data-idrevs="<?=$arListReserv[$arCalendar['arMontDay'][$w][$d]]['id']?>">
													<span class="status_icon rev_<?=$arListReserv[$arCalendar['arMontDay'][$w][$d]]['status']?>"></span>
													<?php if($arListReserv[$arCalendar['arMontDay'][$w][$d]]['parent'] > 0):?>
														<i class="fa fa-link fa-1x chaild_reserv" aria-hidden="true"></i>

													<?php endif;?>
													<?=$arCalendar['arMontDay'][$w][$d]?>
													<div class="c_tooltip">
														<?php if($arListReserv[$arCalendar['arMontDay'][$w][$d]]['status'] == app\models\ReservationCars::STATUS_TEMP):?>
															<div class="c_title">Ожидается подтверждения</div>	
															<div>
																кем: <?=$arListReserv[$arCalendar['arMontDay'][$w][$d]]['users']['second_name']?> <?=$arListReserv[$arCalendar['arMontDay'][$w][$d]]['users']['name']?> <?=$arListReserv[$arCalendar['arMontDay'][$w][$d]]['users']['last_name']?>
																<br> 
																c: <?=$arListReserv[$arCalendar['arMontDay'][$w][$d]]['sdate']?>
																по: <?=$arListReserv[$arCalendar['arMontDay'][$w][$d]]['edate']?>
																<br>
																мест: <?=$arListReserv[$arCalendar['arMontDay'][$w][$d]]['mest']?>
															</div>
														<?php elseif($arListReserv[$arCalendar['arMontDay'][$w][$d]]['status'] == app\models\ReservationCars::STATUS_REPAIRS):?>
															<div class="c_title">В ремонте</div>	
															<div>
																кем: <?=$arListReserv[$arCalendar['arMontDay'][$w][$d]]['users']['second_name']?> <?=$arListReserv[$arCalendar['arMontDay'][$w][$d]]['users']['name']?> <?=$arListReserv[$arCalendar['arMontDay'][$w][$d]]['users']['last_name']?>
																<br> 
																c: <?=$arListReserv[$arCalendar['arMontDay'][$w][$d]]['sdate']?>
																по: <?=$arListReserv[$arCalendar['arMontDay'][$w][$d]]['edate']?>
															</div>
														<?php endif;?>
													</div>
												</td>	
											<?php else:?>
												<td class="cal_day <?=($d>5)?'cal_red':''?>" data-date="<?=$date?>">
													<span class="status_icon green"></span>
													<?=$arCalendar['arMontDay'][$w][$d]?>
												</td>	
											<?php endif;?>
										<?php endif;?>
									<?php endif;?>
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
	
	<div class="modal fade" id="cal_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Информация о бронировании:</h4>
			</div>
			<div class="modal-body">
				<form method="POST" id="form_addres" action="/reservation/add/">
					<input type="hidden" name="Reser[car]" value="<?=$arCar['id']?>">
					<input type="hidden" id="statusReser" name="Reser[status]" value="">
					<input type="hidden" name="Reser[month]" value="<?=$arCalendar['monthNow']?>">
					<input type="hidden" id="sdate" name="Reser[sdate]">
					<input type="hidden" name="<?=Yii::$app->request->csrfParam;?>" value="<?=Yii::$app->request->getCsrfToken(); ?>" />
					<div class="row">
						<div class="col-lg-8">
							<div class="input-group">
								<span class="input-group-addon">От:</span>
								<input type="text" id="sdate_temp" class="form-control" disabled="disabled">
								<span class="input-group-addon">До:</span>
								<input type="text" id="edate" name="Reser[edate]" class="form-control date_pic2" >							
							</div>
						</div>			
						<div class="col-lg-4">
							<div class="input-group">
								<span class="input-group-addon">Время:</span>
								<select class="form-control" name="Reser[time]">
									<option selected>24:00</option>
									<?php for ($i = 1; $i < 25; $i++):?>
										<?php $h = (strlen($i) == 1) ? '0' . $i : $i; $h .= ':00';?>
										<option value="<?=$h?>"><?=$h?></option>
									<?php endfor;?>
								</select>										
							</div>
						</div>			
					</div>
					<br/>
					<div class="row">
						<div class="col-lg-8">
							<div class="input-group">
								<span class="input-group-addon">Количество посадочных мест:</span>
								<select  name="Reser[mest]" class="form-control" >
									<option selected value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
								</select>				
							</div>
						</div>		

					</div>		
				</form>
	      </div>
			<div class="modal-footer">
				<button type="submit" class=" btn btn-primary" onclick="$('#form_addres').submit();">Бронировать</button>
				<?php if(Yii::$app->user->can('padmin')):?>
					<button type="submit" class=" btn btn-warning set_status">В ремонт</button>
				<?php endif;?>
				<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
			</div>
	    </div>
	  </div>
	</div>
   