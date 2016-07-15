function getProjectType(req){

    $.ajax(
        {
            url:'js/getProjectType.php',
            success: function(data){

                if(req){
                    $("#ptype option").remove(); // Remove all <option> child tags.
                    console.log("Data: "+data);

                    $.each(JSON.parse(data), function(index, item) { // Iterates through a collection
                        console.log("Item : "+item);
                        $("#ptype").append( // Append an object to the inside of the select box
                            $("<option></option>").text(item[1]).val(item[0])	);
                    });
                }
  
            }
        });
    
    
}