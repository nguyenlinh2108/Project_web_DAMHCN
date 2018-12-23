<div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li style="background:#463635;color:#fff;">
                        <a href="index.php" style="color:#fff;"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>   
                    <?php 
                    $dem=1;
                    foreach ($mang as $key => $mang_slider)
                    {
                        if(isset($admin) && $admin->level === "Biên tập viên" && $key === "User") continue;
                    
                    ?>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo_<?php echo $dem; ?>"><i class="fa fa-fw fa-file"></i> <?php echo $mang_slider['title']; ?> <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo_<?php echo $dem; ?>" class="collapse">
                            <li>
                                <a href="<?php echo $mang_slider['link_themmoi']; ?>">Thêm mới</a>
                            </li>
                            <li>
                                <a href="<?php echo $mang_slider['link_list']; ?>">Danh sách</a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    $dem++;
                    }                     
                    ?> 					
                </ul>
            </div>