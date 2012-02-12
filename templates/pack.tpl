<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../styles/pack.css" />
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Обратна връзка до сега</title>
	</head>
	<body>
		
		<div id="feedbackContainer">
		<h1>Всичко до сега : {$feedbackCount} обратни връзки</h1>
		{foreach from=$pack item=v name=pack}
			<div class="person-feedback">
				<a href=#{$smarty.foreach.pack.index} name="{$smarty.foreach.pack.index}">
				<h2 class="course-name">{$v["courseName"]}({$v["courseRating"]}) : {$v["teacherName"]}({$v["teacherRating"]}) : {$v["createdDate"]}</h2>
				</a>
					<div class="data">
						<div class="positive">
							<img class="positive-face" width="50" height="50" src="../images/positive-face.png" alt=""/>
							<div class="positive-title">Позитивно</div>
						</div>
						
						<div class="bubble">
								{$v["positive"]}
								<div class="bubble-arrow-border"></div>
								<div class="bubble-arrow"></div>
						</div>
						<div class="negative">
							<img class="positive-face" width="50" height="50" src="../images/negative-face.png" alt=""/>
							<div class="negative-title">Отрицателно</div>
						</div>
							<div class="bubble">
									{$v["negative"]}
									<div class="bubble-arrow-border"></div>
									<div class="bubble-arrow"></div>
							</div>
					</div>
			</div>	
		{/foreach}
		</div>
	</body>
</html>
