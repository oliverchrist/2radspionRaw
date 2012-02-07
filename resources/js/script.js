$(document).ready(function(){
    $('.search select[name=hersteller], .search select[name=modell]').change(function(){
        $(this).parent().submit();
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
});

  function codeAddress(address) {
    geocoder = new google.maps.Geocoder();
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
          latlng = results[0].geometry.location;
          $('form input[name="latlng"]').val(latlng);
          $('#register, #userdata').submit();
      }else{
          alert('Fehler in Adresse ' + address);
      }
    });
  }  