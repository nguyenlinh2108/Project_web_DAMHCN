<?php error_reporting(0);?>
<style type="text/css">
.required
{
	color:red;
}
</style>
<?php include('includes/header.php') ?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
		<?php 					 
			include('../inc/images_helper.php');
			include('../inc/myconnect.php');
			include('../inc/function.php');
			if($_SERVER['REQUEST_METHOD']=='POST')
			{
				$errors=array();
				if(empty($_POST['link']))
				{
					$errors[]='link';
				}
				else
				{
					$title=$_POST['link'];
				}								
						
				// $link=$_POST['link'];								
				// $status=$_POST['status'];
				if(empty($errors))
				{
					//Upload ảnh
					if(($_FILES['img']['type']!="image/gif")
						&&($_FILES['img']['type']!="image/png")
						&&($_FILES['img']['type']!="image/jpeg")
						&&($_FILES['img']['type']!="image/jpg"))
					{
						$message="File không đúng định dạng";	
					}
					elseif ($_FILES['img']['size']>1000000) 
					{
						$message="Kích thước phải nhỏ hơn 1MB";						
					}
					elseif ($_FILES['img']['size']=='') 
					{
						$message="Bạn chưa chọn file ảnh";
					}
					else
					{
						$img=$_FILES['img']['name'];
						$link_img='upload/'.$img;
						move_uploaded_file($_FILES['img']['tmp_name'],"../upload/".$img);																														
						//Xử lý Resize, Crop hình anh
							// $temp=explode('.',$img);
							// if($temp[1]=='jpeg' or $temp[1]=='JPEG')
							// {
							// 	$temp[1]='jpg';
							// }
							// $temp[1]=strtolower($temp[1]);
							// $thumb='upload/resized/'.$temp[0].'_thumb'.'.'.$temp[1];
							// $imageThumb=new Image('../'.$link_img);
							// //Resize anh						
							// if($imageThumb->getWidth()>700)
							// {
							// 	$imageThumb->resize(700,'resize');
							// }				
							// //crop anh
							// //$imageThumb->resize(1280,468,'crop');
							// $imageThumb->save($temp[0].'_thumb','../upload/resized');
					}
					$query="INSERT INTO slide(link,image) 
						VALUES('{$link}','{$link_img}')";
					$results=mysqli_query($dbc,$query); 
					kt_query($results,$query);	
					if(mysqli_affected_rows($dbc)==1)
					{
						echo "<p style='color:green;'>Thêm mới thành công</p>";
					}
					else
					{
						echo "<p class='required'>Thêm mới không thành công</p>";	
					}
					$_POST['link']='';
					$_POST['img']='';					
				}
				else
				{
					$message="<p class='required'>Bạn hãy nhập đầy đủ thông tin</p>";
				}
			}
		?>
		<form name="frmadd_slider" method="POST" enctype="multipart/form-data">
			<?php 
				if(isset($message))
				{
					echo $message;
				}
			?>
			<h3>Thêm mới Slider</h3>
			<div class="form-group">
			<div class="form-group">
				<label>Link</label>
				<input type="text" value="<?php if(isset($_POST['link'])){ echo $_POST['link'];} ?>" name="link" class="form-control" placeholder="Link slider">
				<?php 
					if(isset($errors) && in_array('link',$errors))
					{
						echo "<p class='required'>Bạn chưa nhập link slider</p>";
					}
				?>
			</div>
			<div class="form-group">
				<label>Ảnh đại diện</label>
				<input type="file" name="img" value="">
			</div>
			<input type="submit" name="submit" class="btn btn-primary" value="Thêm mới">
		</form>
	</div>
</div>
<?php include('includes/footer.php') ?>