$(document).ready(function(){
    $('.search select[name=hersteller], .search select[name=modell]').change(function(){
        $(this).parent().submit();
    });
});
