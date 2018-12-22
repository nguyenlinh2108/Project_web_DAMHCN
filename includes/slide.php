<?php
require_once __DIR__ . "/../db/db.php";
$db = db::getInstance();
if($db->select("SELECT * FROM slide ORDER BY RAND() LIMIT 3"))
{
    $slides = $db->getResult();
}
?>
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
	<div class="carousel-inner" role="listbox">
        <?php
        if(isset($slides) && is_array($slides))
        {
            for ($i = 0; $i < count($slides); $i++)
            {
                ?>
                <div class="carousel-item <?php if($i === 0) echo 'active';?>">
                    <img style="height: 625px" class="d-block img-fluid" src="../public/upload/slider/<?= $slides[$i]->image ?>" alt="First slide">
                    <div class="layer">
                        <h2>welcome to the pods</h2>
                        <p><?= $slides[$i]->link ?></p>
                        <a href="../our_story.php" class="btn btn-chocolate">our story <span class="fa fa-chevron-circle-right"></span></a>
                    </div>
                </div>
                <?php
            }
        }else
        {
            ?>
            <div class="carousel-item active">
                <img class="d-block img-fluid" src="../public/images/big-banner.png" alt="First slide">
                <div class="layer">
                    <h2>welcome to the pods</h2>
                    <p>We're passionate chocolate. And making the world a better place.</p>
                    <a href="../our_story.php" class="btn btn-chocolate">our story <span class="fa fa-chevron-circle-right"></span></a>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block img-fluid" src="../public/images/big-banner.png" alt="Second slide">
                <div class="layer">
                    <h2>welcome to the pods</h2>
                    <p>We're passionate chocolate. And making the world a better place.</p>
                    <a href="../our_story.php" class="btn btn-chocolate">our story <span class="fa fa-chevron-circle-right"></span></a>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block img-fluid" src="../public/images/big-banner.png" alt="Third slide">
                <div class="layer">
                    <h2>welcome to the pods</h2>
                    <p>We're passionate chocolate. And making the world a better place.</p>
                    <a href="../our_story.php" class="btn btn-chocolate">our story <span class="fa fa-chevron-circle-right"></span></a>
                </div>
            </div>
            <?php
        }
        ?>
	</div>
	<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
		<span class="fa fa-angle-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
		<span class="fa fa-angle-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>