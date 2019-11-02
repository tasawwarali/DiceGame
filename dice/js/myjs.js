$(document).ready(function(){

	// Flag representing the state, login or register.
	var isLogin = 1;
	var BaseURL = 'http://localhost/';

	// secondaray button click
	$("#sec_btn").click(function () {
		if( isLogin == 1 ) {
			isLogin = 0;
			$("#age_div").slideDown("slow");
			$("#info").html('Or Login Here');
			$("#pri_btn").html('Register');
			$("#sec_btn").html('Login');
		} else {
			isLogin = 1;
			$("#age_div").slideUp("slow");
			$("#info").html('Or Register Youeself Here');
			$("#pri_btn").html('Login');
			$("#sec_btn").html('Register');
		}
	});

console.log('hello Alone');
console.log('Yui Ballad');

	$("#pri_btn").click(function (e) {

		e.preventDefault();


		if( !validator() ) {
			return false;
		}

		uname 	= $("#uname").val();
		pass 	= $("#password").val();
		age 	= $("#age").val();


		if( isLogin == 1 ) {
			URL = 'login_player.php';
		} else {
			URL = 'register_player.php';
		}

		$.ajax({
			type: 'POST',
			url: URL,
			data: {"uname" : uname , "pass" : pass , "age" : age},
			dataType: 'json',
			success: function (result) {
				if (result.success == 1) {
					// alert('success');
					location.href = BaseURL+"dice/home.php";
				} else {
					alert("Error: "+result.message);
				}
			}

		});
	});


	function validator(){

		$("#u_alert").html('');
		$("#p_alert").html('');

		uname 	= $("#uname").val();
		pass 	= $("#password").val();

		if( uname == '' || pass == '') {
			if( uname == '' ) {
				$("#u_alert").html('This Field is Required!');
			}
			if( pass == '' ) {
				$("#p_alert").html('This Field is Required!');
			}

			return false;
		} else {
			return true;
		}
	}


	var is_p1 = 0;
	var turn_count = 0;
	var your_total = 0;
	var op_total = 0;
	var stop = 0;
	var my_dice;

	var ccc;

	var your_turn = 0;

	var score_id = 0;


	function get_rand () { 
		return ( Math.floor( (Math.random()*6) + 1 ) );
	};


	$("#roll").click(function () {
		stop = 1;
		$("#roll").attr('disabled' , 'disabled');
		my_dice = setInterval(roll_dice, 50);
	});


	function roll_dice () {
		r = get_rand ();
		$("#die").html(r);
	}


	$("#stop").click(function () {
		if( stop == 1 ) {
			$("#roll").removeAttr('disabled');
			clearInterval(my_dice);
			d_val = $("#die").html();
			your_total = your_total + parseInt(d_val);
			$("#score").html(your_total);
			$("#your_total").html(your_total);

			stop = 0;
			turn_count++;

		}

		if( turn_count >= 2 ) {
			save_score();
		}
	});


	function save_score() {
		$("#stop").attr("disabled" , "disabled");
		$("#turn").html("Saving Your Score");
		$.ajax({
			type: 'POST',
			url: 'save_score.php',
			data: {"is_p1" : is_p1 , "score" : your_total , "score_id" : score_id},
			dataType: 'json',
			success: function (result) {
				if (result.success == 1) {
					$("#turn").html("Your Opponent Turn");
				}
				else if (result.success == 2) {
					$("#turn").html(result.message);
				}
				else {
					alert("Error: "+result.message);
				}
			}
		});
	}


	$(".cha_btn").click(function(e) {
		// alert('sa'+e);
		console.log(e.currentTarget.id);
		$.ajax({
			type: 'POST',
			url: 'challenge.php',
			data: {"player_id" : e.currentTarget.id},
			dataType: 'json',
			success: function (result) {
				if (result.success == 1) {
					score_id = result.score_id;
					is_p1 = 1;
					your_turn = 1;
					$("#list").css('display', 'none');
					$("#game_box").slideDown("slow");
				} else {
					alert("Error: "+result.message);
				}
			}
		});
	});

	ccc = setInterval(checking_player, 1200);

	function checking_player() {
		console.log('ccc');
		$.ajax({
			type: 'POST',
			url: 'check_challenge.php',
			data: {},
			dataType: 'json',
			success: function (result) {
				if (result.success == 1) {
					score_id = result.score_id;
					$("#list").css('display', 'none');
					$("#game_box").slideDown("slow");
					$("#op_total").html(result.op_score);
				} else {
					// alert("Error: "+result.message);
				}
			}
		});
	}

});



