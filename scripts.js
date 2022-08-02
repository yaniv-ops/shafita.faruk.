
countpos = 0;
$(document).ready(function () {
    var dialog
    dialog = $("#dialog-form").dialog({
        autoOpen: false,
        resizable: true,
        height: 400,
        width: 350,
        modal: true,
        buttons: {
            "Send email" : send_mail,
            Cancel: function () {
            dialog.dialog("close");
        }
    },
    close: function() {
        alert("closing");
    }});
    var dialogb
    dialogb = $("#dialog-form").dialog({
        autoOpen: false,
        resizable: true,
        height: 400,
        width: 350,
        modal: true,
        buttons: {
            "Send email" : send_mail,
            Cancel: function () {
            dialogb.dialog("close");
        }
    },
    close: function() {
        alert("closing");
    }});
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
            <div><p>Job Position: <input type="text" id="contact_pos' + countpos + '" name="pos' + countpos + '"/> \
            <span class="error">Field is required</span></div> \
            <input type=""button" value="-" \
                onclick="$(\'#job_offer'+ countpos + '\').remove();countpos--;return false;"></p> \
            <div><p>Job Description: <textarea id="contact_desc' + countpos + '" name="desc' + countpos + '" rows="8" cols="80"></textarea>\
            <span class="error">Field is required</span></div></p>  \
            <div><p>Company Name: <input type="text" id="contact_comp' + countpos + '" name="comp' + countpos + '" class=company_name value=""/>\
            <span class="error">Field is required</span></p>\
            <p>Recruiter: <input type="text" id="contact_rec' + countpos + '" name="rec' + countpos + '" value=""/><span class="error">Field is required</span></p> \
            <p>Recruiter E-mail: <input type="text" id="contact_rec-mail' + countpos + '" name="rec-mail' + countpos + '" value=""/><span class="error">Field is required</span></p>\
            <p>Recruiter Phone: <input type="text" id="contact_rec-phone' + countpos + '" name="rec-phone' + countpos + '" value=""/><span class="error">Field is required</span></p> \
            <span class="error">Field is required</span></p> \
            </div>');
        $("#contact_pos" + countpos).on('input', function () {
            var input = $(this);
            var is_name = input.val();
            if (is_name) { input.removeClass("invalid").addClass("valid"); }
            else { input.removeClass("valid").addClass("invalid"); }
        });
        $("#contact_desc" + countpos).keyup('input', function () {
            var input = $(this);
            var is_message = input.val();
            if (is_message) { input.removeClass("invalid").addClass("valid"); }
            else { input.removeClass("valid").addClass("invalid"); }
        });
        $("#contact_comp" + countpos).on('input', function () {
            var input = $(this);
            var is_comp = input.val();
            if (is_comp) { input.removeClass("invalid").addClass("valid"); }
            else { input.removeClass("valid").addClass("invalid"); }
        });

        $("#contact_rec" + countpos).on('input', function () {
            var input = $(this);
            var is_rec = input.val();
            if (is_rec) { input.removeClass("invalid").addClass("valid"); }
            else { input.removeClass("valid").addClass("invalid"); }
        });
        $("#contact_rec-mail" + countpos).on('input', function () {
            var input = $(this);
            var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            var is_rec_email = re.test(input.val());
            if (is_rec_email) { input.removeClass("invalid").addClass("valid"); }
            else { input.removeClass("valid").addClass("invalid"); }
        });
        $("#contact_rec-phone" + countpos).on('input', function () {
            var input = $(this);
            var input = $(this);
            var re = /^[0-9-]*$/;
            var is_rec_phone = re.test(input.val());
            if (is_rec_phone) { input.removeClass("invalid").addClass("valid"); }
            else { input.removeClass("valid").addClass("invalid"); }
        }); 
        $('.company_name').autocomplete({
            source: 'json.php'
                });

    });


    $("#first_form_submit").click(function (e) {
        var form_data = $("#first_form").serializeArray();
        var error_free = true;
        for (var input in form_data) {
            var element = $("#contact_" + form_data[input]['name']);
            var valid = element.hasClass("valid");
            var error_element = $("span", element.parent());
            if (!valid) {
                error_element.removeClass("error").addClass('error_show');
                error_free = false;

            } else {
                error_element.removeClass("error_show").addClass("error");

            }


        }
        if (!error_free) {
            alert('not valid');
            e.preventDefault();
        } else {
            alert('No errors: Form will be submitted');
        }

    });
    function send_mail (e) {
        alert("Soon available");
        dialog.dialog("close");
        
    }

    $("#send_button").click(function (e) {
        e.preventDefault();
        dialog.dialog("open");
        

    });
    $('#update').click(function (e) {
        e.preventDefault();
        dialogb.dialog("open");
    })

});


/*
alert("element is: " + element + "AND: " + input);
var valid = element.hasClass("valid");
var error_element = $("span", element.parent());
if (!valid) {
    error_element.removeClass("error").addClass(error_show);
    error_free = false;
} else {
    alert("element is: " + element + "valid " + input);
    error_element.removeClass("error_show").addClass("error");
}
}
if (!error_free) {
e.preventDefault();
} else {
alert('No errors 2: Form will be submitted');
}
*/