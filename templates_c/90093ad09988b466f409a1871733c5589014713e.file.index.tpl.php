<?php /* Smarty version Smarty-3.0.8, created on 2012-02-06 14:16:05
         compiled from "templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:267644f2fd295d8c081-72127341%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '90093ad09988b466f409a1871733c5589014713e' => 
    array (
      0 => 'templates/index.tpl',
      1 => 1328534159,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '267644f2fd295d8c081-72127341',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
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
				<?php echo $_smarty_tpl->getVariable('validatorCode')->value;?>

			});
		</script>		
		
    <title>
    	ФМИ feedback система
    </title>
</head>
<body>

<div id="error_message_wrap">
	<div id="error_message" <?php if (!$_smarty_tpl->getVariable('error')->value){?>style="display: none;"<?php }?>><?php echo $_smarty_tpl->getVariable('error')->value;?>
</div>
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
	   <input type="text" class="panelselect" id="coursebox" name="coursebox" value="<?php echo $_smarty_tpl->getVariable('coursebox')->value;?>
" placeholder="Въведи предмет на кирилица" />
       <input type="hidden" id="courseId" name="courseId" value="<?php echo $_smarty_tpl->getVariable('courseId')->value;?>
" />
	</div>
	
	<div class="second_question">
	                    <select class="panelselect" name="teacherbox" id="teacherbox">
							<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('teacherList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['uid'];?>
" <?php if ($_smarty_tpl->getVariable('teacherbox')->value==$_smarty_tpl->tpl_vars['v']->value['uid']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</option>
							<?php }} else { ?>
							<option value="-1">Първо избери предмет</option>
							<?php } ?>
				        </select>
	</div>
	
	
	<div class="radiowrapper emoticons_1">
                                <div class="radio sad <?php if ($_smarty_tpl->getVariable('courseEmoticon')->value==-1){?>selected<?php }?>" alt="Не съм доволен"></div>
                                <div class="radio neutral <?php if ($_smarty_tpl->getVariable('courseEmoticon')->value==0){?>selected<?php }?>" alt="Мнението ми е неутрално"></div>
                                <div class="radio happy <?php if ($_smarty_tpl->getVariable('courseEmoticon')->value==1){?>selected<?php }?>" alt="Доволен съм"></div>
                                <input type="hidden" name="courseEmoticon" value="<?php echo $_smarty_tpl->getVariable('courseEmoticon')->value;?>
" />
    </div>
	
	<div class="radiowrapper emoticons_2">
                                <div class="radio sad <?php if ($_smarty_tpl->getVariable('subjectEmoticon')->value==-1){?>selected<?php }?>" alt="Не съм доволен"></div>
                                <div class="radio neutral <?php if ($_smarty_tpl->getVariable('subjectEmoticon')->value==0){?>selected<?php }?>" alt="Мнението ми е неутрално"></div>
                                <div class="radio happy <?php if ($_smarty_tpl->getVariable('subjectEmoticon')->value==1){?>selected<?php }?>" alt="Доволен съм"></div>
                                <input type="hidden" name="subjectEmoticon" value="<?php echo $_smarty_tpl->getVariable('subjectEmoticon')->value;?>
" />
    </div>
	
	<div class = 'div_possitive_feedback' >
	<label class='feedback'>Твоето позитивно мнение:</label>
	<br>
	<textarea class = 'input_possitive_feedback' rows="2" cols="20" name="positive"><?php echo $_smarty_tpl->getVariable('positive')->value;?>
</textarea>
	</div>

	<div class="div_negative_feedback" >
	<label class="feedback">Твоето негативно мнение:</label>
	<br>
	<textarea class="input_negative_feedback" rows="2" cols="20" name="negative"><?php echo $_smarty_tpl->getVariable('negative')->value;?>
</textarea>
	</div>

	<div id="owl_question">
		<div id="owl_question_text">
			Благодарим за информацията! 
			<br/>
			Искаш ли да си кажеш 
			<br/>
			<em>името</em> и <em>специалността</em>?
			<br />
			<input type="checkbox" name="authenticated" id="checkme" value="yes" <?php if ($_smarty_tpl->getVariable('authenticated')->value){?>checked="checked"<?php }?> />
			Да, разбира се!
		</div>
	<img class="owl" width="547" height="213" src="images/owl-question.png" />
	</div>

	<div id="student_answer">
	<div id="student_answer_text">
		Казвам се:&nbsp <input type="text" class="student_name" name="student_name" value="<?php echo $_smarty_tpl->getVariable('student_name')->value;?>
"> <br>
		<var class='student_row2' >и изучавам: <var>&nbsp <select id="subjects" name="student_subject">
                            <?php  $_smarty_tpl->tpl_vars['name'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('subjects')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['name']->key => $_smarty_tpl->tpl_vars['name']->value){
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['name']->key;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->getVariable('student_subject')->value==$_smarty_tpl->tpl_vars['id']->value){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</option>
                            <?php }} ?>
                        </select> <br>
	</div>
	</div>

<div id="recaptcha">
<?php echo $_smarty_tpl->getVariable('recaptcha')->value;?>

</div>
	<input id="sendButton" type="submit" value="" />

	
</div>

</form>
<?php $_template = new Smarty_Internal_Template("analytics.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
</body>
</html>