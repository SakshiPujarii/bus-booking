
<?php

    error_reporting(0);
    require_once "bookHelper.php";
    
    $route_id=$_REQUEST['route_id'];
    $seats=BookHelper::getSeats($route_id);
    $seats=implode(",",$seats);
?>
<!doctype html>
<!--[if IE 7 ]>    <html class="ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 	 ]>    <html class="ie" lang="en"> <![endif]-->
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<html>
<head>
	<meta charset="utf-8">
	<title>Bus Booking - Booking</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen,projection,print" />
	<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" />
	<link rel="shortcut icon" href="images/favicon.ico" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
    <style>#holder{width: 370px;}.seat.row-2, .seat.row-3 {margin-top: 40px !important;}</style>
</head>
<body>


    <!--header-->
	<?php
    require_once "header.php";
    ?>
	<!--//header-->
    
    <!--main-->
	<div class="main" role="main">		
		<div class="wrap clearfix">
			<!--main content-->
			<div class="content clearfix">
            <form action="booking-step1.php" method="post">
                
                <input type="hidden" name="route_id" value="<?php echo $route_id;?>" />
                <input type="hidden" id="reserve_seats" name="reserve_seats" value="" />
            	<div style="width: 100%;">
               
                <h2> Choose seats by clicking the corresponding seat in the layout below:</h2>
                <div id="holder"> 
                <ul  id="place">
                </ul>    
                </div>
                <div style="width:600px;text-align:center;overflow:auto"> 
                <ul id="seatDescription">
                    <li style="background:url('images/available_seat_img.gif') no-repeat scroll 0 0 transparent;">Available Seat</li>
                    <li style="background:url('images/booked_seat_img.gif') no-repeat scroll 0 0 transparent;">Booked Seat</li>
                    <li style="background:url('images/selected_seat_img.gif') no-repeat scroll 0 0 transparent;">Selected Seat</li>
                </ul>        
                </div>
            	<div style="width:580px;text-align:left;margin:5px;margin-bottom: 50px;">	
            		<!--<input class="gradient-button" type="button" id="btnShowNew" value="Show Selected Seats" />
                    <input class="gradient-button" type="button" id="btnShow" value="Show All" />--> 
                    <input class="gradient-button" type="submit"  value="Proceed to Reserve Seats" />           
                </div>
                
            
                </form>
                <script type="text/javascript">
                    $(function () {
                        var settings = {
                            rows: 4,
                            cols: 10,
                            rowCssPrefix: 'row-',
                            colCssPrefix: 'col-',
                            seatWidth: 35,
                            seatHeight: 35,
                            seatCss: 'seat',
                            selectedSeatCss: 'selectedSeat',
            				selectingSeatCss: 'selectingSeat'
                        };
            
                        var init = function (reservedSeat) {
                            var str = [], seatNo, className;
                            for (i = 0; i < settings.rows; i++) {
                                for (j = 0; j < settings.cols; j++) {
                                    seatNo = (i + j * settings.rows + 1);
                                    className = settings.seatCss + ' ' + settings.rowCssPrefix + i.toString() + ' ' + settings.colCssPrefix + j.toString();
                                    if ($.isArray(reservedSeat) && $.inArray(seatNo, reservedSeat) != -1) {
                                        className += ' ' + settings.selectedSeatCss;
                                    }
                                    str.push('<li class="' + className + '"' +
                                              'style="top:' + (i * settings.seatHeight).toString() + 'px;left:' + (j * settings.seatWidth).toString() + 'px">' +
                                              '<a title="' + seatNo + '">' + seatNo + '</a>' +
                                              '</li>');
                                }
                            }
                            $('#place').html(str.join(''));
                        };
            
                        //case I: Show from starting
                        //init();
            
                        //Case II: If already booked
                        var bookedSeats = [<?php echo $seats; ?>];
                        init(bookedSeats);
            
            
                        $('.' + settings.seatCss).click(function () {
            			if ($(this).hasClass(settings.selectedSeatCss)){
            				alert('This seat is already reserved');
            			}
            			else{
            			  
                            
                            $(this).toggleClass(settings.selectingSeatCss);
                            
                            var str = [], item;
                            $.each($('#place li.' + settings.selectingSeatCss + ' a'), function (index, value) {
                                item = $(this).attr('title');                   
                                str.push(item);                   
                            });
                            
                            $("#reserve_seats").val(str.join(','));
                            
                            
            				}
                        });
            
                        $('#btnShow').click(function () {
                            var str = [];
                            $.each($('#place li.' + settings.selectedSeatCss + ' a, #place li.'+ settings.selectingSeatCss + ' a'), function (index, value) {
                                str.push($(this).attr('title'));
                            });
                            alert(str.join(','));
                        })
            
                        $('#btnShowNew').click(function () {
                            var str = [], item;
                            $.each($('#place li.' + settings.selectingSeatCss + ' a'), function (index, value) {
                                item = $(this).attr('title');                   
                                str.push(item);                   
                            });
                            alert(str.join(','));
                        })
                    });
                </script>
            </div>
            </form>
			<!--//main content-->
		</div>
	</div>
	<!--//main-->
	
	<!--footer-->
    <?php
    require_once "footer.php";
    ?>
	<!--//footer-->


</body>
</html>