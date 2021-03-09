function colorTd() {
    var nem_el = 0;
    var i = 0;
    $("#myTable th").each(function () {
        i++;
        $('#myTable td').removeClass('activ_one').removeClass('activ_two');
        var el_class = $(this).attr('class');
        if (el_class.indexOf('SortDown') + 1) {
            nem_el = i;
        }
        if (el_class.indexOf('SortUp') + 1) {
            nem_el = i;
        }
    });
    var y = 1;

    $('#myTable tbody tr').each(function () {
        var j = 0;
        $(this).children('td').each(function () {
            j++;
            if (j == nem_el) {
                if (y % 2) {
                    $(this).addClass('activ_two');
                } else {
                    $(this).addClass('activ_one');
                }
            }
        });
        y++;
    });
}
$(document).ready(function(){
        $("#myTable").tablesorter();

        setTimeout(colorTd, 10);

        $(document).on('click','.t_hed',function() {
            setTimeout(colorTd, 10);
        });

        $('th.price').trigger('click');
});