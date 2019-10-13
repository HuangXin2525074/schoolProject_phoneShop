
function getViewModalDetails(tableName, pkID) {

   hideAllViewDetails();

    $('#viewPK').val(pkID);

    $('#viewTableName').val(tableName);


    switchView(tableName, pkID);


};


function switchView(tableName, pkID){

    switch(tableName) {
        case "phoneuser":
            $.ajax({
                type: "post",
                url: api_url + 'getUser.php',
                data: {Username: pkID},
                dataType: 'JSON',
                success: function (data) {

                    if (data.status == true) {
                        var username = data.response[0].Username;
                        var business_name = data.response[0].BusinessName;
                        var family_name = data.response[0].FamilyName;
                        var given_name = data.response[0].GivenName;
                        var title = data.response[0].Title;
                        var email = data.response[0].Email;
                        var contact_number = data.response[0].ContactNumber;
                        var country = data.response[0].Country;
                        var state = data.response[0].StateProvinceRegion;
                        var district = data.response[0].CountyDistrict;
                        var city_town = data.response[0].CityTown;
                        var postal_code = data.response[0].PostalCode;
                        var street_address = data.response[0].StreetAddress;
                        var premises = data.response[0].Premises;
                        var isadmin = data.response[0].isAdmin;

                        $('#view_body_User').show();
                        $('#view_body_item').hide();
                        $('#myViewModalLabel').text('Details for user: ' + username);

                        $('#view_username').text(username);

                        if (business_name != null) {
                            $('#view_business_name').text(business_name);
                        } else {
                            $('#view_business_name').text('-');
                        }
                        $('#view_family_name').text(family_name);
                        $('#view_given_name').text(given_name);
                        $('#view_title').text(title);
                        $('#view_email').text(email);
                        $('#view_contact_number').text(contact_number);
                        $('#view_user_country').text(country);
                        $('#view_state').text(state);
                        if (district != null) {
                            $('#view_county_district').text(district);
                        } else {
                            $('#view_county_district').text('-');
                        }
                        $('#view_city_town').text(city_town);
                        $('#view_postal_code').text(postal_code);
                        $('#view_street_address').text(street_address);
                        if (premises != null) {
                            $('#view_premises').text(premises);
                        } else {
                            $('#view_premises').text('-');
                        }

                        if (isadmin == 1) {
                            $('#view_isadmin').text('Site Administrator');
                        } else {
                            $('#view_isadmin').text('User');
                        }

                        $("#Relatedmainnone-Selected").show();
                        $("#view_categories").hide();


                        if (!$('#viewModal').is(':visible')) {
                            $('#viewModal').modal('toggle');

                        }

                    }
                    else if (data.status == false) {
                        $('#errorModal').modal('toggle');
                    }
                }
            });
            break;

        case "Items":

            $.ajax({
                type: "post",
                url: api_url+'getItem.php',
                data:{ItemID:pkID},
                dataType:'JSON',
                success: function(data){

                    if(data.status==true)
                    {
                        var ItemID=data.response[0].ItemID;
                        var ItemName=data.response[0].ItemName;
                        var Color=data.response[0].Color;
                        var Capacity=data.response[0].Capacity;
                        var Display=data.response[0].Display;
                        var Chip=data.response[0].Chip;
                        var Camera=data.response[0].Camera;
                        var Store=data.response[0].Store;
                        var Price=data.response[0].Price;

                        $('#view_body_User').hide();
                        $('#view_body_item').show();
                        $('#myViewModalLabel').text('Details for Item: ' + ItemID);

                        $('#view_ItemID').text(ItemID);
                        $('#view_ItemName').text(ItemName);
                        $('#view_Color').text(Color);
                        $('#view_Capacity').text(Capacity);
                        $('#view_Display').text(Display);
                        $('#view_Chip').text(Chip);
                        $('#view_Camera').text(Camera);
                        $('#view_Store').text(Store);
                        $('#view_Price').text(Price);



                        if (!$('#viewModal').is(':visible')){
                            $('#viewModal').modal('toggle');

                        }
                    }
                    else if(data.status==false)
                    {
                        $('#errorModal').modal('toggle');
                    }
                }
            });
            break;

    }
}







function hideAllViewDetails() {
    $('#view_body_user').hide();
    $('#view_body_item').hide();

}