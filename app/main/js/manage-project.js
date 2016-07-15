
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
                            { "data": "CLOSEDT" }
                 ]
    } );

});


/*
$.fn.loadAllProjects = function(){
    $.get("getProjects.php", function(data){
        $("#projectList").tablesorter();
        $("#projectList tbody").html(data);
        $("#projectList").trigger("update");
        $("#projectList").tablesorter();
    });
}*/
