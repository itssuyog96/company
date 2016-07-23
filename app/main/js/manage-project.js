
$('document').ready(function() {

    var divCloneP;
    var divClonePT;
    console.log('Document ready!');
    //$.fn.loadAllProjects();

    divCloneP = $('project-modal-div').clone(true, true);
    divClonePT = $('project-type-modal-div').clone(true, true);

    $("#openModalAP").on('click', function(e){

        getProjectType(true);

    });

    $(".project-modal").on('click', '.btn-toolbar', function(e) {
        e.preventDefault();
        console.log('New Project Type Add button clicked!');
    });

    $(".project-type-modal").on('click', '.btn-default', function(e) {
        e.preventDefault();
        console.log("Submit clicked");

        $('#addProjectTypeForm').validate({


            rules: {
                ptype: {
                    required : true
                }

            },


            messages: {
                ptype: {
                    required : 'Please enter Project Type to add'
                }

            }


        });





        console.log("Submitting Form");
        if($('#addProjectTypeForm').validate().form())
        {
            console.log("Form is valid");
            var proType = $('#ptype_new').val();
            $.ajax({
                url: '../../scripts/Forms/processForm.php',
                type: 'POST',
                data: $('#addProjectTypeForm').serialize(),
                success: function(data) {

                    //$('#status').html(data);
                    console.log(data);
                    var dx = JSON.parse(data);
                    console.log("Message "+dx);
                    $.fn.showToast(dx.error.msg, dx.error.title, dx.error.type);
                    console.log("Form submitted successfully!");
                    document.getElementById("close-modal").click();
                    getProjectType(true);
                    $('#ptype').val(proType);
                },
                error: function(data) {

                    //$('#status').html(data);
                    console.log('Error'+data);
                    var dx = JSON.parse(data);
                    console.log("Message "+dx);
                    $.fn.showToast(dx.error.msg, dx.error.title, dx.error.type);
                    console.log("Error occured while submitting form!");
                    getProjectType(true);
                    $('#ptype').val(proType);
                }
            });

        }
        else{
            console.log("Form is invalid");
        }

        return false;

    });



    $(".project-modal").on('click', '.btn-default', function(e) {
        e.preventDefault();
        console.log("Submit clicked");

        $('#addProjectForm').validate({


            rules: {
                pid: {
                    required: true

                },

                ptype: {
                    required: true
                },

                pnm: {
                    required: true

                },

                opendt: {
                    required: true
                },
                closedt: {
                    required: true
                },

            },


            messages: {
                pid: {
                    required: "Please enter Project ID"
                },

                ptype: {
                    required: "Please select/enter Project Type"
                },

                pnm: {
                    required: "Please enter Project Name"
                },
                opendt: {
                    required: "Please enter Project Open Date"
                },
                closedt: {
                    required: "Please enter Project Close Date"
                }

            }


        });





        console.log("Submitting Form");
        if($('#addProjectForm').validate().form())
        {
            console.log("Form is valid");

            $.ajax({
                url: '../../scripts/Forms/processForm.php',
                type: 'POST',
                data: $('#addProjectForm').serialize(),
                success: function(data) {

                    //$('#status').html(data);
                    console.log(data);
                    var dx = JSON.parse(data);
                    console.log("Message "+dx);
                    $.fn.showToast(dx.error.msg, dx.error.title, dx.error.type);
                    console.log("Form submitted successfully!");
                    document.getElementById("close-modal").click();
                },
                error: function(data) {

                    //$('#status').html(data);
                    console.log('Error'+data);
                    var dx = JSON.parse(data);
                    console.log("Message "+dx);
                    $.fn.showToast(dx.error.msg, dx.error.title, dx.error.type);
                    console.log("Error occured while submitting form!");
                }
            });

        }
        else{
            console.log("Form is invalid");
        }

        return false;

    });



    $('#addProject').on('hidden.bs.modal', function() {
        console.log("Modal Closed");

        $('#project-modal-div').replaceWith(divCloneP.clone(true, true));

        //$.fn.loadAllProjects();

    });

    $('#addProjectType').on('hidden.bs.modal', function() {
        console.log("Modal Closed");
        getProjectType(true);
        $('#project-type-modal-div').replaceWith(divClonePT.clone(true, true));


        //$.fn.loadAllProjects();

    });

    $('#project_table').DataTable( {
        ajax: 'js/getProjectData.php',
        columns: [
            { "data": "PRJCTID" },
            { "data": "PRJCTTYPE" },
            { "data": "PRJCTNM" },
            { "data": "PRJCTDESCRI" },
            { "data": "OPENDT" },
            { "data": "CLOSEDT" },
            { "data": function (data) {

                var arr = Object.keys(data).map(function(k) { return data[k] });
                var x = encodeMe(JSON.stringify(arr));
                var y = "'"+x+"'";

                return '<a href="javascript:editProject('+y+')">Edit</a>';
            }

            }
        ]
    } );

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



function editProject(id){

    console.log(id);
    var x = decodeMe(id);
    console.log('Project Editor Opened:'+x);
    y = JSON.parse(x);

    $('#pid').val(y[0]);
    var l = y[1];
    $('#pnm').val(y[2]);
    $('#pdesc').val(y[3]);
    $('#opendt').val(y[4]);
    $('#closedt').val(y[5]);

    document.getElementById('openModalAP').click();

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
