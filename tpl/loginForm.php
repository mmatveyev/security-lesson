<form class="form-signin" name="form1" method="post" action="index.php?action=login">
    <h2 class="form-signin-heading">Please sign in</h2>
    <div id="message" class="alert-danger"><?= $message; ?></div>
    <input name="username" id="myusername" type="text" class="form-control" placeholder="Username" autofocus>
    <input name="password" id="mypassword" type="password" class="form-control" placeholder="Password">
    <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

</form>
