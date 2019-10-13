/**
 * Created by User on 7/7/2019.
 */


function showItemTable()
{
    Username=$('#Username').val();
    var isAdmin=$('#isAdmin').val();


    var actionbtn = function(cell, formatterParams){ //plain text value
        if(isAdmin=="1") {
            return '<select id="action_' + cell.getRow().getData().ItemID.replace(/\s/g, '_') + '" class="action" onchange="Itemaction(\'action_' + cell.getRow().getData().ItemID.replace(/\s/g, '_') + '\',\'' + cell.getRow().getData().ItemID + '\')" name="' + cell.getRow().getData().ItemID + '"><option value="">Select</option><optgroup label="Standard Actions"><option value="view"><i class="fa fa-eye"></i>View</option><option value="edit"><i class="fa fa-edit"></i>Edit</option></optgroup></select>';
        }
        else
        {
            return '<select id="action_' + cell.getRow().getData().ItemID.replace(/\s/g, '_') + '" class="action" onchange="Itemaction(\'action_' + cell.getRow().getData().ItemID.replace(/\s/g, '_') + '\',\'' + cell.getRow().getData().ItemID + '\')" name="' + cell.getRow().getData().ItemID + '"><option value="">Select</option><optgroup label="Standard Actions"><option value="view"><i class="fa fa-eye"></i>View</option></optgroup></select>';
        }
    };

    ItemTable = new Tabulator("#Main-mbb-table", {
        layout:"fitDataFill",
        tooltips:true,
        addRowPos:"top",
        history:false,
        height: "630px",
        pagination:"local",
        paginationSize:10,
        movableColumns:true,
        resizableRows:true,
        selectable:true,
        initialSort:[
            {column:"ItemID", dir:"asc"},
        ],
        columns:[
            {title:"Actions",formatter:actionbtn, align:"center", headerSort:false, frozen:true},
            {
                title:"Phone Information",
                columns:[
                    {title:"Item ID", field:"ItemID",align:"center", sorter:"number"},
                    {title:"Item Name", field:"ItemName",  align:"center"},
                    {title:"Color", field:"Color",  align:"center"},
                    {title:"Capacity", field:"Capacity", align:"center"},
                    {title:"Display", field:"Display", align:"center"},
                    {title:"Chip", field:"Chip", align:"center"},
                    {title:"Camera", field:"Camera", align:"center"},
                    {title:"Store", field:"Store", align:"center"},
                    {title:"Price", field:"Price", align:"center",formatter:"money", formatterParams:{symbol:"$"}},
                ],
            },

        ],
    });


    $.ajax({
        type: "post",
        url: api_url+'getAllItem.php',
        data:{Username:Username,isAdmin:isAdmin},
        dataType:'JSON',
        success: function(data){

            ItemTable.setData(data);
        }
    });

    $(window).resize(function(){
        ItemTable.redraw();
    });

    $("#Main-mbb-columns").on("change", function(){
        var column=$('#Main-mbb-columns').val();
        if (column==null) {
            ItemTable.clearFilter(true);
            return;
        }
        var input=$("#Main-mbb-controls input[name=name]").val();
        ItemTable.setFilter(column, "like", input);
        $("#Main-mbb-table-count").text(ItemTable.getDataCount());
    });
    $("#Main-mbb-controls input[name=name]").on("keyup", function(){
        var column=$('#Main-mbb-columns').val();
        if (column==null) {
            ItemTable.clearFilter(true);
            return;
        }
        ItemTable.setFilter(column, "like", $(this).val());
        $("#Main-mbb-table-count").text(ItemTable.getDataCount());
    });

    $("#Main-mbb-controls  button[name=add-row]").on("click", function(){
        ItemTable.addRow({});
    });


}

function addAllDeviceMode()
{
    $('#addItemModal').modal('toggle');
    $('#add_item_err').hide();
    $('#add_ItemName_errL').hide();
    $('#add_Color_err').hide();
    $('#add_Color_errL').hide();
    $('#add_Capacity_err').hide();
    $('#add_Capacity_errL').hide();
    $('#add_Display_err').hide();
    $('#add_Display_errL').hide();
    $('#add_Chip_err').hide();
    $('#add_Chip_errL').hide();
    $('#add_Camera_err').hide();
    $('#add_Camera_errL').hide();
    $('#add_Store_err').hide();
    $('#add_Store_errL').hide();
    $('#add_Price_amtVal').hide();
    $('#add_Price_amt_err').hide();
   $('#add_Price_amt_errL').hide();
   $('#add_ItemType_err').hide();
   $('#add_Itemtype_errL').hide();


}

$('#add_item_btn').click(function () {

    var ItemName=$('#add_ItemName').val();
    var Color=$('#add_Color').val();
    var Capacity=$('#add_Capacity').val();
    var Display=$('#add_Display').val();
    var Chip=$('#add_Chip').val();
    var Camera=$('#add_Camera').val();
    var Store=$('#add_Store').val();
    var Price=$('#add_Price_Amount').val();
    var ItemType=$('#add_ItemType').val();

    var validForm = 1;

    if(ItemName=="")
    {
        $('#add_item_err').show();
        $('#add_ItemName_errL').show();

        validForm = 0;
    }
    else
    {
        $('#add_item_err').hide();
        $('#add_ItemName_errL').hide();
    }
    if(ItemType=="")
    {
        $('#add_ItemType_err').show();
        $('#add_ItemType_errL').show();
        validForm = 0;
    }
    else
    {
        $('#add_ItemType_err').hide();
        $('#add_ItemType_errL').hide();
    }
    if(Color=="")
    {
        $('#add_Color_err').show();
        $('#add_Color_errL').show();
        validForm = 0;
    }
    else
    {
        $('#add_Color_err').hide();
        $('#add_Color_errL').hide();
    }
    if(Capacity=="")
    {
        $('#add_Capacity_err').show();
        $('#add_Capacity_errL').show();
        validForm = 0;
    }
    else
    {
        $('#add_Capacity_err').hide();
        $('#add_Capacity_errL').hide();
    }
    if(Display=="")
    {
        $('#add_Display_err').show();
        $('#add_Display_errL').show();
        validForm = 0;
    }
    else
    {
        $('#add_Display_err').hide();
        $('#add_Display_errL').hide();
    }
    if(Chip=="")
    {
        $('#add_Chip_err').show();
        $('#add_Chip_errL').show();
        validForm = 0;
    }
    else
    {
        $('#add_Chip_err').hide();
        $('#add_Chip_errL').hide();
    }
    if(Camera=="")
    {
        $('#add_Camera_err').show();
        $('#add_Camera_errL').show();
        validForm = 0;
    }
    else
    {
        $('#add_Camera_err').hide();
        $('#add_Camera_errL').hide();
    }
    if(Store=="")
    {
        $('#add_Store_err').show();
        $('#add_Store_errL').show();
        validForm = 0;
    }
    else
    {
        $('#add_Store_err').hide();
        $('#add_Store_errL').hide();
    }
    if(Price=="")
    {
        $('#add_Price_amtVal').hide();
        $('#add_Price_amt_err').show();
        $('#add_Price_amt_errL').show();
        validForm = 0;
    }
    else if (Price<=0)
    {
        $('#add_Price_amtVal').show();
        $('#add_Price_amt_err').hide();
        $('#add_Price_amt_errL').show();
        validForm = 0;
    }
    else
    {
        $('#add_Price_amtVal').hide();
        $('#add_Price_amt_err').hide();
        $('#add_Price_amt_errL').hide();
    }
    if (validForm ==1)
    {
        var form_data=new FormData();
        form_data.append('ItemName',ItemName);
        form_data.append('Color',Color);
        form_data.append('Capacity',Capacity);
        form_data.append('Display',Display);
        form_data.append('Chip',Chip);
        form_data.append('Camera',Camera);
        form_data.append('Store',Store);
        form_data.append('Price',Price);
        form_data.append('ItemType',ItemType);

        $.ajax({
            type: "post",
            url: api_url+'addItem.php',
            data:form_data ,
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){

                if(data.status==true)
                {
                    $('#addSuccessModal').modal('toggle');

                    showItemTable();
                }
                else if(data.status==false)
                {
                    $('#errorModalRet').modal('toggle');
                }
                $('#addItemModal').modal('toggle');
            }
        });




    }

});


function deleteItem(){
    deleteTable = deleteViewToggle == "main" ? ItemTable : RelatedItemTable;

    if (deleteTable.getSelectedData().length == 0){
        $('#DeleteNoneSelectedModal').modal('toggle');
    } else {
        $('#deleteItemModal').modal('toggle');
    }
}

$('#deleteItemBtn').click(function(){
    var selectedData = deleteTable.getSelectedData();
    var showSuccess = 1;

    for (var i =0 ; i < selectedData.length; i++){
        if (delItem(selectedData[i]['ItemID']) == false) showSuccess = 0;
    }
    $('#deleteItemModal').modal('toggle');
    if (showSuccess == 1) $('#deletionSuccessModal').modal('toggle');
    showItemTable();
});

function delItem(ItemID){
    var success = 1;
    $.ajax({
        type: "post",
        url: api_url+'deleteItem.php',
        data:{ItemID:ItemID},
        dataType:'JSON',
        async: false,
        error: function(jqXHR, textStatus, errorThrown ){
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        },
        success: function(data){
            if(data.status==true)
            {

            }
            else if(data.status==false)
            {
                alert("Failed to delete record with ItemID: " + ItemID);
                success = 0;
            }
        }
    });
    return success;
}

function Itemaction(id,ItemID)
{
    //
    var action=$("#"+id).val();
    if(action=="view")
    {
        viewItem(ItemID);
    }
    else if(action=='edit')
    {

        editItem(ItemID);
    }
    $("#"+id).val('');
}

function viewItem(ItemID)
{
    var isAdmin= $('#isAdmin').val();

    if(isAdmin==1|| isAdmin==0)
    {
        $('.NoShowItem').show();
        getViewModalDetails("Items", ItemID);
    }
    else
    {
        $('.NoShowItem').hide();
        getViewModalDetails("Items", ItemID);
    }
}

function editItem(ItemID)
{
    $('#editAccountItemModal').modal('toggle');

    $('#edit_ItemName_err').hide();
    $('#edit_ItemName_errL').hide();
    
    $('#edit_Color_err').hide();
    $('#edit_Color_errL').hide();
    $('#edit_Capacity_err').hide();
    $('#edit_Capacity_errL').hide();
    $('#edit_Display_err').hide();
    $('#edit_Display_errL').hide();
    $('#edit_Chip_err').hide();
    $('#edit_Chip_errL').hide();
    $('#edit_Camera_err').hide();
    $('#edit_Camera_errL').hide();
    $('#edit_Store_err').hide();
    $('#edit_Store_errL').hide();
    $('#edit_Store_antVal').hide();

    $('#edit_Price_amtVal').hide();
    $('#edit_Price_amt_err').hide();
    $('#edit-account-item-msg').hide();

    $('#edit_account_modal_title').show();
    $('#edit_account_modal_body').show();

    $('#edit_ItemType_err').hide();
    $('#edit_ItemType_errL').hide();

    $(document).ready(function() {
        $.ajax({
            type: "post",
            url: api_url+'getItem.php',
            data:{ItemID:ItemID},
            dataType:'JSON',
            success: function(data){
                if(data.status==true)
                {
                    var ItemID=data.response[0].ItemID;
                    var ItemName=data.response[0].ItemName;
                    var ItemType=data.response[0].ItemType;
                    var Color=data.response[0].Color;
                    var Capacity=data.response[0].Capacity;
                    var Display=data.response[0].Display;
                    var Chip=data.response[0].Chip;
                    var Camera=data.response[0].Camera;
                    var Store=data.response[0].Store;
                    var Price=data.response[0].Price;

                    $('#edit_ItemID').val(ItemID);
                    $('#edit_ItemName').val(ItemName);
                    $('#edit_ItemType').val(ItemType);
                    $('#edit_Color').val(Color);
                    $('#edit_Capacity').val(Capacity);
                    $('#edit_Display').val(Display);
                    $('#edit_Chip').val(Chip);
                    $('#edit_Camera').val(Camera);
                    $('#edit_Store').val(Store);
                    $('#edit_Price').val(Price);
                }
                else if(data.status==false)
                {
                    $('#response-msg').text();
                    $('#response-msg').removeClass("success");
                    $('#response-msg').text(data.response);
                    $('#response-msg').addClass("fail");
                }
            }
        });
    });

}

$('#edit_item_btn').click(function()
{
    var ItemID = $('#edit_ItemID').val();
    var ItemName = $('#edit_ItemName').val();
    var ItemType = $('#edit_ItemType').val();
    var Color=$('#edit_Color').val();
    var Capacity=$('#edit_Capacity').val();
    var Display=$('#edit_Display').val();
    var Chip=$('#edit_Chip').val();
    var Camera=$('#edit_Camera').val();
    var Store=$('#edit_Store').val();
    var Price= $('#edit_Price').val();

    var validForm = 1;

    if(ItemName=='')
    {
        $('#edit_ItemName_err').show();
        $('#edit_ItemName_errL').show();
        validForm = 0;
    } else {
        $('#edit_ItemName_err').hide();
        $('#edit_ItemName_errL').hide();
    }
    if(ItemType=='')
    {
        $('#edit_ItemType_err').show();
        $('#edit_ItemType_errL').show();
        validForm = 0;
    }
    else
    {
        $('#edit_ItemType_err').hide();
        $('#edit_ItemType_errL').hide();

    }
    if(Color=='')
    {
        $('#edit_Color_err').show();
        $('#edit_Color_errL').show();
        validForm = 0;
    } else {
        $('#edit_Color_err').hide();
        $('#edit_Color_errL').hide();
    }
    if(Capacity=='')
    {
        $('#edit_Capacity_err').show();
        $('#edit_Capacity_errL').show();
        validForm = 0;
    } else {
        $('#edit_Capacity_err').hide();
        $('#edit_Capacity_errL').hide();
    }
    if(Display=='')
    {
        $('#edit_Display_err').show();
        $('#edit_Display_errL').show();
        validForm = 0;
    } else {
        $('#edit_Display_err').hide();
        $('#edit_Display_errL').hide();
    }
    if(Chip=='')
    {
        $('#edit_Chip_err').show();
        $('#edit_Chip_errL').show();
    }else{
        $('#edit_Chip_err').hide();
        $('#edit_Chip_errL').hide();
    }

    if(Camera=='')
    {
        $('#edit_Camera_err').show();
        $('#edit_Camera_errL').show();
    }else{
        $('#edit_Camera_err').hide();
        $('#edit_Camera_errL').hide();
    }

    if(Store=='')
    {
        $('#edit_Store_err').show();
        $('#edit_Store_errL').show();
        $('#edit_Store_antVal').hide();
    }else if (Store<0){
        $('#edit_Store_antVal').show();
        $('#edit_Store_err').hide();
        $('#edit_Store_errL').show();
    }
    else
    {
        $('#edit_Store_err').hide();
        $('#edit_Store_errL').hide();
        $('#edit_Store_antVal').hide();
    }

    if(Price=='')
    {
        $('#edit_Price_amtVal').hide();
        $('#edit_Price_amt_err').show();
        $('#edit_Price_amt_errL').show();
        validForm = 0;
    } else if (Price < 0){
        $('#edit_Price_amtVal').show();
        $('#edit_Price_amt_err').hide();
        $('#edit_Price_amt_errL').show();
        validForm = 0;
    } else {
        $('#edit_Price_amtVal').hide();
        $('#edit_Price_amt_err').hide();
        $('#edit_Price_amt_errL').hide();
    }

    if (validForm == 1)
    {
    var form_data=new FormData();
    form_data.append('ItemID',ItemID);
    form_data.append('ItemName',ItemName);
    form_data.append('ItemType',ItemType);
    form_data.append('Color',Color);
    form_data.append('Capacity',Capacity);
    form_data.append('Display',Display);
    form_data.append('Chip',Chip);
    form_data.append('Camera',Camera);
    form_data.append('Store',Store);
    form_data.append('Price',Price);
    $.ajax({
        type: "post",
        url: api_url+'editItem.php',
        data:form_data ,
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        error: function(jqXHR, textStatus, errorThrown ){
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        },
        success: function(data){

            if(data.status==true)
            {
                $('#editSuccessModal').modal('toggle');

                showItemTable();
            }
            else if(data.status==false)
            {
                $('#errorModal').modal('toggle');
            }
            $('#editAccountItemModal').modal('toggle');
        }
    }); }
});
