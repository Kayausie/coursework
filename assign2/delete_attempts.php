<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="description"    content="Connecting client side and server side"  />
    <meta name="keywords"       content="HTML, PHP"     />
    <meta name="author"         content="Kimheng Nguon"               />

    <link rel=" stylesheet" href="styles/form.css"/>
    <link rel="stylesheet" href="styles/style.css"/>
    <link rel="stylesheet" href="styles/responsive.css"/>
</head>
<body>
    <h1>All attempts</h1>
<?php
function sanitise_data($data) //function for data sanitization
{
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}

$countAttempts=  sanitise_data($_POST["Attempt_ID"]);
$studentId = sanitise_data($_POST["StudentID"]);

//direct the user back if their detial information have not been filled
if(( $countAttempts=="")&&($studentId=="")){
    header("location: manage.php");
    exit();
}
require_once ('settings.php');



$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if(!$conn){
    echo "<p>Database connection failure</p>";
}
else {
    

    $query="DELETE FROM attempts WHERE Attempt_number LIKE '%$countAttempts%' AND Student_ID LIKE '%$studentId%' ";

    $result =@mysqli_query($conn, $query);
 
    if(!$result){
        echo"<p>Something is wrong with ", $query,"</p>";
    }
    else {
        echo"<p>Delete successfull.</p>";
    }

    mysqli_close($conn);
}

?>
</body>
</html>