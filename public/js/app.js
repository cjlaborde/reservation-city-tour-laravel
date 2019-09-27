
$(function () {
    $(".datepicker").datepicker();
});


$(function () {
    $(".autocomplete").autocomplete({
        source: base_url + "/searchCities", /* Lecture 17 */
        minLength: 2,
        select: function (event, ui) {

//            console.log(ui.item.value);
        }


    });
});



//room.php /* Lecture 20 deleted code under this line */
