<? // Проверяем сессию для авторезации админки
if ($_SESSION["admin"] == 1){
//статус изменения на выполнение задачи.
if(isset($_POST["status"])){
    
        $id = intval($_POST["status"]);  
        $db->Query("UPDATE db_tasks SET status=1 WHERE id = '$id' ");
        $db->Query("SELECT * FROM db_tasks ORDER BY id = '$id' ");
        $data = $db->FetchArray();
        $name=$data["name"];
        echo "<center><b><font color = 'grein'>Статус изменён на выполнено.Пользователя {$name}</font></b></center><BR />";
        Header("refresh: 2 ");
       }
  // статут на редактирование задачи     
 if(isset($_POST["status_text"])){
    
        $text_id = intval($_POST["status_text"]); 
        $text = $_POST["text"];
        $db->Query("UPDATE db_tasks SET task='$text' , status1=1 WHERE id = '$text_id' ");
        $db->Query("SELECT * FROM db_tasks ORDER BY id = '$text_id'");
        $dat = $db->FetchArray();
        $name=$dat["name"];
        echo "<center><b><font color = 'grein'>Задание отредактировано.Пользователя {$name}</font></b></center><BR />";
        Header("refresh: 2 ");
       }      

?>

<div class="container">
    
    <br>
    
  <div class="table-responsive">
  <table class="table table-bordered">
    <thead>
        
      <tr>
        <th>Имя пользователя</th>
        <th>Email</th>
        <th>Задача</th>
        <th>Статус</th>
         <th>Действие</th>
      </tr>
       
    </thead>  
<? $db->Query("SELECT * FROM db_tasks ORDER BY id  ");
  
	if($db->NumRows() > 0){
  
  		while($task = $db->FetchArray()){
     
		?>

    <tbody>
        <form action="" method="post">
      <tr>
        <td><?=$task["name"];?></td>
        <td><?=$task["email"];?></td>
        <td><textarea rows="4" name="text" type="text" class="form-control" ><?=$task["task"];?></textarea></td>
        <td><center> <?if($task["status"]==0){?><button type="submit" name="status" value="<?=$task["id"]; ?>" class="btn btn-primary">Выполнено</button></center><?}else{?>Отмечено<?}?></td>
        <td><center> <button type="submit" name="status_text" value="<?=$task["id"]; ?>" class="btn btn-primary">Редактировать</button></center></td>
      </tr>
       </form>
    </tbody>

	        
	       
		<?PHP
  
		}
  
	}else echo '<center><h3>Нет заданий</h3></center>'
  ?>    
    
   </table>
</div>
    
    <h1>Админка</h1>
    
</div>
<?}else echo "<center><h2><font color = 'grein'>Авторизуся!!!</font></h2></center><BR />
<script>
    setTimeout(function(){
  window.location.href = '/';
}, 2 * 1000);
</script>";?>




