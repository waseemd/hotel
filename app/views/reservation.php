<?php 
include '../page/header.php';
?>
	<div id="page" class="container">
		<div class="title">
				<h2>Find Reservation By Date</h2>
		</div>
		<div><p>Find and list all reservations that checkin or checkout within the given date range</p></div>
		<form id="search-form" class="search-form date-form" name="form1" method="post" action="">
		<div id="form-message" class="message hide">
                
        </div>	
		<div id="search-bar">	
			<div class="group">
                <label for="date-from">From</label>
                <div class="search-date">
                    <input id="date-from" name="from_date" type="text">
                    <i class="fa fa-calendar"></i>
                </div>
            </div>
             <div class="group">
                <div id="spacer"></div>
            </div>
            <div class="group">
                <label for="date-to">To</label>
                <div class="search-date">
                    <input id="date-to" name="to_date" type="text">
                    <i class="fa fa-calendar"></i>
                </div>
            </div>
            <div class="group search">
                <label class="empty"></label>
                <div><input id="searchbutton" name="search" type="button" value="Search" class="button"/></div>
            </div>
        </div>
        <div id="form-loading" class="hide"><i class="fa fa-circle-o-notch fa-spin"></i></div>
        <input type='hidden' name='function' value='searchByDate'/>
        </form>
        <div id="results" class="hide">
        	<table id="results-table" border='1'>
			    <tr>
			    	<th align="center" >Customer Name</th>
			        <th align="center" >Checkin Date</th>
			        <th align="center" >Checkout Date</th>
			        <th align="center" >Room Type</th>
			        <th align="center" >Room Description</th>
			        <th align="center" >No. Of Guests</th>
			        <th align="center" >Special Requests</th>
			    </tr>
			 </table>
        </div>    
	</div>	
<?php
include '../page/footer.php';      
