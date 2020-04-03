
<?PHP

	if(isset($_POST["log"])){
	
	$login = $func->IsLogin($_POST["log"]);
	
		if($login !== false){
		
			$db->Query("SELECT * FROM db_config ORDER BY id = 1");
            $log = $db->FetchArray();
            
            if(strtolower($log["name"]) == strtolower($_POST["log"])){
			
				if(strtolower($log["pass"]) == strtolower($_POST["pass"])){
				
					
						$_SESSION["admin"] = $log["id"];
						
						Header("Location: /admin");
						
					
				
				}else echo "<center><font color = 'red'><b> Пароль указан неверно</b></font></center><BR />";
			
			}else echo "<center><font color = 'red'><b>Указанный логин не зарегистрирован в системе</b></font></center><BR />";
			
		}else echo "<center><font color = 'red'><b>Указанный логин не зарегистрирован в системе</b></font></center><BR />";
	
	}

?>

<div class="container">

	<form action="" method="post">
   <center><h3>Авторизация</h3></center>	
	
<table width="200" border="0" align="center">
  <tr>
    <td colspan="2">Логин:<BR /><input name="log" type="text" size="23" maxlength="35" class="lg"/></td>
  </tr>
  <tr>
    <td colspan="2">Пароль:<BR /><input name="pass" type="text" size="23" maxlength="35" class="lg"/></td>
  </tr>
 <tr height="5">
    <td align="center" valign="top"><input type="submit" value="Войти" class="btn_in"/></form></td>
    
  </tr>
  
</table>

</div>