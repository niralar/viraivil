<?php 
require_once('../php/sorting.php');
?>
    <div class='subscriberls'>
      <div class="header"><a href="../index.html">
        <img src="../images/logo.png" alt="Viraivil" class="img-rounded" />
		</a>
      </div>
	  <p class="pull-right">Active User : <?php echo $active['rows'] ?> | Inactive User : <?php echo $inactive['rows'] ?> | Total : <?php echo $totalrows['total'] ?> Subscribers</p>
      <div class="subtable">
	  <?php if($totalrows['total']>0) { ?>
      <form method="post" action="../php/action.php">
        <table class='table table-hover'>
          <thead>
            <tr>
              <th></th><?php   foreach ($array as $key=>$value) {
                                    if($key=="id")
                                    $field = str_replace("id","#",$key);
                                    else
                                    $field = str_replace("_"," ",$key);
                                    $field = ucwords($field);
                                    $field = columnSortArrows($key,$field,$orderby,$sort);?>
              <th>
                <?php echo $field ?>
              </th><?php } ?>
            </tr>
          </thead>
          <tbody>
            <?php mysql_data_seek($result,0); while($row = mysql_fetch_assoc($result)){ ?>
            <tr>
              <?php foreach ($row as $field=>$value) { if($field=="id") { ?>
              <td>
                <input name="checkbox[]" type="checkbox" value="<?php echo $value ?>" />
              </td>
              <td>
                <?php echo $value ?>
              </td><?php }else{?>
              <td>
                <?php echo $value ?>
              </td><?php   }}} ?>
            </tr>
          </tbody>
        </table>
        <div class="option">
        <input class="btn btn-primary btn-sm" name="button" type="submit" value="Delete" />
		<input class="btn btn-primary btn-sm" name="button" type="submit" value="Delete All" />
		<input class="btn btn-primary btn-sm" name="button" type="submit" value="Export All" />
        <?php if(!($prev_link==null && $next_link==null && $pagination_links==null)){ ?>
        <ul class="pagination pagination-sm pull-right">
          <?php
                    echo $prev_link;
                    echo $pagination_links;
                    echo $next_link;
                    ?>
        </ul><?php } ?></div>
      </form>
	  </div>
	  <?php } else { ?>
	  <div class="empty">No Subscribers, List Empty !!</div><?php } ?>
    </div>
