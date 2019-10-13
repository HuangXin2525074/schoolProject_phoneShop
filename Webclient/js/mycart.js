/**
 * Created by User on 12/7/2019.
 */


$('#add_cart_btn').click(function()
{

    var ItemName=document.getElementById("view_ItemName").innerHTML;
    var Qty = $('#Add_Order').val();
    var Total_Price= document.getElementById("view_Price").innerHTML;
    var Price = Total_Price*Qty;
   var Username= $('#Username').val();
   var ItemID =  $('#viewPK').val();
   var Store = document.getElementById("view_Store").innerHTML;

    var validForm = 1;

    if(Qty<=0)
    {
        $('#edit_Qty_antVal').show();
        validForm=0;
    }
    if(parseInt(Store)<Qty)
    {
        $('#edit_NoStore_antVal').show();
        validForm=0;
    }


    if(validForm==1) {
        var form_data = new FormData();
        form_data.append('ItemName', ItemName);
        form_data.append('Username', Username);
        form_data.append('Qty', Qty);
        form_data.append('Price', Price);
        form_data.append('ItemID',ItemID);

        $.ajax({
            type: "post",
            url: api_url + 'addCart.php',
            data: form_data,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {

                if (data.status == true) {
                    $('#viewModal').hide();
                    $('#addSuccessModal').modal('toggle');

                }
                else if (data.status == false) {
                    $('#errorModalRet').modal('toggle');
                }
            }
        });

    }

});


$('#clear_cart_btn').click(function()
{
    var Username= $('#Username').val();


    $.ajax({
        type: "post",
        url: api_url + 'clearCart.php',
        data:{Username:Username},
        dataType: 'JSON',
        async: false,
        success: function (data) {

        }
    });

    $.ajax({
        type: "post",
        url: api_url + 'getCart.php',
        data: {Username: Username},
        dataType: 'JSON',
        async: false,
        success: function (data) {
            var cartStr = "";
            if (data.length == 0) {
                cartStr = "<div class=\"row\"><div class=\"col-12 text-center\"><br><br><br><br>-----No items to display.-----</b></div></div>";
            }
            else {
                for (var i = 0; i < data.length; i++) {
                    cartStr += "<div class=\"row changelogEntry\">";
                    cartStr += "<div class=\"col-6  text-center ItemName\">" + data[i]['ItemName'] + "</div>";
                    cartStr += "<div class=\"col-3 text-left QTY\">" + data[i]['Qty'] + "</div>";
                    cartStr += "<div class=\"col-3 text-left Price\">" + data[i]['Price'] + "</div>";
                    cartStr += "</div>";
                }


            }
            $('#viewModalChartBody').html(cartStr);


        }
    });

    $.ajax({
        type: "post",
        url: api_url+'getTotalPrice.php',
        data:{Username:Username},
        dataType:'JSON',
        async: false,
        success: function(data)
        {
            var TotalPrice;
            if(data.length ==0)
            {
               // TotalPrice=0;
            }
            else
            {
                TotalPrice= data['total'];


            }
            $('#TotalPrice').html( TotalPrice);


        }

    });







});
$('#submit_order_btn').click(function () {

    var listCartItem =new Array;

    var Username= $('#Username').val();

    var OrderID = "";
    var possibleChar = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    var possibleDigit = "0123456789";

    // GET radom orderID.
    for (var i = 0; i < 5; i++){
        OrderID += possibleChar.charAt(Math.floor(Math.random() * possibleChar.length));
    }
    for (var i = 0; i < 3; i++){
        OrderID += possibleDigit.charAt(Math.floor(Math.random() * possibleDigit.length));
    }






    $.ajax({
        type: "post",
        url: api_url+'getCart.php',
        data:{Username:Username},
        dataType:'JSON',
        async: false,
        success: function(data)
        {
            if(data.length ==0)
            {
                $("#CartModal").modal('toggle');
                $('#EmptyCartModal').modal('toggle');
            }
            else
            {
                for(var i=0;i<data.length;i++)
                {
                    // CREATE A CART OBJECT TO HOLD ALL VARIABLE
                    var CartObject = {
                        Username:Username,
                        OrderID:OrderID,
                        ItemName: data[i]['ItemName'],
                        ItemID: data[i]['ItemID'],
                        Qty: data[i]['Qty'],
                        Price: data[i]['Price']
                    };

                   listCartItem[i]= CartObject;
                }


            }



        }

    });

    for(var i=0;i<listCartItem.length;i++)
    {
        var form_data = new FormData();

        form_data.append('Username',listCartItem[i].Username);
        form_data.append('OrderID',listCartItem[i].OrderID);
        form_data.append('ItemName',listCartItem[i].ItemName);
        form_data.append('Qty',listCartItem[i].Qty);
        form_data.append('Price',listCartItem[i].Price);
       form_data.append('ItemID',listCartItem[i].ItemID);


        $.ajax({
            type: "post",
            url: api_url + 'addOrder.php',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'JSON',
            success: function (data) {
                if (data.status == true) {
                    $('#OrderID').html(data.OrderID);
                    //$('#OrderSuccessModal').modal('toggle');

                }
                else if (data.status == false) {
                    $('#errorModalRet').modal('toggle');
                }
                $('#CartModal').modal('toggle');
            }
        });



        $.ajax({
            type: "post",
            url: api_url +'minus_Store.php',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'JSON',
            success: function (data) {

                if (data.status == true) {
                    $('#OrderSuccessModal').modal('toggle');
                }
                else if (data.status == false) {
                    $('#errorModalRet').modal('toggle');
                }

            }
        });





     }


    $.ajax({
        type: "post",
        url: api_url + 'clearCart.php',
        data:{Username:Username},
        dataType: 'JSON',
        async: false,
        success: function (data) {

        }
    });



});



