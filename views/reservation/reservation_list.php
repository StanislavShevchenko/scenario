<?php $this->title = 'Бронирование машин'; 

$arFilter['status']  = (empty($arFilter['status'])) ? 'free' : $arFilter['status'];
?>
<h1>Бронирование автомобиля</h1>
	<ul class="nav nav-justified">
		<!--class="active"-->

		<li class='<?=($arFilter['status'] == 'free') ? ' active' : ''?> '><a class="set_filter_status" data-status="free" href="#">Свободные</a></li>
		<li class='<?=($arFilter['status'] == 'free_places') ? ' active' : ''?>'><a class="set_filter_status" data-status="free_places" href="#">Свободные места</a></li>
		<li class='<?=($arFilter['status'] == 'time_consuming') ? ' active' : ''?>'><a class="set_filter_status" data-status="time_consuming" href="#">Заняты по времени</a></li>
		<li class='<?=($arFilter['status'] == 'rented') ? ' active' : ''?>'><a class="set_filter_status" data-status="rented" href="#">Арендованные</a></li>
		<li class='<?=($arFilter['status'] == 'repairs') ? ' active' : ''?>'><a class="set_filter_status" data-status="repairs" href="#">На ремонте</a></li>
    </ul>
	<label class="info_filter">Выбирает машины в пределе указанных ниже дат</label>
    <hr>
    <div class="row">
		<div class="col-lg-4">
			<form class="form-horizontal row_b" role="form" method="get">	
				<div class="input-group">				
					<input class="form-control" name="q" value="<?=Yii::$app->request->get('q');?>" type="text">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit" >Искать машину!</button>
							<?php if(Yii::$app->request->get('q')):?>
								<a class="btn btn-danger " href="/reservation/">Сбросить</a>
							<?php endif;?>
						</span>				
				</div><!-- /input-group -->
			</form>
		</div><!-- /.col-lg-6 -->
		<div class="col-lg-8">
			<form class="form-horizontal row_b" id="filter_cars" role="form" method="get">	
				<input type="hidden" id="status_car" value="<?=$arFilter['status']?>" name="Filter[status]">
				    <div class="row">
						<div class="col-lg-3">
							<div class="input-group">	
								<span class="input-group-addon">От:</span>
								<input type="text" value="<?=$arFilter['sdate']?>" class="form-control date_pic" name="Filter[sdate]"  placeholder="Дата" >
							</div>
						</div>
						<div class="col-lg-3">
							<div class="input-group">	
								<span class="input-group-addon">До:</span>
								<input type="text" class="form-control date_pic" value="<?=$arFilter['edate']?>" name="Filter[edate]" placeholder="Дата" >		
							</div>
						</div>
						<div class="col-lg-4">
							<div class="input-group">		
								<span class="input-group-addon">Количество мест от:</span>
								<select class="form-control"  name="Filter[mest]">
									<?php for($i=1; $i<10; $i++):?>
										<option <?=($arFilter['mest'] == $i)?'selected':''?> value="<?=$i?>"><?=$i?></option>
									<?php endfor;?>
								</select>				
							</div>
						</div>
						<div class="col-lg-2">
							<span class="input-group-btn">
								<button class="btn btn-info" type="submit">Показать</button>
							</span>	
						</div>
					</div>
			</form>
		</div>			
    </div>
	<label class="">Машин в списке <b><?=count($arCarList)?></b></label>
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
                <tr>
					<th>#</th>
					<th>Номер а/м</th>
					<th>Марка</th>
					<th>Модель</th>
					<th>Цвет</th>
					<th>Кол-во мест</th>
					<th>Топливо</th>
					<th>Литраж</th>
					<!--<th>Коробка передач</th>-->
                </tr>
            </thead>
            <tbody>
               <?php foreach($arCarList as $key => $val):?>
					<tr class="click_bcaledar" data-idcar="<?=$val["id"];?>">
						<td><i class="fa fa-car" aria-hidden="true"></i> <?=$val["id"];?></td>
						<td><?=$val["number"];?></td>
						<td><?=$val["brand"];?></td>
						<td><?=$val["model"];?></td>
						<td><?=$val["color"];?></td>
						<td><?=$val["seats"];?></td>
						<td><?=$val["fuel"];?></td>
						<td><?=$val["liters"];?></td>
						<!--<td></td>-->
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>		