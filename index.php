<?php

	include("includes/header.php");

	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
	$pageRows = 15;
	$photoCount = Photo::countRecords();

	$paginate = new Paginate($page, $pageRows, $photoCount);

	$photos = Photo::getRecords($pageRows, $paginate->offset());

?>

<div class="row">

	<!-- Blog Entries Column -->
	<div class="col-md-12">
		<div class="thumbnails row">
			<?php foreach($photos as $photo): ?>
				<div class="home_page_row col-xs-6 col-md-3">
					<a class="thumbnail" href="photo.php?id=<?php echo $photo->id; ?>">
						<img src="admin/<?php echo $photo->picturePath(); ?>" alt="">
					</a>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="row">
			<ul class="pager">
				<?php
					if($paginate->pageTotal() > 1)
					{
						if($paginate->hasNext())
						{
							echo "<li class='next'><a href='index.php?page={$paginate->next()}'>Next</a></li>";
						}

						for($i = 1; $i <= $paginate->pageTotal(); $i++)
						{
							if($i == $paginate->currentPage)
							{
								echo "<li class='active'><a href='index.php?page={$i}'>{$i}</a></li>";
							}
							else
							{
								echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
							}
						}

						if($paginate->hasPrevious())
						{
							echo "<li class='previous'><a href='index.php?page={$paginate->previous()}'>Previous</a></li>";
						}
					}
				?>
			</ul>
		</div>
	</div>

<?php include("includes/footer.php"); ?>
