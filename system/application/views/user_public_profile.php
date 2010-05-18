<div id="user_profile">

  <h2>
    <?php echo $user['user_name']; ?>'s profile
    <?php
      $user_session = $this->session->userdata('user');
      if($user['user_id'] === $user_session['user_id']) {
        
        echo '('.anchor('user/edit', 'Edit').')';
      }
    ?>
  </h2>
  
  <div id="basic_profile">
  
    <table>
      
      <tr>
        <td>Nickname: </td>
        <td><?php echo $user['user_nickname']; ?></td>
      </tr>
      
      <tr>
        <td>Email: </td>
        <td><?php echo $user['user_email']; ?></td>
      </tr>
      
      <tr>
        <td>Reputation: </td>
        <td><?php echo $user['user_reputation']; ?></td>
      </tr>
    </table>
  </div>
  </div>
</div>

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
