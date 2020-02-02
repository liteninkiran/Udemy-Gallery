  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

	<script src="http://tinymce.cachefly.net/4.1/tinymce.min.js"></script>

	<script src="js/scripts.js"></script>
	<script src="js/dropzone.js"></script>

	<script type="text/javascript">

		google.load("visualization", "1", {packages:["corechart"]});
		google.setOnLoadCallback(drawChart);

		function drawChart()
		{
			var data = google.visualization.arrayToDataTable
			([
				['Task'   , 'Hours per Day'],
				['Views'  , <?php echo $session->visitorCount; ?>],
				['Comment', <?php echo Comment::countRecords(); ?>],
				['Users'  , <?php echo User::countRecords(); ?>],
				['Photos' , <?php echo Photo::countRecords(); ?>]
			]);

			var options =
			{
				// legend:'none',
				// pieSliceText: 'label',
				// title: 'My Daily Activities',
				backgrounColor: 'transparent'
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart'));

			chart.draw(data, options);
		}

    </script>




</body>

</html>
