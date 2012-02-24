<?php
require_once ("admin_include.php");

if (isset($_GET["logout"])) {
	$authentication -> logout();
}

if (!$authentication -> checkLogin()) {
	header("Location: login.php");
}
?>

<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="styles/site.css" />
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.2.2/underscore-min.js"></script>
	<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/backbone.js/0.5.3/backbone-min.js"></script>
	
	<link type="text/css" href="../styles/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
    <script type="text/javascript" src="../javascript/jquery-ui-1.8.16.custom.min.js"></script>
	
	<script type="text/javascript" src="../javascript/models/basebackbonecollection.js?<?php echo time(); ?>"></script>
	<script type="text/javascript" src="../javascript/models/teacher.js?<?php echo time(); ?>"></script>
	<script type="text/javascript" src="../javascript/models/course.js?<?php echo time(); ?>"></script>
	<script type="text/javascript" src="javascript/models/courseteachermodel.js?<?php echo time(); ?>"></script>	
	<script type="text/javascript" src="javascript/views/courselist.js?<?php echo time(); ?>"></script>
	<script type="text/javascript" src="javascript/views/teacherlist.js?<?php echo time(); ?>"></script>
	<script type="text/javascript" src="javascript/admin.js?<?php echo time(); ?>"></script>
	<title> Admin Page </title>
</head>
<body>
	<a href="?logout=1">Logout!</a>
	<div id="linkerContainer">
		<h2>Кой преподава по какво ?</h2>
		<input type="text" class="input" id="coursebox" placeholder="Име на предмет" />
		<input type="hidden" id="courseId" value="-1" />
		<br />
		<input type="text" class="input" id="teacherbox" placeholder="Име на преподавател" />
		<input type="hidden" id="teacherId" value="-1" />
		<br />
		<input type="button" value="Link" id="linkTeacherButton" />
	</div>
</body>
</html>