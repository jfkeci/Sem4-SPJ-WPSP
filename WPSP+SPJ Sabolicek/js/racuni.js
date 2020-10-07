$(document).ready(function() {
    SwitchTabs('racuni_placeni');
    LoadReciepts();
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
        url: 'json.php?json_id=get_student_payed_reciepts',
        type: 'GET',
        success: function(oRacuni) {
            /* oRacuni = JSON.parse(oRacuni);
            $('#placeni tbody').empty();
            for (var i = 0; i < oRacuni.length; i++) {
                var sTr = '<tr class="datarow' + i + '">' +
                    '<td>' + (i + 1) + '</td>' +
                    '<td>' + oRacuni[i].broj_racuna + '</td>' +
                    '<td>' + oRacuni[i].soba_id + '</td>' +
                    '<td>' + oRacuni[i].svota_racuna + '</td>' +
                    '<td>' + oRacuni[i].datum_vrijeme + '</td>' +
                    '<td>' + oRacuni[i].placeno + '</td>' +
                    '</tr>';
                $('#placeni tbody').append(sTr);
            } */
        }
    })
    $.ajax({
        url: 'json.php?json_id=get_student_unpayed_reciepts',
        type: 'GET',
        success: function(oRacuni) {
            oRacuni = JSON.parse(oRacuni);
            $('#neplaceni tbody').empty();
            for (var i = 0; i < oRacuni.length; i++) {
                var sTr = '<tr class="datarow' + i + '">' +
                    '<td>' + (i + 1) + '</td>' +
                    '<td>' + oRacuni[i].broj_racuna + '</td>' +
                    '<td>' + oRacuni[i].soba_id + '</td>' +
                    '<td>' + oRacuni[i].svota_racuna + '</td>' +
                    '<td>' + oRacuni[i].datum_vrijeme + '</td>' +
                    '<td>' + oRacuni[i].placeno + '</td>' +
                    '</tr>';
                $('#neplaceni tbody').append(sTr);
            }
        }
    })
};

var oApp = angular.module("MyApp", []);


oApp.controller("placeniRacuni", function($scope,$http){
	$scope.oData=[];
	$http({
		method: "GET",
		url: "display.php"
	}).then(function(response){
		$scope.oData = response.data;
	}, function(response){
		console.log("Pogreska");
    });
    
});
