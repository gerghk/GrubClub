<html>
<head>
<title>Chow Hub</title>
</head>

<body>
<?php echo phpinfo(); ?>
  <table>
    <?php foreach($grubs as $grub): ?>
      <tr>
        <td><span class="grub_title"><?php echo $grub['grub_title'];?></span></td>
        <td><span class="grub_score">Score <?php echo $grub['grub_score'];?></span></td>
      </tr>
      <tr>
        <td><span class="grub_description"><?php echo $grub['grub_description'];?></span><br/><br/></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>