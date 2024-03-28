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

require_once ('settings.php');



$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if(!$conn){
    echo "<p>Database connection failure</p>";
}
else {
    

    $query="SELECT * FROM attempts";

    $result = mysqli_query($conn, $query);
    echo"$query";
    if(!$result){
        echo"<p>Something is wrong with ", $query,"</p>";
    }
    else {
    //show after result
    echo "<table border='1' >\n";
    echo "<tr>\n";
    echo"<th scope='col'>Attempt ID</th>\n";
    echo"<th scope='col'>Date</th>\n";
    echo"<th scope='col'>First Name</th>\n";
    echo "<th scope='col'>Last Name</th>\n";
    echo "<th scope='col'>ID</th>\n";
    echo "<th scope='col'>Attempts</th>\n";
    echo "<th scope='col'>Score</th>\n";
    echo "</tr>\n";

        while($row = mysqli_fetch_assoc($result)){
        echo "<tr>\n";
        echo "<td>",$row["Attempt_id"],"</td>\n";
        echo "<td>",$row["Date_and_Time"],"</td>\n";
        echo "<td>",$row["First_Name"],"</td>\n";
        echo "<td>",$row["Last_Name"],"</td>\n";
        echo "<td>",$row["Student_ID"],"</td>\n";
        echo "<td>",$row["Attempt_number"],"</td>\n";
        echo "<td>",$row["Score"],"</td>\n";
        echo "</tr>\n";
        }

    echo "</table>\n";
    }
    
    mysqli_free_result($result);
    }

    mysqli_close($conn);

?>
</body>
</html>