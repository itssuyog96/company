
$('document').ready(function() {


    console.log('Document ready!');

    getProjectList(true);

    var project_id = '';

    $('#artist_table').DataTable().destroy();

    $('#artist_table').DataTable( {
        ajax: {
            url: 'js/getArtistData.php',
            error: function(error){
                $('#artist_datatable_error_div').css('display', 'block');
                $('#artist_datatable_div').css('display', 'none');
            }

        },
        columns: [
            { "data": "EMPID" },
            { "data": "EMPFNM" },
            { "data": "SKILLS" },
            { "data": "ARTISTASSIGNBIDS" },
            { "data": function (data) {

                var arr = Object.keys(data).map(function(k) { return data[k] });
                var x = encodeMe(JSON.stringify(arr));
                var y = "'"+x+"'";

                return '<a href="javascript:addTask('+y+')"><button  data-toggle="modal" data-target="#addVersion" class="btn btn-primary btn-addon m-b-sm btn-xs"><i class="fa fa-plus"></i>ASSIGN</button></a>';
            }

            }
        ]

    } );

    $("#taskSelect").on('click', '.btn-assign', function(e){
        e.preventDefault();

        var table = $('#asset_table').DataTable();

        
        if(table.rows('.selected').data().length < 1){
            alert('No task selected!');
        }
        else{
            $('#qty').val(table.rows('.selected').data().length);
            var ids = $.map(table.rows('.selected').data(), function (item) {
                console.log(item);
                return item.ASSETCODE;
            });

            $('#selected').val(ids);
            
            $.ajax({
               url: 'js/assign_tasks.php',
                type: 'POST',
                data: $('#submitAssignment').serialize(),
                success: function(data){
                    //close modal
                    //run toast
                },
                error: function(data){
                    //run toast
                }
            });
        }

        


    });



    $(".ProjectSelect").on('click', '.btn-default', function(e){
        e.preventDefault();
        console.log("Project Select Submit");
        
        $.ajax({
            url: "js/validateProject.php",
            type: "POST",
            data: $('#selectProj').serialize(),
            success: function(data){
                console.log(data);
                dx = JSON.parse(data);
                $('#project_id').text(dx[0].PRJCTID);
                $('#project_name').text(dx[0].PRJCTNM);
                $('#project_desc').text(dx[0].PRJCTDESCRI);
                project_id = dx[0].PRJCTID;

                $('#asset_datatable_error_div').css('display', 'none');
                $('#asset_datatable_div').css('display', 'block');

                $('#asset_table').DataTable().destroy();

                $('#asset_table tbody').on( 'click', 'tr', function () {
                    $(this).toggleClass('selected');
                } );

                $('#asset_table').DataTable( {
                    ajax: {
                        url: 'js/getAssetData.php?id='+project_id,
                        type: 'GET',
                        error: function(error){
                           $('#asset_datatable_error_div').css('display', 'block');
                           $('#asset_datatable_div').css('display', 'none');
                        }

                    },
                    columns: [
                        { "data": "ASSETCODE" },
                        { "data": "ASSETTYPE" },
                        { "data": "ASSETNM" }
                    ]

                } );

                $('#asset_entry_row').css("display", "block");
            },

            error: function(error){
                console.log(error);
                $('#selectError').text(error);
                $('#showSelectError').css("display", "block");
            }

        });
    });



});



var Base64 = {


    _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",


    encode: function(input) {
        var output = "";
        var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
        var i = 0;

        input = Base64._utf8_encode(input);

        while (i < input.length) {

            chr1 = input.charCodeAt(i++);
            chr2 = input.charCodeAt(i++);
            chr3 = input.charCodeAt(i++);

            enc1 = chr1 >> 2;
            enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
            enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
            enc4 = chr3 & 63;

            if (isNaN(chr2)) {
                enc3 = enc4 = 64;
            } else if (isNaN(chr3)) {
                enc4 = 64;
            }

            output = output + this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) + this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

        }

        return output;
    },


    decode: function(input) {
        var output = "";
        var chr1, chr2, chr3;
        var enc1, enc2, enc3, enc4;
        var i = 0;

        input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

        while (i < input.length) {

            enc1 = this._keyStr.indexOf(input.charAt(i++));
            enc2 = this._keyStr.indexOf(input.charAt(i++));
            enc3 = this._keyStr.indexOf(input.charAt(i++));
            enc4 = this._keyStr.indexOf(input.charAt(i++));

            chr1 = (enc1 << 2) | (enc2 >> 4);
            chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
            chr3 = ((enc3 & 3) << 6) | enc4;

            output = output + String.fromCharCode(chr1);

            if (enc3 != 64) {
                output = output + String.fromCharCode(chr2);
            }
            if (enc4 != 64) {
                output = output + String.fromCharCode(chr3);
            }

        }

        output = Base64._utf8_decode(output);

        return output;

    },

    _utf8_encode: function(string) {
        string = string.replace(/\r\n/g, "\n");
        var utftext = "";

        for (var n = 0; n < string.length; n++) {

            var c = string.charCodeAt(n);

            if (c < 128) {
                utftext += String.fromCharCode(c);
            }
            else if ((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            }
            else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }

        }

        return utftext;
    },

    _utf8_decode: function(utftext) {
        var string = "";
        var i = 0;
        var c = c1 = c2 = 0;

        while (i < utftext.length) {

            c = utftext.charCodeAt(i);

            if (c < 128) {
                string += String.fromCharCode(c);
                i++;
            }
            else if ((c > 191) && (c < 224)) {
                c2 = utftext.charCodeAt(i + 1);
                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                i += 2;
            }
            else {
                c2 = utftext.charCodeAt(i + 1);
                c3 = utftext.charCodeAt(i + 2);
                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }

        }

        return string;
    }

}



function addTask(id){

    console.log(id);
    var x = decodeMe(id);
    console.log('Task Assigner Opened:'+x);
    var y = JSON.parse(x);

    $('#artist_id').text(y[0]);
    $('#artist_name').text(y[1]);
    $('#artist_skills').text(y[2]);
    $('#aid').val(y[0]);


}

function encodeMe(val){
    return Base64.encode(val);
}

function decodeMe(val){
    return Base64.decode(val);
}

/*
 $.fn.loadAllProjects = function(){
 $.get("getProjects.php", function(data){
 $("#projectList").tablesorter();
 $("#projectList tbody").html(data);
 $("#projectList").trigger("update");
 $("#projectList").tablesorter();
 });
 }*/
