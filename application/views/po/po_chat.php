<style>
3
4
5
6
7
8
9
10
11
12
13
14
15
16
17
18
19
20
21
22
23
24
25
26
27
28
29
30
31
32
33
34
35
36
37
38
39
40
41
42
43
44
45
46
47
48
49
50
51
52
53
54
55
56
57
58
59
.chat
{
    list-style: none;
    margin: 0;
    padding: 0;
}
 
.chat li
{
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
}
 
.chat li.left .chat-body
{
    margin-left: 60px;
}
 
.chat li.right .chat-body
{
    margin-right: 60px;
}
 
 
.chat li .chat-body p
{
    margin: 0;
    color: #777777;
}
 
.panel .slidedown .glyphicon, .chat .glyphicon
{
    margin-right: 5px;
}
 
.panel-body
{
    overflow-y: scroll;
    height: 250px;
}
 
::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}
 
::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}
 
::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}
</style>

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
	<!-- http://bootsnipp.com/snippets/4jXW -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/chat.css" />
	
	
	<script type="text/javascript">	  
		$( document ).ready ( function () {
			
			$('#nickname').keyup(function() {
				var nickname = $(this).val();
				
				if(nickname == ''){
					$('#msg_block').hide();
				}else{
					$('#msg_block').show();
				}
			});
			
			// initial nickname check
			$('#nickname').trigger('keyup');
		});
		
		
	</script>
 
</head>
<body>
 
 
 
<div class="container">
    <div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<span class="glyphicon glyphicon-comment"></span> Chat
			</div>
			<div class="panel-body">
				<ul class="chat" id="received">
					
				</ul>
			</div>
			<div class="panel-footer">
				<div class="clearfix">
					<div class="col-md-3">
						<div class="input-group">
							<span class="input-group-addon">
								Nickname:
							</span>
							<input id="nickname" type="text" class="form-control input-sm" placeholder="Nickname..." />
						</div>
					</div>
					<div class="col-md-9" id="msg_block">
						<div class="input-group">
							<input id="message" type="text" class="form-control input-sm" placeholder="Type your message here..." />
							<span class="input-group-btn">
								<button class="btn btn-warning btn-sm" id="submit">Send</button>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
 