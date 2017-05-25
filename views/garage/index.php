<?php $this->title = 'Гараж'; ?>
<script>
	active_modal_win = "<?=(!empty($active_modal_win)) ? $active_modal_win : ''//ид моделки которую нужно запустить?>";
</script>
<h1>Гараж</h1>
    <hr>
    <div class="row">
      	<div class="col-lg-6">
	        <div class="input-group">
          		<input class="form-control" type="text">
				<span class="input-group-btn">
					<button class="btn btn-default" type="button" >Искать машину!</button>
				</span>
        	</div><!-- /input-group -->
      	</div>
      	<div class="col-lg-6">
      		<button class="btn btn-success" type="button" id="new_car">Добавить машину</button>
      	</div>
    </div>
    <br>
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
                <tr>
					<th>#</th>
					<th>Номер</th>
					<th>Марка</th>
					<th>Модель</th>
					<th>Топливо</th>
					<th>Год выпуска</th>
					<!--<th>Коробка</th>-->
					<th>Литраж</th>
					<th>Мест</th>
					<th>Ведущее реле</th>
					<th>Цвет</th>
					<th>Резина</th>
					<th>Расход то-ва</th>
					<th>Киллометраж</th>
                </tr>
            </thead>
            <tbody>
                <?foreach($arCarList as $key => $val):?>
					<tr class="click_edit_car" data-idcar="<?=$val["id"];?>">
						<td><?=$val["id"];?></td>
						<td><?=$val["number"];?></td>
						<td><?=$val["brand"];?></td>
						<td><?=$val["model"];?></td>
						<td><?=$val["fuel"];?></td>
						<td><?=$val["year"];?></td>
						<!--<td>****</td>-->
						<td><?=$val["liters"];?></td>
						<td><?=$val["seats"];?></td>
						<td><?=$val["relay"];?></td>
						<td><?=$val["color"];?></td>
						<td><?=$val["rubber"];?></td>
						<td><?=$val["consumption"];?></td>
						<td><?=$val["kilometers"];?></td>
					</tr>
				<?endforeach;?>
			</tbody>
		</table>
	</div>	
	
<?//модельное окно добавления авто?>
<div class="modal fade" id="form_edit_car_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog_edit_avto">
	    <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			  <h4 class="modal-title" id="myModalLabel">Редактировать данные авто: Chevrolet (AH2512HK)</h4>
			</div>
			<div class="modal-body">
				  <div class="row">
<!--					  <span class="fa-3x"><i class="fa fa-spinner fa-spin "></i>Ожидайте</span>-->
					  <form class="form-horizontal row_b <?=(!empty($errors)) ? 'errors' : ''?>" role="form" id="Fcar" method="post">	
						  <input type="hidden" name="<?=Yii::$app->request->csrfParam;?>" value="<?=Yii::$app->request->getCsrfToken(); ?>" />
						  <input type="hidden" name="Cars[id]" value="" />
						  <div class="row">
							  <div class="col-lg-6">		
								  <div class="input-group">
										<span class="input-group-addon">Номер:</span>
										<input type="text" name="Cars[number]" class="form-control" >
										<span class="<?=(isset($errors['number'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
								  </div>
							  </div>
							  <div class="col-lg-6">	
								  <div class="input-group">
										<span class="input-group-addon">Марка:</span>
										<input type="text" name="Cars[brand]" class="form-control" >
										<span class="<?=(isset($errors['brand'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
								  </div>								
							  </div>
						  </div>
						  <div class="row">
							  <div class="col-lg-6">		
								  <div class="input-group">
										<span class="input-group-addon">Модель:</span>
										<input type="text" name="Cars[model]" class="form-control" >
										<span class="<?=(isset($errors['model'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
								  </div>
							  </div>
							  <div class="col-lg-6">	
								  <div class="input-group">
										<span class="input-group-addon">Топливо:</span>
										<select name="Cars[fuel]" class="form-control">
											<option value="бензин">бензин</option>
											<option value="дизель">дизель</option>
										</select>
										<span class="<?=(isset($errors['fuel'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
										<!--<input type="text" name="Cars[fuel]" class="form-control" >-->
								  </div>								
							  </div>
						  </div>
						  <div class="row">
							  <div class="col-lg-6">		
								  <div class="input-group">
										<span class="input-group-addon">Год выпуска:</span>
										<input type="number" name="Cars[year]" class="form-control js_only-int" >
										<span class="<?=(isset($errors['year'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
								  </div>
							  </div>
							  <div class="col-lg-6">	
								  <div class="input-group">
										<span class="input-group-addon">Литраж:</span>
										<input type="number" name="Cars[liters]" class="form-control js_only-int" >
										<span class="<?=(isset($errors['liters'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
								  </div>								
							  </div>
						  </div>
						  <div class="row">
							  <div class="col-lg-6">		
								  <div class="input-group">
									  <span class="input-group-addon">Мест:</span>
									  <input type="number" name="Cars[seats]" class="form-control js_only-int" >
									   <span class="<?=(isset($errors['seats'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
								  </div>
							  </div>
							  <div class="col-lg-6">	
								  <div class="input-group">
										<span class="input-group-addon">Ведущее реле:</span>
										<select name="Cars[relay]" class="form-control">
											<option value="задний">задний</option>
											<option value="передний">передний</option>
											<option value="полный привод">полный привод</option>
										</select>
										<span class="<?=(isset($errors['relay'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
								  </div>								
							  </div>
						  </div>
						  <div class="row">
							  <div class="col-lg-6">		
								  <div class="input-group">
										<span class="input-group-addon">Цвет:</span>
										<input type="text" name="Cars[color]" class="form-control" >
										<span class="<?=(isset($errors['color'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
								  </div>
							  </div>
							  <div class="col-lg-6">	
								  <div class="input-group">
										<span class="input-group-addon">Резина:</span>
										<input type="text" name="Cars[rubber]" class="form-control" >
										<span class="<?=(isset($errors['rubber'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
								  </div>								
							  </div>
						  </div>
						  <div class="row">
							  <div class="col-lg-6">		
								  <div class="input-group">
										<span class="input-group-addon">Расход то-ва:</span>
										<input type="number" name="Cars[consumption]" class="form-control js_only-int" >
										<span class="<?=(isset($errors['consumption'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
								  </div>
							  </div>
							  <div class="col-lg-6">	
								  <div class="input-group">
										<span class="input-group-addon">Киллометраж:</span>
										<input type="number" name="Cars[kilometers]" class="form-control js_only-int" >
										<span class="<?=(isset($errors['kilometers'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
								  </div>								
							  </div>
						  </div>						
					  </form>
				  </div>
				<br/>
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
			  <button type="button" class="btn btn-primary" onclick="$('#Fcar').submit();" >Сохранить</button>
			</div>
	    </div>
	</div>
</div>