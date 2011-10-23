<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
    <head> 
        <title>Липсващата Feedback система на ФМИ</title> 
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" type="text/css" href="styles/main.css" /> 
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <link type="text/css" href="javascript/ui/css/start/jquery-ui-1.8.16.custom.css" rel="stylesheet" />

        <script type="text/javascript" src="javascript/ui/js/jquery-ui-1.8.16.custom.min.js"></script>

        <script type="text/javascript" src="javascript/additional_prototypes.js"></script> 
        <script type="text/javascript" src="javascript/main.js"></script> 
        <script type="text/javascript" src="javascript/ajax.js"></script> 
    </head> 
    <body> 
        <div class="wholecenter">
        	До момента са дадени {$totalFeedback} обратни връзки!
            <form method="post">
                <div class="courses">
                    <label for="coursebox">Име на предмета(autocomplete e):</label>
                    <br />
                    <input type="text" class="panelselect" id="coursebox" />
                    <input type="hidden" id="courseId" name="courseId" value="-1" />
                </div>
                <div class="courses">
                    <label for="teacherbox">Име на преподавателя :</label>
                    <br />
                    <select class="panelselect" name="teacherbox" id="teacherbox">
                    	<option value="-1">Изберете предмет</option>
                    </select>
                </div>

                <br class="clear" />

                <div class="courses">
                    <label for="positive">Вашето позитивно мнение :)</label>
                    <br />
                    <textarea id="positive" name="positive" class="textarea"></textarea>
                </div>
                <div class="courses">
                    <label for="negative">Вашето негативно мнение :|</label>
                    <br />
                    <textarea id="negative" name="negative" class="textarea"></textarea>
                </div>

                <br class="clear" />

                <div class="whole" id="questions">
                    {foreach from=$questions key=id item=text}
                        <div>
                            {$text}:
                            <div class="radiowrapper">
                                <div class="radio sad"></div>
                                <div class="radio neutral"></div>
                                <div class="radio happy"></div>

                                <div style="clear:both;"></div>
                                <input type="hidden" name="question[{$id}]" value="" />
                            </div>
                        </div>
                    {/foreach}
                </div>

                <br class="clear" />

                <div class="whole">
                    <input type="checkbox" id="anonymous" /><strong>Не искам да съм анонимен!</strong>
                </div>

                <br class="clear" />

                <div class="whole" id="info">
                    <div class="courses">
                        Специалност:
                        <select id="subjects" name="student_subject">
                            {foreach from=$subjects key=id item=name}
                                <option value="{$id}">{$name}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="courses">
                        Име: <input type="text" name="student_name" id="name" />
                    </div>
                </div>

                <br class="clear" />

                <div class="whole">
                    <input id="sendButton" type="submit" name="sumbit" value="Изпрати"/>
                </div>
            </form>
        </div>
    </body> 
</html>