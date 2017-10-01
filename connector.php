<?php
 if(!empty($_GET['basic_info'])){
	 $name=$_GET['name'];
	 $phone=$_GET['phone'];
	 $email=$_GET['email'];
	 $address=$_GET['address'];
	 $result=setBasic($name,$email,$phone,$address);
	 echo "success";
 }
 function setBasic($name,$email,$phone,$address){
	 $names=explode(' ',$name);
	 $fname=validate($names[0]);
	 $lname=validate($names[1]);
	 $email=validate($email);
	 $phone=validate($phone);
	 $address=validate($address);
	 $query="insert into basic_info(first_name,last_name,email,phone,address) values('$fname','$lname','$email','$phone','$address')";
	 return insertRow($query);
 }
 function validate($val){
	 $val=trim($val);
	 $val=htmlspecialchars($val);
	 $val=stripslashes($val);
	 $val=stripcslashes($val);
	 return $val;
 }
 function connect(){
	 $db="(DESCRIPTION =(ADDRESS= (PROTOCOL= TCP)(HOST=192.168.103.2)(PORT=1521))(CONNECT_DATA=(SERVER=DEDICATED)(SERVICE_NAME=XE)))";
	 $connect=oci_connect("HR","hr","XE");
	 return $connect;
 }
 function insertRow($query){
	 $connect=connect();
	 $result=oci_parse($connect,$query);
	 if(oci_execute($result))
		 return true;
	 else return false;
 }
 function executeQuery($query){
	 $connect=connect();
	 $result=oci_parse($connect,$query);
	 return oci_execute($result);
 }
 function getString($query){
	 $connect=connect();
	 $result=oci_parse($connect,$query);
	 $rs=oci_execute($result);
	 while($row=oci_fetch_array($rs)){
		 if(!empty($row[0]))
			 return $row[0];
	 }
	 return false;
 }
?>