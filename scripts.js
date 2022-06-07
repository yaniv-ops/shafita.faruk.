
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
            <p>Job Position: <input type="text" id="pos' + countpos + '" name="year' + countpos + '"/> \
            <span class="error">Field is required</span> \
            <input type=""button" value="-" \
                onclick="$(\'#job_offer'+ countpos + '\').remove();countpos--;return false;"></p> \
            <p>Job Description: <textarea id="desc' + countpos +'" name="desc'+ countpos + '" rows="8" cols="80"></textarea></p> \
            <span class="error">Field is required</span> \
            <p>Company Name: <input type="text" id="comp' + countpos +'" name="year'+ countpos + '" value=""/>Company E-mail: <input type="text" id="e-mail' + countpos + '" name="year' + countpos + '" value=""/></p> \
            <span class="error">Field is required</span> \
            <p>Company Phone: <input type="text" id="phone' + countpos + '" name="year'+ countpos + '" value=""/>Recruiter: <input type="text" id="rec' + countpos + '" name="year' + countpos + '" value=""/></p> \
            <p>Recruiter E-mail: <input type="text" id="rec-mail' + countpos + '" name="year'+ countpos + '" value=""/>Recruiter Phone: <input type="text" id="rec-phone' + countpos + '" name="year' + countpos + '" value=""/></p> \
            <span class="error">Field is required</span> \
            <p><input type="text" name="year'+ countpos + '" value=""/>Position<input type="text" name="year' + countpos + '" value=""/></p> \
            </div>');
        $("#pos" + countpos).on('input', function () {
            var input = $(this);
            var is_name = input.val();
            if (is_name) { input.removeClass("invalid").addClass("valid"); }
            else { input.removeClass("valid").addClass("invalid"); }
        });
        $("#desc" + countpos).keyup('input', function () {
            var input = $(this);
            var is_message = input.val();
            if (is_message) { input.removeClass("invalid").addClass("valid"); }
            else { input.removeClass("valid").addClass("invalid"); }
        });
        $("#comp" + countpos).on('input', function () {
            var input = $(this);
            var is_comp = input.val();
            if (is_comp) { input.removeClass("invalid").addClass("valid"); }
            else { input.removeClass("valid").addClass("invalid"); }
        });
        $("#e-mail" + countpos).on('input', function() {
            var input=$(this);
            var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            var is_email=re.test(input.val());
            if(is_email){input.removeClass("invalid").addClass("valid");}
            else{input.removeClass("valid").addClass("invalid");}
        });
        $("#phone" + countpos).on('input', function () {
            var input = $(this);
            var is_phone = input.val();
            if (is_phone) { input.removeClass("invalid").addClass("valid"); }
            else { input.removeClass("valid").addClass("invalid"); }
        });
        $("#rec" + countpos).on('input', function () {
            var input = $(this);
            var is_rec = input.val();
            if (is_rec) { input.removeClass("invalid").addClass("valid"); }
            else { input.removeClass("valid").addClass("invalid"); }
        });
        $("#rec-mail" + countpos).on('input', function() {
            var input=$(this);
            var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            var is_rec_email=re.test(input.val());
            if(is_rec_email){input.removeClass("invalid").addClass("valid");}
            else{input.removeClass("valid").addClass("invalid");}
        });
        $("#rec-phone" + countpos).on('input', function () {
            var input = $(this);
            var is_rec_phone = input.val();
            if (is_rec_phone) { input.removeClass("invalid").addClass("valid"); }
            else { input.removeClass("valid").addClass("invalid"); }
        });



    });




});




function doValidate() {
    $('.error').css("color", 'purple');
    alert('No errors123: Form will be submitted');
    return true;
}