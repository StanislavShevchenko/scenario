<?$this->title = 'Пользователи';?>
<script>
	active_modal_win = "<?=(!empty($active_modal_win)) ? $active_modal_win : ''//ид моделки которую нужно запустить?>";
</script>
<h1>Пользователи</h1>
    <hr>
    <div class="row">
      	<div class="col-lg-6">
			<form class="form-horizontal row_b" role="form" method="get">	
				<div class="input-group">				
					<input class="form-control" name="q" value="<?=Yii::$app->request->get('q');?>" type="text">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit" >Искать пользователя!</button>
							<?if(Yii::$app->request->get('q')):?>
								<a class="btn btn-danger " href="/users/">Сбросить</a>
							<?endif;?>
						</span>				
				</div><!-- /input-group -->
			</form>
      	</div>
      	<div class="col-lg-6">
      		<button class="btn btn-success" type="button" id="new_user">Добавить пользователя</button>
      	</div>
    </div>
    <br>
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
                <tr>
					<th>#</th>
					<th>Login</th>
					<th>Фио</th>
					<th>E-mail</th>
					<th>Телефон</th>
					<th>Должность</th>
					<th>Локация</th>
					<th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($arUsersList as $key => $val):?>
					<tr class="click_edit_user" data-iduser="<?=$val["id"];?>">
						<td><i  class="fa fa-user" aria-hidden="true"></i> <?=$val["id"];?></td>
						<td><?=$val["login"];?></td>
						<td><?=$val["last_name"];?> <?=$val["name"];?> <?=$val["second_name"];?></td>
						<td><?=$val["email"];?></td>
						<td><?=$val["phone"];?> <?=(!empty($val["mphone"])) ? '/'.$val["mphone"]: ''?></td>
						<td><?=$val["position"];?></td>
						<td><?=$val["country"];?> <?=$val["city"];?>
							<?=(!empty($val["street"])) ? 'ул.'.$val["street"] : ''?> <?=(!empty($val["home"])) ? 'дом '.$val["home"] : ''?> 
							<?=(!empty($val["zip"]))? '('.$val["zip"].')' : ''?>
						</td>
<!--						<td>
							<?php if($val["roles"]['item_name']=='su'):?>
								Root
							<?php elseif($val["roles"]['item_name']=='admin'):?>
								Администратор
							<?php elseif($val["roles"]['item_name']=='user'):?>
								Пользователь
							<?php endif;?>
						</td>-->
						<td>							
							<!--<i title="Детально" class="fa fa-chevron-down  info_user_btn" aria-hidden="true"></i>-->
							<i title="Удалить пользователя" class="remove_user fa fa-times " aria-hidden="true"></i>
						</td>
					</tr>
<!--					<tr style="display: none" data-userinfo="<?=$val["id"];?>">
						<td colspan="9">
							    <div class="row">
									<div class="col-lg-12">
										
									</div>
								</div>
						</td>
					</tr>-->
				<?php endforeach;?>
			</tbody>
		</table>
	</div>	
	
<?//модельное окно добавления авто?>
<div class="modal fade" id="form_edit_user_modal" tabindex="-1" role="dialog" aria-labelledby="myUserLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog_edit_user">
	    <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			  <h4 class="modal-title" id="myUserLabel">Добавить пользователя</h4>
			</div>
			<div class="modal-body">
				  <div class="row">
<!--					  <span class="fa-3x"><i class="fa fa-spinner fa-spin "></i>Ожидайте</span>-->
					  <form class="form-horizontal row_b <?=(!empty($errors)) ? 'errors' : ''?>" role="form" id="Fuser" method="post">	
							<input type="hidden" name="<?=Yii::$app->request->csrfParam;?>" value="<?=Yii::$app->request->getCsrfToken(); ?>" />
							<input type="hidden" name="User[id]" value="" />
							<div class="row">
								<div class="col-lg-3">		
									<div class="input-group">
										<span class="input-group-addon">Логин:</span>
										<input type="text" name="User[login]" class="form-control" >
										<span class="<?=(isset($errors['login'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
									</div>
								</div>
								<div class="col-lg-3">	
									<div class="input-group">
										<span class="input-group-addon">Пароль:</span>
										<input type="password" name="User[password]" class="form-control" >
										<span class="<?=(isset($errors['password'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
									</div>								
								</div>
								<div class="col-lg-3">	
									<div class="input-group">
										<span class="input-group-addon">E-mail:</span>
										<input type="email" name="User[email]" class="form-control" >
										<span class="<?=(isset($errors['email'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
									</div>								
								</div>
								<div class="col-lg-3">		
									<div class="input-group">
										<span class="input-group-addon">Права:</span>
										<select name="User[roles]" class="form-control">
											<option value="user">Пользователь</option>
											<option value="admin">Администратор</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3">		
									<div class="input-group">
										<span class="input-group-addon">Имя:</span>
										<input type="text" name="User[name]" class="form-control" >
										<span class="<?=(isset($errors['name'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
									</div>
								</div>
								<div class="col-lg-3">	
									<div class="input-group">
										<span class="input-group-addon">Фамилия:</span>
										<input type="text" name="User[second_name]" class="form-control" >
										<span class="<?=(isset($errors['second_name'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
									</div>								
								</div>
								<div class="col-lg-3">		
									<div class="input-group">
										<span class="input-group-addon">Отчество:</span>
										<input type="text" name="User[last_name]" class="form-control" >
										<span class="<?=(isset($errors['last_name'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
									</div>
								</div>
								<div class="col-lg-3">		
									<div class="input-group">
										<span class="input-group-addon">Звания:</span>
										<input type="text" name="User[rangs]" class="form-control" >
										<span class="<?=(isset($errors['rangs'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3">		
									<div class="input-group">
										<span class="input-group-addon">Страна:</span>
										<input type="text" name="User[country]" class="form-control" >
										<span class="<?=(isset($errors['country'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
									</div>
								</div>
								<div class="col-lg-3">	
									<div class="input-group">
										<span class="input-group-addon">Город:</span>
										<input type="text" name="User[city]" class="form-control" >
										<span class="<?=(isset($errors['city'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
									</div>								
								</div>
								<div class="col-lg-3">		
									<div class="input-group">
										<span class="input-group-addon">Улица:</span>
										<input type="text" name="User[street]" class="form-control" >
										<span class="<?=(isset($errors['street'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
									</div>
								</div>
								<div class="col-lg-3">		
									<div class="input-group">
										<span class="input-group-addon">Дом:</span>
										<input type="text" name="User[home]" class="form-control" >
										<span class="<?=(isset($errors['home'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3">		
									<div class="input-group">
										<span class="input-group-addon">Индекс:</span>
										<input type="text" name="User[zip]" class="form-control" >
										<span class="<?=(isset($errors['zip'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
									</div>
								</div>
								<div class="col-lg-3">		
									<div class="input-group">
										<span class="input-group-addon">Телефон:</span>
										<input type="text" name="User[phone]" class="form-control" >
										<span class="<?=(isset($errors['phone'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
									</div>
								</div>
								<div class="col-lg-3">	
									<div class="input-group">
										<span class="input-group-addon">Мобильный:</span>
										<input type="text" name="User[mphone]" class="form-control" >
										<span class="<?=(isset($errors['mphone'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
									</div>								
								</div>
								<div class="col-lg-3">	
									<div class="input-group">
										<span class="input-group-addon">Должность:</span>
										<input type="text" name="User[position]" class="form-control" >
										<span class="<?=(isset($errors['position'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
									</div>								
								</div>
							</div>						 
							<div class="row">
								<div class="col-lg-3">	
									<div class="input-group">
										<span class="input-group-addon">Уровень:</span>
										<select name="User[department]" class="form-control">
											<option value="chief">Управляющий</option>
											<option value="subordinate">Подчинённый</option>
										</select>
										<span class="<?=(isset($errors['department'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
									</div>								
								</div>
								<div class="col-lg-3">	
									<div class="input-group">
										<span class="input-group-addon">Ключ:</span>
										<input type="text" name="User[key]" class="form-control" >
										<span class="<?=(isset($errors['key'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
									</div>								
								</div>								
								<div class="col-lg-3">	
									<div class="input-group">
										<span class="input-group-addon">Перс. №:</span>
										<input type="text" name="User[personal_num]" class="form-control" >
										<span class="<?=(isset($errors['personal_num'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
									</div>								
								</div>
								<div class="col-lg-3">		
									<div class="input-group">
										<span class="input-group-addon">Доп. звания:</span>
										<input type="text" name="User[second_rangs]" class="form-control" >
										<span class="<?=(isset($errors['second_rangs'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
									</div>
								</div>	
							</div>						 
							<div class="row">
								<div class="col-lg-3">		
									<div class="input-group">
										<span class="input-group-addon">Начало дня:</span>
										<input type="text" name="User[start_work]" class="form-control" >
										<span class="<?=(isset($errors['start_work'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
									</div>
								</div>
								<div class="col-lg-3">		
									<div class="input-group">
										<span class="input-group-addon">Конец дня:</span>
										<input type="text" name="User[end_work]" class="form-control" >
										<span class="<?=(isset($errors['end_work'])? 'error_f' : 'display_n')?>">Ошибка заполнения</span>
									</div>
								</div>								
							
							</div>			
					  </form>
				  </div>
				<br/>
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
			  <button type="button" class="btn btn-primary" onclick="$('#Fuser').submit();" >Сохранить</button>
			</div>
	    </div>
	</div>
</div>