<?php
    $error = "";

    $succesMessage = "";

    if ($_POST) {
       if (!$_POST["email"]) {
         $error .= "An email address is required<br>";
       }

       if (!$_POST["content"]) {
         $error .= "The content field is required.<br>";
       }

       if (!$_POST["subject"]) {
         $error .= "The subject is required.<br>";
       }

       if($_POST["email"] && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false) {
        $error .= "The email address is invalid.<br>";
       }

       //check if there are errors
       if($error != "") {
        $error = '<div class="alert alert-danger" role="alert"><p>There were error(s) in your form:</p>' . $error . '</div>';
    }
    else {  //email address is good!
        $emailTo = "codestarsjpbaugh@gmail.com";
        $subject = $_POST["subject"];
        $content = $_POST["content"];
        $headers = "From: " . $_POST["email"];

        //try sending the mail
        if(mail($emailTo, $subject, $content, $headers)) {
            $successMessage = '<div class="alert alert-success" role="alert">Your message was sent, ' . 
                            'we\'ll get back to you ASAP!</div>';
        }
        else {
            $error = '<div class="alert alert-danger" role="alert">Your message couldn\'t be sent - try again later</div>';
        }//end if mail function succeeded or failed
    }//end else for the if $error != ""

}//end if $_POST

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
    
</head>
<body>
    <div class="container">
        <h1>Get in touch!</h1>
        <div id="error"><?php echo $error.$successMessage; ?></div>

        <form method="post">
            <fieldset class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" 
                name="email" placeholder="Enter email">
                <small class="text-muted">We'll never share your e-mail with anyone else.</small>
            </fieldset>

            <fieldset class="form-group">
            <label for="subject">Subject</label>
            <input type="text" class="form-control" id="subject" name="subject">
            </fieldset>

            <fieldset class="form-group">
            <label for="content">What would you like to ask us?</label>
            <textarea class="form-control" id="content" name="content" rows="3"></textarea>
            </fieldset>

            <button type="submit" id="submit" class="btn btn-primary">Submit</button>
        </form>
    </div> <!-- End of container -->

    <script src="./jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
    crossorigin="anonymous"></script>

    <!-- TODO: JS -->

    <script>
        $("form").submit(function(e){
            let error = "";

            if($("#email").val() == "") {
                error += "the email field is required!<br>";
            }

            if($("#subject").val() == "") {
                error += "the subject field is required!<br>";
            }

            if($("#content").val() == "") {
                error += "the content field is required!<br>";
            }

            //test if there was an error or not
            if(error != "") {
                $("#error").html('<div class="alert alert-danger" role="alert"><p>' +
               '<strong>There were error(s) in your form:</strong></p>' + error + '</div>');

               return false
            } else {  //no errors!
                return true;
            }
        })
    </script>
</body>
</html>