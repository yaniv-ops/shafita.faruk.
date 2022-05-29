<?php
 $oldguess = isset($_POST['guess']) ? $_POST['guess'] : '';
?>

<p>Guessing game...</p>
<form method="post">
 <p>
  <label for="guess">Input Guess</label>
  <input type="text" name="guess" size="40" id="guess" value="<?= $oldguess ?>"/>
 </p> 
 <input type="submit"/> 
</form>
<pre>
$_POST:
<?php
 print_r($_POST['guess']);
?>
</pre>


<form id="contact" method="post" action="">
        <!-- Name -->
        <div>
            <label for="contact_name">Name:</label>
            <input type="text" id="contact_name" name="name">
            <span class="error">This field is required</span>
        </div>
        <!-- Email -->
        <div>
            <label for="contact_email">Email:</label>
            <input type="email" id="contact_email" name="email">
            <span class="error">A valid email address is required</span>
        </div>
        <!--Website -->
        <div>
            <label for="contact_website">Website:</label>
            <input type="url" id="contact_website" name="website">
            <span class="error">A valid url is required</span>
        </div>
        <!-- Message -->
        <div>
            <label for="contact_message">Message:</label>
            <textarea id="contact_message" name="message"></textarea>
            <span class="error">This field is required</span>
        </div>
        <!-- Submit Button -->
        <div id="contact_submit">
            <button type="submit">Submit</button>
        </div>
    </form>