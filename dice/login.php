<?php
    require_once('header.php');
?>

<div class="form">
    <h2 id="title" >Please Login Here</h2>

    <div>
        <label for="fname">Username</label>
        <input type="text" required id="uname" name="uname" placeholder="Your Username...">
        <p class="alert" id="u_alert" ></p>

        <label for="pass">Password</label>
        <input type="password" required id="password" name="password" placeholder="Your Password...">
        <p class="alert" id="p_alert" ></p>

        <div id="age_div" style="display: none">
            <label for="pass">Age</label>
            <input type="text" id="age" name="age" placeholder="Your Age...">
        </div>
        <br>

        <button id="pri_btn" class="login_btn">Login</button>

    </div>

    <hr>
    <p id="info" >Or Register Youeself Here</p>
    <button id="sec_btn" class="login_btn" >Register</button>
</div>


<?php
    require_once('footer.php');
?>
