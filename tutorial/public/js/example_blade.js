$(document).ready(function(){
    $(".readOnlyRow").hide();
    $("#readOnlyRowsToggle").click(function(){
        var elem=$(".readOnlyRow")[0];
        if(elem.style.display=='none')
        $(".readOnlyRow").show();
        else
        $(".readOnlyRow").hide();
    });
});