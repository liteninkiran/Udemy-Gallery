	<?php

		include("includes/header.php");

		if(!$session->isSignedIn())
		{
			redirect("login.php");
		}

		$photos = Photo::getRecords();

	?>

	<!-- Navigation -->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

		<!-- Brand and toggle get grouped for better mobile display -->
		<?php include("includes/top_nav.php"); ?>

		<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
		<?php include("includes/side_nav.php"); ?>

	</nav>

	<div id="page-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">
						Photos
					</h1>

					<p class="bg-success">
						<?php echo $session->message; ?>
					</p>

					<div class="col-md-12">

						<table class="table table-hover">
							<thead>
								<tr>
									<th width="80px">ID</th>
									<th>Photo</th>
									<th>Title</th>
									<th>Caption</th>
									<th>Alt Text</th>
									<th>Description</th>
									<th>File Name</th>
									<th>Type</th>
									<th width="100px">Size</th>
									<th>Comments</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($photos as $photo): ?>
									<tr>
										<td><?php echo $photo->id; ?></td>
										<td>
											<a href="comments.php?id=<?php echo $photo->id; ?>">
												<img class="admin-photo-thumbnail" src="<?php echo $photo->picturePath(); ?>" alt="">
											</a>
											<div class="action_links">
												<a class="delete_link" href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a>
												<a href="edit_photo.php?id=<?php echo $photo->id; ?>">Edit</a>
												<a href="../photo.php?id=<?php echo $photo->id; ?>">View Comments</a>
											</div>
										</td>
										<td><?php echo $photo->title; ?></td>
										<td><?php echo $photo->caption; ?></td>
										<td><?php echo $photo->alternate_text; ?></td>
										<td><?php echo $photo->description; ?></td>
										<td><?php echo $photo->filename; ?></td>
										<td><?php echo $photo->type; ?></td>
										<td style="text-align: right;"><?php echo formatBytes($photo->size); ?></td>

										<td style="text-align: center;">
											<a href="comments.php?id=<?php echo $photo->id; ?>" class="btn btn-primary">
												<?php
													$comments = Comment::getComments($photo->id);
													if(count($comments) == 0)
													{
														echo "-";
													}
													else
													{
														echo count($comments);
													}
												?>
											</a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>

					</div>

				</div>
			</div>
		</div>
	</div>

	<?php include("includes/footer.php"); ?>


<?php
/*

Version:

(PHP 4 and above)

Syntax:

number_format(number, decimals, dec_point, thousands_sep) 

Parameter:

															Required
Name			Description									   OR			Type
															Optional

number			The input number.							Required		Float
decimals		Refer to the number of decimal points.		Optional		Integer
dec_point		Refers the separator of decimal points.		Optional		String
thousands_sep	Refers the thousands separator.				Optional		String

Note:			The function accepts one, two, or four parameters (not three).
Return value:	A formatted version of the number.
Value Type:		String
Example:		<?php
					$number=100000;
					echo number_format($number).'<br>';
					echo number_format($number, 2).'<br>';
					echo number_format($number, 3).'<br>';
					echo number_format($number, 2, ',', '.');
				?>

Output:			100,000
				100,000.00
				100,000.000
				100.000,00 

*/

?>
