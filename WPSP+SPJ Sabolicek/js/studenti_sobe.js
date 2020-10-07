$(document).ready(function() {
    SwitchTabs('studenti_sobe');
    LoadAll();

    $("#search1").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#studentiSaSobama tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $("#search2").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#studentiBezSoba tr").filter(function() {
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

function LoadAll() {
    $.ajax({
        url: 'json.php?json_id=get_students_with_room',
        type: 'GET',
        success: function(oStudenti) {
            oStudenti = JSON.parse(oStudenti);
            $('#saSobama tbody').empty();
            for (var i = 0; i < oStudenti.length; i++) {
                var sTr = '<tr class="datarow' + i + '">' +
                    '<td>' + (i + 1) + '</td>' +
                    '<td>' + oStudenti[i].ime + '</td>' +
                    '<td>' + oStudenti[i].prezime + '</td>' +
                    '<td>' + oStudenti[i].jmbag + '</td>' +
                    '<td>' + oStudenti[i].adresa + '</td>' +
                    '<td>' + oStudenti[i].postanski_broj + '</td>' +
                    '<td>' + oStudenti[i].grad + '</td>' +
                    '<td>' + oStudenti[i].smjer + '</td>' +
                    '<td>' + oStudenti[i].godina_studiranja + '</td>' +
                    '<td>' + oStudenti[i].ostvareno_ects + '</td>' +
                    '<td>' + oStudenti[i].prosjek_ocjena + '</td>' +
                    '<td>' + oStudenti[i].student_korisnicko_ime + '<span class="glyphicon glyphicon-search" onclick="GetModal(\'modals.php?modal_id=show_students_room&room_id=' + oStudenti[i].student_korisnicko_ime + '\')" aria-hidden="true"></span></td>' +
                    '<td><span class="glyphicon glyphicon-random" onclick="GetModal(\'modals.php?modal_id=student_to_from_room&sid=' + oStudenti[i].jmbag + '\')" aria-hidden="true"></span></td>' +
                    '<td><span class="glyphicon glyphicon-log-out" onclick="GetModal(\'modals.php?modal_id=student_out_of_room&sid=' + oStudenti[i].jmbag + '\')" aria-hidden="true"></span></td>' +
                    '</tr>';
                $('#saSobama tbody').append(sTr);
            }
        }
    })
    $.ajax({
        url: 'json.php?json_id=get_students_without_room',
        type: 'GET',
        success: function(oStudenti) {
            oStudenti = JSON.parse(oStudenti);
            $('#listaCekanja tbody').empty();
            for (var i = 0; i < oStudenti.length; i++) {
                var sTr = '<tr class="datarow' + i + '">' +
                    '<td>' + (i + 1) + '</td>' +
                    '<td>' + oStudenti[i].ime + '</td>' +
                    '<td>' + oStudenti[i].prezime + '</td>' +
                    '<td>' + oStudenti[i].jmbag + '</td>' +
                    '<td>' + oStudenti[i].adresa + '</td>' +
                    '<td>' + oStudenti[i].postanski_broj + '</td>' +
                    '<td>' + oStudenti[i].grad + '</td>' +
                    '<td>' + oStudenti[i].smjer + '</td>' +
                    '<td>' + oStudenti[i].godina_studiranja + '</td>' +
                    '<td>' + oStudenti[i].ostvareno_ects + '</td>' +
                    '<td>' + oStudenti[i].prosjek_ocjena + '</td>' +
                    '<td><span class="glyphicon glyphicon-log-in" onclick="GetModal(\'modals.php?modal_id=student_to_room&sid=' + oStudenti[i].jmbag + '\')" aria-hidden="true"></span></td>' +
                    '</tr>';
                $('#listaCekanja tbody').append(sTr);
            }
        }
    })
};

function ExpelStudent(studID){
    $.ajax({
        url: 'action.php',
        type: 'POST',
        dataType: "html",
        data: {
            action_id: 'remove_from_room',
            student_jmbag: studID
        },
        success: function(oData) {
            $("#modals").modal('hide');
            LoadAll();
        },
        error: function(XMLHttpRequest, textStatus, exception) {
            console.log("Ajax failure\n");
        },
        async: true
    });
}
function StudentToRoom(studID, sobaID){
    $.ajax({
        url: 'action.php',
        type: 'POST',
        dataType: "html",
        data: {
            action_id: 'student_to_room',
            soba_id: sobaID,
            student_jmbag: studID
        },
        success: function(oData) {
            $("#modals").modal('hide');
            LoadAll();
        },
        error: function(XMLHttpRequest, textStatus, exception) {
            console.log("Ajax failure\n");
        },
        async: true
    });
}
function StudentToFromRoom(studID, sobaID){
    $.ajax({
        url: 'action.php',
        type: 'POST',
        dataType: "html",
        data: {
            action_id: 'student_to_from_room',
            soba_id: sobaID,
            student_jmbag: studID
        },
        success: function(oData) {
            $("#modals").modal('hide');
            LoadAll();
        },
        error: function(XMLHttpRequest, textStatus, exception) {
            console.log("Ajax failure\n");
        },
        async: true
    });
}