<?php
//echo "<pre>"; print_r($_REQUEST);
$num=$_REQUEST['num'];
if($num!='' || $num>1)
{
for($i=0;$i<$num;$i++)
{
?>
    <div class="form_grid_12">
        <label class="field_title" >Email</label>
            <div class="form_input" >
                <input name="email[]" type="text" tabindex="1" required  style="width:44%;" />
            </div>
    </div>
<?php
}
}
else
{
?>
<div class="form_grid_12">
        <label class="field_title" >Email</label>
            <div class="form_input" >
                <input name="email[]" type="text" tabindex="1" required  style="width:44%;" />
            </div>
    </div>
<?php
}
?>