

countpos = 0;
$(document).ready(function () {
    window.console && console.log('Document ready called');
    $('#addJob').click(function (event) {
        event.preventDefault();
        if (countpos >= 9) {
            alert("Maximum of nine offers at a time please!");
            return;
        }
        countpos++;
        window.console && console.log("Adding Job offer:" + countpos);
        $('#position_fields').append(
            '<div id="job_offer' + countpos + '"> \
            <p>Job Position: <input type="text" id="pos' + countpos + '" name="year'+ countpos + '" value=""/> \
            <span class="error">Field is required</span> \
            <input type=""button" value="-" \
                onclick="$(\'#job_offer'+ countpos + '\').remove();countpos--;return false;"></p> \
            <p>Job Description: <textarea name="desc'+ countpos + '" rows="8" cols="80"></textarea></p> \
            <span class="error">Field is required</span> \
            <p>Company Name: <input type="text" name="year'+ countpos + '" value=""/>Company E-mail: <input type="text" name="year' + countpos + '" value=""/></p> \
            <span class="error">Field is required</span> \
            <p>Company Phone: <input type="text" name="year'+ countpos + '" value=""/>Recruiter: <input type="text" name="year' + countpos + '" value=""/></p> \
            <p>Recruiter E-mail: <input type="text" name="year'+ countpos + '" value=""/>Recruiter Phone: <input type="text" name="year' + countpos + '" value=""/></p> \
            <span class="error">Field is required</span> \
            <p><input type="text" name="year'+ countpos + '" value=""/>Position<input type="text" name="year' + countpos + '" value=""/></p> \
            </div>');



    });
    $('#addAlljobs').click(function (event) {
        event.preventDefault();
        alert("submit form preeseed!!!")
    });

});
