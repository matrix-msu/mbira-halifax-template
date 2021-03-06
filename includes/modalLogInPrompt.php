<?php if($pgType == 'plc') { ?>
    <div id='modalLogInPrompt' class='modal'>
<?php } ?>
        
<?php if($pgType == 'exp') { ?>
    <div id='modalLogInExpPrompt' class='modal'>
<?php } ?>
	<div>
		<div class="modalHeader">
			<div class="modalTitle">You need to sign in first...</div>
		</div>
		<div class='modal-x-btn '>
			<img src='assets/svgs/close.svg' class='closeModalLogInPrompt' />
		</div>
		<form id="loginPrompt" name="loginPrompt" action="login-post.php" method="post">
			<div class='modalContent'>
				<div class="rightLinkCont">
					<input type="email" name="usermail" placeholder="Your Email">
					<a href="signUp.php" class="rightLink" id="signUpLink">Or Sign Up</a>
				</div>
				<div class="rightLinkCont">
					<input type="password" name="password" placeholder="Your Password">
					<a href="#" class="rightLink forgotPassword" id="forgotPasswordLink">Forgot Password?</a>
				</div>
                <input type="hidden" name="page" value="<?php echo $redirectLocation; ?>">
			</div>
            <?php if($pgType == 'plc') { ?>
    			<a href="placeSingle-Conversation.php?id=<?php echo $_GET['id']?>&type=<?php echo $_GET['type']?>" onclick="this.parentNode.submit(); return false;" class="modalBottomButton">SIGN IN</a>
            <?php } ?>
            
            <?php if($pgType == 'exp') { ?>
    			<a href="explorationSingle-Conversation.php?id=<?php echo $_GET['id']?>" onclick="this.parentNode.submit(); return false;" class="modalBottomButton">SIGN IN</a>
            <?php } ?>
		</form>
	</div>
</div>
        
<?php
$pgType = "";                                     
include('includes/modalForgotPassword.php'); 
?>

<script>
$('.forgotPassword').click(function() {
	$('#modalForgotPasswordPrompt').addClass('displayModal');
	$('body').addClass('modal-open');
	return false;
});

$('#modalLogInPrompt').click(function(e){
      if (e.target !== this)
        return;

    $('#modalLogInPrompt').removeClass('displayModal');
    $('body').removeClass('modal-open');    
})

$('.closeModalPwdPrompt').click(function() {
	$('#modalForgotPasswordPrompt').removeClass('displayModal');
	$('body').removeClass('modal-open');
});
</script>
