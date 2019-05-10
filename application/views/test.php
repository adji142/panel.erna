<!DOCTYPE html>

<html>

<head>

	<title>How to convert image into base64 string jQuery?</title>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>

<form>

	<input type="file" name="image" onchange="encodeImagetoBase64(this)">

	<button type="submit">Submit</button>

	<a class="link" href=""></a>

</form>

</body>

<script type="text/javascript">

   function encodeImagetoBase64(element) {

	  var file = element.files[0];

	  var reader = new FileReader();

	  reader.onloadend = function() {

	    $(".link").attr("href",reader.result);

	    $(".link").text(reader.result);

	  }

	  reader.readAsDataURL(file);

	}

</script>

</html>