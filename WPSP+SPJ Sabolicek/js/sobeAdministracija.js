!$(document).ready(function() {
    LoadAlbum(1, 4, 'sobeSve');
    LoadAlbum(1, 3, 'sobePrizemlje');
    LoadAlbum(1, 2, 'sobeDrugi');
    LoadAlbum(1, 1, 'sobePrvi');
    LoadAlbum(2, 4, 'sobeSve');
    $("#sve").click();
});
var oSobe = [];

function LoadAlbum(nOpcija, nKat, katID) {
    $.ajax({
        url: 'json.php?json_id=get_rooms_by_floor&room_floor=' + nKat,
        type: 'GET',
        success: function(oData) {
                oSobe = [];
                oData = JSON.parse(oData);
                if(nOpcija=1){
                for (var i = 0; i < oData.length; i++) {
                    oSobe.push(oData[i]);
                    var imgDir = GetDirectory(oData[i].tip_sobe, oData[i].opis);
                    var sTr = '<div class="col-md-4">' +
                        '<div class="card mb-4 box-shadow">' +
                        '<img class="card-img-top" style="height: 225px; display: block;" src="img/' + imgDir + '/slika1" data-holder-rendered="true">' +
                        '<div class="card-body">' +
                        '<p class="card-text">' + DajKat(oData[i].kat) + '<br>Broj sobe: ' + oData[i].broj_sobe + ' </p>' +
                        '<div class="d-flex justify-content-between align-items-center">' +
                        '<div class="btn-group">' +
                        '<span class="btn btn-success" onclick="GetModal(\'modals.php?modal_id=show_room&img_dir=' + imgDir + '&room_id=' + oData[i].soba_id + '\')" aria-hidden="true">Pogledaj</span>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                    $('.' + katID + '').append(sTr);
                }
            }
            if(nOpcija=2){
                for (var i = 0; i < oData.length; i++) {
                    oSobe.push(oData[i]);
                    var imgDir = GetDirectory(oData[i].tip_sobe, oData[i].opis);
                    var sTr = '<tr>' +
                    '<td>' + (i + 1) + '</td>' +
                    '<td>' + oData[i].soba_id + '</td>' +
                    '<td>' + oData[i].broj_sobe + '</td>' +
                    '<td>' + oData[i].kat + '</td>' +
                    '<td>' + oData[i].tip_sobe + '</td>' +
                    '<td>' + oData[i].opis + '</td>' +
                    '<td><span class="glyphicon glyphicon-search" onclick="GetModal(\'modals.php?modal_id=show_room&img_dir=' + imgDir + '&room_id=' + oData[i].soba_id + '\')" aria-hidden="true"></span></td>' +
                    '</tr>';
                    $('.tableRooms').append(sTr);
                }
            }
            
        }
    })
};

function openFloor(kat) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(kat).style.display = "block";
    //event.currentTarget.className += " active";

}

function GetDirectory(tip, opis) {
    var imgString;
    if (opis == 'Dijeljena kupaonica' && tip == 'Dvokrevetna') {
        imgString = 'dvokrevetnab';
    }
    if (opis == 'Zasebna kupaonica' && tip == 'Dvokrevetna') {
        imgString = 'dvokrevetnaa';
    }
    if (opis == 'Zasebna kupaonica' && tip == 'Jednokrevetna') {
        imgString = 'jednokrevetna';
    }

    return imgString;
}

function DajKat(kat) {
    var sKat;
    if (kat == 3) {
        sKat = 'Prizemlje';
    }
    if (kat == 2) {
        sKat = 'Drugi kat';
    }
    if (kat == 1) {
        sKat = 'Prvi kat';
    }
    return sKat;
}

function SaveNewComment() {
    let datax = $('.comments:visible').serialize() + "&action_id=save_new_comment";
    $.ajax({
        url: 'action.php',
        type: 'POST',
        dataType: "html",
        data: datax,
        success: function(oData) {
            // loadaj opet komentare iz ajaxa
        },
        error: function(XMLHttpRequest, textStatus, exception) {
            console.log("Ajax failure\n");
        },
        async: true
    });
}