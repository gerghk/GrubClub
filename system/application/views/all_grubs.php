<table>
  <?php foreach($grubs as $grub): ?>
    <tr>
      <td><span class="grub_title"><?php echo $grub['grub_title'];?></span></td>
      <td><span class="grub_score">Score <?php echo $grub['grub_score'];?></span></td>
    </tr>
    <tr>
      <td><span class="grub_description"><?php echo $grub['grub_description'];?></span><br />
      <br />
      </td>
    </tr>
    <tr>
      <td><img src="<?php echo $grub['grub_photo_url']; ?>"></td>
    </tr>
  <?php endforeach; ?>
</table>
