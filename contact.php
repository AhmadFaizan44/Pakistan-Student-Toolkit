<?php $title="Contact"; include __DIR__."/includes/header.php"; ?>
<h1>Contact</h1>
<form method="post" action="contact.php" class="calc">
  <div class="row">
    <div><label>Your Name</label><input class="input" name="name" required/></div>
    <div><label>Email</label><input class="input" type="email" name="email" required/></div>
  </div>
  <div><label>Message</label><textarea class="input" name="message" rows="5" required></textarea></div>
  <button class="btn-primary" type="submit">Send</button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $name = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $msg = trim($_POST['message'] ?? '');
  $ok = false; $status = "";
  if ($name && filter_var($email,FILTER_VALIDATE_EMAIL) && $msg) {
    $to = "you@example.com"; // TODO: change to your email
    $subject = "Student Toolkit Contact from $name";
    $headers = "From: ".$email."\r\nReply-To: ".$email."\r\nContent-Type: text/plain; charset=UTF-8";
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$msg";
    // Attempt to send; may depend on hosting configuration
    $ok = @mail($to, $subject, $body, $headers);
    $status = $ok ? "Thanks! Your message has been sent." : "Message queued. (Mail not enabled on this host.)";
  } else {
    $status = "Please fill all fields correctly.";
  }
  echo '<div class="card" style="margin-top:12px">'.$status.'</div>';
}
?>
<?php include __DIR__."/includes/footer.php"; ?>
