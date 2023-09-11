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
    function sanitise_data($data)
    {
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }
        $con=@mysqli_connect("feenix-mariadb.swin.edu.au","s104320456","150904","s104320456_db");
        if($con)
        {
            $mark=0;
            $num=0;
            $error="";
            if(isset($_POST["SUBMIT"]))
            {
                $val="SELECT 1 FROM attempts";
                $result=mysqli_query($con,$val);
                if(!$result)
                {
                    $val="CREATE TABLE attempts(
                        Attempt_id AUTO_INCREMENT PRIMARY KEY,
                        Date_and_Time DATETIME(6),
                        First_Name VARCHAR(30),
                        Last_Name VARCHAR(30),
                        Student_number INT(10),
                        Attempt_number INT,
                        Score INT)";
                    $create=mysqli_query($con,$val);
                }
                mysqli_free_result($result);
            }
            if((isset($_POST["GivenName"]))&&(isset($_POST["familyname"]))&&(isset($_POST["StudentID"])))
            {
                $val="SELECT First_Name, Last_Name, Student_number, Attemp_number FROM attempts";
                $result=mysqli_query($con,$val);
                $firstname=$_POST["GivenName"];
                $firstname=sanitise_data($firstname);
                $lastname=$_POST["familyname"];
                $lastname=sanitise_data($lastname);
                $stuid=$_POST["StudentID"];
                $stuid=sanitise_data($stuid);
                if((preg_match("/\d{7}|\d{10}/",$stuid))&&(preg_match("/[a-zA-Z][a-zA-Z0-9-\s]{1,30}/",$firstname))&&(preg_match("/[a-zA-Z][a-zA-Z0-9-\s]{1,30}/",$lastname)))
                {
                    if($result)
                    {
                        while($row=mysqli_fetch_assoc($result))
                        {
                            if((isset($row["First_Name"]))&&(isset($row["Last_Name"]))&&(isset($row["Student_number"])))
                            {
                                if(($firstname==$row["First_Name"])&&($lastname==$row["Last_Name"])&&($stuid==$row["Student_number"]))
                                {
                                    if(isset($row["Attempt_number"]))
                                    {
                                        $num=$row["Attempt_number"];
                                    }
                                    else
                                    {
                                        $num=0;
                                    }
                                }
                            }
                        }mysqli_free_result($result);
                    }
                    
                    $num=$num+1;
                    if($num>=3)
                    {
                        $error.="The attempt number is higher than 2<br>";
                    }
                }
                else
                {
                    $error.="The First Name or Last name or Student ID is not valid<br>";
                }
            }
            else
            {
                $error.="Missing personal Information<br>";
            } 
            if(isset($_POST["question1"]))
            {
                if(isset($_POST["Your unit"]))
                {
                    if(isset($_POST["answer1"])||isset($_POST["answer2"])||isset($_POST["answer3"])||isset($_POST["answer4"]))
                    {
                        if(isset($_POST["question4"]))
                        {
                            if(isset($_POST["question"]))
                            {
                                if($_POST["Your unit"]=="early19th")
                                {
                                    $mark=$mark+30;
                                } 
                                if($_POST["question4"]=="answer3")
                                {                        
                                    $mark=$mark+30;
                                }
                                if(isset($_POST["answer2"]))
                                {
                                    $mark=$mark+30;
                                }    
                            }
                        }
                    }
                }
            }   
            if(!$error)
            {
                $date=date("Y-m-d H:i:s");
                $insert="INSERT INTO attempts
                            (Attempt_id, Date_and_Time, First_Name, Last_Name, Student_Number, Attempt_Number)
                            VALUES
                            ('NULL', CURRENT_TIMESTAMP(), '$firstname', '$lastname', '$stuid', '$num')";
                $excinsert=mysqli_query($con,$insert);
                $insert2="INSERT INTO attempts
                        (Score)
                        VALUES
                        ('$mark')";
                $excinsert2=mysqli_query($con,$insert2);
                echo "<p>Quiz successfully submitted!</p><br>";
                echo "<p>Go back to the <a href='quiz.php'>form</a>.</p>";
            }
            else
            {
                echo "<p>".$error."</p>";
            }
        mysqli_close($con);
        }
    ?>
</body>
</html>
            