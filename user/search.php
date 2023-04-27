<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
	</script>
<script>

	$(document).ready(function()
	{
		$('#search').keyup(function() {
			var d = $('#search').val();
			//console.log(d);

			if(d!='')
			{
				$.ajax({

						url:'search_product.php',
						method:'post',
						data:{ d:d },
						success:function(data){
							$('#display').html(data);
						}


				})

			}
		});

	});
			
	</script>

</head>
<body>

	<input type="text" name="" id="search">

    <div id="display"></div>
</body>
</html>