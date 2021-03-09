$( document ).ready(function() {

    $(document).on("input",'.podborki_section_serch input[name="podborki_serch"]',function() {

        var value = $(this).val().toUpperCase();
        if (value.length > 2){

            $(".podborki_section_content").each(function () {
                if($(".li_box",$(this)).length == 0)
                {
                    var cat_tex = $(this).text().toUpperCase();
                    if(cat_tex.indexOf(value) >= 0) {
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                }
            });

            $('.li_box').each(function () {
               var link_tex = $(this).text().toUpperCase();
                if(link_tex.indexOf(value) >= 0) {
                    $(this).show();
                    $(this).parents('.podborki_section_content').show();
                }else{
                    $(this).hide();
                    if($(this).parents('.podborki_section_content').find('.li_box:visible').length == 0)
                    {
                        $(this).parents('.podborki_section_content').hide();
                    }
                }
            });

            if($(".podborki_section_content:visible").length == 0)
            {
                $("#not_cat_str").text(value);
                $("#not_find_category").show();
            }else
            {
                $("#not_find_category").hide();
            }
        }else{
            $(".podborki_section_content").show();
            $('.li_box').show();
            $("#not_find_category").hide();
        }


    });
});
