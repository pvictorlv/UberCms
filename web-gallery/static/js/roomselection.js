var HabboSearchHabblet=Class.create();HabboSearchHabblet.prototype={minSearchLength:0,maxSearchLength:0,initialize:function(B,A){this.maxSearchLength=A;this.minSearchLength=B;this.habbletPaging=new HabbletSearchPaging(habboReqPath+"/ajax_habblet/habbosearchcontent.php");Event.observe("avatar-habblet-search-button","click",function(C){Event.stop(C);
this._processSearch(C)}.bind(this));Event.observe("avatar-habblet-search-string","keypress",function(C){if(C.keyCode==Event.KEY_RETURN){this._processSearch(C)}}.bind(this));$("avatar-habblet-content").observe("click",Event.delegate({"a.add":function(E){E.stop();var D=E.element();var G=D.readAttribute("avatarid");
if(!!D&&!!G){var F=function(){Overlay.hide();$("avatar-habblet-dialog").remove()};var C=Dialog.createDialog("avatar-habblet-dialog",L10N.get("habblet.search.add_friend.title"),9001,0,-1000,F);$("avatar-habblet-dialog").observe("click",Event.delegate({"a.done > *":function(H){H.stop();F()},"a.add-continue > *":function(H){H.stop();
Dialog.setAsWaitDialog(C);new Ajax.Request(habboReqPath+"/ajax_habblet/addFriend.php",{parameters:{accountId:G},onComplete:function(I){D.hide();Dialog.setDialogBody(C,I.responseText)}})}}));Dialog.setAsWaitDialog(C);Dialog.moveDialogToCenter(C);Overlay.show();new Ajax.Request(habboReqPath+"/ajax_habblet/confirmAddFriend.php",{parameters:{accountId:G},onComplete:function(H){Dialog.setDialogBody(C,H.responseText)
}})}},"ul *:not(a)":function(D){var C=D.findElement("li");if(!!C.readAttribute("homeurl")){location.href=C.readAttribute("homeurl")}}}));Utils.limitTextarea("avatar-habblet-search-string",this.maxSearchLength,function(C){var D=$("habbo-search-error-container");if(C&&!Element.visible(D)){$("habbo-search-error").innerHTML=L10N.get("habblet.search.error.search_string_too_long");
Element.show(D)}else{if(!C){Element.hide(D)}}})},_processSearch:function(B){var A=$F("avatar-habblet-search-string");A=A.strip();if(this._isValidSearchString(A)){Element.wait($("avatar-habblet-list-container"));new Ajax.Updater("avatar-habblet-list-container",habboReqPath+"/ajax_habblet/habbosearchcontent.php",{method:"post",parameters:"searchString="+encodeURIComponent(A),onComplete:function(){this.habbletPaging.bindElementsAndEvents()
}.bind(this)})}else{Element.show($("habbo-search-error-container"))}},_isValidSearchString:function(A){if(A.length<this.minSearchLength){$("habbo-search-error").innerHTML=L10N.get("habblet.search.error.search_string_too_short");return false}else{if(A.length>this.maxSearchLength){$("habbo-search-error").innerHTML=L10N.get("habblet.search.error.search_string_too_long")
}}return true}};var HighscoreHabblet=Class.create();HighscoreHabblet.prototype={initialize:function(A){this.habbletId=A;this.containerEl=$("highscores-habblet-list-container-"+A);this._setupPaging();this._setupGameLinks()},_setupPaging:function(){if($("habblet-paging-"+this.habbletId)){Event.observe($("habblet-paging-"+this.habbletId),"click",function(A){Event.stop(A);
this._handlePagingClick(A)}.bind(this))}},_handlePagingClick:function(D){var C=Event.findElement(D,"a");if(Element.hasClassName(C,"list-paging-link")){var A=$F(this.habbletId+"-pageNumber");var B=$F(this.habbletId+"-gameId");switch(C.id.split("-").last()){case"next":A++;break;case"previous":A--;break
}this._updateContent(A,B)}},_setupGameLinks:function(){Event.observe($("highscores-habblet-games-"+this.habbletId),"click",function(A){Event.stop(A);this._handleGameLinkClick(A)}.bind(this))},_handleGameLinkClick:function(C){var B=Event.findElement(C,"a");if(Element.hasClassName(B,"highscores-habblet-game-link")){var A=B.id.split("-").last();
this._updateContent(0,A)}},_updateContent:function(A,B){new Ajax.Updater(this.containerEl,habboReqPath+"/habblet/personalhighscores",{method:"post",parameters:{pageNumber:A,gameId:B,hid:this.habbletId},onComplete:function(){this._setupPaging();this._setupGameLinks()}.bind(this)})}};var InviteFriendHabblet=Class.create();
InviteFriendHabblet.prototype={initialize:function(B){Event.observe("send-friend-invite-button","click",function(C){Event.stop(C);this._sendInvite()}.bind(this));Event.observe("getlink-friend-invite-button","click",function(C){Event.stop(C);this._getInviteLink()}.bind(this));Utils.limitTextarea("invitation_message",B,function(C){var E=$("invitation_message_error");
if(C&&!Element.visible(E)){var D=$$("#invitation_message_error .rounded").first();D.innerHTML=L10N.get("invitation.error.message_too_long");Element.show(E)}else{if(!C){Element.hide(E)}}});for(var A=1;A<4;A++){Event.observe($("invitation_recipient"+A),"focus",function(D){var C=Event.element(D);if(C&&C.value==L10N.get("invitation.form.recipient")){C.value=""
}});Event.observe($("invitation_recipient"+A),"blur",function(D){var C=Event.element(D);if(C&&C.value==""){C.value=L10N.get("invitation.form.recipient")}})}},_sendInvite:function(){var B=encodeURIComponent($("invitation_message").value);for(var A=1;A<4;A++){if($("invitation_recipient"+A).value!=L10N.get("invitation.form.recipient")){B+="&recipientEmails="+encodeURIComponent($("invitation_recipient"+A).value)
}}new Ajax.Updater("friend-invitation-habblet-container",habboReqPath+"/habblet/ajax/mgmsendinvite",{method:"post",parameters:"message="+B,evalScripts:true,onComplete:function(D,E){if(E=="success"){for(var C=1;C<4;C++){$("invitation_recipient"+C).value=L10N.get("invitation.form.recipient")}}}})},_getInviteLink:function(){$("invitation-link-container").wait(75);
new Ajax.Updater("invitation-link-container",habboReqPath+"/habblet/ajax/mgmgetinvitelink",{method:"post",evalScripts:true,onComplete:function(A,B){}})}};var RedeemHabblet=Class.create({busy:false,initialize:function(){Event.observe("voucher-form","submit",this._redeemVoucher.bind(this));var A=$("purse-redeemcode-button");
if(A){A.observe("click",this._redeemVoucher.bind(this));document.observe("dom:loaded",function(){$("purse-habblet-redeemcode-string").setStyle({width:($(A.parentNode).getWidth()-A.getWidth()-50)+"px"})})}},_redeemVoucher:function(A){if(this.busy){return }this.busy=true;Event.stop(A);new Ajax.Request(habboReqPath+"/habblet/ajax/redeemvoucher",{method:"post",parameters:{voucherCode:$F("purse-habblet-redeemcode-string")},onComplete:function(C){var B=$("voucher-form");
B.innerHTML=C.responseText;B.select(".rounded").each(function(D){Rounder.addCorners(D,8,8)});if($("purse-redeemcode-button")){Event.observe("purse-redeemcode-button","click",this._redeemVoucher.bind(this))}this.busy=false}.bind(this)})}});var HabboIdForm=Class.create({form:null,busy:false,initialize:function(A){this.form=$(A);
if(!!this.form){this.form.observe("submit",this._getId.bind(this));this.form.observe("click",this._clicked.bind(this))}},_clicked:function(B){if(this.busy){return }var A=B.findElement(".habboid-submit");if(!!A){this._getId(B)}},_getId:function(A){if(this.busy){return }A.stop();this.busy=true;new Ajax.Request(habboReqPath+"/habblet/ajax/new_habboid",{method:"post",parameters:{habboIdName:this.form.down("input[type=text]").value},onComplete:function(C){var B=C.getHeader("X-Reply-Status");
if(B=="success"){this.form.up(".habboid-container").innerHTML=C.responseText}else{this.form.innerHTML=C.responseText}this.form.select(".rounded").each(function(D){Rounder.addCorners(D,8,8)});this.busy=false}.bind(this)})}});var ActiveHabbosHabblet=Class.create();ActiveHabbosHabblet.prototype={numberOfRows:3,numberOfColumns:6,horizontalSpace:62,verticalSpace:45,numberOfImages:18,initialize:function(){this._positionPlaceHolderImages()
},generateRandomImages:function(){var C=$("homes-habblet-list-container").select(".active-habbo-image");var E=[];var A=0;while(E.length<C.length){var B=Math.floor(Math.random()*C.length);var D=C[B];var F=$("active-habbo-image-placeholder-"+A);if(E.indexOf(B)==-1){$("imagemap-area-"+A).href=$("active-habbo-url-"+B).value;
this._addToolTip(A,$("active-habbo-data-"+B));this._placeImage(F,D);E.push(B);A++}if(A==this.numberOfImages){break}}},_placeImage:function(B,A){window.setTimeout(function(){B.style.backgroundImage="url("+A.value+")"},Math.floor(Math.random()*700))},_addToolTip:function(A,B){new Tip("imagemap-area-"+A,B.innerHTML,{className:"bubbletip",title:" ",target:$("active-habbo-image-placeholder-"+A),hook:{target:"topRight",tip:"bottomRight"},offset:{x:85,y:40}})
},_positionPlaceHolderImages:function(){var C=$("homes-habblet-list-container").select(".active-habbo-image-placeholder");var E=10;var D=50;var B=0;for(var G=0;G<this.numberOfRows;G++){for(var A=0;A<this.numberOfColumns;A++){var F=C[B];if(F){F.style.left=D+"px";F.style.top=E+"px";D=D+this.horizontalSpace;
B=B+1}}if(G%2<1){D=20}else{D=50}E=E+this.verticalSpace}C.each(function(H){H.style.display="block"})}};var RoomSelectionHabblet={initClosableHabblet:function(){$("habblet-close-roomselection").observe("click",function(A){RoomSelectionHabblet.showConfirmation()})},hideHabblet:function(){new Ajax.Request(habboReqPath+"/habblet/ajax/roomselectionHide");
Effect.Fade("roomselection",{afterFinish:function(){$("roomselection").remove()}})},showConfirmation:function(){Overlay.show();var A=Dialog.createDialog("roomselection-dialog",L10N.get("roomselection.hide.title"),false,false,false,RoomSelectionHabblet.hideConfirmation);Dialog.setAsWaitDialog(A);Dialog.makeDialogDraggable(A);
Dialog.moveDialogToCenter(A);new Ajax.Request(habboReqPath+"/habblet/ajax_roomselectionConfirm",{onComplete:function(B){$("roomselection-dialog-body").update(B.responseText);$("roomselection-cancel").observe("click",function(C){Event.stop(C);RoomSelectionHabblet.hideConfirmation()});if(!!$("roomselection-hide")){$("roomselection-hide").observe("click",function(C){Event.stop(C);
RoomSelectionHabblet.hideConfirmation();RoomSelectionHabblet.hideHabblet()})}}})},hideConfirmation:function(){$("roomselection-dialog").remove();Overlay.hide()},create:function(B,D){var A=false;try{A=window.habboClient}catch(C){}if(A){window.location.href=B;return false}try{isEmbeddedWelcomePage=window.embeddedWelcomePage
}catch(C){}if(isEmbeddedWelcomePage){if(window.opener){window.opener.login_ok(D);window.close()}else{window.location.replace(B)}return false}if(document.habboLoggedIn){new Ajax.Request(habboReqPath+"/habblet/ajax_roomselectionCreate",{parameters:{roomType:D}})}HabboClient.openOrFocus(B);if($("roomselection-plp-intro")){$("roomselection-plp","habblet-close-roomselection").invoke("hide");
$("roomselection-plp-intro").update(L10N.get("roomselection.old_user.done"))}return false}};var GiftQueueHabblet={init:function(A){GiftQueueHabblet.container=$("gift-countdown");if(!!GiftQueueHabblet.container){new PrettyTimer(A,function(B){GiftQueueHabblet.container.update(B)},{showDays:false,showMeaningfulOnly:false,localizations:{hours:L10N.get("time.hours")+" ",minutes:L10N.get("time.minutes")+" ",seconds:L10N.get("time.seconds")},endCallback:function(){GiftQueueHabblet.reload()
}})}},initClosableHabblet:function(){$("habblet-close-giftqueue").setStyle({display:"inline"});$("habblet-close-giftqueue").observe("click",function(A){GiftQueueHabblet.hide()})},reload:function(){new Ajax.Request(habboReqPath+"/habblet/ajax/nextgift",{onComplete:function(B,A){$("gift-container").update(B.responseText);
GiftQueueHabblet.init(parseInt(A))}})},hide:function(){new Ajax.Request(habboReqPath+"/habblet/ajax/giftqueueHide");Effect.Fade("giftqueue",{afterFinish:function(){$("giftqueue").remove()}})}};var CurrentRoomEvents={init:function(){$("event-category").observe("change",function(A){Element.wait($("event-list"));
new Ajax.Updater("event-list","/habblet/ajax/load_events",{parameters:{eventTypeId:$F("event-category")},onComplete:function(){CurrentRoomEvents.initListItems()}})});CurrentRoomEvents.initListItems()},initListItems:function(){$$("#current-events ul.habblet-list").each(function(A){Event.observe(A,"click",function(C){var D=Event.element(C);
if(D.tagName.toUpperCase()=="A"){return }Event.stop(C);if(!$(D).match("li")){D=$(D).up("li")}var B=$(D).readAttribute("roomid");if(B){HabboClient.roomForward(habboDefaultClientPopupUrl+"?forwardId=2&roomId="+B,B,"private")}})})}};