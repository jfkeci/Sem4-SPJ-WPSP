function GetModal(sHref) {
        $('#modals').removeData('bs.modal');
        $('#modals').modal
            ({
                remote:sHref,
                show: true
            });
    }

function GetData(caseString){
    var oList=new Array();
    $.ajax(
        {
            url:'json.php?json_id='+caseString+'',
            type:'GET',
            async: false,
            success:function (oData)
            {
                oList = oData;
            }
        });
        return oList;
};

function GetStudentRoom(studJmbag){
    var roomData=GetData('get_room_data');
    var roomID;
    for(var i=0; i<roomData.length; i++){
        if(roomData[i].student==studJmbag){
            roomID=roomData[i].soba;
        }
    }  
    return roomID;
}

function LogIn() {
    $.ajax({
        url: 'login.php',
        type: 'POST',
        dataType: "html",
        data: {
            username: $('#inptUsername').val(),
            password: $('#inptPassword').val()
        },
        success: function(oData) {
            $("#modals").modal('hide');
        },
        error: function(XMLHttpRequest, textStatus, exception) {
            console.log("Ajax failure\n");
        },
        async: true
    });
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