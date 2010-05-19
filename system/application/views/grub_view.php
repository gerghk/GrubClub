<?php echo img(substr_replace($grub['grub_photo_url'], 'l', -5, 1)); ?>
<br/><br/>
<div class="yui-g">
  <div class="yui-u first" id="grub_basic_info">
    <p class="grub_title"><?php echo $grub['grub_title'];?></p>
    <p class="grub_description"><?php echo $grub['grub_description'];?></p>
  </div>
  <div class="yui-u" id="grub_details">
    <table>
      <tr>
        <td>Restaurant:</td>  
        <td><?php echo $details['grub_restaurant']; ?></td>
      </tr>
    
      <tr>
        <td>Date of consumption:</td>
        <td>
          <?php
            if(!is_null($details['grub_consumption_date'])) {
              $consumption_time = strtotime($details['grub_consumption_date']);
              echo date('F j, Y', $consumption_time);
            }
          ?>
        </td>
      </tr>
      
      <tr>
        <td>Ingredients:</td>
        <td><?php echo $details['grub_ingredients']; ?></td>
      </tr>
      
      <tr>
        <td>Estimated calories:</td>
        <td><?php echo $details['grub_calories']; ?></td>
      </tr>
    </table>
  </div>
</div>
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
  
