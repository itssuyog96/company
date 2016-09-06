/**
 * Created by itssu on 06-Aug-16.
 */
$(document).ready(function(){

    var divCloneP = $('project-modal-div').clone(true, true);

    getProjectList(true);
    
    $('#addAssetForm').validate({


    });

    $('.asset-modal').on('click', '.btn-default', function(e){
        e.preventDefault();
        console.log('Submit clicked!');

        if($('#addAssetForm').validate().form()){
            $.ajax({
                url: 'js/artist_asset_entry.php',
                data: $('#addAssetForm').serialize(),
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