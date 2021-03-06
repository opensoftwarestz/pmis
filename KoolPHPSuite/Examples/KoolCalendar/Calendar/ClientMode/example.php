<?php
	/*
	 * This file is ready to run as standalone example. However, please do:
	 * 1. Add tags <html><head><body> to make a complete page
	 * 2. Change relative path in $KoolControlFolder variable to correctly point to KoolControls folder 
	 */

	$KoolControlsFolder = "../../../../KoolControls";//Relative path to "KoolPHPSuite/KoolControls" folder
	
	require $KoolControlsFolder."/KoolCalendar/koolcalendar.php";	
	
	$cal = new KoolCalendar("cal"); //Create calendar object
	$cal->scriptFolder = $KoolControlsFolder."/KoolCalendar";//Set scriptFolder
	$cal->styleFolder="default";

	//Enabled client mode
	$cal->ClientMode = true;
	
	
	//MultiView setting
	$cal->MultiViewColumns = 2;
	$cal->MultiViewRows = 1;	

	//Multi Selection setting
	$cal->EnableMultiSelect = true; //Enable MultiSelection
	$cal->UseColumnHeadersAsSelectors = true; //Able to select multi date by clicking to column header
	$cal->UseRowHeadersAsSelectors = true; //Able to select multi date by clicking to row header
	$cal->ShowViewSelector = true;
	
	//Init calendar before render
	$cal->Init();
?>

<form id="form1" method="post">	
	<div style="padding-top:20px;padding-bottom:40px;width:650px;<?php if ($style_select=="black") echo "background:#333"; ?>">
		<?php echo $cal->Render();?>
		
		<div style="padding-top:10px;">
			<input type="submit" value="Submit" />
		</div>
		<div style="padding-top:10px;">
			<?php
				if($cal->SelectedDates!=null)
				{
					echo "<b>Selected Dates:</b>";
					for($i=0;$i<sizeof($cal->SelectedDates);$i++)
					{
						echo " [".date("Y-m-d",$cal->SelectedDates[$i])."] ";
					}
				}
			?>
		</div>		
	</div>
</form>
