<?php
	//kết nối với csdl

	$dbc=mysqli_connect('localhost', 'root', '', 'ban_hang');
	//nếu kết nối không thành công thì in ra lỗi
	if(!$dbc)
	{
		echo 'Kết nối không thành công.';
	}
	else
	{
		mysqli_set_charset($dbc, 'utf8');

	}
 ?>

