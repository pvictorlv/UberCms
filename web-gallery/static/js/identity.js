var FacebookIntegration={apiKey:"",applicationName:"",popupWindowParams:"toolbar=no,location=yes,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=540,height=450",badgeImagePath:"",initUI:function(){FB_RequireFeatures(["CanvasUtil"],function(){FB.XdComm.Server.init(habboReqPath+"/facebook/xd_receiver.htm")
})},openPopupWindow:function(A){var B=window.open(A.href,null,FacebookIntegration.popupWindowParams);if(window.focus){B.focus()}},linkAccountOk:function(){window.location.replace(habboReqPath+"/facebook/authenticate")},publishFacebookStory:function(C,A){if(typeof HabbletLoader!="undefined"&&HabbletLoader.needsFlashKbWorkaround()){$("client-ui").addClassName("x-workaround-feed")
}var B=[{text:L10N.get("facebook.story.actionlink.text"),href:"http://apps.facebook.com/"+FacebookIntegration.applicationName+"/"}];FB_RequireFeatures(["Api"],function(){FB.Facebook.init(FacebookIntegration.apiKey,habboReqPath+"/facebook/xd_receiver.htm");FB.ensureInit(function(){FB.Connect.streamPublish("",C,B,null,A,function(){$("client-ui").removeClassName("x-workaround-feed")
})})})},publishAchievementStory:function(A,C){var B={name:L10N.get("facebook.story.name"),description:C,caption:L10N.get("facebook.story.achievement.caption","{*actor*}"),media:[{type:"image",src:FacebookIntegration.badgeImagePath+"/"+A+".gif",href:"http://apps.facebook.com/"+FacebookIntegration.applicationName+"/"}]};
FacebookIntegration.publishFacebookStory(B,L10N.get("facebook.story.achievement.prompt"))},showBookmarkDialog:function(){if(typeof HabbletLoader!="undefined"&&HabbletLoader.needsFlashKbWorkaround()){$("client-ui").addClassName("x-workaround-feed")}FB_RequireFeatures(["Api"],function(){FB.Facebook.init(FacebookIntegration.apiKey,habboReqPath+"/facebook/xd_receiver.htm");
FB.Connect.showBookmarkDialog(function(){$("client-ui").removeClassName("x-workaround-feed")})})}};var RpxIntegration={apiKey:"",popupWindowParams:"toolbar=no,location=yes,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=540,height=450",openPopupWindow:function(A){var B=window.open(A.href,null,RpxIntegration.popupWindowParams);
B.focus()},linkAccountOk:function(){var A="";if(RpxIntegration.next){A="?next="+escape(RpxIntegration.next)}window.location.replace(habboReqPath+"/rpx/authenticate"+A)}};var Identity={popupWindowParams:"toolbar=no,location=yes,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=350",openInfoWindow:function(B){var A=window.open(B.href,null,Identity.popupWindowParams);
A.focus()},startActivationNag:function(){if(!HabbletLoader.needsFlashKbWorkaround()){var A=$$(".client-habblet-container");$$(".client-habblet-container").each(function(C){var B=C.select("#inner-message-container");if(B){Identity.infoHabblet=C;Identity.centerActivation()}});Identity.activationTimer=window.setInterval(function(){Identity.centerActivation()
},16000)}},sendActivationRequest:function(){if($("email")){var A=$("email").value;new Ajax.Updater("inner-message-container",habboReqPath+"/habblet/update_email_and_send_activation",{parameters:{email:A},evalScripts:true,method:"post"})}},closeActivation:function(){if(Identity.activationTimer){Identity.activationTimer=clearTimeout(Identity.activationTimer);
Identity.activationTimer=null}var A=$$(".client-habblet-container.contains-accountActivation")[0];if(A){HabbletLoader.hide(A)}},centerActivation:function(){if(Identity.infoHabblet){Identity.infoHabblet.setStyle({left:"-350px"});Identity.infoHabblet.setStyle({top:"50px"});Identity.infoHabblet.setStyle({position:"relative"})
}}};__accountActivation__defined__=true;