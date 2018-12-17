
<?php
    include('includes/header.php');
    require_once __DIR__ . "/../db/db.php";
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Dánh sách ảnh Slider</h3>
        <a href="add_slider.php" class="btn btn-primary" style="float: right">Thêm mới</a>
		<table class="table table-hover">
			<thead>	
				<tr>
					<th>Mã</th>
					<th>Link</th>
					<th>Ảnh</th>						
					<th>Edit</th>					
					<th>Delete</th>					
				</tr>
			</thead>
			<tbody>
				<?php
                $db = db::getInstance();
					//đặt số bản ghi cần hiện thị
					$limit=10;
					//Xác định vị trí bắt đầu
					if(isset($_GET['s']) && filter_var($_GET['s'],FILTER_VALIDATE_INT,array('min_range'=>1)))
					{
						$start=$_GET['s'];
					} 	
					else
					{
						$start=0;
					}	
					if(isset($_GET['p']) && filter_var($_GET['p'],FILTER_VALIDATE_INT,array('min_range'=>1)))
					{
						$per_page=$_GET['p'];
					} 
					else
					{
						//Nếu p không có, thì sẽ truy vấn CSDL để tìm xem có bao nhiêu page
//						$query_pg="SELECT COUNT(id) FROM slide";

						//Tìm số trang bằng cách chia số dữ liệu cho số limit
                        if($db->select_one("SELECT COUNT(id) FROM slide"))
                        {
                            $total = $db->getResult()->{'COUNT(id)'};

                            $per_page = ceil (intval($total)/$limit);
                        }
						else
						{
							$per_page=1;
						}
					}					
					$query="SELECT id, link, image FROM slide ORDER BY id LIMIT {$start},{$limit}";
					if($db->select($query))
                    {
                        foreach ($db->getResult() as $obj)
                        {
                         ?>
                            <tr>
                                <td><?php echo $obj->id; ?></td>
                                <td><?php echo$obj->link; ?></td>
                                <td>
                                    <a href="edit_image_slider.php?id=<?php echo $obj->id;?>" style="font-size: 10px">
                                        <img width="100px" src="/public/upload/slider/<?php echo $obj->image; ?>"/>
                                        Edit image
                                    </a>
                                </td>
                                <td><a href="edit_slider.php?id=<?php echo $obj->id; ?>"><img width="16" src="/public/images/icon_edit.png"></a></td>
                                <td><a href="delete_slider.php?id=<?php echo $obj->id;?>" onclick="return confirm('Bạn có thực sự muốn xóa không');"><img width="16" src="/public/images/icon_delete.png"></a></td>
                            </tr>

                            <?php
                        }
					}
				?>				
			</tbody>
		</table>
		<?php 
			echo "<ul class='pagination'>";
			if($per_page > 1)
			{
				$current_page=($start/$limit) + 1;
				//Nếu không phải là trang đầu thì hiện thị trang trước
				if($current_page !=1)
				{
					echo "<li><a href='list_slider.php?s=".($start - $limit)."&p={$per_page}'>Back</a></li>";
				}
				//hiện thị những phần còn lại của trang
				for ($i=1; $i <= $per_page ; $i++) 
				{ 
					if($i != $current_page)
					{
						echo "<li><a href='list_slider.php?s=".($limit *($i - 1))."&p={$per_page}'>{$i}</a></li>";
					}
					else
					{
						echo "<li class='active'><a>{$i}</a></li>";
					}
				}
				//Nếu không phải trang cuối thì hiện thị nút next
				if($current_page != $per_page)
				{
					echo "<li><a href='list_slider.php?s=".($start + $limit)."&p={$per_page}'>Next</a></li>";
				}
			}
			echo "</ul>";			
		?>		
	</div>
</div>
<?php include('includes/footer.php'); ?>