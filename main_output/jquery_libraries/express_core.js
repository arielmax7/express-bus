/*Principal envia los task y los cid de los formulario*/
if(typeof(express)==="undefined"){var express={}}express.editors={};express.editors.instances={};express.submitform=function(a,b){if(typeof(b)==="undefined"){b=document.getElementById("adminForm");if(!b){b=document.adminForm}}if(typeof(a)!=="undefined"){b.task.value=a}if(typeof b.onsubmit=="function"){b.onsubmit()}if(typeof b.fireEvent=="function"){b.fireEvent("submit")}b.submit()};express.submitbutton=function(a){express.submitform(a)};express.JText={strings:{},_:function(a,b){return typeof this.strings[a.toUpperCase()]!=="undefined"?this.strings[a.toUpperCase()]:b},load:function(a){for(var b in a){this.strings[b.toUpperCase()]=a[b]}return this}};express.replaceTokens=function(c){var b=document.getElementsByTagName("input");for(var a=0;a<b.length;a++){if((b[a].type=="hidden")&&(b[a].name.length==32)&&b[a].value=="1"){b[a].name=c}}};express.isEmail=function(b){var a=new RegExp("^[\\w-_.]*[\\w-_.]@[\\w].+[\\w]+[\\w]$");return a.test(b)};function writeDynaList(e,g,d,h,a){var c="\n	<select "+e+">";var b=0;for(x in g){if(g[x][0]==d){var f="";if((h==d&&a==g[x][1])||(b==0&&h!=d)){f='selected="selected"'}c+='\n		<option value="'+g[x][1]+'" '+f+">"+g[x][2]+"</option>"}b++}c+="\n	</select>";document.writeln(c)}function changeDynaList(c,e,b,f,a){var d=document.adminForm[c];for(i in d.options.length){d.options[i]=null}i=0;for(x in e){if(e[x][0]==b){opt=new Option();opt.value=e[x][1];opt.text=e[x][2];if((f==b&&a==opt.value)||i==0){opt.selected=true}d.options[i++]=opt}}d.length=i}function radioGetCheckedValue(b){if(!b){return""}var c=b.length;if(c==undefined){if(b.checked){return b.value}else{return""}}for(var a=0;a<c;a++){if(b[a].checked){return b[a].value}}return""}function getSelectedValue(b,a){var c=document[b];var d=c[a];i=d.selectedIndex;if(i!=null&&i>-1){return d.options[i].value}else{return null}}function checkAll(h,b){if(!b){b="cb"}if(h.form){var m=0;for(var g=0,a=h.form.elements.length;g<a;g++){var l=h.form.elements[g];if(l.type==h.type){if((b&&l.id.indexOf(b)==0)||!b){l.checked=h.checked;m+=(l.checked==true?1:0)}}}if(h.form.boxchecked){h.form.boxchecked.value=m}return true}else{var j=document.adminForm;var m=j.toggle.checked;var a=h;var k=0;for(var g=0;g<a;g++){var d=j[b+""+g];if(d){d.checked=m;k++}}if(m){document.adminForm.boxchecked.value=k}else{document.adminForm.boxchecked.value=0}}}function listItemTask(g,b){var d=document.adminForm;var a=d[g];if(a){for(var c=0;true;c++){var e=d["cb"+c];if(!e){break}e.checked=false}a.checked=true;d.boxchecked.value=1;submitbutton(b)}return false}function isChecked(a){if(a==true){document.adminForm.boxchecked.value++}else{document.adminForm.boxchecked.value--}}function submitbutton(a){submitform(a)}function submitform(a){if(a){document.adminForm.task.value=a}if(typeof document.adminForm.onsubmit=="function"){document.adminForm.onsubmit()}if(typeof document.adminForm.fireEvent=="function"){document.adminForm.fireEvent("submit")}document.adminForm.submit()}function popupWindow(g,e,b,d,a){var c=(screen.width-b)/2;var f=(screen.height-d)/2;winprops="height="+d+",width="+b+",top="+f+",left="+c+",scrollbars="+a+",resizable";win=window.open(g,e,winprops);if(parseInt(navigator.appVersion)>=4){win.window.focus()}}function tableOrdering(a,c,b){var d=document.adminForm;d.filter_order.value=a;d.filter_order_Dir.value=c;submitform(b)}function saveorder(b,a){checkAll_button(b,a)}function checkAll_button(d,a){if(!a){a="saveorder"}for(var b=0;b<=d;b++){var c=document.adminForm["cb"+b];if(c){if(c.checked==false){c.checked=true}}else{alert("You cannot change the order of items, as an item in the list is `Checked Out`");return}}submitform(a)};