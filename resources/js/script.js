$(document).ready(function(){
    $('.search select').change(function(){
        $(this).parents('form.search').submit();
    });
    $('.search .reset').click(function(){
        $(this).parents('form.search').find('.inputField input').removeAttr('value');
        $(this).parents('form.search').find('select option').removeAttr('selected');
    });
    
    $('a.lightbox').lightBox({
        imageLoading: 'resources/images/lightbox-ico-loading.gif',
        imageBtnPrev: 'resources/images/lightbox-btn-prev.gif',
        imageBtnNext: 'resources/images/lightbox-btn-next.gif',
        imageBtnClose: 'resources/images/lightbox-btn-close.gif',
        imageBlank: 'resources/images/lightbox-blank.gif'
    });
    
    $('#register .submit, #userdata .submit').click(function(){
        var form = $(this).parents('form');
        var postcode = $('input[name="postcode"]', form).val();
        var city = $('input[name="city"]', form).val();
        //alert(postcode + ' ' + city);
        codeAddress(postcode + ' ' + city);
    });
    
    $('.delete').click(function(e){
        var link = $(this).attr('href');
        var answere = confirm("Wirklich löschen?");
        if(!answere){
            e.preventDefault();
        }
    });
    
    $('.selectEigenschaft').change(function(){
        if($(this).val() == -1){
            $(this).next('input').show();
        }else{
            $(this).next('input').hide();
        }
    });
});

function codeAddress(address) {
    geocoder = new google.maps.Geocoder();
    geocoder.geocode( { 'address': address}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
              latlng = results[0].geometry.location;
              lat = results[0].geometry.location.lat();
              lng = results[0].geometry.location.lng();
              
              $('form input[name="latlng"]').val(latlng);
              $('form input[name="lat"]').val(lat);
              $('form input[name="lng"]').val(lng);
              $('#register, #userdata').submit();
          }else{
              alert('Fehler in Adresse ' + address);
          }
    });
}  