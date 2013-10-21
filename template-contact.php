<?php
/*
Template Name: Contact Page
*/
?>
<?php 
$nameError = '';
$emailError = '';
$messageError = '';
if(isset($_POST['submitted'])) {
		if(trim($_POST['contactname']) === '') {
			$nameError = __('Please enter your name.', 'sptheme');
			$hasError = true;
		} else {
			$name = trim($_POST['contactname']);
		}
		
		if(trim($_POST['email']) === '')  {
			$emailError = __('Please enter your email address.', 'sptheme');
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = 'You entered an invalid email address.';
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
			
		if(trim($_POST['message']) === '') {
			$messageError = __('Please enter a message.', 'sptheme');
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$messages = stripslashes(trim($_POST['message']));
			} else {
				$messages = trim($_POST['message']);
			}
		}
			
		if(!isset($hasError)) {
			$emailTo = $smof_data['email'];
			if (!isset($emailTo) || ($emailTo == '') ){
				$emailTo = 'info@somagroup.com.kh';
			}
			$subject = 'From '.$name;
			$body = "Name: $name \n\nEmail: $email \n\nComments: $messages";
			$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body, $headers);
			$emailSent = true;
		}
	
} ?>


<?php get_header(); ?>


	<div class="container clearfix">
    
    <h1 class="entry-title"><?php echo the_title(); ?></h1>
    
    <div class="two-fourth">
		
        <?php while ( have_posts() ): the_post(); ?>

			<?php the_content(); ?>

		<?php endwhile; ?>
        
    </div><!-- end .two-fourth -->
    
    <div class="two-fourth last">
		<?php if(isset($emailSent) && $emailSent == true) { ?>
             <div class="success">
                <h5><?php _e('Thanks, your email was sent successfully.', 'sptheme') ?></h5>
            </div>

        <?php } ?>
        <form class="contact-page" action="<?php the_permalink(); ?>" id="contactForm" method="post">
        	<div>
        	<label for="name"><?php _e('Name', 'sptheme'); ?> *</label>
            <input type="text" name="contactname" class="name" value="<?php if(isset($_POST['contactname'])) echo $_POST['contactname'];?>" />
            <?php if($nameError != '') { ?>
                <span class="error"><?php echo $nameError; ?></span> 
            <?php } ?>
            </div>
            <div>
            <label for="email"><?php _e('E-mail', 'sptheme'); ?> *</label>
            <input type="text" name="email" class="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" />
            <?php if($emailError != '') { ?>
                <span class="error"><?php echo $emailError; ?></span>
            <?php } ?>
            </div>
            
            <div>
            <label for="message"><?php _e('Message', 'sptheme'); ?> *</label>
            <textarea name="message" cols="83" rows="5" class="message"><?php if(isset($_POST['message'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['message']); } else { echo $_POST['message']; } } ?></textarea>
            <?php if($messageError != '') { ?>
                <span class="error"><?php echo $messageError; ?></span> 
            <?php } ?>
            </div>
            
            <input type="hidden" name="submitted" id="submitted" value="true" />
            <button id="submit" type="submit" class="button"><?php _e('Send Message', 'sptheme') ?></button>
        </form>
        
    </div><!-- end .two-fourth -->
    
    </div><!-- end .container -->

<?php get_footer(); ?>