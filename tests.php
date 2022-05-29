<head>
    <title>Form Validation</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript" src="scripts.js"></script>
</head>

<body>
    <p id="bacon">Add Job offer: <button id="addJob" onclick="addJob()">+</button></p>
    <div id='position_fields'></div>
    <script>
        countpos = 0;

        function addJob() {


            document.getElementById("bacon").style.color = "red";
            if (countpos >= 9) {
                alert("Maximum of nine offers at a time please!");
                return;
            }
            countpos++;
            $('#position_fields').append(

                '<div id="job_offer' + countpos + '"> \
                <p>Job Position: <input type="text" id="pos' + countpos + '" name="year' + countpos + '" value=""/> \
                <span class="error">Field is required</span> \
                <input type=""button" value="-" \
                    onclick="$(\'#job_offer' + countpos + '\').remove();countpos--;return false;"></p> \
                <p>Job Description: <textarea name="desc' + countpos + '" rows="8" cols="80"></textarea></p> \
                <span class="error">Field is required</span> \
                <p>Company Name: <input type="text" name="year' + countpos + '" value=""/>Company E-mail: <input type="text" name="year' + countpos + '" value=""/></p> \
                <span class="error">Field is required</span> \
                <p>Company Phone: <input type="text" name="year' + countpos + '" value=""/>Recruiter: <input type="text" name="year' + countpos + '" value=""/></p> \
                <p>Recruiter E-mail: <input type="text" name="year' + countpos + '" value=""/>Recruiter Phone: <input type="text" name="year' + countpos + '" value=""/></p> \
                <span class="error">Field is required</span> \
                <p><input type="text" name="year' + countpos + '" value=""/>Position<input type="text" name="year' + countpos + '" value=""/></p> \
                </div>');
        }
    </script>
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
</body>