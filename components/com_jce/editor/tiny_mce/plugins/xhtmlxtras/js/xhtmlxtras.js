/* jce - 2.6.19 | 2017-08-10 | http://www.joomlacontenteditor.net | Copyright (C) 2006 - 2017 Ryan Demmer. All rights reserved | GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html */
!function($){var XHTMLXtrasDialog={settings:{},init:function(){var ed=tinyMCEPopup.editor,se=ed.selection,n=se.getNode(),element=tinyMCEPopup.getWindowArg("element");if(element&&(n=ed.dom.getParent(n,element)),Wf.init(),n){var text=n.textContent||n.innerText||"";se.isCollapsed()&&text!=se.getContent({format:"text"})||($(":input").each(function(){var k=$(this).attr("id");/on(click|dblclick)/.test(k)&&(k="data-mce-"+k),"classes"!==k&&"classlist"!==k||(k="class");var v=ed.dom.getAttrib(n,k);"class"===k&&(v=v.replace(/mceItem[a-z0-9]+/gi,"").replace(/\s+/," "),v=$.trim(v)),$(this).val(v)}),$("#insert").button("option","label",ed.getLang("update","Insert")))}$("#remove").button({icons:{primary:"uk-icon-minus-circle"}}).toggle(!!element),"html4"===ed.settings.schema&&ed.settings.validate===!0&&$("input.html5").parents(".uk-form-row").hide(),tinymce.is(n,":input, form")||$("input.form").parents(".uk-form-row").hide(),"IMG"!==n.nodeName&&$("input.media").parents(".uk-form-row").hide()},insert:function(){var elm,ed=tinyMCEPopup.editor,se=ed.selection,n=se.getNode();tinyMCEPopup.restoreSelection();var element=tinyMCEPopup.getWindowArg("element"),args={};$(":input").not("#classlist-select, #classes").each(function(){var k=$(this).attr("id"),v=$(this).val();/on(click|dblclick)/.test(k)&&(k="data-mce-"+k),args[k]=v});var cls=$("#classes").val();if(element)elm=n.nodeName.toLowerCase()==element?n:ed.dom.getParent(n,element),ed.formatter.apply(element.toLowerCase(),args,elm),ed.dom.addClass(elm,cls);else{var isTextSelection=se.getContent()==se.getContent({format:"text"});n==ed.getBody()||isTextSelection?(args.class=cls,ed.formatter.apply("attributes",args)):(ed.dom.setAttribs(n,args),ed.dom.addClass(n,cls))}ed.undoManager.add(),tinyMCEPopup.close()},remove:function(){var ed=tinyMCEPopup.editor,element=tinyMCEPopup.getWindowArg("element");element&&(ed.formatter.remove(element),ed.undoManager.add()),tinyMCEPopup.close()},insertDateTime:function(id){document.getElementById(id).value=this.getDateTime(new Date,"%Y-%m-%dT%H:%M:%S")},getDateTime:function(d,fmt){return fmt=fmt.replace("%D","%m/%d/%y"),fmt=fmt.replace("%r","%I:%M:%S %p"),fmt=fmt.replace("%Y",""+d.getFullYear()),fmt=fmt.replace("%y",""+d.getYear()),fmt=fmt.replace("%m",this.addZeros(d.getMonth()+1,2)),fmt=fmt.replace("%d",this.addZeros(d.getDate(),2)),fmt=fmt.replace("%H",""+this.addZeros(d.getHours(),2)),fmt=fmt.replace("%M",""+this.addZeros(d.getMinutes(),2)),fmt=fmt.replace("%S",""+this.addZeros(d.getSeconds(),2)),fmt=fmt.replace("%I",""+((d.getHours()+11)%12+1)),fmt=fmt.replace("%p",""+(d.getHours()<12?"AM":"PM")),fmt=fmt.replace("%%","%")},addZeros:function(value,len){var i;if(value=""+value,value.length<len)for(i=0;i<len-value.length;i++)value="0"+value;return value}};window.XHTMLXtrasDialog=XHTMLXtrasDialog,tinyMCEPopup.onInit.add(XHTMLXtrasDialog.init,XHTMLXtrasDialog)}(jQuery);