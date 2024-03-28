<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="description"    content="Connecting client side and server side"  />
    <meta name="keywords"       content="HTML, PHP"     />
    <meta name="author"         content="Kimheng Nguon"               />
    <title>Manger</title>
    <link rel=" stylesheet" href="styles/form.css"/>
    <link rel="stylesheet" href="styles/style.css"/>
    <link rel="stylesheet" href="styles/responsive.css"/>
</head>
<body>
<?php
        include_once("header.inc");
?>

<h1>Manage Data</h1>


<fieldset>
    <legend>Search for Student</legend>
    <form method="post" action="display_student.php" >
        <p><label>Student ID:   <input type="text" name= "StudentID" id="StudentID" pattern="\d{7,10}" maxlength="10" size="20" /></label></p>
        <p><label>First Name:   <input type="text" name= "GivenName" id="GivenName"  pattern="([a-zA-Z][a-zA-Z0-9-\s]{1,30})" maxlength="45" size="20" /></label></p>
        <p><label> Family name: <input type="text" name= "familyname" id="familyname" pattern="[a-zA-Z][a-zA-Z0-9-\s]{1,30}" maxlength="45" size="20"/></label></p>
        <input type="submit" value="Submit">
    </form>
</fieldset>


<fieldset>
    <legend>Delete Attempts</legend>
    <form method="post" action="delete_attempts.php" >
        <p><label>Student ID: <input type="text" name= "StudentID" id="StudentID" pattern="\d{7,10}" maxlength="10" size="20" /></label></p>
        <p><label>Attempt ID: <input type="text" name= "Attempt_ID" id="familyname" maxlength="10" size="20"/></label></p>
        <input type="submit" value="Submit">
    </form>
</fieldset>
<br>
<!-- button to list all attempts -->
<div>
<legend>List all attempts</legend>
    <form method="post" action="displayall.php" >
    <input type="submit" value="click">
    </form>
<div>

<br>

<div>
    <legend>Student with 100% mark on 1st attempt</legend>
    <form method="post" action="display_fullmark.php" >
    <input type="submit" value="click">
    </form>
<div>
<br>
<div>
    <legend>Students with less than 50% mark on 2nd attempt</legend>
    <form method="post" action="display_halfmark.php" >
    <input type="submit" value="click">
    </form>
<div>
<br>










<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
           include_once("footer.inc");
?>
</body>
</html>

    

    