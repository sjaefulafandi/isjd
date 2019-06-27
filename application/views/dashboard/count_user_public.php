<div class="row">
    
    <div class="col-lg-7">
        <?php
        echo '<b>Sebaran Anggota </b><br>';

        foreach ($total_users_group->result() as $r_total_users_group)
        {
            echo '&nbsp;&nbsp;'.$r_total_users_group->user_group.'('.$r_total_users_group->jum_user.')<br>';
        }
        ?>
    </div>
    <div class="col-lg-5 col-sm-3">
        <br>
            <div class="panel">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-2">
                            <i class="fa fa-users fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div> [<?php echo $total_users;?>]</div>
                        </div>
                    </div>
                </div>
           </div>
    </div>
</div>
