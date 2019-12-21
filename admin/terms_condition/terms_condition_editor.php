<?php
 include("../template/header.php");
 include("tinymce.php");
?>
<script language="javascript" src="users.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<link rel="stylesheet" href="../../datepicker/jquery-ui.css">
<script src="../../datepicker/jquery-1.10.2.js"></script>
<script src="../../datepicker/jquery-ui.js"></script>


<a href="index.php?cmd=list" class="btn  btn-primary"><i class="fa fa-arrow-circle-left"></i> List</a> <br><br>

		         
	<div class="row">
    <div class="col">
        <section class="card">
            <header class="card-header">
                <div class="card-actions">
                    <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                </div>

                <h2 class="card-title">Terms condition</h2>
            </header>
            <div class="card-body">  
    
                 <form name="frm_about" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
                  <div class="portlet-body">
                 <div class="table-responsive">	
                    <table class="table">
                         <tr>
                         <td valign="top">Content</td>
                         <td>
                            <textarea name="content" id="content"  class="form-control-static" style="width:200px;height:100px;"><?=$content?></textarea>
                         </td>
                     </tr>
                     <tr> 
                         <td align="right"></td>
                         <td>
                            <input type="hidden" name="cmd" value="add">
                            <input type="hidden" name="id" value="<?=$Id?>">			
                            <input type="submit" name="btn_submit" id="btn_submit" value="submit" class="btn btn-primary">
                         </td>     
                     </tr>
                    </table>
                    </div>
                    </div>
              </form>
           
           </div>
        </section>
    </div>
</div>							  
			     
  <script>
	$( ".datepicker" ).datepicker({
		dateFormat: "yy-mm-dd", 
		changeYear: true,
		changeMonth: true,
		showOn: 'button',
		buttonText: 'Show Date',
		buttonImageOnly: true,
		buttonImage: '../../images/calendar.gif',
	});
</script>  			
<?php
 include("../template/footer.php");
?>

