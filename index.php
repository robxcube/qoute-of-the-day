<?php

    require 'vendor/autoload.php';
    use Mailgun\Mailgun;
    if(isset($_POST['submit'])){
        if(!empty($_POST['from']) && !empty($_POST['to']) && !empty($_POST['subject']) && !empty($_POST['message'])) {
            $sender = $_POST['from'];
            $receiver = $_POST['to'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            $mg = Mailgun::create('your-apikey'); // For US servers

            $mg->messages()->send('yourDomain', [
              'from'    => $sender,
              'to'      => $receiver,
              'subject' => $subject,
              'text'    => $message
            ]);
        } else {
            echo 'empty fields!!';
            header('Location: index.php');
        }


    }



?>



<!DOCTYPE html>

<div class="box">

<div class="containerGrid" >

<html>
    <head>
        <link rel="stylesheet" href="style/style.css?v=<?php echo time();?>"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>

    <header>
        <div class="itemHeader">
            <?php include 'template/header.php' ?>
        </div>
    </header>


    <body>
    <form action="index.php" method="POST" id="form">
        <div class="sideBar">
            <p>From</p>
            <input type="email" placeholder="ex: example@domain.com" name="from" require/><br>

            <p>To</p>
            <input type="email" placeholder="ex: example@domain.com" name="to" require/>

        </div>

        <div class="main">
            <p>Subject</p>
            <input type="text" name="subject" placeholder="Enter text here"  require><br>

            <p>Message</p>
            <textarea name="message" rows="4" cols="50" form="form" placeholder="Enter text here" id="quote"></textarea>
        </div>


        <button type="button" onclick="generate();"  style="color: black;">Generate</button><input type="submit" name="submit" id="submitBtn" value="send">
        <br>
        <br>

    </form>
    </body>

    <footer>
        <div class="footer">

        </div>
    </footer>

</html>

</div>

</div>

<script type="text/javascript">



function generate() {

    fetch("https://type.fit/api/quotes")
  .then(function(response) {
    return response.json();
  })
  .then(function(data) {
    console.log(data);
    var number = Math.floor((Math.random() * 1000) + 1);
    document.getElementById("quote").value = data[number].text;
  });

}



</script>