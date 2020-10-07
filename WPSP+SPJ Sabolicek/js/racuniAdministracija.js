$(document).ready(function() {
    SwitchTabs('racuni_placeni');
    LoadReciepts();

    $("#search1").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#placeniData tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $("#search2").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#neplaceniData tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

function SwitchTabs(tabs) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabs).style.display = "block";
}

function LoadReciepts() {
    $.ajax({
        url: 'json.php?json_id=get_payed_reciepts',
        type: 'GET',
        success: function(oRacuni) {
            oRacuni = JSON.parse(oRacuni);
            $('#placeni tbody').empty();
            for (var i = 0; i < oRacuni.length; i++) {
                var sTr = '<tr class="datarow' + i + '">' +
                    '<td>' + (i + 1) + '</td>' +
                    '<td>' + oRacuni[i].broj_racuna + '</td>' +
                    '<td>' + oRacuni[i].soba_id + '</td>' +
                    '<td>' + oRacuni[i].datum_vrijeme + '</td>' +
                    '<td>' + oRacuni[i].svota_racuna + '</td>' +
                    '<td>' + oRacuni[i].placeno + '</td>' +
                    '<td>'+oRacuni[i].student_id+'<span style="margin-left:10px;"class="glyphicon glyphicon-search" onclick="GetModal(\'modals.php?modal_id=show_student&sid=' + oRacuni[i].student_id + '\')" aria-hidden="true"></span></td>' +
                    '<td><span class="glyphicon glyphicon-log-out" onclick="GetModal(\'modals.php?modal_id=student_out_of_room&sid=' + oRacuni[i].student_id + '\')" aria-hidden="true"></span></td>' +
                    '</tr>';
                $('#placeni tbody').append(sTr);
            }
        }
    })
    $.ajax({
        url: 'json.php?json_id=get_unpayed_reciepts',
        type: 'GET',
        success: function(oRacuni) {
            oRacuni = JSON.parse(oRacuni);
            $('#neplaceni tbody').empty();
            for (var i = 0; i < oRacuni.length; i++) {
                var sTr = '<tr class="datarow' + i + '">' +
                    '<td>' + (i + 1) + '</td>' +
                    '<td>' + oRacuni[i].broj_racuna + '</td>' +
                    '<td>' + oRacuni[i].soba_id + '</td>' +
                    '<td>' + oRacuni[i].datum_vrijeme + '</td>' +
                    '<td>' + oRacuni[i].svota_racuna + '</td>' +
                    '<td>' + oRacuni[i].placeno + '</td>' +
                    '<td>'+oRacuni[i].student_id+'<span style="margin-left:10px;"class="glyphicon glyphicon-search" onclick="GetModal(\'modals.php?modal_id=show_student&sid=' + oRacuni[i].student_id + '\')" aria-hidden="true"></span></td>' +
                    '<td><span class="glyphicon glyphicon-log-out" onclick="GetModal(\'modals.php?modal_id=student_out_of_room&sid=' + oRacuni[i].student_id + '\')" aria-hidden="true"></span></td>' +
                    '<td><button type="button" class="btn btn-primary" onclick="GetModal(\'modals.php?modal_id=update_reciept&reciept_number=' + oRacuni[i].broj_racuna + '\')">Ažuriraj</button></td>' +
                    '</tr>';
                $('#neplaceni tbody').append(sTr);
            }
        }
    })
};

function UpdateReciept(brojRacuna){
    var sPlaceno='DA';
    $.ajax({
        url: 'action.php',
        type: 'POST',
        dataType: "html",
        data: {
            action_id: 'update_reciept',
            broj_racuna: brojRacuna,
            placeno: sPlaceno
        },
        success: function(oData) {
            $("#modals").modal('hide');
            LoadReciepts();
        },
        error: function(XMLHttpRequest, textStatus, exception) {
            console.log("Ajax failure\n");
        },
        async: true
    });
}
function IzdajRacune(){
    $.ajax({
        url: 'action.php',
        type: 'POST',
        dataType: "html",
        data: {
            action_id: 'issue_reciepts'
        },
        success: function(oData) {
            $("#modals").modal('hide');
            LoadReciepts();
        },
        error: function(XMLHttpRequest, textStatus, exception) {
            console.log("Ajax failure\n");
        },
        async: true
    });
}