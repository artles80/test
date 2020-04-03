<?PHP
    // Сортировка по убыванию или по увеличению.В базе меняем значение 0 или 1  
    if(isset($_POST["sort"])){
        
        $db->Query("SELECT * FROM db_config ORDER BY id = 1");
        $sort = $db->FetchArray();
        if($sort["sort"]==0){ 	$db->Query("UPDATE db_config SET sort=1 WHERE id = '1'"); } 
		
	    if($sort["sort"]==1){   $db->Query("UPDATE db_config SET sort=0 WHERE id = '1'"); }			        	      
        
    }
    
// Проверяем форму правельного ввода и заносим задачу БД
	if(isset($_POST["tas"])){
	    
	    $email = $func->IsMail($_POST["email"]);
	    $login = $func->IsLogin($_POST["login"]);
	    $text = $func->IsText($_POST["text"]);
	    
	    	if($login !== false){
	    	    
	    	    
	    	    	if($email !== false){
	    	    	    
	    	    	    
	    	    	    if($text !== false){ $text =$_POST["text"]; }else {$text=="";}
	    	    	        
	    	    	        $db->Query("SELECT COUNT(*) FROM db_tasks WHERE email = '$email'");
					
					            if($db->FetchRow() == 0){ 
	    	    	        
	    	    	        	      $db->Query("INSERT INTO db_tasks (name,email,task) 
					        	      VALUES ('$login', '$email','$text')");
					        	      echo "<center><b><font color = 'grein'>Задача успешно добавлена.</font></b></center><BR />";
					        	      Header("refresh: 2 ");
					            }else echo "<center><font color = 'red'><b>Указанный Email уже зарегистрирован в системе</b></font></center>";      
					        	      
	    	    	        
	    	    	   
			
			
			       }else echo "<center><font color = 'red'><b>Email имеет неверный формат.</b></font></center>";
			
			
	    	}else echo "<center><b><font color = 'red'>Имя заполнен неверно.</font></b></center><BR />";
	    	
	}
	    
?>



<div class="container">
    <br>
    
  	    <div class="table-responsive">
  <table class="table table-bordered">
    <thead>
        <form action="" method="post">
      <tr>
        <th><button class="b" type="submit" name="sort" >Имя пользователя</button></th>
        <th><button class="b" type="submit" name="sort" >Email</button></th>
        <th><button class="b" type="submit" name="sort" >Текст задачи</button></th>
        <th><button class="b" type="submit" name="sort" >Статус</button></th>
      </tr>
       </form>
    </thead>  
 <?PHP // Здесь все для снтраниц )).
        if (isset($_GET['page'])){
		$page = $_GET['page'];
	    }else $page = 1;// Текущая страница
 
         $db->Query("SELECT * FROM db_tasks ORDER BY id DESC");
         $data = $db->FetchArray();
         $kol = 3;  //количество записей для вывода
         $art = ($page * $kol) - $kol;// какую записи нам выводить
         $total = $data["id"] ;// Все количество записей в таблице
         $str_pag = ceil($total / $kol);// Количество страниц
         for ($i = 1; $i <= $str_pag; $i++){
		 echo "<a href=/?page=".$i."> Страница ".$i." </a>"; }// формируем страницы
	                                                                   
 $db->Query("SELECT * FROM db_config ORDER BY id = 1");
 $sort = $db->FetchArray();        
 if($sort["sort"]==0){ $db->Query("SELECT * FROM db_tasks ORDER BY id LIMIT $art,$kol ");}else{ $db->Query("SELECT * FROM db_tasks ORDER BY id DESC LIMIT $art,$kol  ");}
  
	if($db->NumRows() > 0){
  
  		while($task = $db->FetchArray()){
  		 if ($task["status"]==0 ){$status="не выполнено";}else{$status='<font color="green">выполнено</font>';}
	     if ($task["status1"]==0){$status1="";}else{$status1="отредактировано администратором";}
		?>

    <tbody>
      <tr>
        <td><?=$task["name"];?></td>
        <td><?=$task["email"];?></td>
        <td><?=$task["task"];?></td>
        <td><?=$status;?><br><font color="red"><?=$status1;?></font></td>
      </tr>

    </tbody>

	        
	       
		<?PHP
  
		}
  
	}else echo '<center><h3></h3></center>'
  ?>    
    
   </table>
</div>


    
<br>
<form action="" method="post">
    <div class="row">    
    
        <div class="col-4">
            <div class="form-group">
                 <label for="login">Ваше Имя:</label>
                 <input name="login" type="login" class="form-control" id="login">
            </div>
    
            <div class="form-group">
                 <label for="email">Email:</label>
                 <input name="email" type="email" class="form-control" id="email">
            </div>
      
        </div>
        <div class="col-4">
            <div class="form-group">
                 <label for="text">Текст задачи:</label>
                 <textarea rows="4" name="text" type="text" class="form-control" id="text"></textarea>
            </div>
        </div>
        <div class="col-4">
            <br><br>
              <center> <button type="submit" name="tas" class="btn btn-primary">Сохранить</button></center>
         </div>
   </div>
</form>
</div>