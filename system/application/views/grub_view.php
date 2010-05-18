<table>
  <tr>
      <td><?php echo img(substr_replace($grub['grub_photo_url'], 'l', -5, 1)); ?></td>
  </tr>
  <tr>
    <td><span class="grub_title"><?php echo $grub['grub_title'];?></span></td>
    <!-- <td><span class="grub_score">Score <?php echo $grub['grub_score'];?></span></td> -->
  </tr>
  <tr><td><br/></td></tr>
  <tr>
    <td><span class="grub_description"><?php echo $grub['grub_description'];?></span></td>
  </tr><br/><br/>
</table>
<br/><br/>
<div id='grub_comments'>
<table>
  <tr>
    <th>Comments<br/><br/></th>
  </tr>
  <?php foreach ($comments as $comment): ?>
    <tr>
      <td><?php echo anchor('user/profile/' . $comment['user_id'], $comment['user_nickname']); ?></td>
    </tr>
    <tr>
      <td><?php echo $comment['comment_body']; ?><br/><br/></td>
    </tr>
  <?php endforeach ?>
  <tr>
    <td><br/>Add Comment</td>
  </tr>
  <tr><td>  
    <?php echo form_open_multipart('grub/addCommentPost/' . $grub['grub_id'], array('id' => 'comment_form')); ?>
    <table>
      <tr>
        <td class = 'form_text_box_td'><?php echo form_textarea(array('name' => 'comment_body', 'value' => set_value('comment_body'), 'rows' => '4', 'cols' => '50', 'maxlength' => '1000')); ?></td>
      </tr>
      <tr>
        <td><?php echo form_submit(array('name' => 'submit', 'value' => 'Submit', 'class' => 'submit_button')); ?></td>
      </tr>
    </table>
  </tr></td>
<?php echo form_close(); ?>
</table>
</div>
  
