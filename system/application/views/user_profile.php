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
  
  <div id="extended_profile">
  
    <table>
    
      <tr>
        <td>Gender: </td>
        <td>
          <?php
            if(!is_null($health_record['user_gender'])) {
              if($health_record['user_gender'] == 'M') {
                echo 'Male';
              }
              else {
                echo 'Female';
              }
            }
          ?>
        </td>
      </tr>
      
      <tr>
        <td>Birthdate: </td>
        <td>
          <?php
            if(!is_null($health_record['user_birthdate'])) {
              $birthdatetime = strtotime($health_record['user_birthdate']);
              echo date('F j, Y', $birthdatetime);
            }
          ?>
        </td>
      </tr>
      
      <tr>
        <td>Ethnicity: </td>
        <td>
          <?php
            if(!is_null($health_record['user_ethnicity'])) {
              echo $health_record['user_ethnicity'];
            }
          ?>
        </td>
      </tr>
      
      <tr>
        <td>Height: </td>
        <td>
          <?php
            if(!is_null($health_record['user_height'])) {
              $inches = $health_record['user_height'] % 12;
              $feet = ($health_record['user_height'] - $inches) / 12;
              echo $feet.' ft '.$inches.' in';
            }
          ?>
        </td>
      </tr>
      
      <tr>
        <td>Weight: </td>
        <td>
          <?php
            if(!is_null($health_record['user_weight'])) {
              echo $health_record['user_weight'].' lbs';
            }
          ?>
        </td>
      </tr>
      
      <tr>
        <td>Weekly Exercise: </td>
        <td>
          <?php
            if(!is_null($health_record['user_weekly_exercise_hours'])) {
              echo $health_record['user_weekly_exercise_hours'].' hours';
            }
          ?>
        </td>
      </tr>
    </table>
  </div>
</div>
