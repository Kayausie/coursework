<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="description"    content="Creating Web Application"  />
    <meta name="keywords"       content="HTML, CSS, JavaScript"     />
    <meta name="author"         content="Long Nguyen"               />
    <title>Quiz</title>
    <link rel=" stylesheet" href="styles/form.css"/>
    <link rel="stylesheet" href="styles/style.css"/>
    <link rel="stylesheet" href="styles/responsive.css"/>
</head>
<body>
    <?php
        include_once("header.inc");
    ?>
            <h1>
                Quiz Time
            </h1>
        </header>     
    <form method="post" action="markquiz.php" novalidate="novalidate">
    <section class="body">
    <div id="introquiz">
    <p>
        Here will be some questions about our research topic
    </p>
    <p>
        This will be hand and check from us
        Cheer.
    </p>
    </div>
    <fieldset>
        <legend>Name</legend>
        <div id="personal" class="inputBox">
        <p>Personal Details</p>
        <p>
            <input type="text" name= "StudentID" id="StudentID" pattern="\d{7,10}" maxlength="10" size="10" required="required"/>
            <span>Student ID</span>
        </p>
        <p>
            <input type="text" name= "GivenName" id="GivenName"  pattern="([a-zA-Z][a-zA-Z0-9-\s]{1,30})" maxlength="45" size="20" required="required"/>
            <span>First Name</span>
        </p>
         <p>
            <input type="text" name= "familyname" id="familyname" pattern="[a-zA-Z][a-zA-Z0-9-\s]{1,30}" maxlength="45" size="20" required="required"/>
            <span> Family name</span>
        </div>
        </p>
    </fieldset>

    <fieldset>

        <legend>Quiz</legend>
        
        <p id="question1">
           1.Present briefly about the evolutionary of computing( maximum 100 words)<br>
            <input type="text" id="present" name="question1" placeholder="Write down your answer" required="required" maxlength="100"/>
        </p>
        <p>
            2.Which generation that transfer from physical to digital computing:
        </p>
            <!-- radio button group -->
                <section id="radiobutton">
                <p>
                    <input type="radio" id="answer1radio" name="Your unit" value="late20th" required="required"/>
                    <label for="answer1radio">Late 20th century</label>
                </p>
                <p>
                    <input type="radio" id="answer2radio" name="Your unit" value="early19th"/>
                    <label for="answer2radio">Early 19th century</label>
                </p>
                <p>
                    <input type="radio" id="answer3radio" name="Your unit" value="20th"/>
                    <label for="answer3radio">20th century</label>  
                </p>
                <p>
                    <input type="radio" id="answer4radio" name="Your unit" value="21st"/>
                    <label for="answer4radio">21stcentury</label>        
                </p> 
                </section> 
<p>
    3.When is the first 64-bit CPU established?
</p>
<section id="checkbox">
    <!--check box group-->
    
        <input type="checkbox" id="answer1checkbox" name="answer1" value="2001">
        <label for="answer1checkbox">2001</label>

        <input type="checkbox" id="answer2checkbox" name="answer2" value="2002">   
        <label for="answer2checkbox">2002</label>
  
        <input type="checkbox" id="answer3checkbox" name="answer3" value="2003"> 
        <label for="answer3checkbox">2003</label>
  
        <input type="checkbox" id="answer4checkbox" name="answer4" value="2004">     
        <label for="answer4checkbox">2004</label>
</section>
        <p>
            4.What is the name of the author of Turing machine?
            <!--drop list -->
        </p>
            <p>
                <select name="question4" id="question4" required="required">
                    <option value="">Please Select</option>
                    <option value="answer1">Turing Killian</option>            
                    <option value="answer2">Turing Salin</option>
                    <option value="answer3">Alan Turing</option>
                    <option value="answer4">Henderson Turing</option>
                </select>
            </p>
        <p>
            5.Give us some of your ideals and insights about computing nowadays:
            <!--input type of your choice different from above-->
            <!--Doing textarea-->
            <textarea id="question" name="question" placeholder="Write down your answer" rows="4" cols="80" ></textarea>

        </p>   
    </fieldset>

    <fieldset>
        <legend>
            Feedback 
        </legend>
        <p>
            What is your comment and feedback?
        </p>
        <p class="exception">
            <label for="descriptionofissue"></label>
            <textarea id="descriptionofissue" name="descriptionofissue" placeholder="Write description of your thinking" rows="4" cols="80"></textarea>
            
        </p>
    </fieldset>
    <input id="Smit" type= "submit" name="SUBMIT" value="Submit"/>
    <input id="Rset" type= "reset" value="Reset"/>
</section>
        </form>
        <?php
        include_once("footer.inc");
        ?>
    </body>
</html>
