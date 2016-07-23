/**
 * Created by itssu on 23-Jul-16.
 */

function getProjectList(req){

    $.ajax(
        {
            url:'js/getProjectList.php',
            success: function(data){

                if(req){
                    $("#project option").remove(); // Remove all <option> child tags.
                    console.log("Data: "+data);

                    $.each(JSON.parse(data), function(index, item) { // Iterates through a collection
                        console.log("Item - Value: "+item.PRJCTID+" Text: "+item.PRJCTNM);
                        $("#project").append( // Append an object to the inside of the select box
                            $("<option></option>").text(item.PRJCTNM).val(item.PRJCTID)	);
                    });
                }
                else
                {

                    xn = data;
                    console.log("Project List(in): "+xn);
                }


            }
        });

}