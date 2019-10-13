/**
 * Created by User on 5/7/2019.
 */




function showUserTable()
{

    var actionbtn = function(cell, formatterParams){ //plain text value
        return '<select id="action_'+cell.getRow().getData().Username.replace(/\s/g, '_')+'" class="action" onchange="actionUser(\'action_'+cell.getRow().getData().Username.replace(/\s/g, '_')+'\',\''+cell.getRow().getData().Username+'\')" name="'+cell.getRow().getData().ApiaristUsername+'"><option value="">Select</option><optgroup label="Standard Actions"><option value="view"><i class="fa fa-eye"></i>View</option><option value="edit"><i class="fa fa-edit"></i>Edit</option></optgroup><optgroup label="Special"><option value="reset_pass"><i class="fa fa-plus"></i>Reset Password</option></optgroup></select>';
    };

    UserTable = new Tabulator("#Main-mbb-table", {
        layout:"fitDataFill",
        tooltips:true,
        addRowPos:"top",
        history:false,
        pagination:"local",
        paginationSize:10,
        movableColumns:true,
        resizableRows:true,
        selectable:true,
        initialSort:[
            {column:"Username", dir:"asc"},
        ],
        columns:[

            {title:"Actions",formatter:actionbtn, align:"center", headerSort:false, frozen:true},
            {title:"AccountType", field:"isAdmin",  align:"center"},
            {
                title:"Personal Information",
                columns:[
                    {title:"Username", field:"Username",align:"center", sorter:"number"},
                    {title:"Business Name", field:"BusinessName", align:"center"},
                    {title:"Given Name", field:"GivenName",  align:"center"},
                    {title:"Family Name", field:"FamilyName",  align:"center"},
                    {title:"Title", field:"Title",  align:"center"},
                    {title:"Email", field:"Email",  align:"center"},
                    {title:"Contact Number", field:"ContactNumber",  align:"center"},
                ],
            },
            {
                title:"Residential Address",
                columns:[
                    {title:"Country", field:"Country", align:"center", sorter:"number"},
                    {title:"State/Province/Region", field:"StateProvinceRegion",  align:"center"},
                    {title:"County or District", field:"CountyDistrict",  align:"center"},
                    {title:"City or Town", field:"CityTown",  align:"center"},
                    {title:"Postal Code", field:"PostalCode", align:"center"},
                    {title:"Street Address", field:"StreetAddress",  align:"center"},
                    {title:"Premises", field:"Premises",  align:"center"},
                ],
            },

        ],

    });



    var Username=$('#Username').val();
    var isAdmin=$('#isAdmin').val();



    $.ajax({
        type: "post",
        url: api_url+'getAllUser.php',
        data:{Username:Username,isAdmin:isAdmin},
        dataType:'JSON',
        error: function(jqXHR, textStatus, errorThrown ){
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        },
        success: function(data){
            UserTable.setData(data);

        }
    });

    $(window).resize(function(){
       UserTable.redraw();
    });


    $("#Main-mbb-columns").on("change", function(){
        var column=$('#Main-mbb-columns').val();
        if (column==null) {
            UserTable.clearFilter(true);
            return;
        }
        var input=$("#Main-mbb-controls input[name=name]").val();
        UserTable.setFilter(column, "like", input);
        $("#Main-mbb-table-count").text(UserTable.getDataCount());
    });

    $("#Main-mbb-controls input[name=name]").on("keyup", function(){
        var column=$('#Main-mbb-columns').val();
        if (column==null) {
            UserTable.clearFilter(true);
            return;
        }
        UserTable.setFilter(column, "like", $(this).val());
        $("#Main-mbb-table-count").text(UserTable.getDataCount());
    });

    $("#Main-mbb-controls  button[name=add-row]").on("click", function(){
        UserTable.addRow({});
    });
}

function addUserMode(){
    $('#addUserModal').modal('toggle');

    $('#add_user_userVal').hide();
    $('#add_user_userExist').hide();
    $('#add_user_user_err').hide();
    $('#add_user_user_errL').hide();
    $('#add_user_passVal').hide();
    $('#add_user_pass_err').hide();
    $('#add_user_pass_errL').hide();
    $('#add_user_rbrandExist').hide();
    $('#add_user_regbrand_err').hide();
    $('#add_user_regbrand_errL').hide();
    $('#add_user_regterr_err').hide();
    $('#add_user_regterr_errL').hide();
    $('#add_user_fname_err').hide();
    $('#add_user_fname_errL').hide();
    $('#add_user_gname_err').hide();
    $('#add_user_gname_errL').hide();
    $('#add_user_title_err').hide();
    $('#add_user_title_errL').hide();
    $('#add_user_emailVal').hide();
    $('#add_user_emailExist').hide();
    $('#add_user_email_err').hide();
    $('#add_user_email_errL').hide();
    $('#add_user_number_err').hide();
    $('#add_user_number_errL').hide();
    $('#add_user_cty_err').hide();
    $('#add_user_cty_errL').hide();
    $('#add_user_spr_err').hide();
    $('#add_user_spr_errL').hide();
    $('#add_user_citytown_err').hide();
    $('#add_user_citytown_errL').hide();
    $('#add_user_postal_err').hide();
    $('#add_user_postal_errL').hide();
    $('#add_user_street_err').hide();
    $('#add_user_street_errL').hide();
    $('#add-apiarist-msg').hide();

    $('#add_username').val('');
    $('#add_password').val('');
    $('#add_registration_brand').val('');
    $('#add_registration_territory').val('');
    $('#add_business_name').val('');
    $('#add_family_name').val('');
    $('#add_given_name').val('');
    $('#add_title').val('');
    $('#add_email').val('');
    $('#add_contact_number').val('');
    $('#add_user_country').val('');
    $('#add_state').val('');
    $('#add_county_district').val('');
    $('#add_city_town').val('');
    $('#add_postal_code').val('');
    $('#add_street_address').val('');
    $('#add_premises').val('');
    $('#add_isAdmin').prop("checked", false);

    $('#add_user_modal_title').show();
    $('#add_user_modal_body').show();


    $('#add_user_btn').click(function() {

        var Username= $('#add_username').val();
        var Password= $('#add_password').val();
        var BusinessName=$('#add_business_name').val();
        var FamilyName=$('#add_family_name').val();
        var GivenName=$('#add_given_name').val();
        var Title=$('#add_title').val();
        var Email=$('#add_email').val();
        var ContactNumber=$('#add_contact_number').val();
        var Country=$('#add_user_country').val();
        var StateProvinceRegion=$('#add_state').val();
        var CountyDistrict=$('#add_county_district').val();
        var CityTown=$('#add_city_town').val();
        var PostalCode=$('#add_postal_code').val();
        var StreetAddress=$('#add_street_address').val();
        var Premises=$('#add_premises').val();
        var isAdmin= $('#add_isAdmin').prop("checked") == true ? 1 : 0;

        var validForm = 1;

        if(Username=="") {
            $('#add_user_userVal').hide();
            $('#add_user_userExist').hide();
            $('#add_user_user_err').show();
            $('#add_user_user_errL').show();
            validForm = 0;
        } else if (Username.length < 8 || Username.length > 30){
            $('#add_user_user_err').hide();
            $('#add_user_userExist').hide();
            $('#add_user_userVal').show();
            $('#add_user_user_errL').show();
            validForm = 0;
        } else {
            var form_dataUser=new FormData();
            form_dataUser.append('Username', Username);

            $.ajax({
                type: "post",
                url: api_url+'addUserValidate.php',
                data: form_dataUser,
                contentType: false,
                cache: false,
                processData: false,
                dataType:'JSON',
                async:false,
                success: function(data){
                    if(data.statusUser==false){
                        $('#add_user_user_err').hide();
                        $('#add_user_userVal').hide();
                        $('#add_user_userExist').hide();
                        $('#add_user_user_errL').hide();
                    } else {
                        $('#add_user_user_err').hide();
                        $('#add_user_userVal').hide();
                        $('#add_user_userExist').show();
                        $('#add_user_user_errL').show();
                        validForm = 0;
                    }
                }
            });
        }


        if(Password=="") {
            $('#add_user_passVal').hide();
            $('#add_user_pass_err').show();
            $('#add_user_pass_errL').show();
            validForm = 0;
        } else {
            var countChar = 0;
            var countNum = 0;
            if (Password.length >= 8) {
                for (var i=0; i<Password.length; i++){
                    if ($.isNumeric(Password.charAt(i))){
                        countNum++;
                    } else if (Password.charAt(i).toLowerCase() != Password.charAt(i).toUpperCase()){
                        countChar++;
                    }
                }
            }
            if (countChar > 0 && countNum > 0) {
                $('#add_user_pass_err').hide();
                $('#add_user_passVal').hide();
                $('#add_user_pass_errL').hide();
            } else {
                $('#add_user_pass_err').hide();
                $('#add_user_passVal').show();
                $('#add_user_pass_errL').show();
                validForm = 0;
            }
        }

        if(FamilyName=='')
        {
            $('#add_user_fname_err').show();
            $('#add_user_fname_errL').show();
            validForm = 0;
        } else {
            $('#add_user_fname_err').hide();
            $('#add_user_fname_errL').hide();
        }
        if(GivenName=='')
        {
            $('#add_user_gname_err').show();
            $('#add_user_gname_errL').show();
            validForm = 0;
        } else {
            $('#add_user_gname_err').hide();
            $('#add_user_gname_errL').hide();
        }
        if(Title=='')
        {
            $('#add_user_title_err').show();
            $('#add_user_title_errL').show();
            validForm = 0;
        } else {
            $('#add_user_title_err').hide();
            $('#add_user_title_errL').hide();
        }

        if(Email==""){
            $('#add_user_emailVal').hide();
            $('#add_user_emailExist').hide();
            $('#add_user_email_err').show();
            $('#add_user_email_errL').show();
            validForm = 0;
        } else {
            if (!Email.match(/(.+)@(.+){2,}\.(.+){2,}/)){
                $('#add_user_email_err').hide();
                $('#add_user_emailExist').hide();
                $('#add_user_emailVal').show();
                $('#add_user_email_errL').show();
                validForm = 0;
            } else {
                var form_dataEmail=new FormData();
                form_dataEmail.append('Email', Email);

                $.ajax({
                    type: "post",
                    url: api_url+'addUserValidate.php',
                    data: form_dataEmail,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType:'JSON',
                    async:false,
                    success: function(data){
                        if(data.statusEmail==false) {
                            $('#add_user_email_err').hide();
                            $('#add_user_emailVal').hide();
                            $('#add_user_emailExist').hide();
                            $('#add_user_email_errL').hide();
                        } else {
                            $('#add_user_email_err').hide();
                            $('#add_user_emailVal').hide();
                            $('#add_user_emailExist').show();
                            $('#add_user_email_errL').show();
                            validForm = 0;
                        }
                    }
                });
            }
        }


        if(ContactNumber=="") {
            $('#add_user_number_err').show();
            $('#add_user_number_errL').show();
            validForm = 0;
        }else {
            $('#add_user_number_err').hide();
            $('#add_user_number_errL').hide();
        }

        if(Country==""){
            $('#add_user_cty_err').show();
            $('#add_user_cty_errL').show();
            validForm = 0;
        }else {
            $('#add_user_cty_err').hide();
            $('#add_user_cty_errL').hide();
        }

        if(StateProvinceRegion==""){
            $('#add_user_spr_err').show();
            $('#add_user_spr_errL').show();
            validForm = 0;
        }else {
            $('#add_user_spr_err').hide();
            $('#add_user_spr_errL').hide();
        }

        if(CityTown==""){
            $('#add_user_citytown_err').show();
            $('#add_user_citytown_errL').show();
            validForm = 0;
        }else {
            $('#add_user_citytown_err').hide();
            $('#add_user_citytown_errL').hide();
        }

        if(PostalCode=="") {
            $('#add_user_postal_err').show();
            $('#add_user_postal_errL').show();
            validForm = 0;
        }else {
            $('#add_user_postal_err').hide();
            $('#add_user_postal_errL').hide();
        }

        if(StreetAddress==""){
            $('#add_user_street_err').show();
            $('#add_user_street_errL').show();
            validForm = 0;
        } else {
            $('#add_user_street_err').hide();
            $('#add_user_street_errL').hide();
        }

        if (validForm == 1) {

            var form_data = new FormData();
            form_data.append('Username', Username);
            form_data.append('Password', Password);
            form_data.append('BusinessName', BusinessName);
            form_data.append('FamilyName', FamilyName);
            form_data.append('GivenName', GivenName);
            form_data.append('Title', Title);
            form_data.append('Email', Email);
            form_data.append('ContactNumber', ContactNumber);
            form_data.append('Country', Country);
            form_data.append('StateProvinceRegion', StateProvinceRegion);
            form_data.append('CountyDistrict', CountyDistrict);
            form_data.append('CityTown', CityTown);
            form_data.append('PostalCode', PostalCode);
            form_data.append('StreetAddress', StreetAddress);
            form_data.append('Premises', Premises);
            form_data.append('isAdmin', isAdmin);

            $.ajax({
                type: "post",
                url: api_url + 'addUser.php',
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == true) {
                        $('#addSuccessModal').modal('toggle');

                        showApiaristTable();
                    }
                    else if (data.status == false) {
                        $('#errorModalRet').modal('toggle');
                    }
                    $('#addUserModal').modal('toggle');
                }
            });
        }




    });



}// end of Add user method


$('#edit_user_btn').click(function()
{
    var Username= $('#edit_username').val();
    var BusinessName=$('#edit_business_name').val();
    var FamilyName=$('#edit_family_name').val();
    var GivenName=$('#edit_given_name').val();
    var Title=$('#edit_title').val();
    var Email=$('#edit_email').val();
    var ContactNumber=$('#edit_contact_number').val();
    var Country=$('#edit_user_country').val();
    var StateProvinceRegion=$('#edit_state').val();
    var CountyDistrict=$('#edit_county_district').val();
    var CityTown=$('#edit_city_town').val();
    var PostalCode=$('#edit_postal_code').val();
    var StreetAddress=$('#edit_street_address').val();
    var Premises=$('#edit_premises').val();
    

    var isAdmin= $('#edit_isAdmin').prop("checked") == true ? 1 : 0;

    var validForm = 1;

  
    
    if(FamilyName=='')
    {
        $('#edit_user_fname_err').show();
        $('#edit_user_fname_errL').show();
        validForm = 0;
    } else {
        $('#edit_user_fname_err').hide();
        $('#edit_user_fname_errL').hide();
    }
    if(GivenName=='')
    {
        $('#edit_user_gname_err').show();
        $('#edit_user_gname_errL').show();
        validForm = 0;
    } else {
        $('#edit_user_gname_err').hide();
        $('#edit_user_gname_errL').hide();
    }
    if(Title=='')
    {
        $('#edit_user_title_err').show();
        $('#edit_user_title_errL').show();
        validForm = 0;
    } else {
        $('#edit_user_title_err').hide();
        $('#edit_user_title_errL').hide();
    }

    if(Email==""){
        $('#edit_user_emailVal').hide();
        $('#edit_user_emailExist').hide();
        $('#edit_user_email_err').show();
        $('#edit_user_email_errL').show();
        validForm = 0;
    } else {
        var reg = /(.+)@(.+){2,}\.(.+){2,}/;
        if (!reg.test(Email)){
            $('#edit_user_email_err').hide();
            $('#edit_user_emailExist').hide();
            $('#edit_user_emailVal').show();
            $('#edit_user_email_errL').show();
            validForm = 0;
        } else {
            var form_dataEmail=new FormData();
            form_dataEmail.append('Username', Username);
            form_dataEmail.append('Email', Email);

            $.ajax({
                type: "post",
                url: api_url+'editUserValidate.php',
                data: form_dataEmail,
                contentType: false,
                cache: false,
                processData: false,
                dataType:'JSON',
                async:false,
                success: function(data){
                    if(data.statusEmail==false) {
                        $('#edit_user_email_err').hide();
                        $('#edit_user_emailVal').hide();
                        $('#edit_user_emailExist').hide();
                        $('#edit_user_email_errL').hide();
                    } else {
                        $('#edit_user_email_err').hide();
                        $('#edit_user_emailVal').hide();
                        $('#edit_user_emailExist').show();
                        $('#edit_user_email_errL').show();
                        validForm = 0;
                    }
                }
            });
        }
    }

    if(ContactNumber=="") {
        $('#edit_user_number_err').show();
        $('#edit_user_number_errL').show();
        validForm = 0;
    }else {
        $('#edit_user_number_err').hide();
        $('#edit_user_number_errL').hide();
    }

    if(Country==""){
        $('#edit_user_cty_err').show();
        $('#edit_user_cty_errL').show();
        validForm = 0;
    }else {
        $('#edit_user_cty_err').hide();
        $('#edit_user_cty_errL').hide();
    }

    if(StateProvinceRegion==""){
        $('#edit_user_spr_err').show();
        $('#edit_user_spr_errL').show();
        validForm = 0;
    }else {
        $('#edit_user_spr_err').hide();
        $('#edit_user_spr_errL').hide();
    }

    if(CityTown==""){
        $('#edit_user_citytown_err').show();
        $('#edit_user_citytown_errL').show();
        validForm = 0;
    }else {
        $('#edit_user_citytown_err').hide();
        $('#edit_user_citytown_errL').hide();
    }

    if(PostalCode=="") {
        $('#edit_user_postal_err').show();
        $('#edit_user_postal_errL').show();
        validForm = 0;
    }else {
        $('#edit_user_postal_err').hide();
        $('#edit_user_postal_errL').hide();
    }

    if(StreetAddress==""){
        $('#edit_user_street_err').show();
        $('#edit_user_street_errL').show();
        validForm = 0;
    } else {
        $('#edit_user_street_err').hide();
        $('#edit_user_street_errL').hide();
    }
    if (validForm == 1){

    var form_data=new FormData();
    form_data.append('Username',Username);
    form_data.append('BusinessName',BusinessName);
    form_data.append('FamilyName',FamilyName);
    form_data.append('GivenName',GivenName);
    form_data.append('Title',Title);
    form_data.append('Email',Email);
    form_data.append('ContactNumber',ContactNumber);
    form_data.append('Country',Country);
    form_data.append('StateProvinceRegion',StateProvinceRegion);
    form_data.append('CountyDistrict',CountyDistrict);
    form_data.append('CityTown',CityTown);
    form_data.append('PostalCode',PostalCode);
    form_data.append('StreetAddress',StreetAddress);
    form_data.append('Premises',Premises);
    form_data.append('isAdmin',isAdmin);

    $.ajax({
        type: "post",
        url: api_url+'editUser.php',
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        dataType:'JSON',
        success: function(data){
            if(data.status==true)
            {
                $('#editSuccessModal').modal('toggle');

                showUserTable();
            }
            else if(data.status==false)
            {
                $('#errorModalRet').modal('toggle');
            }
            $('#editUserModal').modal('toggle');
        }
    }); }

}); // end of edit user function



















function deleteUser(){
    deleteTable = deleteViewToggle == "main" ? UserTable : RelateduserTable;

    if (deleteTable.getSelectedData().length == 0){
        $('#DeleteNoneSelectedModal').modal('toggle');
    } else {
        $('#deleteUserModal').modal('toggle');
    }
}

$('#deleteUserBtn').click(function(){

    var selectedData = deleteTable.getSelectedData();
    var showSuccess = 1;

    for (var i =0 ; i < selectedData.length; i++){
        if (delUser(selectedData[i]['Username']) == false) showSuccess = 0;
    }
    $('#deleteUserModal').modal('toggle');
    if (showSuccess == 1) $('#deletionSuccessModal').modal('toggle');
    showUserTable();
    
});

function delUser(Username){
    var success = 1;
    $.ajax({
        type: "post",
        url: api_url+'delete_User.php',
        data:{Username:Username},
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
                alert("Failed to delete record with Username: " + Username);
                success = 0;
            }
        }
    });
    return success;
}

function actionUser(id,Username)
{
    //
    var action=$("#"+id).val();
    
    if(action=="view")
    {
        viewUser(Username);
    }
    else if(action=='edit')
    {
        editUser(Username);
    }
    else if (action=='reset_pass')
    {
        resetPassword(Username);
    }
    $("#"+id).val('');

}

function viewUser(Username)
{
    $('.NoShowItem').hide();
    getViewModalDetails("phoneuser", Username);

}

function editUser(Username)
{
    $(document).ready(function() {
        $('#editUserModal').modal('toggle');

        $('#edit_user_modal_title').show();
        $('#edit_user_modal_body').show();

       
        $('#edit_user_fname_err').hide();
        $('#edit_user_fname_errL').hide();
        $('#edit_user_gname_err').hide();
        $('#edit_user_gname_errL').hide();
        $('#edit_user_title_err').hide();
        $('#edit_user_title_errL').hide();
        $('#edit_user_emailVal').hide();
        $('#edit_user_emailExist').hide();
        $('#edit_user_email_err').hide();
        $('#edit_user_email_errL').hide();
        $('#edit_user_number_err').hide();
        $('#edit_user_number_errL').hide();
        $('#edit_user_cty_err').hide();
        $('#edit_user_cty_errL').hide();
        $('#edit_user_spr_err').hide();
        $('#edit_user_spr_errL').hide();
        $('#edit_user_citytown_err').hide();
        $('#edit_user_citytown_errL').hide();
        $('#edit_user_postal_err').hide();
        $('#edit_user_postal_errL').hide();
        $('#edit_user_street_err').hide();
        $('#edit_user_street_errL').hide();
        $('#edit-apiarist-msg').hide();

        $.ajax({
            type: "post",
            url: api_url+'getUser.php',
            data:{Username:Username},
            dataType:'JSON',
            success: function(data){
                if(data.status==true)
                {
                    $('#edit_username').val(data.response[0].Username);
                    $('#edit_business_name').val(data.response[0].BusinessName);
                    $('#edit_family_name').val(data.response[0].FamilyName);
                    $('#edit_given_name').val(data.response[0].GivenName);
                    $('#edit_title').val(data.response[0].Title);
                    $('#edit_email').val(data.response[0].Email);
                    $('#edit_contact_number').val(data.response[0].ContactNumber);
                    $('#edit_user_country').val(data.response[0].Country);
                    $('#edit_state').val(data.response[0].StateProvinceRegion);
                    $('#edit_county_district').val(data.response[0].CountyDistrict);
                    $('#edit_city_town').val(data.response[0].CityTown);
                    $('#edit_postal_code').val(data.response[0].PostalCode);
                    $('#edit_street_address').val(data.response[0].StreetAddress);
                    $('#edit_premises').val(data.response[0].Premises);
                    $('#edit_user_rcountry').val(data.response[0].RCountry);
                    if (data.response[0].isAdmin == 1){
                        $('#edit_isAdmin').prop("checked", true);
                    } else {
                        $('#edit_isAdmin').prop("checked", false);
                    }
                }
                else if(data.status==false)
                {
                    $('#response-msg').text();
                    $('#response-msg').removeClass("success");
                    $('#response-msg').text(data.response);
                    $('#response-msg').addClass("fail");
                    $('html, body').animate({
                        scrollTop: $("#response-msg").offset().top
                    }, 1000);
                }
            }
        });
    });

       
}

function resetPassword(Username){
    $('#ResetPassUser').val(Username);
    $('#resetPasswordPrompt').modal('toggle');
}

$('#resetPasswordPromptBtn').click(function(){
    var newPass = "";
    var possibleChar = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    var possibleDigit = "0123456789";

    for (var i = 0; i < 5; i++){
        newPass += possibleChar.charAt(Math.floor(Math.random() * possibleChar.length));
    }
    for (var i = 0; i < 3; i++){
        newPass += possibleDigit.charAt(Math.floor(Math.random() * possibleDigit.length));
    }

    $.ajax({
        type: "post",
        url: api_url+'resetUserPassword.php',
        data:{Username:$('#ResetPassUser').val(), Password:newPass},
        dataType:'JSON',
        success: function(data){

            $('#resetPasswordPrompt').modal('toggle');
            $('#resetPassTxt').text(newPass);
            $('#resetPasswordModal').modal('toggle');

        }
    });
});