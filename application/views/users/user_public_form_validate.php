<form class="cmxform" id="commentForm" method="get" action="">
  <fieldset>
    <legend>Please provide your name, email address (won't be published) and a comment</legend>
    <p>
      <label for="cname">Name (required, at least 2 characters)</label>
      <input id="cname" name="name" minlength="2" type="text" required>
    </p>
    <p>
      <label for="cemail">E-Mail (required)</label>
      <input id="cemail" type="email" name="email" required>
    </p>
    <p>
      <label for="curl">URL (optional)</label>
      <input id="curl" type="url" name="url">
    </p>
    <p>
      <label for="ccomment">Your comment (required)</label>
      <textarea id="ccomment" name="comment" required></textarea>
    </p>
    <p>
      <input class="submit" type="submit" value="Submit">
    </p>
  </fieldset>
</form>
<script>
$("#commentForm").validate();
</script>




<div class="form-group form-group-sm" id="user_public_submission_form" role="form" >
  <div class="row">
    <div class="col-sm-12"> Form Daftar Peserta</div>
  </div>
  <div class="row">
    <div class="col-sm-8"> Nama Lengkap
      <input type="input" class="form-control input-sm" id="nama_lengkap" required>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-8"> Email
    <input type="input" class="form-control input-sm " id="emails">
    </div>
  </div>
  <div class="row">
    <div class="col-sm-8"> Kelompok User
    <select id="user_groups" class="form-control input-sm">
      
      <?php
      // print_r($user_group);
      foreach ($user_group->result() as $row_user_group)
      {
        echo '<option value="'.$row_user_group->id_user_group.'">'.$row_user_group->user_group;//echo $row_user_group->user_group.'<br>';
      }
      ?>
      </select>
  
    </div>
  </div>
  <div class="row">
    <div class="col-sm-4"> User Name
    <input type="input" id="user_name" class="form-control input-sm">
    </div>
  </div>
  <div class="row">
    <div class="col-sm-4"> Password
      <input type="password" id="passwords" class="form-control input-sm">
    </div>
  </div>
  <div class="row">
    <div class="col-sm-4"> Re-Password
      <input type="password" id="password2" class="form-control input-sm">
    </div>
  </div>
  <div class="row">
    <div class="col-sm-8"><br>
      <input type="button" onclick="saveformdaftar();" class="btn btn-primary btn-xs" id="btn_submit" value="Kirim">
    </div>
  </div>

</div>
<script>
  $("#user_public_submission_form").validate();
</script>