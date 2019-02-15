var GroupUtils={validateGroupElements:function(fieldId,maxLength,message){var groupElement=$(fieldId);
if(groupElement.value.length>=maxLength){groupElement.value=groupElement.value.substring(0,maxLength);
$(fieldId+"_message_error").innerHTML=message;
$(fieldId+"_message_error").style.display="block"
}else{$(fieldId+"_message_error").innerHTML="";
$(fieldId+"_message_error").style.display="none"
}if($(fieldId+"-counter")){var charatersLeft=maxLength-groupElement.value.length;
$(fieldId+"-counter").value=charatersLeft
}}}
