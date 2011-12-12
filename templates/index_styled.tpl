
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="styles/site.css" />
     <script src="http://code.jquery.com/jquery-latest.js"></script>
        <link type="text/css" href="javascript/ui/css/start/jquery-ui-1.8.16.custom.css" rel="stylesheet" />

        <script type="text/javascript" src="javascript/ui/js/jquery-ui-1.8.16.custom.min.js"></script>

        <script type="text/javascript" src="javascript/additional_prototypes.js"></script> 
        <script type="text/javascript" src="javascript/main.js"></script> 
        <script type="text/javascript" src="javascript/ajax.js"></script> 
    <title>
    	ФМИ feedback система
    </title>
</head>
<body>

<div id='header_bg'>

	<div id='header'>	
	<img width='891' height='202' src='images/header.png' >
	</div>

</div>
<form>
<div id='arrows_background'>
	
	<div class="first_question">
	   <input type="text" class="panelselect" id="coursebox" />
       <input type="hidden" id="courseId" name="courseId" value="-1" />
	</div>
	
	<div class="second_question">
	                    <select class="panelselect" name="teacherbox" id="teacherbox">
                    	<option value="-1">Изберете предмет</option>
                    </select>
	</div>
	
	<div class='emoticons_1'>
	<img width='42' height='42' src='images/emoticon1.png' >
	<img width='42' height='42' src='images/emoticon2.png' >
	<img width='42' height='42' src='images/emoticon3.png' >
	</div>
	
	<div class='emoticons_2'>
	<img width='42' height='42' src='images/emoticon1.png' >
	<img width='42' height='42' src='images/emoticon2.png' >
	<img width='42' height='42' src='images/emoticon3.png' >
	</div>
	
	<div class = 'div_possitive_feedback' >
	<label class='feedback'>Вашето позитивно мнение:</label>
	<br>
	<textarea class = 'input_possitive_feedback' rows="2" cols="20"></textarea>
	</div>

	<div class = 'div_negative_feedback' >
	<label class='feedback'>Вашето негативно мнение:</label>
	<br>
	<textarea class = 'input_negative_feedback' rows="2" cols="20"></textarea>
	</div>

	<div id='owl_question'>
		<div id='owl_question_text'>
			Благодарим за вашата информация! <br>
			Искате ли да кажете вашите <br>
			<em>име</em> и <em>специалност</em>?<br>
			<input type="checkbox" name="authenicated" value="yes" /> Да, разбира се! <br>
		</div>
	<img class = 'owl' width='547' height='213' src='images/owl-question.png' >
	</div>

	<div id='student_answer'>
	<div id='student_answer_text'>
		Казвам се:&nbsp <input type='text' class='student_name'></textarea> <br>
		<var class='student_row2' >и изучавам: <var>&nbsp <select></select> <br>
	</div>
	</div>

	<input id = 'ready_button' type='submit' value='' />

	
</div>


</form>


</body>
</html>