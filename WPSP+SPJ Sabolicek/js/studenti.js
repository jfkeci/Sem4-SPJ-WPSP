$(document).ready(function() {
    LoadStudents();

    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tableStudents tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
var oStudenti=[];
function LoadStudents() {
    $.ajax({
        url: 'json.php?json_id=get_all_students',
        type: 'GET',
        success: function(oData) {
            oStudenti=[];
            oData=JSON.parse(oData);
            $('.table tbody').empty(); 
            for (var i = 0; i < oData.length; i++) {
                oStudenti.push(oData[i]);
                var sTr = '<tr>' +
                    '<td>' + (i + 1) + '</td>' +
                    '<td>' + oData[i].ime + '</td>' +
                    '<td>' + oData[i].prezime + '</td>' +
                    '<td>' + oData[i].jmbag + '</td>' +
                    '<td>' + oData[i].adresa + '</td>' +
                    '<td>' + oData[i].postanski_broj + '</td>' +
                    '<td>' + oData[i].grad + '</td>' +
                    '<td>' + oData[i].smjer + '</td>' +
                    '<td>' + oData[i].godina_studiranja + '</td>' +
                    '<td>' + oData[i].ostvareno_ects + '</td>' +
                    '<td>' + oData[i].prosjek_ocjena + '</td>' +
                    '<td><span class="glyphicon glyphicon-pencil" onclick="GetModal(\'modals.php?modal_id=edit_student&sid=' + oData[i].osoba_id + '\')" aria-hidden="true"></span></td>' +
                    '<td><span class="glyphicon glyphicon-trash" onclick="GetModal(\'modals.php?modal_id=delete_student&sid=' + oData[i].osoba_id + '\')" aria-hidden="true"></span></td>' +
                    '</tr>';
                $('.table tbody').append(sTr);
            }
        }
    })
};
function DeleteStudent(studID) {
    $.ajax({
        url: 'action.php',
        type: 'POST',
        dataType: "html",
        data: {
            action_id: 'delete_student',
            id: studID
        },
        success: function(oData) {
            $("#modals").modal('hide');
            LoadStudents();
        },
        error: function(XMLHttpRequest, textStatus, exception) {
            console.log("Ajax failure\n");
        },
        async: true
    });
}

function SaveNewStudent() {
    $.ajax({
        url: 'action.php',
        type: 'POST',
        dataType: "html",
        data: {
            action_id: 'add_new_student',
            ime: $('#inptIme').val(),
            prezime: $('#inptPrezime').val(),
            jmbag: $('#inptJmbag').val(),
            korisnicko_ime: $('#inptUsername').val(),
            zaporka: $('#inptPassword').val(),
            adresa: $('#inptAdresa').val(),
            postanski_broj: $('#inptPB').val(),
            grad: $('#inptGrad').val(),
            smjer: $('#inptSmjer').val(),
            godina_studiranja: $('#inptGodina').val(),
            ostvareno_ects: $('#inptECTS').val(),
            prosjek_ocjena: $('#inptProsjek').val()
        },
        success: function(oData) {
            $("#modals").modal('hide');
            LoadStudents();
        },
        error: function(XMLHttpRequest, textStatus, exception) {
            console.log("Ajax failure\n");
        },
        async: true
    });
}

function EditStudent(studId) {
    $.ajax({
        url: 'action.php',
        type: 'POST',
        dataType: "html",
        data: {
            action_id: 'edit_student',
            id: studId,
            ime: $('#inptIme').val(),
            prezime: $('#inptPrezime').val(),
            jmbag: $('#inptJmbag').val(),
            korisnicko_ime: $('#inptUsername').val(),
            zaporka: $('#inptPassword').val(),
            adresa: $('#inptAdresa').val(),
            postanski_broj: $('#inptPB').val(),
            grad: $('#inptGrad').val(),
            smjer: $('#inptSmjer').val(),
            godina_studiranja: $('#inptGodina').val(),
            ostvareno_ects: $('#inptECTS').val(),
            prosjek_ocjena: $('#inptProsjek').val()
        },
        success: function(oData) {
            $("#modals").modal('hide');
            LoadStudents();
        },
        error: function(XMLHttpRequest, textStatus, exception) {
            console.log("Ajax failure\n");
        },
        async: true
    });
}
