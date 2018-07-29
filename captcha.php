<?php
    // database connection
    require_once "./includes/connectvars.inc.php";

    // declare variables
    $display_form = true;
    $user_input = '';
    $error_msg = '';
    $valid_length = false;
    $valid_char = false;
    $length_error_msg = 'Your input must be 5 characters.';
    $char_error_msg = 'Illegal character(s) are entered.';
    $char_regex = '/^[a-zA-Z0-9@\$\^]*$/';
    
    // check if submit button has submitted form data
    if (isset($_POST['submit'])) {
        
        //get submitted form data
        $user_input = trim($_POST['userinput']);
        
        // validate input length
        if (strlen($user_input) == 5) {
            $valid_length = true;
        } else {
            $error_msg .= "$length_error_msg<br>";
        }
        
        // validate input characters
        if (preg_match($char_regex, $user_input)) {
            $valid_char = true;
        } else {
            $error_msg .= $char_error_msg;
        }

        if ($valid_length && $valid_char) { // input is valid
            $display_form = false;
        } else { // input is invalid
            $error_msg = "<p id='error'>$error_msg</p>";
        }
    }
    
    // HTML document
    require_once("./includes/htmlhead.inc.php");
?>

    <body>
        <div id="bodycontainer">
            
<?php require_once("./includes/header.inc.php"); ?>
            
            <div id="content">
                
                <?php
                    if ($display_form) { // display form
                ?>
                
                <h2>Use your input to create a CAPTCHA</h2>
                <p>Please enter a five-character input. Legal characters are alphabets (a-z, A-Z), numbers (0-9), $, ^, and @.</p>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="userform">
                    
                    <?= $error_msg ?>
                    
                    <table>
                        <tr>
                            <td><label for="userinput">Your input:</label></td>
                            <td><input type="text" name="userinput" id="userinput" size="10" value="<?= $user_input ?>"></td>
                        </tr>
                    </table>
                    <p><input type="submit" name="submit" id="submit" value="Submit"></p>
                </form>
                
                <?php    
                    } else { // display processing output page
                ?>
                
                <h2>Your input as a CAPTCHA</h2>
                <p><img src="./input_image.php?userInput=<?= $user_input ?>" alt="user input image"></p>
                <p><a href="<?= $_SERVER['PHP_SELF'] ?>">Play Again</a></p>
            
                <?php
                    }
                ?>
                
            </div>
            
<?php require_once("./includes/footer.inc.php"); ?>
            
        </div>
    </body>
</html>

<?php
    // close database connection
    mysqli_close($dbc);
?>
