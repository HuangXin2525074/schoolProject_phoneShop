/**
 * Created by User on 5/7/2019.
 */



var deleteViewToggle;
var addViewToggle;

$('#RelatedMain-mbb-add').click(function(event){

   var isAdmin= $('#isAdmin').val();

    var cat = $(this).attr("id") == "RelatedMain-mbb-add" ? $("#main-cat option:selected").val() : $("#Relatedmain-cat option:selected").val();




   if(cat=="Admin")
   {
       addUserMode();
   }
   if(cat=="All Device")
   {
       addAllDeviceMode();
   }





});

$('#Main-mbb-delete_all').click(function(){

    var cat = $(this).attr("id") == "Main-mbb-delete_all" ? $("#main-cat option:selected").val() : $("#Relatedmain-cat option:selected").val();
    deleteViewToggle = $(this).attr("id") == "Main-mbb-delete_all" ? "main" : "view";

    if(cat == "Admin"){
        deleteUser();
    }

    if(cat=="All Device")
    {
        deleteItem();
    }






});



