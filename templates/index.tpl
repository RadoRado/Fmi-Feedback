<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
    <head> 
        <title>FMI Feedback</title> 
        <link rel="stylesheet" type="text/css" href="styles/main.css" /> 
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <link type="text/css" href="javascript/ui/css/start/jquery-ui-1.8.16.custom.css" rel="stylesheet">

            <script type="text/javascript" src="javascript/ui/js/jquery-ui-1.8.16.custom.min.js"></script>

            <script type="text/javascript" src="javascript/main.js"></script> 
            <script type="text/javascript" src="javascript/ajax.js"></script> 
    </head> 
    <body> 
        <div class="wholecenter">

            <div class="courses">
                <input type="text" class="panelselect" id="coursebox" />
            </div>
            <div class="courses">
                <select class="panelselect" id="teacherbox"></select>
            </div>

            <br class="clear" />

            <div class="courses">
                <textarea id="positive" class="textarea"></textarea>
            </div>
            <div class="courses">
                <textarea id="negative" class="textarea"></textarea>
            </div>

            <br class="clear" />

            <div class="whole" id="questions">
                <div>
                    Quastion 1: 
                    <img src="images/icon_sad_gray.png" class="radiowrapper sad" alt="" />
                    <img src="images/icon_neutral_gray.png" class="radiowrapper neutral" alt="" />
                    <img src="images/icon_happy_gray.png" class="radiowrapper happy" alt="" />
                    <input type="radio" name="group1" class="radio" value="1" />
                    <input type="radio" name="group1" class="radio" value="0" />
                    <input type="radio" name="group1" class="radio" value="-1" />
                </div>
                <div>
                    Quastion 2: 
                    <img src="images/icon_sad_gray.png" class="radiowrapper sad" alt="" />
                    <img src="images/icon_neutral_gray.png" class="radiowrapper neutral" alt="" />
                    <img src="images/icon_happy_gray.png" class="radiowrapper happy" alt="" />
                    <input type="radio" name="group1" class="radio" value="1" />
                    <input type="radio" name="group1" class="radio" value="0" />
                    <input type="radio" name="group1" class="radio" value="-1" />
                </div>
                <div>
                    Quastion 3: 
                    <img src="images/icon_sad_gray.png" class="radiowrapper sad" alt="" />
                    <img src="images/icon_neutral_gray.png" class="radiowrapper neutral" alt="" />
                    <img src="images/icon_happy_gray.png" class="radiowrapper happy" alt="" />
                    <input type="radio" name="group1" class="radio" value="1" />
                    <input type="radio" name="group1" class="radio" value="0" />
                    <input type="radio" name="group1" class="radio" value="-1" />
                </div>
            </div>

            <br class="clear" />

            <div class="whole">
                <input type="checkbox" id="anonymous" />Не искам да съм анонимен!
            </div>

            <br class="clear" />

            <div class="whole" id="info">
                <div class="courses">
                    Специалност:
                    <select id="subjects">
                        <option value="1">Course 1</option>
                        <option value="2">Course 2</option>
                        <option value="3">Course 3</option>
                        <option value="4">Course 4</option>
                    </select>
                </div>
                <div class="courses">
                    Име: <input type="text" id="name" />
                </div>
            </div>

            <br class="clear" />

            <div class="whole">
                <input id="sendButton" type="button" value="Изпрати"/>
            </div>

        </div>
    </body> 
</html>