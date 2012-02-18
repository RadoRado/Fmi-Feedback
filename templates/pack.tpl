<!DOCTYPE html>
<html>
	<head>
		<meta property="og:title" content="Система за обратна връзка към ФМИ" />
		<meta property="og:image" content="http://game-craft.com/fmifeedback/images/header.png" />
		<link rel="stylesheet" type="text/css" href="../styles/pack.css" />
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Обратна връзка до сега</title>
	</head>
	<body>
		
		<div id="feedbackContainer">
		<h1>Всичко до сега : {$feedbackCount} обратни връзки</h1>
		<div class="special-text">Поради съображения за сигурност, имената на студентите не се показват.</div>
		{foreach from=$pack item=v name=pack}
			<div class="person-feedback">
				<a class="course" href=#{$smarty.foreach.pack.index} name="{$smarty.foreach.pack.index}">
				<h2 class="course-name">{$v["courseName"]} {geticon rating=$v["courseRating"]} : {$v["teacherName"]} {geticon rating=$v["teacherRating"]}</h2>
				<div class="date">Написано на {$v["createdDate"]}</div>
				</a>
					<div class="data">
						<div class="positive">
							<img class="positive-face" width="50" height="50" src="../images/positive-face.png" alt=""/>
							<div class="positive-title">Позитивно</div>
						</div>
						
						<div class="bubble">
								{$v["positive"]|default:'<span class="gray">Не е въведен текст</span>'}
								<div class="bubble-arrow-border"></div>
								<div class="bubble-arrow"></div>
						</div>
						<div class="negative">
							<img class="positive-face" width="50" height="50" src="../images/negative-face.png" alt=""/>
							<div class="negative-title">Отрицателно</div>
						</div>
							<div class="bubble">
									{$v["negative"]|default:'<span class="gray">Не е въведен текст</span>'}
									<div class="bubble-arrow-border"></div>
									<div class="bubble-arrow"></div>
							</div>
					</div>
						<a class="back" href="http://game-craft.com/fmifeedback/" > 
						< Върни се и дай твоето мнение
						</a>
			</div>	
		{/foreach}
		</div>
	</body>
</html>