<div class="page-content">
	<div class="page-header">
		<h1>
			Dialer
			<small>
				<i class="ace-icon fa fa-angle-double-right"></i>
				Dialer
			</small>
		</h1>
	</div><!-- /.page-header -->
	<script type="text/javascript"src="https://media.twiliocdn.com/sdk/js/client/releases/1.3.21/twilio.min.js"></script>
	<script type="text/javascript">
		var caller_id = '';
		var client_id = 0;
		Twilio.Device.setup("<?php echo $token; ?>");
		Twilio.Device.ready(function (device) {
			$("#log").text("Ready");
			setTimeout(function(){
				nextusers();
			},100);
		});
		Twilio.Device.error(function (error) {
			$("#log").text("Error: " + error.message);
		});
		Twilio.Device.connect(function (conn) {
			$("#log").text("Successfully established call");
		});
		Twilio.Device.disconnect(function (conn) {
			$("#log").text("Call ended");
			callended();
		});
		function call() {
			params = {"PhoneNumber": $("#number").val(),"client_id": client_id,"caller_id": caller_id,"user_id": '<?php echo $this->Session->read('Customer.id');?>'};
			Twilio.Device.connect(params);
		}
		function hangup(){
			Twilio.Device.disconnectAll();
			$("#log").text("Ready");
		}
		function nextusers(){
			$.ajax({
				url: "<?php echo SITEURL ?>dialers/nextusers",
				type: "POST",
				dataType: "html",
				success: function(response) {
					if(response !=''){
						var dial_number_id = $("#dial_number_id").val();
						var result = response.split('-');
						if(result[0] > 0){
							$("#dial_number_id").val(result[0]);
						}
						if(result[1]!=''){
							$("#number").val(result[1]);
						}
						if(result[2]!=''){
							client_id = result[2];
						}
						if(result[3]!=''){
							caller_id = result[3];
						}
						if(dial_number_id !=result[0]){
							call();
						}
					}
				}
			});
		}
		function savenotes(){
			var dial_number_id = $("#dial_number_id").val();
			if(dial_number_id > 0){
				var message = $("#message").val();
				if(message !=''){
					$.ajax({
						url: "<?php echo SITEURL ?>dialers/savenotes",
						type: "POST",
						dataType: "html",
						data: {message:message,dial_number_id:dial_number_id},
						success: function(response) {
							$("#message").val('');
						}
					});
				}else{
					alert("Please enter message");
					return false;
				}
			}else{
				alert("No call right now.please try again");
				return false;
			}
		}
		function callstablished(){
			var dial_number_id = $("#dial_number_id").val();
			if(dial_number_id  > 0){
				$.ajax({
					url: "<?php echo SITEURL ?>dialers/callstablished",
					type: "POST",
					dataType: "html",
					data: {dial_number_id:dial_number_id},
					success: function(response) {
					}
				});
			}
		}
		function callended(){
			callstablished();
			var delay = $("#delay").val();
			if(delay > 10){
				delay = delay * 1000;
			}else{
				delay = 10000;
			}
			setTimeout(function(){
				$("#dial_number_id").val('');
				$("#number").val('');
				$("#message").val('');
				setInterval(function(){
					nextusers();
				},3000);
			},delay);
		}
    </script>
	<style>
		#log {
		  width: 100%;
		  max-width: 466px;
		  background: #404040;
		  padding: 10px;
		  margin-top: 0.75em;
		  margin-bottom: 0.75em;
		  text-align: center;
		  border: 1px solid #d4d4d4;
		  text-decoration: none;
		  font:18px/normal sans-serif;
		  color: white;
		  white-space: nowrap;
		  outline: none;
		  background-color: #404040;
		  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#000), to(#404040));
		  background-image: -moz-linear-gradient(#000, #404040);
		  background-image: -o-linear-gradient(#000, #404040);
		  background-image: linear-gradient(#000, #404040);
		  -webkit-background-clip: padding;
		  -moz-background-clip: padding;
		  -o-background-clip: padding-box;
		  /*background-clip: padding-box;*/ /* commented out due to Opera 11.10 bug */
		  -webkit-border-radius: 5px;
		  -moz-border-radius: 5px;
		  line-height: 25px;
		  border-radius: 5px;
		  /* IE hacks */
		  zoom: 1;
		  *display: inline;
		}

		#people {
			position:fixed;
			bottom:0px;
			right: 0px;
			height:100%;
			width:200px;
			margin: 0;
			padding: 0;
			list-style: none;
			font-family:'Helvetica','Arial';
			text-align: left;
			background-color:#ee0000 !important;
			border:none !important;
			overflow: auto;
			overflow-x: hidden;

		}

		#people li {
			position:relative;
			width: 100%;
			display:block;
			color:#eee !important;
			background-color:#ff0000!important;
			border:solid 1px #ee0000 !important;
			padding: 0.5em 0 0.5em 1em;
			background: #f7f2ea;
			cursor: pointer;
		}

		#people li:HOVER {
			color: #fff;
			background-color:#dd0000!important;
		}

		#people li:ACTIVE {
			color: #fff;
			background-color:#C00 !important;
		}



		/* ------------------------------------------------------------------------------------------------------------- BUTTON */

		button.call, button.hangup, input {
			-moz-box-shadow: 1px 2px 10px #BBB;
			-webkit-box-shadow: 1px 2px 10px #BBB;
			box-shadow: 1px 2px 10px #BBB;
		}

		button.call, button.hangup {
			position: relative;
			overflow: visible;
			display: inline-block;
			padding: 0.5em 1em;
			border: 1px solid #d4d4d4;
			margin: 25px auto 0 auto;
			text-decoration: none;
			text-shadow: 1px 1px 0 #fff;
			font:35px/normal sans-serif;
			font-weight: bold;
			color: #333;
			white-space: nowrap;
			cursor: pointer;
			outline: none;
			background-color: #ececec;
			background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#f4f4f4), to(#ececec));
			background-image: -moz-linear-gradient(#f4f4f4, #ececec);
			background-image: -o-linear-gradient(#f4f4f4, #ececec);
			background-image: linear-gradient(#f4f4f4, #ececec);
			-webkit-background-clip: padding;
			-moz-background-clip: padding;
			-o-background-clip: padding-box;
			/*background-clip: padding-box;*/ /* commented out due to Opera 11.10 bug */
			-webkit-border-radius: 10px;
			-moz-border-radius: 10px;
			border-radius: 10px;
			/* IE hacks */
			zoom: 1;
			*display: inline;
		}

		button.call:hover,
		button.call:focus,
		button.call:active,
		button.call.active,
		button.hangup:hover,
		button.hangup:focus,
		button.hangup:active,
		button.hangup.active {
			border-color: #3072b3;
			border-bottom-color: #2a65a0;
			text-decoration: none;
			text-shadow: -1px -1px 0 rgba(0,0,0,0.3);
			color: #fff;
			background-color: #3C8DDE;
			background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ff0000), to(#dd0000));
			background-image: -moz-linear-gradient(#599bdc, #3072b3);
			background-image: -o-linear-gradient(#599bdc, #3072b3);
			background-image: linear-gradient(#599bdc, #3072b3);
		}

		button.call:active,
		button.call.active,
		button.hangup:active,
		button.hangup.active {
			border-color: #2a65a0;
			border-bottom-color: #3884CF;
			background-color: #3072b3;
			background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#3072b3), to(#599bdc));
			background-image: -moz-linear-gradient(#3072b3, #599bdc);
			background-image: -o-linear-gradient(#3072b3, #599bdc);
			background-image: linear-gradient(#3072b3, #599bdc);
		}

		/* overrides extra padding on button elements in Firefox */
		button.call::-moz-focus-inner,
		button.hangup::-moz-focus-inner {
			padding: 0;
			border: 0;
		}

		input {
		  display: block;
		  outline: none;
		  border: 1px solid #999;
		  line-height: 1.4em;
		  font-size: 24px;
		  padding: 10px;
		  width: 100%;
		  max-width: 466px;
		  text-align: center;
		  margin-top: 0.75em;
		}
		.sendernumber {
		  display: block;
		  outline: none;
		  border: 1px solid #999;
		  line-height: 1.4em;
		  font-size: 24px;
		  padding: 10px;
		  width: 100%;
		  max-width: 466px;
		  text-align: center;
		  margin-top: 0.75em;
		}

		/* ............................................................................................................. Icons */

		button.call:before,
		button.hangup:before {
			content: "";
			position: relative;
			top: 1px;
			float:left;
			width: 44px;
			height: 37px;
			margin: 0 0.75em 0 -0.25em;
			background: url(<?php echo SITEURL;?>img/buttons.png) 0 99px no-repeat;
		}

		button.call:before { background-position: 0 -48px; }
		button.call:hover:before,
		button.call:focus:before,
		button.call:active:before { background-position: 0 0; }

		button.call {
		   margin-right: 25px;
		}

		button.hangup:before { background-position: 0 -131px; }
		button.hangup:hover:before,
		button.hangup:focus:before,
		button.hangup:active:before { background-position: 0 -88px; }
    </style>
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-6 col-sm-6">
				<div class="panel">
					<div class="panel-header">
						<div class="panel-title">Power dialer</div>
					</div>
					<div class="panel-body">
						<button class="call" onclick="call();">
						  Call
						</button>
						<button class="hangup" onclick="hangup();">
						  Hangup
						</button>	
						<input type="text" id="number" name="number" placeholder="Enter a phone number to call" readonly/>
						<input type="text" id="delay" name="delay" placeholder="Delay in seconds" value="30"/>
						<div id="log">Loading pigeons...</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6">
				<div class="panel">
					<div class="panel-header">
						<div class="panel-title">Add Notes</div>
					</div>
					<div class="panel-body">
						<form action="" method="post" enctype='multipart/form-data'>
							<input type="hidden" id="dial_number_id" value="" name="dial_number_id"/>
							<div class="form-body">
								<div class="form-group">
									<label class="control-label"></label>
									<textarea id="message" class="form-control" name="message" placeholder="Message" style="height:180px"></textarea>
								</div>
							</div><!-- /.form-body -->
							<div class="form-body">
								<div class="pull-right">
									<button class="btn btn-success" type="button" onclick="return savenotes();">Save</button>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.form-footer -->
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
