<table>
  <?php foreach($grubs as $grub): ?>
    <tr>
      <td><?php 
            $img_props = array ('src' => $grub['grub_photo_url'], 'class' => 'grub_thumb');
            echo img($img_props);?>
      </td>
      <td>
        <table>
          <tr>
            <td><span class="grub_title"><?php echo anchor('grub/view/' . $grub['grub_id'], $grub['grub_title']);?></span></td>
            <!-- <td><span class="grub_score">Score <?php echo $grub['grub_score'];?></span></td> -->
          </tr>
          <tr>
            <td><span class="grub_user">Posted by: <?php echo anchor('user/show/'.$grub['user_id'], $grub['user_nickname']);?></span></td>
          </tr>
          <tr><td><br/></td></tr>
          <tr>
            <td><span class="grub_description"><?php echo $grub['grub_description'];?></span><br />
            <br />
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr><td><br/><br/></td></tr>
  <?php endforeach; ?>
</table>
