<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="description"    content="Creating Web Application"  />
    <meta name="keywords"       content="HTML, CSS, JavaScript"     />
    <meta name="author"         content="Kimheng Nguon"               />
    <title>Quiz</title>
    <link rel=" stylesheet" href="styles/form.css"/>
    <link rel="stylesheet" href="styles/style.css"/>
    <link rel="stylesheet" href="styles/responsive.css"/>
</head>
<body>
<?php
    function sanitise_data($data) //function for data sanitization
    {
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }

    //direct the user back if their detial information have not been filled
   
    
    //sanitize data from form
    $fname = sanitise_data($_POST["GivenName"]);
    $lname = sanitise_data($_POST["familyname"]);
    $studentId = sanitise_data($_POST["StudentID"]);
    $question1 = sanitise_data($_POST["question1"]);
    $question2 = sanitise_data($_POST["unit"]);
    $question3 = sanitise_data($_POST["answer"]);
    $question4 = sanitise_data($_POST["question4"]);
    $question5 = sanitise_data($_POST["question5"]);
     
    //direct the user back if their detial information have not been filled
    if(( $fname=="")||($lname=="")||($studentId=="")){
        header("location: quiz.php");
        exit();
    }

    $errors="";
    
    //vadlidate data from from
    if($fname==""){
        $errors .="<p>Please enter your first name.</p>";
    }else if (!preg_match("/^[A-Za-z -]{1,30}$/", $fname)){
        $errors .= "<p>First name must contain alphabetic characters, spaces, or hyphens.</p>";
    }

    if($lname==""){
        $errors .="<p>Please enter your Last name.</p>";
    }else if (!preg_match("/^[A-Za-z -]{1,30}$/", $lname)){
        $errors .= "<p>Last name must contain alphabetic characters, spaces, or hyphens.</p>";
    }

    if ($studentId=="") {
        $errors.= "<p>Enter your student ID.</p>";
    } elseif (!preg_match("/^\d{7}$|^\d{10}$/", $studentId)) {
        $errors .= "<p>Student ID must be either 7 or 10 digits.</p>";
    }

    if ($question1=="") {
        $errors .= "<p>Please answer queston 1.</p>";
    } 

    if (!isset($question2)) {
        $errors .= "<p>Please answer queston 2.</p>";
    } 

    //if (!isset($question3)) 
    if ($question3=="")  {
        $errors .= "<p>Please answer queston 3.</p>";
    } 

    //if (!isset($question4)) 
    if ($question4==""){
        $errors .= "<p>Please answer queston 4.</p>";
    } 

    if ($question5=="") {
        $errors .= "<p>Please answer queston 5.</p>";
    } 

    //if there is any error, it will display the error message and stop executing the rest of the code
    if ($errors!=""){
        echo $errors;
        exit();
    }

    //mark quiz
    $mark=0;

    if($question1!==""){
        $mark +=10;
    }

    if($question2=="20th"){
        $mark +=10;
    }

    
    if($question3=="2001"){
        $mark +=10;
    }

    if($question4=="answer3"){
        $mark +=10;
    }

    if($question5!==""){
        $mark +=10;
    }
    

    //connect to the database
    require_once ('settings.php');

    $conn= mysqli_connect($host, $user, $pwd, $sql_db);

    if($conn)//check connection
    {
            //create table if there isnt any
            $query="CREATE TABLE IF NOT EXISTS attempts(
                Attempt_id INT(10) AUTO_INCREMENT PRIMARY KEY,
                Date_and_Time DATETIME,
                First_Name VARCHAR(30),
                Last_Name VARCHAR(30),
                Student_ID INT(10),
                Attempt_number INT(3),
                Score INT(10)
            )";
            $result=mysqli_query($conn,$query);
            if(!$result){
                echo "<p>Create table unsuccessful!</p>";
                exit();
            }

            $countAttempt= 1;

            //identify if there is anything in the table
            $query = "SELECT * FROM attempts WHERE First_Name = '$fname'";
            $result_query = mysqli_query($conn, $query);
            if(!$result_query){
                echo "<p>query identify unsuccessful!</p>";
                exit();
            }

            //assign $detail varaible with the value at the current row
            $detail = mysqli_fetch_assoc($result_query);
            if(!$detail){
                $query = "INSERT INTO attempts (Date_and_Time, First_Name, Last_Name,Student_ID,Attempt_number,Score) 
                    VALUES (NOW(),'$fname', '$lname', '$studentId', '$countAttempt', $mark)";
                $insert_query=mysqli_query($conn,$query);
                if (!$insert_query){
                echo "<p>Insert 1 failed.</p>";
                exit();
                }
            } else if ($detail["Attempt_number"] < 2) {// check if any student already had an attempt
                $countAttempt = $detail["Attempt_number"] + 1;
                $query = "INSERT INTO attempts (Date_and_Time, First_Name, Last_Name,Student_ID,Attempt_number,Score) 
                    VALUES (NOW(),'$fname', '$lname', '$studentId', '$countAttempt', $mark)";
                $insert_query=mysqli_query($conn,$query);
                if (!$insert_query){
                echo "<p>Insert failed.</p>";
                exit();
                }
            }

    


            //select the table
            $query="SELECT * FROM attempts WHERE Student_ID LIKE '%$studentId' ORDER BY First_Name ,Last_name,Attempt_number,Score";

            $result = mysqli_query($conn, $query);
    
            if(!$result){
                echo"<p>Something is wrong with ", $query,"</p>";
            }
            else {
            //show after result
            echo "<table border='1' >\n";
            echo "<tr>\n";
            echo"<th scope='col'>First Name</th>\n";
            echo "<th scope='col'>Last Name</th>\n";
            echo "<th scope='col'>ID</th>\n";
            echo "<th scope='col'>Attempts</th>\n";
            echo "<th scope='col'>Score</th>\n";
            echo "</tr>\n";

                while($row = mysqli_fetch_assoc($result)){
                echo "<tr>\n";
                echo "<td>",$row["First_Name"],"</td>\n";
                echo "<td>",$row["Last_Name"],"</td>\n";
                echo "<td>",$row["Student_ID"],"</td>\n";
                echo "<td>",$row["Attempt_number"],"</td>\n";
                echo "<td>",$row["Score"],"</td>\n";
                echo "</tr>\n";
                }

            echo "</table>\n";
            }

            //allow another if the user had only just attempt
            if ($countAttempt < 2) {
                echo "<p>Try again: '<a href='quiz.php'>click here</a>'</p>'";
            }
            else {
                echo"<p>Maximun number of attempt is reached.</p>";
            }

            //disconnect database
            mysqli_free_result($result_query);
            mysqli_close($conn);
        
        }else {
            echo "</p>Connnection failed!</p>";
        }
    
    
?>
</body>
</html>