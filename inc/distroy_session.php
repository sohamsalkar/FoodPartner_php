<?php
session_start();

if (isset($_SESSION['CODE'], $_SESSION['MATES'], $_SESSION['TABLE_NO'])) {
	if (isset($_COOKIE['CODE'])) {

		unset($_COOKIE['CODE']);
		unset($_COOKIE['TABLE_NO']);

		setcookie('CODE', FALSE, -1, '/');
		setcookie('TABLE_NO', FALSE, -1, '/');


		unset($_SESSION['CODE']);
		unset($_SESSION['MATES']);
		unset($_SESSION['TABLE_NO']);
		unset($_SESSION['order_id']);
		unset($_SESSION['tblno']);
		unset($_SESSION['user_id']);
		session_destroy();

?>

		<body>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
			<script type="text/javascript">
				localStorage.removeItem('time');
				localStorage.removeItem('firstTime');
				window.localStorage.clear();
			</script>
		</body>



<?php

		header("refresh:3;url=againscan.php"); //localstorage need time time to clear up the space..
		exit('Successfully logged out.. ');
	}
} else {
	//emergency or direct access

	setcookie('CODE', FALSE, -1, '/');
	setcookie('TABLE_NO', FALSE, -1, '/');
	session_destroy();
	header("refresh:3;url=againscan.php");
	exit('Redirect in 3 seconds...');
}

?>

<script type='text/javascript'>
	window.close();
</script>