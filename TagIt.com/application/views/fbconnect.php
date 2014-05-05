<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Facebook PHP SDK</title>
</head>
<body>
<div>
  <?php if(!$fb_data['me']): ?>
  Login with Facebook: <a href="<?php echo $fb_data['loginUrl']; ?>">login</a>
  <?php else: ?>
  <img src="https://graph.facebook.com/<?php echo $fb_data['uid']; ?>/picture" alt="" class="pic" />
  <p>Hi <?php echo $fb_data['me']['name']; ?><br></br>
  </p>
  <p>
  <a href="home/topsecret"></a> or <a href="<?php echo $fb_data['logoutUrl']; ?>">logout</a> </p>
  <?php endif; ?>
</div>
</body>
</html>