<!DOCTYPE html>
<?php
session_start();
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Tomicevi Pezosi</title>
    <link rel="stylesheet" href="nav.css">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        *{
            font-family: 'Poppins', sans-serif;
            margin: 0;
            box-sizing: border-box;
        }
        /*
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            margin: 10px;

        }

        td,th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        }

        tr:nth-child(even) {
        background-color: #dddddd;
        }*/
        ul {
          list-style-type: none;
          margin: 0;
          padding: 0;
         }

        li {
            display: inline;
        }
        a {
           display: inline;
           font-size: 1rem;
           color: #04AA6D;
           margin: 10px;
        } 
        a.nav {
           display: inline;
           font-size: 2rem;
           text-decoration: none;
           color: black;
           margin: 10px;
        } 
        ul{
            margin: 20px;
        }
        a:hover{
            color: rgb(181, 181, 181);
            transition: 0.5s ease-in-out;
        }
        p{
            font-size: 1.3rem;
            margin: 20px 20px 20px 30px;
        }
        h1{
            margin: 20px 20px 20px 30px;
        }
        table {
            border-collapse: collapse;
            width: 60%;
            margin: 20px 20px 20px 30px;
        }

        th, td {
            text-align: left;
            padding: 8px;
            border: 1px solid #ddd;
        }


        th {
            background-color: #04AA6D;
            color: white;
        }

</style>
<body>
    <script>
    function myFunction(x) {
    x.classList.toggle("change");
    const mobCont = document.getElementById("mob-cont");

    if (mobCont.classList.contains("menu-open")) {
        mobCont.classList.remove("menu-open"); // Hide menu
    } else {
        mobCont.classList.add("menu-open"); // Show menu
    }

}
    </script>
    <script src="toast.js"></script>
    <ul class = "nav">
            <li class = "nav"><a href="home.php"><button class = "navbut">Home</button></a></li>
            <li class = "nav"><a href="company.php"><button class = "navbut2">My Company</button></a></li>
            <?php
        if(isset($_SESSION["user"])){
            $conn = mysqli_connect('localhost', 'root', '', 'tomicevipezosi');
            if($conn->connect_error){
                die('Connection Failed : '.$conn->connect_error);
            }else{
                $email = $_SESSION['user'];
                $sql = "SELECT firstName FROM user WHERE email = '$email'";
                $res = $conn->query($sql);
                $res = $res -> fetch_assoc();
                echo "<li class = 'nav'><a href='user.php' class='nav'><button class='navbut2'>" . $res['firstName'] . "</button></a></li>";
                $conn->close();
            }
        }
        else{
            echo "<li class = 'nav'><a href='login.php'><button class = 'navbut2'>Log-In</button></a></li><li class = 'nav'><a href='register.php'><button class = 'navbut2'>Register</button></a></li>";
        }
        ?>
        </ul>
        <div class="container" onclick="myFunction(this)">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
        <div class = "mobile-container" id = "mob-cont">
            <ul class="mobile">
                <!--<a href="" class="close"></a> -->
                <li class="mobile"> <a href="home.php"> <button class = "navbut2">Home</button> </a> </li>
                <li class="mobile"> <a href="company.php"> <button class = "navbut">My Company</button> </a></li>
                <?php
        if(isset($_SESSION["user"])){
            $conn = mysqli_connect('localhost', 'root', '', 'tomicevipezosi');
            if($conn->connect_error){
                die('Connection Failed : '.$conn->connect_error);
            }else{
                $email = $_SESSION['user'];
                $sql = "SELECT firstName FROM user WHERE email = '$email'";
                $res = $conn->query($sql);
                $res = $res -> fetch_assoc();
                echo "<li class = 'mobile'><a href='user.php'><button class='navbut2'>" . $res['firstName'] . "</button></a></li>";
                $conn->close();
            }
        }
        else{
            echo "<li class='mobile'> <a href='login.php'> <button class = 'navbut2'>Log-In</button> </a></li>
                <li class='mobile'> <a href='register.php'> <button class = 'navbut2'>Register</button> </a></li>";
        }
        ?>
                
            </ul>
        </div>
        <div id="snackbar"></div>
    <h1>Top 5 najboljih kompanija</h1>
    <table>
        <?php
            $conn = mysqli_connect('localhost', 'root', '', 'tomicevipezosi');
    if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
    }else{
        $sql = "SELECT ticker, name, id, value FROM kompanija ORDER BY value DESC LIMIT 5";

        $result = $conn->query($sql);
        $p = "";
        if($result->num_rows > 0){
            echo "<table>";
            echo "<tr><th>Ticker</th><th>Name</th><th>Stock Price</th><th>Details</th></tr>";
            $i = 1;
            while($row = $result->fetch_assoc()){
                if($i <= 5){
                    echo "<tr>";
                    echo "<td>" . $row["ticker"] . "</td>" . "<td>" . $row["name"] . "</td><td>" . $row["value"] . "</td><td><a href='/kompanija.php?id=" . $row["id"] . "'>Details</a></td>";
                    echo "</tr><br>";
                }
                $i++;
            }
            echo "</table>";
        }
        $result = $p;
        
        $conn->close();
    }


?>
        
    </table>

</body>
</html>