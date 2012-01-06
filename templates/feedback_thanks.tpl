<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
    <head> 
        <title>FMI Feedback</title> 
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
				
        <link rel="stylesheet" type="text/css" href="styles/site.css" /> 
        <link rel="stylesheet" type="text/css" href="styles/thanks.css" /> 
        
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script type="text/javascript" src="javascript/additional_prototypes.js"></script> 
        <script type="text/javascript" src="javascript/main.js"></script>
        <script type="text/javascript" src="javascript/thanks_jquery.js"></script>
         
    </head> 
    <body> 
        <div id="content">
        	<form id="gamifiedEducation">
        		<input type="hidden" value="{$feedbackId}" id="feedbackId" />
        		<h2>А би ли желал образованието да бъде като игра ?</h2>
        		<br />
        		<input type="button" value="Да" class="button yes" />
        		<input type="button" value="Не" class="button no" />
        	</form>
        	<div id="thankYouMessage">
				<h2>Благодаря за обратната връзка. Твоето мнение е важно за бъдещето на Факултета :)</h2>
				Ако искаш, <a href="http://game-craft.com/fmifeedback/"><strong>може да дадеш още обратна връзка!</strong></a>
        	</div>
        </div>
    </body> 
</html>