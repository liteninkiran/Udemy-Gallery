
	$(document).ready(function()
	{

		// Confirm Delete
		$(".delete_link").click(function()
		{
			return confirm("Are you sure you want to delete this record?");
		});


		// Toggle Record Details

		$(".info-box-header").click(function()
		{
			$(".inside").slideToggle("fast");
			$("#toggle").toggleClass("glyphicon-menu-down glyphicon , glyphicon-menu-up glyphicon ");
		});



		// Edit Photo Sidebar

		var userHref;
		var userHrefSplitted;
		var userId;

		var photoSource;
		var photoHrefSplitted;
		var photoName;

		var photoId;

		// User clicks on image
		$(".modal_thumbnails").click(function()
		{
			// Enable the button
			$("#set_user_image").prop('disabled', false);

			// Store the URL & extract user ID
			userHref = $("#user-id").prop('href');
			userHrefSplitted = userHref.split('=');
			userId = userHrefSplitted[userHrefSplitted.length -1];

			// Store photo URL
			photoSource = $(this).prop('src');
			photoHrefSplitted = photoSource.split('/');
			photoName = photoHrefSplitted[photoHrefSplitted.length -1];

			// Store the photo ID
			photoId = $(this).attr('data');

			$.ajax(
			{
				url: "includes/ajax_code.php",
				data:{photoId: photoId},
				type: "POST",
				success:function(data)
				{
					if(data.error)
					{

					}
					else
					{
						$("#modal_sidebar").html(data);
					}
				}
			});

		});

		// User clicks on "Apply Selection"
		$("#set_user_image").click(function()
		{
			$.ajax(
			{
				url: "includes/ajax_code.php",
				data:{photoName: photoName, userId: userId},
				type: "POST",
				success:function(data)
				{
					if(data.error)
					{
						alert("Error");
					}
					else
					{
						//$(".user_image_box a img").prop('src', data);
						location.reload(true);
					}
				}
			});
		});

		tinymce.init({selector:'textarea'});
	});

