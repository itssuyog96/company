/**
 * Created by itssu on 17-Jul-16.
 */
function addRow(r) {
    var x = [];
    var y = 0;
    var m = [];
    var n = 0;
    var root = r.parentNode;//the root 
    var allRows = root.getElementsByTagName('tr');//the rows' collection
    var cRow = allRows[0].cloneNode(true);//the clone of the 1st row
    var cInp = cRow.getElementsByTagName('input');//the inputs' collection of the 1st row 
    for (var i = 0; i < cInp.length-1; i++) {//changes the inputs' names (indexes the names)
        cInp[i].setAttribute('name', cInp[i].getAttribute('name') + '_' + (allRows.length));
        cInp[i].setAttribute('id', cInp[i].getAttribute('id') + '_' + (allRows.length));



        if(i==0){
            cInp[i].setAttribute('value', allRows.length + 1);
        }

        if(i == 1 || i == 2 || i==3){
            x[y++] = cInp[i].getAttribute('id');
        }
        if(i>3 && i<=10){
            m[n++] = cInp[i].getAttribute('id');

        }
    }
    var cSel = cRow.getElementsByTagName('select')[0];
    cSel.setAttribute('name', cSel.getAttribute('name') + '_' + (allRows.length));//change the selecet's name
    cSel.setAttribute('id', cSel.getAttribute('id') + '_' + (allRows.length));//change the selecet's name



    $('#formSize').val(allRows.length + 1);
    root.appendChild(cRow);//appends the cloned row as a new row

    for(i = 0; i < y; i++){
        $('#'+x[i]).val('');
        addRequired('#'+x[i]);

    }

    for(i = 0; i < n; i++){
        $('#'+m[i]).val('');
        addRequired('#'+m[i]);
        addNumberedRange('#'+m[i]);
    }

    $('#submitType').val('bulk');
}

function changedisabled(id, num, status){
    if(status == true){
        if(num != ''){
            document.getElementById(id+'_'+num).setAttribute('disabled',status);
        }
        else{
            document.getElementById(id).setAttribute('disabled',status);
        }
    }
    else{
        if(num != ''){
            document.getElementById(id+'_'+num).removeAttribute('disabled');

        }
        else{
            document.getElementById(id).removeAttribute('disabled');

        }
    }
}

function removeAllDisableAttr(num){
    changedisabled('rigging',num, false);
    changedisabled('modelling',num, false);
    changedisabled('matte_painting',num, false);
    changedisabled('lookdev',num, false);
    changedisabled('modelling',num, false);
    changedisabled('foliage',num, false);
    changedisabled('hair_fur',num, false);
    changedisabled('surfacing',num, false);

}


function changetextbox(id)
{
    var num = id.replace(/^\D+/g, "");

    removeAllDisableAttr(num);
    switch(document.getElementById(id).value){
        case "SET":
            changedisabled('hair_fur',num, true);
            break;
        case "PROP":
            changedisabled('foliage',num, true);
            changedisabled('matte_painting',num, true);
            break;
        case "CHARACTER":
            changedisabled('foliage',num, true);
            changedisabled('matte_painting',num, true);
            break;
    }

}


function validatorRules(){
    addRequired('#asset_name');
    addRequired('#asset_code');
    addRequired('#modelling');
    addNumberedRange('#modelling');
    addRequired('#surfacing');
    addNumberedRange('#surfacing');
    addRequired('#rigging');
    addNumberedRange('#rigging');
    addRequired('#hair_fur');
    addNumberedRange('#hair_fur');
    addRequired('#lookdev');
    addNumberedRange('#lookdev');
    addRequired('#foliage');
    addNumberedRange('#foliage');
    addRequired('#matte_painting');
    addNumberedRange('#matte_painting');

}




function addNumberedRange(id){
    $(id).rules('add', {
        range : [0, 10000],
        messages: {
            required: 'Required'
        }
    });
}

function addRequired(id){
    $(id).rules('add',{
        required: true,
        messages: {
            required: 'Required'
        }
    });
}



$(document).ready(function(){

    getProjectList(true);
    
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
                $('#pid').val(dx[0].PRJCTID);
                $('#asset_entry_row').css("display", "block");
            },
        
            error: function(error){
                console.log(error);
                $('#selectError').text(error);
                $('#showSelectError').css("display", "block");
            }
        
        });
    });


    $('#bulk_asset_form').validate({

    });

    validatorRules();


    $(".bulk_asset_entry").on('click', '.btn-default', function(e) {
        e.preventDefault();
        console.log("Submit clicked!");



        if($('#bulk_asset_form').validate().form()){
            $.ajax({
                url: 'js/process_bulk_entry.php',
                data: $('#bulk_asset_form').serialize(),
                type: 'POST',
                success: function(data){
                    var dx = JSON.parse(data);
                    console.log("Message "+dx);
                    $.fn.showToast(dx.error.msg, dx.error.title, dx.error.type);
                    console.log("Form submitted successfully!");
                },
                error: function(data){
                    var dx = JSON.parse(data);
                    console.log("Message "+dx);
                    $.fn.showToast(dx.error.msg, dx.error.title, dx.error.type);
                }
            });
        }


    });

});

