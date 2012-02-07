<!DOCTYPE html>
<html>
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Обратна връзка до сега</title>
	</head>
	<body>
		<h1>Всичко до сега : {$feedbackCount} обратни връзки</h1>
		<div id="feedbackContainer">
		{foreach from=$pack item=v}
			<h2>{$v["courseName"]}({$v["courseRating"]}) : {$v["teacherName"]}({$v["teacherRating"]}) : {$v["createdDate"]}</h2>
				<h3>Positive</h3>
					{$v["positive"]}
				<h3>Negative</h3>
					{$v["negative"]}
		{/foreach}
		</div>
	</body>
</html>