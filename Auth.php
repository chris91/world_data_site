<?php

//require_once 'PasswordHash.php';

class Auth {

	protected static $_instance;

	/*parameters for connecting to the db*/
	private static $_db_host="localhost";
	private static $_db_user="root";
	private static $_db_password="geometry";
	private static $_db_name="mydb";

	private $_current_user;
/**
* The difference between $this and self is that $this referces to the current object
*(non static reference) and self refers to the current class(static reference)
*/	
	public static function instance() {
		if (is_null(self::$_instance)){
			self::$_instance = new Auth();
		}
		return self::$_instance;
	}

	private function __construct(){
		//session_start();
	}


	public function _fetch_the_data($c_id,$i_id,$year){//under construction
		//$mysqli=self::_db_connect();
		$result=$this->_find_data_by_ids($c_id,$i_id,$year);
		//while ($row = $result->fetch_row()) {
        	//	printf ("%s (%s)\n", $row[0], $row[1]);
    		//}
		
	}
	
	public function _create_data_barchart1($countries,$indicator,$years){
		$myarray=array();
		$years_row=$this->_get_the_years($years);
		$N=count($countries);
		for($i=0;$i < $N; $i++){
			$country=$countries[$i];
			$first_year=$years_row[0];
			$last_year=$years_row[1];
			$result=$this->_get_the_query($country,$indicator,$first_year,$last_year);
			$result=$this->_put_zeros($result,$first_year,$last_year,$country,$indicator);
			$myarray[]=$result;
		}
		$this->_write_to_file($myarray,'multibarchart.csv',0);
	}
	
	public function _create_data_barchart2($country,$indicators,$years){
		$myarray=array();
		$years_row=$this->_get_the_years($years);
		$N=count($indicators);
		for($i=0;$i < $N; $i++){
			$indicator=$indicators[$i];
			$first_year=$years_row[0];
			$last_year=$years_row[1];
			$result=$this->_get_the_query($country,$indicator,$first_year,$last_year);
			$result=$this->_put_zeros($result,$first_year,$last_year,$country,$indicator);
			$myarray[]=$result;
		}
		$this->_write_to_file($myarray,'multibarchart.csv',1);
	}

	public function _create_data_barchart3($countries,$indicators,$years){
		$myarray=array();
		$years_row=$this->_get_the_years($years);
		$N=count($indicators);
		$M=count($countries);
		for($i=0;$i < $N; $i++){
			for($j=0;$j <$M;$j++){
				$indicator=$indicators[$i];
				$country=$countries[$j];
				$first_year=$years_row[0];
				$last_year=$years_row[1];
				$result=$this->_get_the_query($country,$indicator,$first_year,$last_year);
				$result=$this->_put_zeros($result,$first_year,$last_year,$country,$indicator);
				$myarray[]=$result;
			}
		}
		$this->_write_to_file1($myarray,'multitimeline.tsv',1);
	}

	public function _create_data_barchart4($country,$indicators,$years){//from here
		$myarray=array();
		$years_row=$this->_get_the_years($years);
		$N=count($indicators);
		for($i=0;$i < $N; $i++){
			$indicator=$indicators[$i];
			$first_year=$years_row[0];
			$last_year=$years_row[1];
			$result=$this->_get_the_query($country,$indicator,$first_year,$last_year);
			$result=$this->_put_zeros($result,$first_year,$last_year,$country,$indicator);
			$myarray[]=$result;
		}
		$this->_write_to_file2($myarray,'scatterplot.tsv',1);
	}

	private function _write_to_file2($myarray,$filename,$flag){
		$handle = fopen($filename, 'w') or die('I cannot open the file');
		$N=count($myarray);
		$M=count($myarray[0]);
		$text=$myarray[0][0][1];
		fwrite($handle,"sepalLength\tsepalWidth\tpetalLength\tpetalWidth\tspecies"."\n") or die('I cannot write to file');
		for($i=0;$i<$N;$i++){
			for($k=$i+1;$k<$N;$k++){
				for ($j = $i;$j<$M;$j++) {
					$text='';
					$temp='';
					$text=$text.$myarray[$i][$j][3]."\t".$myarray[$k][$j][3]."\t"."0\t0\t".$myarray[$i][$j][1].'|'.$myarray[$k][$j][1];
					fwrite($handle,$text."\t".$temp."\n") or die('I cannot write to file');	
    				}
			}
		}
		fclose($handle);
//		$fp = fopen($filename, 'w') or die('i/o error');
//		fwrite($fp, print_r($myarray, TRUE));
//		fwrite($fp, $myarray[0][0][0]) or die('error to write');
//		fclose($fp);		
	}


	private function _write_to_file1($myarray,$filename,$flag){
		$handle = fopen($filename, 'w') or die('I cannot open the file');
		$N=count($myarray);
		$M=count($myarray[0]);
		$text='date';
		for($i=0;$i<$N;$i++){
			$text=$text."\t".$myarray[$i][0][0].'|'.$myarray[$i][0][1];//edo
		}
		fwrite($handle,$text."\n") or die('I cannot write to file');
		for ($j = 0;$j<$M;$j++) {
			$text=$myarray[0][$j][2].'01'.'01';//yearmonthday
			for($i=0;$i<$N;$i++){
				$text=$text."\t".$myarray[$i][$j][3];
			}
			fwrite($handle,$text."\n") or die('I cannot write to file');	
    		}
		fclose($handle);
//		$fp = fopen($filename, 'w') or die('i/o error');
		//fwrite($fp, print_r($myarray, TRUE));
//		fwrite($fp, $myarray[0][0][0]) or die('error to write');
//		fclose($fp);		
	}

	private function _write_to_file($myarray,$filename,$flag){
		$handle = fopen($filename, 'w') or die('I cannot open the file');
		$N=count($myarray);
		$M=count($myarray[0]);
		$text='State';
		for($i=0;$i<$N;$i++){
			$text=$text.','.$myarray[$i][0][$flag];//edo
		}
		fwrite($handle,$text."\n") or die('I cannot write to file');
		for ($j = 0;$j<$M;$j++) {
			$text=$myarray[0][$j][2];
			for($i=0;$i<$N;$i++){
				$text=$text.','.$myarray[$i][$j][3];
			}
			fwrite($handle,$text."\n") or die('I cannot write to file');	
    		}
		fclose($handle);
//		$fp = fopen($filename, 'w') or die('i/o error');
		//fwrite($fp, print_r($myarray, TRUE));
//		fwrite($fp, $myarray[0][0][0]) or die('error to write');
//		fclose($fp);		
	}

	private function _get_the_query($country,$indicator,$first_year,$last_year){
		$mysqli=self::_db_connect();
		$sql="select * from worlddata where country_id='".$country."' and indicator_id='".$indicator."'"." and year>=".$first_year." and year<=".$last_year.";";
		$result=$mysqli->query($sql) or die($mysqli->error);
		mysqli_close($mysqli);
		return $result;
	}

	public function _take_the_data($country,$indicator,$year){
		$array=array();
		$result=$this->_get_the_query($country,$indicator,$year,$year);
		$data=$result->fetch_row();
		$array[]=$this->_get_country_name($country);
		$array[]=$this->_get_indicator_name($indicator);
		$array[]= $data[3];
		if($data[3]==NULL){
			$array[]=TRUE;
		}
		else{
			$array[]=FALSE;
		}
		return $array;
	}
	
	public function _insert_new_row($country,$indicator,$year,$data){//under testing
		$mysqli=self::_db_connect();
		$sql="insert into worlddata(country_id,indicator_id,year,data) values('".$country."','".$indicator."','".$year."','".$data."');";
		$result=$mysqli->query($sql) or die($mysqli->error);
		mysqli_close($mysqli);		
	}
	
	public function _get_reports($user_id){//here sos under testing
		$mysqli=self::_db_connect();
		$sql="select * from reports where user_id='".$user_id."' order by idreports desc;";
		$result=$mysqli->query($sql) or die($mysqli->error);
		mysqli_close($mysqli);
		return $result;
	}
	
	public function _insert_new_report($user_id,$timestamp,$location,$type){
		$mysqli=self::_db_connect();
		$sql="insert into reports(user_id,timestamp,location,type) values('".$user_id."','".$timestamp."','".$location."','".$type."');";
		$result=$mysqli->query($sql) or die($mysqli->error);
		mysqli_close($mysqli);		
	}


	public function _update_row($country,$indicator,$year,$data){//under testing
		$mysqli=self::_db_connect();
		$sql="update worlddata set data=".$data." where country_id='".$country."' and indicator_id='".$indicator."' and year='".$year."';";
		$result=$mysqli->query($sql) or die($mysqli->error);
		mysqli_close($mysqli);		
	}

	public function _delete_row($country,$indicator,$year){//under testing
		$mysqli=self::_db_connect();
		$sql="delete from worlddata where country_id='".$country."' and indicator_id='".$indicator."' and year='".$year."';";
		$result=$mysqli->query($sql) or die($mysqli->error);
		mysqli_close($mysqli);		
	}

	private function _get_country_name($country){
		$mysqli=self::_db_connect();
		$sql="select * from countries where c_id='".$country."';";
		$result=$mysqli->query($sql) or die($mysqli->error);
		mysqli_close($mysqli);
		$res=$result->fetch_row();
		return $res[1];
	}

	private function _get_indicator_name($indicator){
		$mysqli=self::_db_connect();
		$sql="select * from indicators where i_id='".$indicator."';";
		$result=$mysqli->query($sql) or die($mysqli->error);
		mysqli_close($mysqli);
		$res=$result->fetch_row();
		return $res[1];
	}

	private function _put_zeros($result,$firstyear,$lastyear,$country,$indicator){
		$newarray=array();
		$current_year=$firstyear;
		while($current_year<=$lastyear){
			while ($row = $result->fetch_row()){
				while($current_year<$row[2]){
					$temp_array=array($row[0],$row[1],$current_year,'0');
					$current_year=$current_year+1;
					$newarray[]=$temp_array;
				}
				$temp=array($row[0],$row[1],$row[2],$row[3]);
				$newarray[]=$temp;
				$current_year=$row[2]+1;
    			}
			if($current_year>$lastyear)
				break;
			$temp_array=array($country,$indicator,$current_year,'0');
			$current_year=$current_year+1;
			$newarray[]=$temp_array;
		}
		return $newarray;
	}

	private function _get_the_years($years){
		$mysqli=self::_db_connect();
		$sql="select firstyear,lastyear from years where years_id='".$years."';";
		$result=$mysqli->query($sql) or die($mysqli->error);
		$row = $result->fetch_row();
		return $row;		
	}

	private function _db_connect(){
		$db = new mysqli(self::$_db_host,self::$_db_user,self::$_db_password,self::$_db_name);
		if(mysqli_connect_errno()){
			$error='Error connecting to database: '.mysqli_connect_error();
			die($error);
		}
		return $db;
	}

	public function _find_countries(){
		$mysqli=self::_db_connect();
		$sql="select * from countries ORDER BY country_name;";
		$result=$mysqli->query($sql) or die($mysqli->error);
		mysqli_close($mysqli);
		return $result;
	}

	public function _find_indicators(){
		$mysqli=self::_db_connect();
		$sql="select * from indicators ORDER BY indicator_name;";
		$result=$mysqli->query($sql) or die($mysqli->error);
		mysqli_close($mysqli);
		return $result;
	}

	private function _find_data_by_ids($c_id,$i_id,$year){
		$file = 'data.tsv';
		$current_year=1960;
		$mysqli=self::_db_connect();
		//$sql="select * from worlddata where country_id='".$c_id."' and indicator_id='".$i_id."' and year=".$year.";";
		$sql="select * from worlddata where country_id='".$c_id."' and indicator_id='".$i_id."';";
		$result=$mysqli->query($sql) or die($mysqli->error);
		$handle = fopen($file, "w");
		$mystring="xaxis\tyaxis\n";
		$fwrite = fwrite($handle,$mystring);
		while ($row = $result->fetch_row()) {
			while($current_year<$row[2]){
				$mystring=$current_year."\t0\n";
				$fwrite = fwrite($handle,$mystring);
				$current_year=$current_year+1;
			}	
			$mystring=$row[2]."\t".$row[3]."\n";
        		//printf ("%s (%s) %s %s\n", $row[0], $row[1],$row[2],$row[3]);
			$fwrite = fwrite($handle,$mystring);
			$current_year=$row[2]+1;
    		}
		fclose($handle);
		mysqli_close($mysqli);
		return $result;
	}
}
?>
