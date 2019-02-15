    <div id="mypage-wrapper" class="cbb blue"> 
<div class="box-tabs-container box-tabs-left clearfix"> 
	<!--
	<a href="/myhabbo/startSession/22033758" id="edit-button" class="new-button dark-button edit-icon" style="float:left"><b><span></span>Editar</b><i></i></a> 
	-->
	<div class="myhabbo-view-tools"> 
	</div> 
    <h2 class="page-owner">%home_title%</h2> 
    <ul class="box-tabs"></ul> 
</div> 
	<div id="mypage-content"> 
			<div id="mypage-bg" class="b_bg_pattern_abstract2"> 
				<div id="playground">  
				<?php
				
				foreach ($homeData->GetItems() as $item)
				{
					echo $item->GetHtml();
				}

				?>
				</div> 
				<div id="mypage-ad"> 
    <div class="habblet "> 
    
    </div> 
				</div> 
			</div> 
	</div> 
</div> 
 
<script type="text/javascript"> 
	Event.observe(window, "load", observeAnim);
	document.observe("dom:loaded", function() {
		initDraggableDialogs();
        repositionInvalidItems();
	});
</script> 
    </div> 
	
<div class="cbb topdialog" id="guestbook-form-dialog"> 
	<h2 class="title dialog-handle">Edit guestbook entry</h2> 
	
	<a class="topdialog-exit" href="#" id="guestbook-form-dialog-exit">X</a> 
	<div class="topdialog-body" id="guestbook-form-dialog-body"> 
<div id="guestbook-form-tab"> 
<form method="post" id="guestbook-form"> 
    <p> 
        Note: messages cannot be more than 200 characters
        <input type="hidden" name="ownerId" value="2" /> 
	</p> 
	<div> 
	    <textarea cols="15" rows="5" name="message" id="guestbook-message"></textarea> 
    <script type="text/javascript"> 
        bbcodeToolbar = new Control.TextArea.ToolBar.BBCode("guestbook-message");
        bbcodeToolbar.toolbar.toolbar.id = "bbcode_toolbar";
        var colors = { "red" : ["#d80000", "Red"],
            "orange" : ["#fe6301", "Orange"],
            "yellow" : ["#ffce00", "Yellow"],
            "green" : ["#6cc800", "Green"],
            "cyan" : ["#00c6c4", "Cyan"],
            "blue" : ["#0070d7", "Blue"],
            "gray" : ["#828282", "Grey"],
            "black" : ["#000000", "Black"]
        };
        bbcodeToolbar.addColorSelect("Colours", colors, true);
    </script> 
<div id="linktool"> 
    <div id="linktool-scope"> 
        <label for="linktool-query-input">Create link to a:</label> 
        <input type="radio" name="scope" class="linktool-scope" value="1" checked="checked"/>Habbo
        <input type="radio" name="scope" class="linktool-scope" value="2"/>Sala
        <input type="radio" name="scope" class="linktool-scope" value="3"/>Grupo
    </div> 
    <input id="linktool-query" type="text" name="query" value=""/> 
    <a href="#" class="new-button" id="linktool-find"><b>Find</b><i></i></a> 
    <div class="clear" style="height: 0;"><!-- --></div> 
    <div id="linktool-results" style="display: none"> 
    </div> 
    <script type="text/javascript"> 
        linkTool = new LinkTool(bbcodeToolbar.textarea);
    </script> 
</div> 
    </div> 
 
	<div class="guestbook-toolbar clearfix"> 
		<a href="#" class="new-button" id="guestbook-form-cancel"><b>Cancelar</b><i></i></a> 
		<a href="#" class="new-button" id="guestbook-form-preview"><b>Previsualizar</b><i></i></a>	
	</div> 
</form> 
</div> 
<div id="guestbook-preview-tab">&nbsp;</div> 
	</div> 
</div>	
<div class="cbb topdialog" id="guestbook-delete-dialog"> 
	<h2 class="title dialog-handle">Delete entry</h2> 
	
	<a class="topdialog-exit" href="#" id="guestbook-delete-dialog-exit">X</a> 
	<div class="topdialog-body" id="guestbook-delete-dialog-body"> 
<form method="post" id="guestbook-delete-form"> 
	<input type="hidden" name="entryId" id="guestbook-delete-id" value="" /> 
	<p>Are you sure you want to delete this entry?</p> 
	<p> 
		<a href="#" id="guestbook-delete-cancel" class="new-button"><b>Cancelar</b><i></i></a> 
		<a href="#" id="guestbook-delete" class="new-button"><b>Borrar</b><i></i></a> 
	</p> 
</form> 
	</div> 
</div>	
					
<script type="text/javascript"> 
HabboView.run();
</script> 	