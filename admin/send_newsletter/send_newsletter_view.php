<?php
  include("../template/header.php");
  include("tinymce.php");
?>
<?php
  if($msg)
  {
  	echo "<b>".$msg."</b>";
  }
?>

    
<div class="row">
    <div class="col">
        <section class="card">
            <header class="card-header">
                <div class="card-actions">
                    <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                </div>

                <h2 class="card-title">News letter</h2>
            </header>
            <div class="card-body">
               <form name="form_data" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			

                <table class="table table-bordered table-striped mb-0" id="datatable-default">
                    <tbody>
                     <tr>
                       <td>Select Name</td>
                       <td>
                        <?php
							$info["table"] = "news_letter";
							$info["fields"] = array("news_letter.*"); 
							$info["where"]   = "1";
							$arr =  $db->select($info);
						?>
                        <select name="news_letter" class="form-control" onChange="loadData(this.value);">
                            <option>Select</option>
                            <?php
							  for($i=0;$i<count($arr);$i++)
								{
							?>
                             <option value="<?=$arr[$i]['id']?>" <?php if($_REQUEST['news_letter']==$arr[$i]['id']){ echo "selected";} ?>><?=$arr[$i]['name']?></option>
                            <?php
								}
							?>
                        </select>                        
                        <input type="hidden" name="cmd" value="load">
                       </td>
                     </tr>
                    </table> 
                </form>
          </div>
        </section>
    </div>
</div>				
<div class="row">
    <div class="col">
        <section class="card">
            <header class="card-header">
                <div class="card-actions">
                    <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                </div>

                <h2 class="card-title">News letter</h2>
            </header>
            <div class="card-body">             
             
                <form name="form_data2" action="" method="post">
                   <table cellspacing="3" cellpadding="3" width="100%">                    
                    <tr>
						 <td valign="top">Content</td>
						 <td>
						    <textarea name="content" id="content"  class="form-control" style="width:200px;height:100px;"><?=$content?></textarea>
                         </td>
				     </tr>
                     <tr>
						 <td valign="top"></td>
						 <td>
                            <input type="hidden" name="cmd" value="send">
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary"> 
                         </td>
				     </tr>
                    </table> 
                 
              </form>
           
           </div>
        </section>
    </div>
</div>						
        
        <script language="javascript">
		   function loadData(value)
		   {
			   document.forms["form_data"].submit();

		   }
		</script>
        
        
<?php
include("../template/footer.php");
?>









