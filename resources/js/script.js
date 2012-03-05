$(document).ready(function(){
    $('.search select').change(function(){
        $(this).parents('form.search').submit();
    });
    $('.search .reset').click(function(){
        $(this).parents('form.search').find('.inputField input').removeAttr('value');
        $(this).parents('form.search').find('select option').removeAttr('selected');
    });
    var html = radtyp[$('.search select[name=radtyp]').val()];
    if(html){
        $('.teaser .info').html(html).show();
    }

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
        var answere = confirm("Wollen Sie dieses Angebot wirklich löschen?");
        if(!answere){
            e.preventDefault();
        }
    });

    $('.ajaxDelete').click(function(e){
        e.preventDefault();
        var link = $(this).attr('href');
        var element = $(this).parents('.bikeListElement');
        element.css('height',element.height() + 'px');
        var answere = confirm("Wollen Sie dieses Angebot wirklich löschen?");
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

    $('.ajaxNotepadDelete').click(function(e){
        e.preventDefault();
        var link = $(this).attr('href');
        var element = $(this).parent().parent();
        element.css('height',element.height() + 'px');
        var answere = confirm("Wollen Sie dieses Angebot vom Merkzettel wirklich löschen?");
        if(answere){
            $.ajax({
              url: link,
              context: element,
              success: function(result){
                if(result == 'delete'){
                    $(this).addClass("notepadDeleted");
                }else{
                    console.log('Fehler in notepadAjax.php');
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

    $('.print').click(function(e){
        e.preventDefault();
        window.print();
    });


});

function codeAddress(address) {
    geocoder = new google.maps.Geocoder();
    geocoder.geocode( { 'address': address}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
              latlng = results[0].geometry.location;
              lat = results[0].geometry.location.lat();
              lng = results[0].geometry.location.lng();
          }else{
              lat = '';
              lng = '';
          }
          $('form input[name="lat"]').val(lat);
          $('form input[name="lng"]').val(lng);
          $('#register, #userdata').submit();
    });
}

var radtyp = new Object;
radtyp['BMX'] = '20 Zoll Laufräder, ursprünglich für Cross-Rennen und Trial, heute gibt es 5 Disziplinen für BMX: Race, Flatland, Street, Park und Dirt';
radtyp['Citybike'] = '28 Zoll Laufräder, aufrechte Sitzposition, geschlossener Kettenkasten, Nabenschaltung, breite Reifen, Lichtanlage, Gepäckträger und evtl. Einkaufskorb';
radtyp['Cross- / Cyclocrossrad'] = '28 Zoll Laufräder, Rennrad für Querfeldeinrennen, 23 mm  breite Reifen, Kettenschaltung, Cantilever-Bremsen, klassischerweise ohne Fderung oder hydraulische Elemente';
radtyp['Beachcruiser'] = '24/26 Zoll Laufräder, geschwungene Rahmenform, breite Reifen, meist Nabenschaltung, aufrechte Sitzposition, weicher Sattel';
radtyp['Cruiser'] = '24/26 Zoll Laufräder, geschwungene Rahmenform, breite Reifen, meist Nabenschaltung, aufrechte Sitzposition, weicher Sattel';
radtyp['Dirt / Dual Bike'] = '24/26 Zoll Laufräder, stabiles Mountainbike mit kleinem Rahmen, großer Federweg an der Gabel, meist ohne Schaltung, für Dirt-Jump';
radtyp['Dreirad'] = 'Einsatz als Lastenrad oder Rikscha, ideal auch für Menschen mit motorischen Störungen, auch als Liegedreiräder verfügbar';
radtyp['Elektro Rad'] = 'Elektromotor kann hinzugeschaltet werden, Versorgung des Elektromotors erfolgt über abnehmbaren Akku.';
radtyp['Faltrad / Klapprad'] = '16/20 Zoll Laufräder, mit Scharnieren und Schnellspannern lässt sich das Rad schnell auf kleines Packmaß bringen';
radtyp['Fitnessbike'] = '28 Zoll Laufräder, geeignet für leichtes Gelände, ähnliche Geometrie wie Rennrad, viele Ausstattungsvarianten möglich';
radtyp['Freeride / Downhill'] = '26 Zoll Laufräder, für Abfahrtsrennen gebaut, vollgefedert, wegen der hohen Stabilität schwerer, Scheibenbremsen, optimierte Kettenschaltung';
radtyp['Hollandrad'] = '28 Zoll Laufräder, aufrechte Sitzposition, geschlossener Kettenkasten, Hinterrad-Seitenverkleidung, hervorragenden Geradeauslauf, oft Trommelbremsen und Narbenschaltung';
radtyp['Jugendrad'] = '20-26 Zoll';
radtyp['Kinderrad'] = '12-18 Zoll';
radtyp['Mountainbike hardtail'] = '26 Zoll Laufräder, Geländerad, Federgabel, breite Reifen, verschiedene Bremsanlagen und Schaltungen';
radtyp['Mountainbike fully'] = '26 Zoll Laufräder, Geländerad, voll geferdert, breite Reifen, verschiedene Bremsanlagen und Schaltungen';
radtyp['Rennrad'] = '28 Zoll Laufräder, nur für die Straße, minimales Gewicht, schmale Reifen, Kettenschaltung';
radtyp['Singlespeed'] = 'nur ein Gang, keine Schaltung, meist auch kein Freilauf, manchmal auch ohne Bremsen';
radtyp['Triathlonrad'] = '26/28 Zoll Rennrad mit aerodynamischen Anpassungen an Rahmen und Sitzposition';
radtyp['Tandem'] = 'Fahrrad mit 2 Sitzplätzen, Pilot sitzt vorne, der Nichtlenkende sitzt hinten';
radtyp['Trekkingrad'] = '28 Zoll Laufräder, für leichtes Gelände, Rahmengeometrie vergleichbar mit Rennrad';
radtyp['Transportrad'] = 'Lastenrad zur Bewegung großer oder schwerer Lasten, Einspur- und Dreirad-Variante, verschiedene Aufbauten möglich';
radtyp['Reiserad'] = 'längerer Radstand, größerer Nachlauf, stabile Materialien, größere Wanddicken der Rahmenrohre, 2 Gepäckträger, Lowrider, Lenkertasche';
radtyp['XXL Bike'] = 'Ausgelegt für Körpergewicht bis 170 Kg, verstärkter Rahmen, verstärkte Federgabel';
radtyp['Pedelec'] = 'Elektrofahrrad welches seine zusätzliche Leistung nur bei gleichzeitigem Pedalbetrieb abgibt -> Hybrid, da Elektromotor und Muskelkraft';
radtyp['Einrad'] = 'Für Sportgerät für Artisten, neu auch Freestyle und Offroad Unicycles MUni';
radtyp['Crossrad vollgefedert'] = '28 Zoll Laufräder, Rennrad für Querfeldeinrennen, 23 mm  breite Reifen, Kettenschaltung, Cantilever-Bremsen';
radtyp['Tourenrad'] = 'alltagstaugliches Fahrrad, aufrechte Sitzposition, mit gefedertem Sattel, meist Nabenschaltung, breite Reifen';
radtyp['Biker Cross'] = 'Spezialrad für Mountainbike Renndisziplin, straffe Federgabel, teilweise vollgefedert';
