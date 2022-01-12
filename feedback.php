<?php
include('inc/config/config.php');

$name = '';
$email = '';
$dateofvisit ='';
$visitor_number='';
$q1 ='';
$q2 ='';
$q3 ='';
$suggest = '';

$error = array('visitor_number'=>'','name'=>'');

if(isset($_POST['submit'])){
    if(empty($_POST['name'])){
        $error['name']= "Name is required";
    }
    else{
        $name = htmlspecialchars($_POST['name']);
    }
    
    if(empty($_POST['number-visitors'])){
        $error['visitor_number']= "Visitors Count is required";
    }
    else{
        $visitor_number = htmlspecialchars($_POST['number-visitors']);
    }

    if(empty($_POST['visit-again'])){
        $q3=4;
    }
    else{
        $q3 = htmlspecialchars($_POST['visit-again']);
    }    
    
    if(empty($_POST['food-care'])){
        $q2= 4;
    }
    else{
        $q2 = htmlspecialchars($_POST['food-care']);
    }    
    
    if(empty($_POST['time'])){
        $q1= 4;
    }
    else{
        $q1 = htmlspecialchars($_POST['time']);
    }

    if(array_filter($error)){
        // echo print_r($error);
    }
    else{

        $name = mysqli_real_escape_string($conn,$_POST['name']);
        $visitor_number = mysqli_real_escape_string($conn,$_POST['number-visitors']);
        $q1 = mysqli_real_escape_string($conn,$q1);
        $q2 = mysqli_real_escape_string($conn,$q2);
        $q3 = mysqli_real_escape_string($conn,$q3);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $suggest = mysqli_real_escape_string($conn,$_POST['feedback']);
        // echo $q1.' '. $q2;
        $sql = "INSERT INTO `feedback`(`name`,`email`,`v_no`,`suggest`,`q1`,`q2`,`q3`,`date`) VALUES ('$name','$email','$visitor_number','$suggest','$q1','$q2','$q3',now());";
        if(mysqli_query($conn,$sql)){
            header('Location:inc/distroy_session.php');
            // mysqli_close($conn);
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FoodPartner</title>
    <link rel="stylesheet" href="inc/css/feedback.css">
    <link rel="icon" type="image/png" href="https://img.icons8.com/color/2x/cocktail.png"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
  </head>
  <body>
<?php
if (empty($_SESSION["user_id"])) {
    header("refresh:1;url=login.php");
    //header('url:login.php');
}
?>
    <div class="container">

      <div class="intro">
        <header>

          <h1 id="title"><i class="fas fa-utensils fa-lg"></i><br />
          Feedback form</h1>
          <p id="description">Thank you for visiting one of our restaurants.
            <br />
            Your feedback is important to us. We review your feedback every week to make sure we are getting things right.
            <br />
            Below we have questions you can answer, and we would like to hear your honest thoughts.</p>
        </header>
      </div>

      <main>

        <form method="post" id="survey-form">

          <div class="name-email">
            <div class="name-field">
              <label for="name" id="name-label" class="bold-question">Name:</label>
              <input type="text" id="name" name="name" placeholder="Enter your name">
              <h5 class="error"><?php echo $error['name'];?></h5>
            </div>

            <div class="email-field">
              <label for="email" id="email-label"  class="bold-question">Email:</label>
              <input type="email" id="email" name="email" placeholder="you@example.com">
            </div>
          </div>

          <div class="date-visit">
<!-- 
            <div class="date-field">
              <label for="visit-date"  class="bold-question">Date of Visit:</label>

              <input type="date" id="visit-date" name="visit-date">

            </div> -->

            <div class="visitor-field">
              <label for="number" id="number-label"  class="bold-question">Number of people:</label>
              <input type="number" id="number-visitors" name="number-visitors" min="1" max="30" placeholder="0">
              <h5 class="error"><?php echo $error['visitor_number'];?></h5>
            </div>
          </div>

          <!-- <div>
            <label for="dropdown" class="bold-question">Restaurant branch visited:</label>

            <select name="restaurant" id="dropdown" required>
              <option value="">--Please select a branch:--</option>

              <option value="hampstead">Hampstead</option>

              <option value="oxford-street">Oxford Street</option>

              <option value="westfield-london">Westfield London</option>

              <option value="westfield-stratford">Westfield Stratford</option>
            </select>
          </div> -->


          <hr  />

          <!-- <div class="padding-questions">
            <fieldset>
              <legend class="bold-question">
                If you ordered our limited edition burgers, please select below:
              </legend>

              <input type="checkbox" id="buttermilk-chicken" name="specials"
               value="buttermilk-chicken">
              <label for="buttermilk-chicken">Buttermilk Chicken Burger</label>

              <input type="checkbox" id="hawaiian" name="specials"
               value="hawaiian">
              <label for="hawaiian">Hawaiian Burger</label>
              <br />
              <input type="checkbox" id="rump-steak" name="specials"
               value="rump-steak">
              <label for="rump-steak">Rump Steak Burger</label>


            </fieldset>

          </div> -->

          <div class="padding-questions">
            <fieldset>
              <legend class="bold-question">1. Did you receive your food within a reasonable time?<br />(1 = strongly disagree, 5 = strongly agree) </legend>

              <input type="radio" id="time-strongly-disagree" name="time" value="1">
              <label for="time-strongly-disagree">1</label>

              <input type="radio" id="time-disagree" name="time" value="2">
              <label for="time-disagree">2</label>

              <input type="radio" id="time-neutral" name="time" value="3">
              <label for="time-neutral">3</label>

              <input type="radio" id="time-agree" name="time" value="4">
              <label for="time-agree">4</label>

              <input type="radio" id="time-strongly-agree" name="time" value="5">
              <label for="time-strongly-agree">5</label>

            </fieldset>
          </div>


          <div class="padding-questions">
            <fieldset>
              <legend class="bold-question">2. Did your food look as if it had been made with care?<br />(1 = strongly disagree, 5 = strongly agree) </legend>

              <input type="radio" id="food-strongly-disagree" name="food-care" value="1">
              <label for="food-strongly-disagree">1</label>

              <input type="radio" id="food-disagree" name="food-care" value="2">
              <label for="food-disagree">2</label>

              <input type="radio" id="food-neutral" name="food-care" value="3">
              <label for="food-neutral">3</label>

              <input type="radio" id="food-agree" name="food-care" value="4">
              <label for="food-agree">4</label>

              <input type="radio" id="food-strongly-agree" name="food-care" value="5">
              <label for="food-strongly-agree">5</label>

            </fieldset>
          </div>

          <div class="padding-questions">
            <fieldset>
              <legend class="bold-question">3. Will you visit this branch again?<br />(1 = highly unlikely, 5 = very likely) </legend>

              <input type="radio" id="visit-strongly-disagree" name="visit-again" value="1">
              <label for="visit-strongly-disagree">1</label>

              <input type="radio" id="visit-disagree" name="visit-again" value="2">
              <label for="visit-disagree">2</label>

              <input type="radio" id="visit-neutral" name="visit-again" value="3">
              <label for="visit-neutral">3</label>

              <input type="radio" id="visit-agree" name="visit-again" value="4">
              <label for="visit-agree">4</label>

              <input type="radio" id="visit-strongly-agree" name="visit-again" value="5">
              <label for="visit-strongly-agree">5</label>

            </fieldset>
          </div>

          <div class="padding-questions">
            <label for="feedback" class="bold-question">Any Comments or Suggestions?:</label>
            <!-- <br /> -->
            <textarea id="feedback" name="feedback" rows="5" cols="80">
            </textarea>
          </div>

          <div class="padding-questions">
            <button id="submit" type="submit" name="submit">Submit your feedback</button>
          </div>
        </form>
      </main>
    </div>
  </body>
</html>