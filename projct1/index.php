<?php 
$msg= '';
$msgClass= '';
//Check for Submit
if(filter_has_var(INPUT_POST, 'submit')){
    //echo 'Submitted';
    //Get Frorm Data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    //Check Required Fields
    if(!empty($name) && !empty($email) && !empty($message)){ 
        //Passed
        //Check Email
        if(filter_var($email, FILTER_VALIDATE_EMAIL)=== false){
            //Failed
            $msg = 'Please use a valid email';
            $msgClass = 'alert-danger';    
        } else {
            //Passed
           $toEmail = 'manuel.zumub@outlook.pt';
           $subject = 'Contact Request From'.$name;   
           $body= '<h2>Contact Request</h2>
                    <h4>Name</h4><p>'.$name.'</p>
                    <h4>Email</h4><p>'.$email.'</p>
                    <h4>Message</h4><p>'.$message.'</p>';
            
            // Email Headers
            $headers = "MINE-Version: 1.0" ."\r\n";
            $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";
           
            //AdditionL HEADERS
            $headers .= "From: " .$name. "<".$email.">". "\r\n";

            if (mail($toEmail, $subject, $body, $headers)){
                //Email Sent
                $msg = 'Your email has been send';
                $msgClass = 'alert-success';   
            }else{
                //Failed
                $msg = 'Your email was not send';
                $msgClass = 'alert-danger';   
            }
            
        }
    }else {
        //Fail
        $msg = 'Please fill in all fields';
        $msgClass = 'alert-danger';    
    }  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact US</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/cosmo/bootstrap.min.css">
</head>
<body>
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php"> My Website </a>
                </div>
            </div>
        </nav>
    <div class="container">
           <?php if ($msg != ''): ?>
                <div class="alert <?php echo $msgClass; ?>"><?php echo 
                $msg; ?></div>
            <?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <div class="form-group">   
                <label>Name</label>
                <input type="text" name="name" class="form-control" 
                value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
            </div>
            <div class="form-group">   
                <label>Email</label>
                <input type="text" name="email" class="form-control" 
                value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
            </div>
            <div class="form-group">   
                <label>Message</label>
                <textarea name="message" class="form-control"><?php echo isset($_POST['message']) ? $message : ''; ?>  
                </textarea>
            </div>
            <br>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>