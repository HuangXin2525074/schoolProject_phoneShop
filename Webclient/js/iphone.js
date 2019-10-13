function showiphoneTable()
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

    iphoneTable = new Tabulator("#Main-mbb-table", {
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
        url: api_url+'getiphone.php',
        data:{Username:Username,isAdmin:isAdmin},
        dataType:'JSON',
        success: function(data){
            iphoneTable.setData(data);
        }
    });

    $(window).resize(function(){
        iphoneTable.redraw();
    });

    $("#Main-mbb-columns").on("change", function(){
        var column=$('#Main-mbb-columns').val();
        if (column==null) {
            iphoneTable.clearFilter(true);
            return;
        }
        var input=$("#Main-mbb-controls input[name=name]").val();
        iphoneTable.setFilter(column, "like", input);
        $("#Main-mbb-table-count").text(iphoneTable.getDataCount());
    });
    $("#Main-mbb-controls input[name=name]").on("keyup", function(){
        var column=$('#Main-mbb-columns').val();
        if (column==null) {
            iphoneTable.clearFilter(true);
            return;
        }
        iphoneTable.setFilter(column, "like", $(this).val());
        $("#Main-mbb-table-count").text(iphoneTable.getDataCount());
    });

    $("#Main-mbb-controls  button[name=add-row]").on("click", function(){
        iphoneTable.addRow({});
    });


}


