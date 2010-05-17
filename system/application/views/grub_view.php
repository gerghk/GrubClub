<table>
  <?php foreach($grubs as $grub):?>
    <tr>
      <td><span class="grub_title"><?php echo $grub['grub_title'];?></span></td>
      <td><span class="grub_score">Score <?php echo $grub['grub_score'];?></span></td>
    </tr><br/>
    <tr>
      <td><span class="grub_description"><?php echo $grub['grub_description'];?></span></td>
    </tr><br/><br/>
    
  <?php endforeach;?>
</table>

