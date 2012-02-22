$(document).ready(function(){
    $('.search select').change(function(){
        $(this).parents('form.search').submit();
    });
    $('.search .reset').click(function(){
        $(this).parents('form.search').find('.inputField input').removeAttr('value');
        $(this).parents('form.search').find('select option').removeAttr('selected');
    });
    $('.search select[name=radtyp] option').mouseenter(function(){
        var html = radtyp[$(this).val()];
        if(html){
            $('.teaser .info').html(html).show();
        }
    }).mouseleave(function(){
        $('.teaser .info').hide();
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
    
    $('.ajaxDelete').click(function(e){
        e.preventDefault();
        var link = $(this).attr('href');
        var element = $(this).parents('.bikeListElement');
        element.css('height',element.height() + 'px');
        var answere = confirm("Wirklich löschen?");
        if(answere){
            $.ajax({
              url: link,
              context: element,
              success: function(result){
                if(result == 'delete'){
                    $(this).addClass("deleted");
                }else{
                    console.log('Fehler in bikeAjax.php');
                }
              }
            });
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

var radtyp = new Object;
radtyp['BMX Rad'] = '20 Zoll Laufräder, ursprünglich für Cross-Rennen und Trial, heute gibt es 5 Disziplinen für BMX: Race, Flatland, Street, Park und Dirt';
radtyp['Citybike'] = '28 Zoll Laufräder, aufrechte Sitzposition, geschlossener Kettenkasten, Nabenschaltung, breite Reifen, Lichtanlage, Gepäckträger und evtl. Einkaufskorb';
radtyp['Crossrad hardtail'] = '28 Zoll Laufräder, Rennrad für Querfeldeinrennen, 23 mm  breite Reifen, Kettenschaltung, Cantilever-Bremsen, klassischerweise ohne Fderung oder hydraulische Elemente';
radtyp['Beachcruiser'] = '24/26 Zoll Laufräder, geschwungene Rahmenform, breite Reifen, meist Nabenschaltung, aufrechte Sitzposition, weicher Sattel';
radtyp['Cruiser'] = '24/26 Zoll Laufräder, geschwungene Rahmenform, breite Reifen, meist Nabenschaltung, aufrechte Sitzposition, weicher Sattel';
radtyp['Dirt / Dual Bike'] = '24/26 Zoll Laufräder, stabiles Mountainbike mit kleinem Rahmen, großer Federweg an der Gabel, meist ohne Schaltung, für Dirt-Jump';
radtyp['Dreirad'] = 'Einsatz als Lastenrad oder Rikscha, ideal auch für Menschen mit motorischen Störungen, auch als Liegedreiräder verfügbar';
radtyp['Elektro Rad / Faltrad'] = 'Elektromotor kann hinzugeschaltet werden, versorgung des Elektromotors erfolgt über abnehmbaren Akku.';
radtyp['Faltrad / Klapprad'] = '16/20 Zoll Laufräder, mit Scharnieren und Schnellspannern läst sich das Rad schnell auf kleines Packmaß bringen';
radtyp['Fitnessbike'] = '28 Zoll Laufräder, geeignet für leichtes Gelände, ähnliche Geometrie wie Rennrad, viele Ausstattungvarianten möglich';
radtyp['Freeride / Downhill'] = '26 Zoll Laufräder, für Abfahrtsrennen gebaut, vollgefedert, wegen der hohen Stabilität schwerer, Scheibenbremsen, optimierte Kettenschaltung';
radtyp['Hollandrad'] = '28 Zoll Laufräder, aufrechte Sitzposition, geschlossener Kettenkasten, Hinterrad-Seitenverkleidung, hervorragenden Geradeauslauf, oft Trommelbremsen und Narbenschaltung';
radtyp['Jugendrad'] = '20"-26"';
radtyp['Kinderrad'] = '12"-18"'; 
radtyp['Mountainbike'] = '26 Zoll Laufräder, Geländerad, vollgefedert oder hardtail, breite Reifen, verschiedene Bremsanlagen und Schaltungen';
radtyp['Rennrad'] = '28 Zoll Laufräder, nur für die Straße, minimales Gewicht, schmale Reifen, Kettenschaltung';
radtyp['Singlespeed'] = ' ';
radtyp['Speedbike'] = '   ';
radtyp['Tandem'] = '  ';
radtyp['Trekkingrad'] = ''; 
radtyp['Transportrad'] = ' ';   
radtyp['Urbanbike'] = '   ';
radtyp['XXL-Bike Herren'] = ''; 
radtyp['XXL-Bike Damen'] = '  ';
radtyp['Bike ab 150 kg Gesamtgewicht'] = '';    
radtyp['Pedelec'] = 'Elektrofahrrad welches seine zusätzliche Leistung nur bei gleichzeitigem Pedalbetrieb abgibt -> hybrid elektromotor und Muskelkraft';
