<!-- JavaScript Bundle with Popper -->
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<div class="alert alert-info" role="alert">
	<i class="fas fa-info-circle"></i> info: Bill history tab helps to see bill of the customer just by entering CustomerID into the search bar below.</br>
	Keep that in mind each row represent a unique table, deleting row might be loosing the data(orders) associated with it.
</div>

<!--start-->
<div class="table-responsive" style="margin-top:10px;border: none;">
	<div id="hi">

	</div>

</div>

<script>
	function loadXMLDoc() {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("hi").innerHTML =
					this.responseText;
			}
		};
		xhttp.open("GET", "inc/server.php", true);
		xhttp.send();
	}
	setInterval(function() {
		loadXMLDoc();
	}, 1000);
	window.onload = loadXMLDoc;
</script>