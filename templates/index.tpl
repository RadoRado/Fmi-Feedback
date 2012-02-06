<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta property="og:title" content="Система за обратна връзка към ФМИ" />
	<meta property="og:image" content="http://game-craft.com/fmifeedback/images/owl-head.png" />
    <link rel="stylesheet" type="text/css" href="styles/site.css" />
    <script src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.2.2/underscore-min.js"></script>
	<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/backbone.js/0.5.3/backbone-min.js"></script>
    <link type="text/css" href="styles/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
    <script type="text/javascript" src="javascript/jquery-ui-1.8.16.custom.min.js"></script>
	<script type="text/javascript" src="javascript/jquery.qtip.min.js"></script>
    <link type="text/css" href="styles/jquery.qtip.min.css" rel="stylesheet" />	
    <script type="text/javascript" src="javascript/additional_prototypes.js"></script>
    
    <script type="text/javascript" src="javascript/models/teacher.js"></script>
    <script type="text/javascript" src="javascript/models/course.js"></script>
    <script type="text/javascript" src="javascript/views/courseinput.js"></script>
    <script type="text/javascript" src="javascript/views/teacherselect.js"></script>
     
     
    <script type="text/javascript" src="javascript/validator.js"></script>
    <script type="text/javascript" src="javascript/index.js"></script>
				
		<script type="text/javascript">
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
<a target="_blank" href="https://github.com/RadoRado/Fmi-Feedback/blob/master/README.markdown">
За какво става <br>
въпрос ?
</a>
</div>	
</div>

<form id="just_form" method="post" action="">
<div id='arrows_background'>
	
	<div id="courseInputContainer" class="first_question">
	   <input type="text" class="panelselect" id="coursebox" name="coursebox" value="{$coursebox}" placeholder="Въведи предмет на кирилица" />
       <input type="hidden" id="courseId" name="courseId" value="{$courseId}" />
	</div>
	
	<div class="second_question">
	                    <select class="panelselect" name="teacherbox" id="teacherbox">
							{foreach from=$teacherList item=v}
							<option value="{$v['uid']}" {if $teacherbox == $v['uid']}selected="selected"{/if}>{$v['name']}</option>
							{foreachelse}
							<option value="-1">Първо избери предмет</option>
							{/foreach}
				        </select>
	</div>
	
	
	<div class="radiowrapper emoticons_1">
                                <div class="radio sad {if $courseEmoticon == -1}selected{/if}" alt="Не съм доволен"></div>
                                <div class="radio neutral {if $courseEmoticon == 0}selected{/if}" alt="Мнението ми е неутрално"></div>
                                <div class="radio happy {if $courseEmoticon == 1}selected{/if}" alt="Доволен съм"></div>
                                <input type="hidden" name="courseEmoticon" value="{$courseEmoticon}" />
    </div>
	
	<div class="radiowrapper emoticons_2">
                                <div class="radio sad {if $subjectEmoticon == -1}selected{/if}" alt="Не съм доволен"></div>
                                <div class="radio neutral {if $subjectEmoticon == 0}selected{/if}" alt="Мнението ми е неутрално"></div>
                                <div class="radio happy {if $subjectEmoticon == 1}selected{/if}" alt="Доволен съм"></div>
                                <input type="hidden" name="subjectEmoticon" value="{$subjectEmoticon}" />
    </div>
	
	<div class = 'div_possitive_feedback' >
	<label class='feedback'>Твоето позитивно мнение:</label>
	<br>
	<textarea class = 'input_possitive_feedback' rows="2" cols="20" name="positive">{$positive}</textarea>
	</div>

	<div class="div_negative_feedback" >
	<label class="feedback">Твоето негативно мнение:</label>
	<br>
	<textarea class="input_negative_feedback" rows="2" cols="20" name="negative">{$negative}</textarea>
	</div>

	<div id="owl_question">
		<div id="owl_question_text">
			Благодарим за информацията! 
			<br/>
			Искаш ли да си кажеш 
			<br/>
			<em>името</em> и <em>специалността</em>?
			<br />
			<input type="checkbox" name="authenticated" id="checkme" value="yes" {if $authenticated}checked="checked"{/if} />
			Да, разбира се!
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
{include file="analytics.tpl"}
</body>
</html>