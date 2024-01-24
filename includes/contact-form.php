
<div id="body">
    <main id="contact" class="main">
        <div class="heading img-bg-black">
            <h1 class="txt-green">CONTACT US</h1>
        </div>
        <section>
            <div class="img-wrapper"></div>
            <div class="form-wrapper img-bg-white">
                <form action="contact.php" method="post">
                    <?php  
                    if (!isset($_SESSION['email'])) {
                        echo '<div class="contact-email contact-item">
                                <label for="email">Email</label>
                                <input type="email" placeholder="somebody@example.com" name="email" id="email"';
                                if (isset($_POST['email'])) echo ' value="' . $_POST['email'] . '"';
                            echo '></div>';
                            if (!empty($error_email)) {
                                echo $error_email;
                            }
                        }
                    ?>
                    <div class="contact-subject contact-item">
                        <label for="subject">Subject</label>
                        <input type="text" name="subject" id="subject" maxlength="40"
                        <?php if (isset($_POST['subject'])) echo ' value="' . $_POST['subject'] . '"'; ?>>
                        <?php if (!empty($error_subject)) echo $error_subject; ?>
                    </div>
                    <div class="contact-textarea contact-item">
                        <div>
                            <label for="body">Message</label>
                            <p id="charDisplay">Characters Available: 300</p>
                        </div>
                        <textarea id="contactBody" name="body" maxlength="300"><?php if (isset($_POST['body'])) echo $_POST['body']; ?></textarea>
                        <?php if (!empty($error_body)) echo $error_body; ?>
                    </div>
                    <div class="contact-submit btn-container">
                        <input type="submit" value="Send">
                    </div>
                    <img src="images/paper-airplane.png" id="airplane">
                </form>
            </div> 