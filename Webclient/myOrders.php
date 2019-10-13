<?php    
session_start();
if(isset($_SESSION['isAdmin']))
{
		 if(isset($_SESSION['Username']))
		{
		    $Username=$_SESSION['Username'];
		     $isAdmin=$_SESSION['isAdmin'];
		}
		else if(!isset($_SESSION['Username']))  
		{
		 header("Location: index.php?err=login");
		}	
}
else
{
	header("Location: index.php?err=login");
}

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Order Page</title>
		<meta charset="utf-8" />
	  <!-- Theme style -->
		<link rel="stylesheet" href="css/AdminLTE.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="css/main.css" />
		<link rel="stylesheet" href="css/app.css" />
		<link rel="stylesheet" href="css/tabulator.min.css" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		
		<noscript><link rel="stylesheet" href="css/noscript.css" /></noscript>

		
	</head>
	<body class="is-preload">
		<!-- Page Wrapper -->
			<div id="page-wrapper">
				<!-- Header -->
					<header id="header">
						<h1><a href="data.php">E-Phone</a></h1>
						<nav id="nav">
							<ul>
								<li class="special">
									<a href="#menu" class="menuToggle"><span>Menu</span></a>
									<div id="menu">
										<ul>
                                            <li><a href="accounts.profile.php" id="">Account</a></li>
                                            <li><a href="data.php">Sell Portal</a></li>
                                            <li><a href="faq.html" id="">FAQ</a></li>
											<li><a href="../Server/logout.php" id="">Log Out</a></li>
										</ul>
									</div>
								</li>
							</ul>
						</nav>
					</header>
				<!-- Main -->
					<article id="main">
						<header>
							<h1>Order Page</h1>
							<p>Check Order Information</p>
						</header>

<div class="py-5">
    <div class="container">
        <div>
            <input type="hidden" name="Username" id="Username" value="<?php echo $Username;?>">
            <section class="content-header">
                <h3>Order History</h3>

            </section>

            <section class="content">
                <div class="row">
                    <div class="col-12 col-md-7 col-lg-8 col-xl-9 mt-4 mt-md-0">
                        <div>
                            <div class="tab-content m-12">
                                <div class="tab-pane fade show active" role="tabpanel" id="Overview">
                                    <div class="card mb-12">

                                        <div class="card-body">

                                            <div class="col-table mt-12">
                                                <div class="col-table-header">
                                                    <div class="row">
                                                        <div class="col-2 text-center"><b>OrderID</b></div>
                                                        <div class="col-3 text-center"><b>ItemName</b></div>
                                                        <div class="col-2 text-center"><b>QTY</b></div>
                                                        <div class="col-3 text-center"><b>Order date</b></div>
                                                        <div class="col-2 text-center"><b>Price</b></div>
                                                    </div>
                                                </div>
                                                <div class="col-table-body" style="height:200px" id="viewOrderHistoryBody">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                



                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>

            </section>
        </div>
	</div>
</div>
</article>



<!-- //--// -->

				<!-- Footer -->
					<footer id="footer">
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
							<li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
						</ul>
						<ul class="copyright">
							<li>&copy; I-Phone</li><li>Design: <a href="#">Huang Xin</a></li>
						</ul>
					</footer>

			</div>

</div>
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery-ui.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js" ></script>
        <script src="js/jquery.scrollex.min.js"></script>
        <script src="js/jquery.scrolly.min.js"></script>
        <script src="js/browser.min.js"></script>
        <script src="js/breakpoints.min.js"></script>
        <script src="js/util.js"></script>
        <script src="js/xlsx.js"></script>
        <script src="js/jszip.js"></script>
        <script src="js/xlsx.full.min.js"></script>
        <script type="text/javascript" src="js/tabulator.min.js"></script>
        <script src="js/jquery_wrapper.js" ></script>
        <script src="js/jquery_wrapper.min.js" ></script>
        <script src="js/app.js"></script>
		
        <script src="js/main.js"></script>

		








	</body>
</html>

<script>
$(document).ready(function(){

    var Username = $('#Username').val();


    $.ajax({
        type: "post",
        url: api_url+'getOrders.php',
        data:{Username:Username},
        dataType:'JSON',
        async: false,
        success: function(data)
        {
            var OrderhistoryStr = "";
            if(data.length ==0)
            {
                OrderhistoryStr="<div class=\"row\"><div class=\"col-12 text-center\"><br><br><br><br>-----No orders to display.-----</b></div></div>";
            }
            else
            {
                for(var i=0;i<data.length;i++)
                {
                    OrderhistoryStr += "<div class=\"row changelogEntry\">";
                    OrderhistoryStr += "<div class=\"col-2  text-center OrderID\">" +   data[i]['OrderID'] +"</div>";
                    OrderhistoryStr += "<div class=\"col-3 text-center ItemName\">" + data[i]['ItemName'] + "</div>";
                    OrderhistoryStr += "<div class=\"col-2 text-center Qty\">" + data[i]['Qty'] + "</div>";
                    OrderhistoryStr += "<div class=\"col-3 text-center OrderDate\">" + data[i]['OrderDate'] + "</div>";
                    OrderhistoryStr += "<div class=\"col-2 text-center Price\">" + data[i]['Price'] + "</div>";
                    OrderhistoryStr += "</div>";
                }



            }
            $('#viewOrderHistoryBody').html(OrderhistoryStr);


        }

    });







});




</script>