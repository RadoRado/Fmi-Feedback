
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="styles/site.css" />
     <script src="http://code.jquery.com/jquery-latest.js"></script>
        <link type="text/css" href="javascript/ui/css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />

        <script type="text/javascript" src="javascript/ui/js/jquery-ui-1.8.16.custom.min.js"></script>

        <script type="text/javascript" src="javascript/additional_prototypes.js"></script> 
        <script type="text/javascript" src="javascript/validator.js"></script>
        <script type="text/javascript" src="javascript/main.js"></script> 
        <script type="text/javascript" src="javascript/teacher_linking_window.js"></script>         
        <script type="text/javascript" src="javascript/ajax.js"></script>
        <script type="text/javascript" src="javascript/index.js"></script>
				
		<script>
			$(function(){
				{$validatorCode}
			});
		</script>		
		
    <title>
    	ФМИ feedback система
    </title>
</head>
<body>

<div id="error_message_wrap">
	<div id="error_message" {if !$error}style="display: none;"{/if}>{$error}</div>
</div>

<div id='header_bg'>

	<div id='header'>	
	<img width='891' height='202' src='images/header.png' >
	</div>

</div>

<div id="completedWrapper">
<div id='completed'>	
<img width='227' height='85' src='images/exp-bar.png' />	
</div>	
</div>
<form id="just_form" method="post" action="">
<div id='arrows_background'>
	
	<div class="first_question">
	   <input type="text" class="panelselect" id="coursebox" name="coursebox" value="{$coursebox}" />
       <input type="hidden" id="courseId" name="courseId" value="{$courseId}" />
	</div>
	
	<div class="second_question">
	                    <select class="panelselect" name="teacherbox" id="teacherbox">
							{foreach from=$teacherList item=v}
							<option value="{$v['uid']}" {if $teacherbox == $v['uid']}selected="selected"{/if}>{$v['name']}</option>
							{foreachelse}
							<option value="-1">Изберете предмет</option>
							{/foreach}
				        </select>
	</div>
	
	
	<div class="radiowrapper emoticons_1">
                                <div class="radio sad {if $courseEmoticon == -1}selected{/if}"></div>
                                <div class="radio neutral {if $courseEmoticon == 0}selected{/if}"></div>
                                <div class="radio happy {if $courseEmoticon == 1}selected{/if}"></div>
                                <input type="hidden" name="courseEmoticon" value="{$courseEmoticon}" />
    </div>
	
	<div class="radiowrapper emoticons_2">
                                <div class="radio sad {if $subjectEmoticon == -1}selected{/if}"></div>
                                <div class="radio neutral {if $subjectEmoticon == 0}selected{/if}"></div>
                                <div class="radio happy {if $subjectEmoticon == 1}selected{/if}"></div>
                                <input type="hidden" name="subjectEmoticon" value="{$subjectEmoticon}" />
    </div>
	
	<div class = 'div_possitive_feedback' >
	<label class='feedback'>Вашето позитивно мнение:</label>
	<br>
	<textarea class = 'input_possitive_feedback' rows="2" cols="20" name="positive">{$positive}</textarea>
	</div>

	<div class="div_negative_feedback" >
	<label class="feedback">Вашето негативно мнение:</label>
	<br>
	<textarea class="input_negative_feedback" rows="2" cols="20" name="negative">{$negative}</textarea>
	</div>

	<div id="owl_question">
		<div id="owl_question_text">
			Благодарим за вашата информация! 
			<br/>
			Искате ли да кажете вашите 
			<br/>
			<em>име</em> и <em>специалност</em>?
			<br />
			<input type="checkbox" name="authenticated" id="checkme" value="yes" {if $authenticated}checked="checked"{/if} />
		</div>
	<img class="owl" width="547" height="213" src="images/owl-question.png" />
	</div>

	<div id="student_answer">
	<div id="student_answer_text">
		Казвам се:&nbsp <input type="text" class="student_name" name="student_name" value="{$student_name}"> <br>
		<var class='student_row2' >и изучавам: <var>&nbsp <select id="subjects" name="student_subject">
                            {foreach from=$subjects key=id item=name}
                                <option value="{$id}" {if $student_subject == $id}selected="selected"{/if}>{$name}</option>
                            {/foreach}
                        </select> <br>
	</div>
	</div>

<div id="recaptcha">
{strip}
{$recaptcha}
{/strip}
</div>
	<input id="sendButton" type="submit" value="" />

	
</div>

</form>

<div id="linkerWindow" style="visibility:hidden">
<p class="title">Кой преподава по {0} ?</p>
</div>

</body>
</html>