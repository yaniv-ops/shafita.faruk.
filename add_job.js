

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
        window.console && console.log("Adding Job offer" + countpos);
        $('#position_fields').append(
            '<div id="job_offer' + countpos + '"> \
            <p>Year: <input type="text" name="year'+ countpos + '" value=""/> \
            <input type=""button" value="-" \
                onclick="$(\'#job_offer'+ countpos + '\').remove();countpos--;return false;"></p> \
            <textarea name="desc'+ countpos + '" rows="8" cols="80"></textarea> \
            </div>');


    });

});
