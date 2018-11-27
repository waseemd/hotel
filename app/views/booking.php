<?php 
include '../page/header.php';
?>
	<div id="page" class="container">
		<form id="booking-form" class="booking-form" name="form1" method="post" action="">
            <div class="h1">Booking Form</div>
            <div id="form-message" class="message hide">
                Thank you for your enquiry!
            </div>
            <div id="form-content">
                <div class="group">
                    <label for="date-from">From</label>
                    <div class="addon-right">
                        <input id="date-from" name="checkin_date" class="form-control" type="text">
                        <i class="fa fa-calendar"></i>
                    </div>
                </div>
                <div class="group">
                    <label for="date-to">To</label>
                    <div class="addon-right">
                        <input id="date-to" name="checkout_date" class="form-control" type="text">
                        <i class="fa fa-calendar"></i>
                    </div>
                </div>
                <div class="group">
                    <label for="room_type">Room Type</label>
                    <div>
                        <select id="room_type" name="room_type" class="form-control">
                        	<option value="">Select Room Type</option>
		                ?>
		                <?php
		                $roomtypes  = getRoomTypes();
						foreach ($roomtypes as $roomtype) {
		                ?>
		                	<option value="<?php echo $roomtype['id']?>"><?php echo $roomtype['type']?></option>
		                <?php
		            	}
		                ?>           
                        </select>
                    </div>
                </div>
                <div class="group">
                    <label for="room">Room</label>
                    <div>
                        <select id="room-type" name="room_id" class="form-control" disabled required>
                            <option value="">Select Room Type</option>
                            </select>
                    </div>
                </div>
                <div class="group">
                    <label for="guests">Number of Guests</label>
                    <div>
                        <select id="guests" name="guests" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                </div>
                <div class="group">
                    <label for="name">Name</label>
                    <div><input id="name" name="name" class="form-control" type="text" placeholder="Name" required></div>
                </div>
                <div class="group">
                    <label for="email">Email</label>
                    <div><input id="email" name="email" class="form-control" type="email" placeholder="Email" required></div>
                </div>
                <div class="group">
                    <label for="phone">Phone</label>
                    <div><input id="phone" name="phone" class="form-control" type="text" placeholder="Phone" required></div>
                </div>
                <div class="group">
                    <label for="address">Address</label>
                    <div><input id="address" name="address" class="form-control" type="text" placeholder="Address"></div>
                </div>
                <div class="group">
                    <label for="special-requirements">Special requirements</label>
                    <div><textarea id="special-requirements" name="special_requests" class="form-control" cols="" rows="5" placeholder="Special requirements"></textarea></div>
                </div>
                <div class="group submit">
                    <label class="empty"></label>
                    <div><input name="submit" type="submit" value="Submit"/></div>
                </div>
            </div>
            <div id="form-loading" class="hide"><i class="fa fa-circle-o-notch fa-spin"></i></div>
            <input type='hidden' name='function' value='save'/>
        </form>
	</div>
<?php
include '../page/footer.php';      
?>