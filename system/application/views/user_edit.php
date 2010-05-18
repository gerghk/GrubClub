<div id="user_profile">

  <h2>Editing <?php echo $user['user_name']; ?>'s profile</h2>
  
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

  <div id="extended_profile">
  
    <div class="validation_errors">
      <?php echo validation_errors(); ?>
    </div>

    <?php echo form_open('user/update'); ?>
    <table>
    
      <tr>
        <td>Gender: </td>
        <td>
          <?php
            $gender_options = array('' => '', 'M' => 'Male', 'F' => 'Female');
            echo form_dropdown('user_gender', $gender_options, $health_record['user_gender']);
          ?>
        </td>
      </tr>
      
      <tr>
        <td>Birthdate: </td>
        <td>
          <?php echo form_input(array('name' => 'user_birthdate', 'id' => 'user_birthdate')); ?>
          <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
          <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
          <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
          <script type="text/javascript">
            $(document).ready(function() {
              <?php $user_birthdate = strtotime($health_record['user_birthdate']); ?>
              $('#extended_profile input#user_birthdate').datepicker({ changeYear: true });
              $('#extended_profile input#user_birthdate').datepicker( "option", "yearRange", '1900:2010' );
              $('#extended_profile input#user_birthdate').val('<?php echo date('m/d/Y', $user_birthdate); ?>');
            });
          </script>
        </td>
      </tr>
      
      <tr>
        <td>Ethnicity: </td>
        <td>
          <?php echo form_input('user_ethnicity', $health_record['user_ethnicity']); ?>
        </td>
      </tr>
      
      <tr>
        <td>Height: </td>
        <td>
          <?php
            $inches = $health_record['user_height'] % 12;
            $feet = ($health_record['user_height'] - $inches) / 12;
            echo form_input('user_height_feet', $feet); echo ' ft ';
            echo form_input('user_height_inches', $inches); echo ' in';
          ?>
        </td>
      </tr>
      
      <tr>
        <td>Weight: </td>
        <td>
          <?php
            echo form_input('user_weight', $health_record['user_weight']); echo ' lbs';
          ?>
        </td>
      </tr>
      
      <tr>
        <td>Weekly Exercise: </td>
        <td>
          <?php
            echo form_input('user_weekly_exercise_hours', $health_record['user_weekly_exercise_hours']); echo ' hours';
          ?>
        </td>
      </tr>
      
      <tr>
        <td>
          <br/>
          <?php echo form_submit('submit', 'Update profile'); ?>
        </td>
      </tr>
    </table>
    
    <?php echo form_close(); ?>
  </div>
</div>
