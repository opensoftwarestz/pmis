<?php
	/*
	 * This file is ready to run as standalone example. However, please do:
	 * 1. Add tags <html><head><body> to make a complete page
	 * 2. Change relative path in $KoolControlFolder variable to correctly point to KoolControls folder 
	 */

	$KoolControlsFolder = "../../../../KoolControls";//Relative path to "KoolPHPSuite/KoolControls" folder
	
    require $KoolControlsFolder."/KoolAjax/koolajax.php";
	$koolajax->scriptFolder = $KoolControlsFolder."/KoolAjax";

	if(isset($_POST["load"]))
	{
		switch($_POST["load"])
		{
			case "treeview":
				require $KoolControlsFolder."/KoolTreeView/kooltreeview.php";

				$control = new KoolTreeView("control");
				$control->scriptFolder = $KoolControlsFolder."/KoolTreeView";
				$control->imageFolder=$KoolControlsFolder."/KoolTreeView/icons";
				$control->styleFolder="default";
				
				$root = $control->getRootNode();
				$root->text = "My Properties";
				$root->expand=true;
				$root->image="woman2S.gif";
				$control->Add("root","hardware","Hardware",false,"xpNetwork.gif","");
				$control->Add("hardware","laptop","HP dv2500 Laptop",false,"square_blueS.gif","");	
				$control->Add("hardware","desktop","Lenovo desktop",false,"square_greenS.gif","");
				$control->Add("hardware","lcd","Asus 19\" LCD",false,"square_redS.gif","");
				
				$control->Add("root","software","Software",true,"ie.gif","");
				$control->Add("software","os","Operating System",true,"bfly.gif","");
				$control->Add("os","linux","Ubuntu 8.10",false,"ball_redS.gif","");
				$control->Add("os","windows","Vista Home Edition",false,"ball_blueS.gif","");
				$control->Add("software","office","Office",false,"doc.gif","");
				$control->Add("office","msoffice","Microsoft Office 2007",false,"square_redS.gif","");
				$control->Add("office","ooffice","Open Office 2.4",false,"square_greenS.gif","");
				$control->Add("software","burning","Burn CD/DVD",false,"xpShared.gif","");
				$control->Add("burning","nero","Nero 8",false,"triangle_yellowS.gif","");
				$control->Add("burning","k3b","K3B <i>(on Ubuntu)</i>",false,"triangle_blueS.gif","");
				$control->Add("software","imageeditor","Image editors",false,"goblet_bronzeS.gif","");
				$control->Add("imageeditor","photoshop","Photoshop 10",false,"ball_glass_blueS.gif","");
				$control->Add("imageeditor","gimp","GIMP 2.3.4",false,"ball_glass_greenS.gif","");
				
				$control->Add("root","book","Books",false,"book.gif","");
				$control->Add("book","ajax","Ajax For Dummies",false,"BookY.gif","");
				$control->Add("book","csharp","Mastering C#",false,"BookY.gif","");
				$control->Add("book","flash","Flash 8 Bible",false,"BookY.gif","");
				$control->showLines = true;
					
				break;
			case "listbox":
				require $KoolControlsFolder."/KoolListBox/koollistbox.php";
				$control = new KoolListBox("control");
				$control->styleFolder ="default";
				$control->AddItem(new ListBoxItem("Agentina"));
				$control->AddItem(new ListBoxItem("Australia"));
				$control->AddItem(new ListBoxItem("Brazil"));
				$control->AddItem(new ListBoxItem("Canada"));
				$control->AddItem(new ListBoxItem("Chile"));
				$control->AddItem(new ListBoxItem("China"));
				$control->AddItem(new ListBoxItem("Egypt"));
				$control->AddItem(new ListBoxItem("England"));
				$control->AddItem(new ListBoxItem("France"));
				$control->AddItem(new ListBoxItem("Germany"));
				$control->AddItem(new ListBoxItem("India"));
				$control->AddItem(new ListBoxItem("Indonesia"));
				$control->AddItem(new ListBoxItem("Kenya"));
				$control->AddItem(new ListBoxItem("Mexico"));
				$control->AddItem(new ListBoxItem("New Zealand"));
				$control->AddItem(new ListBoxItem("South Africa"));
				$control->AddItem(new ListBoxItem("USA"));
				
				$control->ButtonSettings->ShowDelete = true;
				$control->ButtonSettings->ShowReorder = true;
				
				$control->Init();
				break;
			case "menu":
				require $KoolControlsFolder."/KoolMenu/koolmenu.php";
				
				$control = new KoolMenu("control");
				$control->scriptFolder = $KoolControlsFolder."/KoolMenu";
				$control->styleFolder="default";
				
				$control->Add("root","file","File");
				$control->Add("file","new","New...",null);
				$control->Add("new","newfile","File","javascript:alert(\"New File\")");
				$control->Add("new","newfolder","Folder","javascript:alert(\"New Folder\")");
				$control->AddSeparator("file");
				$control->Add("file","open","Open","javascript:alert(\"Open\")");
				$control->Add("file","close","Close","javascript:alert(\"Close\")");
				$control->Add("file","save","Save","javascript:alert(\"Save\")");
				$item = $control->Add("file","saveas","Save as ...",null);
				$item->Enabled = false;
				$control->Add("file","permission","Permission",null);
				$control->Add("permission","unrestrict","Unrestricted Access");
				$control->Add("permission","donotattribute","Do not attribute");
				
				$control->Add("root","edit","Edit");
				$control->Add("edit","cut","Cut","javascript:alert(\"Cut\")");
				$control->Add("edit","copy","Copy","javascript:alert(\"Copy\")");
				$control->Add("edit","paste","Paste","javascript:alert(\"Paste\")");
			 
				$control->Add("root","view","View");
				$control->Add("view","normal","Normal","javascript:alert(\"Normal View\")");
				$control->Add("view","print","Print","javascript:alert(\"Print View\")");
				$control->Add("view","weblayout","Web Layout","javascript:alert(\"Web Layout View\")");
				
				$item = $control->Add("root","help","Help");
				$item->Enabled = false;					
				break;				
		}
		
	}
?>

<form id="form1" method="post">
	<?php echo $koolajax->Render();?>
	
	<style>
		#mypanel
		{
			width:655px;
			border:dotted 1px gray;
			min-height:50px;
			padding:10px;
		}
	</style>
		
				<?php echo KoolScripting::Start();?>
					<updatepanel id="mypanel">
						<content>
							<![CDATA[
								<?php
									if(isset($_POST["load"]))
									{
										echo $control->Render();
									}
								?>
							]]>
						</content>
						<loading image="<?php echo $KoolControlsFolder ?>/KoolAjax/loading/5.gif" />
					</updatepanel>
				<?php echo KoolScripting::End();?>	


		<script type="text/javascript">
			function load_treeview()
			{
				mypanel.attachData("load","treeview");
				mypanel.update();	
			}
			function load_listbox()
			{
				mypanel.attachData("load","listbox");
				mypanel.update();	
			}
			function load_menu()
			{
				mypanel.attachData("load","menu");
				mypanel.update();	
			}						
		</script>

		<input type="button" value="Load TreeView" onclick="load_treeview()" />
		<input type="button" value="Load ListBox" onclick="load_listbox()" />
		<input type="button" value="Load Menu" onclick="load_menu()" />

</form>


