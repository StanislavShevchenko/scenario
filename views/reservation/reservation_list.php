<?php $this->title = 'Бронирование машин'; ?>
<h1>Бронирование автомобиля</h1>
	<ul class="nav nav-justified">
		<!--class="active"-->
		<li ><a href="#">Свободные</a></li>
		<li><a href="#">Свободные места</a></li>
		<li><a href="#">Заняты по времени</a></li>
		<li><a href="#">Арендованные</a></li>
		<li><a href="#">На ремонте</a></li>
    </ul>
    <hr>
    <div class="row">
		<div class="col-lg-4">
			<div class="input-group">
			  <input class="form-control" type="text">
			  <span class="input-group-btn">
				<button class="btn btn-info" type="button">Искать машину!</button>
			  </span>
			</div><!-- /input-group -->
		</div><!-- /.col-lg-6 -->
		<div class="col-lg-8">
			<div class="input-group">
				<span class="input-group-addon">От:</span>
				<input type="text" class="form-control date_pic" name="text" placeholder="Дата" >
				<span class="input-group-addon">До:</span>
				<input type="text" class="form-control date_pic" name="text" placeholder="Дата" >		
				<span class="input-group-addon">Количество мест:</span>
				<select class="form-control" >
					<option selected="">1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
				</select>				
				<span class="input-group-btn">
					<button class="btn btn-info" type="button">Показать</button>
				</span>			  
			</div>
		</div>			
    </div>
    <br>
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
					<th>Коробка передач</th>
                </tr>
            </thead>
            <tbody>
               <?foreach($arCarList as $key => $val):?>
					<tr class="click_bcaledar" data-idcar="<?=$val["id"];?>">
						<td><i class="fa fa-car" aria-hidden="true"></i> <?=$val["id"];?></td>
						<td><?=$val["number"];?></td>
						<td><?=$val["brand"];?></td>
						<td><?=$val["model"];?></td>
						<td><?=$val["color"];?></td>
						<td><?=$val["seats"];?></td>
						<td><?=$val["fuel"];?></td>
						<td><?=$val["liters"];?></td>
						<td>							
						</td>
					</tr>
				<?endforeach;?>
			</tbody>
		</table>
	</div>		