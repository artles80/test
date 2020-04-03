<?PHP
class func{
	public $TableID = -1; # ID таблицы
	public $UserAgent = "Undefined"; // Браузер пользователя

	/*======================================================================*\
	Function:	__construct
	Descriiption: Выполняется при создании экземпляра класса
	\*======================================================================*/
	public function __construct(){
		   $this->UserAgent = $this->UserAgent();
	}
	
	/*======================================================================*\
	Function:	__destruct
	Descriiption: Уничтожение объекта
	\*======================================================================*/
	public function __destruct(){
	
	}
	
	
	/*======================================================================*\
	Function:	IsText
	Descriiption: Проверяет правильность ввода текста
	\*======================================================================*/
	public function IsText($text, $mask = "^[\sa-zA-Zа-яА-ЯёЁ0-9]", $len = "{1,250}"){
		
		return (is_array($text)) ? false : (mb_ereg_match("{$mask}{$len}+$", $text)) ? $text : false;
	
	}
	
	
	/*======================================================================*\
	Function:	IsLogin
	Descriiption: Проверяет правильность ввода логина
	\*======================================================================*/
	public function IsLogin($login, $mask = "^[a-zA-Zа-яА-ЯёЁ0-9]", $len = "{1,10}"){
		
		return (is_array($login)) ? false : (mb_ereg("{$mask}{$len}+$", $login)) ? $login : false;
	
	}
	
	/*======================================================================*\
	Function:	IsPassword
	Descriiption: Проверяет правильность ввода пароля
	\*======================================================================*/
	public function IsPassword($password, $mask = "^[a-zA-Z0-9а-яА-ЯёЁ]", $len = "{3,20}"){

return (is_array($password)) ? false : (mb_ereg("{$mask}{$len}+$", $password)) ? $password : false;

}
	
	
	
	/*======================================================================*\
	Function:	IsMail
	Descriiption: Проверяет правильность ввода email адреса
	\*======================================================================*/
	public function IsMail($mail){
		
		if(is_array($mail) && empty($mail) && strlen($mail) > 255 && strpos($mail,'@') > 64) return false;
			return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $mail)) ? false : strtolower($mail);
			
	}
	

	
	/*======================================================================*\
	Function:	UserAgent
	Descriiption: Возвращает браузер пользователя
	\*======================================================================*/
	public function UserAgent(){
		
		return $this->TextClean($_SERVER['HTTP_USER_AGENT']);
		
	}
	
	/*======================================================================*\
	Function:	TextClean
	Descriiption: Очистка текста
	\*======================================================================*/
	public function TextClean($text){
		
		$array_find = array("`", "<", ">", "^", '"', "~", "\\");
		$array_replace = array("&#96;", "&lt;", "&gt;", "&circ;", "&quot;", "&tilde;", "");
		
		
		
		return str_replace($array_find, $array_replace, $text);
		
	}
	
	/*======================================================================*\
	Function:	ShowError
	Descriiption: Выводит список ошибок строкой
	\*======================================================================*/
	public function ShowError($errorArray = array(), $title = "Исправьте следующие ошибки"){
		
		if(count($errorArray) > 0){
		
		$string_a = "<div class='Error'><div class='ErrorTitle'>".$title."</div><ul>";
		
			foreach($errorArray as $number => $value){
				
				$string_a .= "<li>".($number+1)." - ".$value."</li>";
				
			}
			
		$string_a .= "</ul></div><BR />";
		return $string_a;
		}else return "Неизвестная ошибка :(";
		
	}
	
	

	
	

}
?>