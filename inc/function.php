<?php
//kiểm tra xem kết quả trả về có đúng hay không
function kt_query($result, $query)
{
	global $dbc; //biến global là biến siêu toàn cục, nó lấy tất cả các biến trong thư mục web của mình
	if(!$result)
	{
		die("Query {$query} \n<br> MYSQL Error:".mysqli_error($dbc));
	}
}
?>