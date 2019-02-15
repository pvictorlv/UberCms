HabboView.add(function(){
HabboEditor.addCallback("setGender",function(A){$("settings-gender").value=A});
HabboEditor.addCallback("setFigure",function(A){$("settings-figure").value=A});
HabboEditor.addCallback("setEditorState",function(A){$("settings-state").value=A});
HabboEditor.addCallback("setAllowedToProceed",function(A){if(A){$("settings-submit").removeClassName("disabled-button");
HabboEditor.hideHabboClubNotice()}else{$("settings-submit").addClassName("disabled-button")}});
HabboEditor.addCallback("showHabboClubNotice",function(A){$("settings-hc").show()});
HabboEditor.addCallback("hideHabboClubNotice",function(A){$("settings-hc").hide()});
HabboEditor.addCallback("showOldFigureNotice",function(A){$("settings-oldfigure").show()
});

HabboEditor.addCallback("hideOldFigureNotice",function(A){$("settings-oldfigure").hide()})});

HabboView.add(function(){if(!!$("registerform")){$("registerform").observe("submit",function(A){if(!HabboEditor.isAllowedToProceed()){Event.stop(A)}});$("settings-submit").observe("click",function(A){Event.stop(A);
if(HabboEditor.isAllowedToProceed()){$("registerform").submit()}})}});var Wardrobe=function(){var C=[];var B=function(F,E){$("wardrobe-slot-"+F).setStyle({backgroundImage:"url("+E+")"})};var D=function(I,E,G){Overlay.show();var F=Dialog.createDialog("wardrobe-replace",L10N.get("profile.figure.wardrobe_replace.title"));
Dialog.setDialogBody(F,L10N.get("profile.figure.wardrobe_replace.dialog"));var H=function(J){Event.stop(J);$("wardrobe-replace").remove();Overlay.hide()};$("wardrobe-replace-cancel").observe("click",H);$("wardrobe-replace-ok").observe("click",function(J){A(I,E,G);H(J)});Dialog.moveDialogToCenter(F);Dialog.makeDialogDraggable(F);
return true};var A=function(G,E,F){Wardrobe.add(G,E,F);new Ajax.Request(habboReqPath+"habblet/wardrobestore.php",{parameters:{slot:G,figure:E,gender:F},onComplete:function(I,H){if(H.e){alert(L10N.get("profile.figure.wardrobe_invalid_data"))}else{B(G,H.u);$("wardrobe-dress-"+G).show()}}})};return{init:function(){$$("span.wardrobe-dress").invoke("observe","click",Wardrobe.dress);
$$("span.wardrobe-store").invoke("observe","click",Wardrobe.store);Event.observe(window,"load",function(){$("content").insert('<div id="wardrobe-instructions" style="display: none"><div class="bubbletip left"><div class="bubbletip-title"></div><div class="content">'+L10N.get("profile.figure.wardrobe_instructions")+"</div></div></div>");
$("wardrobe-instructions").setStyle({top:($("wardrobe-slots").offsetTop-$("wardrobe-instructions").getHeight()-6)+"px"});$("settings-wardrobe").observe("mouseover",function(){$("wardrobe-instructions").show()});$("settings-wardrobe").observe("mouseout",function(){$("wardrobe-instructions").hide()})})
},add:function(H,E,F,G){C[H]={f:E,g:F,hc:G}},store:function(I){var H=Event.element(I);if(H&&H.id){var F=H.id.split("-").last();if(F>0){var E=$("settings-figure").value;var G=$("settings-gender").value;if(!C[F]||!D(F,E,G)){A(F,E,G)}}}},dress:function(G){var F=Event.element(G);if(F&&F.id){var E=F.id.split("-").last();
if(C[E]&&$("settings-figure").value!=C[E].f){HabboEditor.setGender(C[E].g);HabboEditor.setFigure(C[E].f);swfobj.addVariable("figure",C[E].f);swfobj.addVariable("gender",C[E].g);swfobj.addVariable("showClubSelections",(C[E].hc)?"1":"0");swfobj.write("settings-editor")}}}}}();var HabboEditor=function(){var D=true;
var A=null;var B=null;var C=[];return{addCallback:function(E,F){if(!C[E]){C[E]=[]}C[E].push(F)},setGenderAndFigure:function(F,E){this.setGender(F);this.setFigure(E)},setFigure:function(E){A=E;if(C.setFigure){C.setFigure.each(function(F){F(E)})}},setGender:function(E){B=E;if(C.setGender){C.setGender.each(function(F){F(E)
})}},setAllowedToProceed:function(E){D=E;if(C.setAllowedToProceed){C.setAllowedToProceed.each(function(F){F(E)})}},isAllowedToProceed:function(){return D},showHabboClubNotice:function(){if(C.showHabboClubNotice){C.showHabboClubNotice.each(function(E){E()})}},hideHabboClubNotice:function(){if(C.hideHabboClubNotice){C.hideHabboClubNotice.each(function(E){E()
})}},showOldFigureNotice:function(){if(C.showOldFigureNotice){C.showOldFigureNotice.each(function(E){E()})}},hideOldFigureNotice:function(){if(C.hideOldFigureNotice){C.hideOldFigureNotice.each(function(E){E()})}},setEditorState:function(E){if(C.setEditorState){C.setEditorState.each(function(F){F(E)})
}}}}();