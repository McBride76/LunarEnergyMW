<?php

$page_title = 'Lunar Energy : Contact';
include("includes/head.php");

$msg_sent = false;
$email_pattern = '/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/';

include("php-functions/spam-scrubber.php");

// Check for form submission:
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $error_email = '';
        $error_subject = '';
        $error_body = '';

        if(isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
        } else {
            if (!preg_match($email_pattern, trim($_POST['email']))) {
                $error_email = '<p class="error">Email is not correctly formatted</p>';
            } else {
                $email = $_POST['email'];
            }
        }

        // Clean the form data:
        $scrubbed_subject = spam_scrubber($_POST['subject']);
        $scrubbed_body = spam_scrubber($_POST['body']);

        if (empty($scrubbed_subject)) {
            $error_subject = '<p class="error">This subject looks like spam, please try again.</p>';
        }

        if (empty($scrubbed_body)) {
            $error_body = '<p class="error">This message looks like spam, please try again.</p>';
        }

        $valid_input = (empty($error_email) && empty($error_subject) && empty($error_body));
    
        // Minimal form validation
        if ($valid_input) {
    
            // Make it no longer than 70 characters long:
            $scrubbed_body = wordwrap($scrubbed_body, 70);
    
            // Send the email:
            mail('ianmcbride777@gmail.com', $scrubbed_subject, $scrubbed_body, "From: '$email'");
    
            // Clear $_POST (so that the form's not sticky):
            $_POST = [];
            $msg_sent = true;
    
        }
    
    } // End of main isset() IF

    // Dont display form once message has been sent
    if (!$msg_sent) {
        include("includes/contact-form.php");
        echo '</section>';
        include("includes/footer.html");
    } else {
        echo '<div class="activate-msg-container img-bg-black"><p class="txt-center">Your message has been sent! Please allow us 1-2 business days to respond.</p></div>';
    }
?>      
    </main>
</div>  