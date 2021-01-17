<?php
/**
 * @author CoderSpy Ltd
 * @email info@coderspy.com
 * @create date 2021-01-17 06:42:07
 * @modify date 2021-01-17 06:42:07
 * @desc [description]
 */

require dirname(__FILE__) . '/php-email-address-validator.php';

use PHPEmailAddressValidator\PHPEmailAddressValidator;
if(isset($_POST['submit'])){ 
    $emails = preg_split('/\s+/',$_POST['emails']);
    foreach( $emails as $key=>$email){
        $result = PHPEmailAddressValidator::validateString($email);
        if($result === true){
            $result = PHPEmailAddressValidator::validate($email);
            if($result === true){
                $resultArray[$email]=$email;
            }
        }
    }
    $h = fopen('output/email.txt', 'r+');
    fwrite($h, var_export($resultArray, true));

}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Email List Cleaning Tool Using PHP</title>
    <style>
        body{
            background: #effbfb;
        }
        .mt-25{
            margin-top: 25px;
        }
        .output{
            width: 100%;
            background: #ffffff;
            min-height: 250px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 25px 25px 25px 25px;
        }
        textarea#floatingTextarea {
            min-height: 250px;
        }
        .dwn{
            text-align: right;
            font-size: 10px;
            margin: 0;
        }
        a {
            text-decoration: none;
            color: black;
            font-weight: 500;
        }
        button.btn.btn-primary {
            margin-top: 25px;
            background-color: #0dcaf0;
            border-color: #0dcaf0;
        }
        p.list {
    font-size: 11px;
    padding: 0px;
    margin: 0px;
    font-family: monospace;
    line-height: 12px;
}
p.dwn.text-left {
    color: red;
}
    </style>
  </head>
  <body>
  <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-center mt-25">Email List Cleaning Tool Using PHP</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <form action="index.php" method="POST">
                <h4 class="mt-25 text-center">Email List</h4>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="email@example.com" id="floatingTextarea" rows="5" name="emails"><?php if(isset($_POST['emails'])){ echo $_POST['emails']; }?></textarea>
                    <label for="floatingTextarea">Emails</label>
                </div>
                <div class="col-auto">
                    <button type="submit" name="submit" class="btn btn-primary">Check Verified Email</button>
                </div>
            </form>
        </div>
        <div class="col-lg-6">
            <h4 class="mt-25 text-center">Cleanup Email List</h4>
            <div class="output">
                <?php if(isset($resultArray)){
                    $count = 0;
                    foreach($resultArray as $key=>$email){
                        echo '<p class="list">'.$email.'</p>';
                        $count++;
                    }
                }?>
            </div>
           
            <div class="row">
                <div class="col-lg-6"> <?php if(isset($count)){?><p class="dwn text-left" style="text-align: left !important;">Your valid email count is <?php echo $count;?></p> <?php } ?></div>
                <div class="col-lg-6"><p class="dwn">Download as <a href="output/email.txt">txt</a></p></div>
                
            </div>
        </div>
    </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" ></script>


  </body>
</html>
