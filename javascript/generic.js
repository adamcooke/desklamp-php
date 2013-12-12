
function addLoadEvent(func) {
  var oldonload = window.onload;
  if (typeof window.onload != 'function') {
    window.onload = func;
  } else {
    window.onload = function() {
      if (oldonload) {
        oldonload();
      }
      func();
    }
  }
}

addLoadEvent(prepareInputs);

function prepareInputs() { 
// This function is used to change the background colour of input (text/textarea) boxes on focus
	if (!document.getElementById) return false;
	if (!document.getElementsByTagName) return false;
	
	var inputs = document.getElementsByTagName("input");
	for (var j=0; j < inputs.length; j++) { 
		var type = inputs[j].getAttribute("type");
		if (type == "text" || type == "password" || type == "file") { 
			inputs[j].onfocus = function() { this.className = "focus"; this.onblur = function() { this.className = ""; return false; }; return false; }
		}
	}
	
	var inputs = document.getElementsByTagName("textarea");
	for (var j=0; j < inputs.length; j++) { 
		var type = inputs[j].getAttribute("type");
	
			inputs[j].onfocus = function() { this.className = "focus"; this.onblur = function() { this.className = ""; return false; }; return false; }
		
	}
	
	var inputs = document.getElementsByTagName("select");
	for (var j=0; j < inputs.length; j++) { 
		var type = inputs[j].getAttribute("type");
	
			inputs[j].onfocus = function() { this.className = ""; this.onblur = function() { this.className = ""; return false; }; return false; }
		
	}


}

function stripe_tables() { 
	if (!document.getElementById) return false;
	if (!document.getElementsByTagName) return false;
	if (!document.getElementsByTagName("table")) return false;


	var tbl = document.getElementsByTagName("table");
	for (var p=0; p < tbl.length; p++) { 
		if (tbl[p].className == "datatable" || tbl[p].className == "formtable") { 
				var odd = true;
				var rows = tbl[p].getElementsByTagName("tr");
				for (var j=2; j < rows.length; j++) { 
						var vis = rows[j].className;
						
						if (vis == "highlight") { 
							
						}
						else { 
							if (rows[j].className == "th") {  }
							else { 
								if (odd == true) { 
									rows[j].className = "odd";
									odd = false;
								}
								else {
									rows[j].className = "e";
									odd = true;
								}
							}
						}
						vis = null;
				}	
			
		}
	}
}

function prepareTableMouseOver() {
	if (!document.getElementById) return false;
	if (!document.getElementsByTagName) return false;
	if (!document.getElementsByTagName("table")) return false;


	var tbl = document.getElementsByTagName("table");
	for (var p=0; p < tbl.length; p++) { 
		if (tbl[p].className == "datatable") { 

			var rows = tbl[p].getElementsByTagName("tr");
				for (var j=0; j < rows.length; j++) { 
				if (rows[j].className != "th") { 
					rows[j].onmouseover = function() { TableRowMouseOver(this); return false; }
				}
			}
		}
	}
}

function TableRowMouseOver(row) { 
// This prepares the mouseovers for rows in a table
	var currentclass = row.className;
	row.className =  'mo';
	row.onmouseout = function() { row.className = currentclass; return false; }
}
addLoadEvent(prepareTableMouseOver);
addLoadEvent(stripe_tables);


function validateForm(form) { 
	var errortext = "";
	var inputs = document.getElementsByTagName("input");
		for (var p=0; p < inputs.length; p++) { 
			if (inputs[p].getAttribute('dl:validate') == 'presence') { 
				var value = inputs[p].value;
				if (value == '') { 
					var inputtitle = inputs[p].title;
					errortext += "- " + inputtitle + "\n";
					inputs[p].className = "errorfield";
				}
			}
		}
		
	var selects = document.getElementsByTagName("select");
		for (var i=0; i < selects.length; i++) { 
			if (selects[i].getAttribute('dl:validate') == 'presence') { 
				var value = selects[i].value;
				if (value == '') { 
					var inputtitle = selects[i].title;
					errortext += "- " + inputtitle + "\n";
					selects[i].className = "errorfield";
				}
			}
		}
		
	var tas = document.getElementsByTagName("textarea");
		for (var j=0; j < tas.length; j++) { 
			if (tas[j].getAttribute('dl:validate') == 'presence') { 
				var value = tas[j].value;
				if (value == '') { 
					var inputtitle = tas[j].title;
					errortext += "- " + inputtitle + "\n";
					tas[j].className = "errorfield";
				}
			}
		}

		
	if (errortext != '') { 
		newerrortext = "The following fields were not entered correctly, please correct this and click Save again:\n\n" + errortext;
		alert(newerrortext);
		form.focus();
		return false;
	}
	else { 
		return true;
	}
}

function confirmCheck(text) { 
		if (confirm(text))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
			
function hidewithcolflash(elementid) { 
	var idtohide = document.getElementById(elementid);
	idtohide.className = 'highlight';
	Effect.toggle(idtohide, 'appear');
	stripe_tables();
}

function changeLogoBorder(selectbox) { 
	var logo = document.getElementById("companylogo");
	
	if (logo.className == "logoborder") { 
		logo.className = "";
	}
	else { 
		logo.className = "logoborder"; 
	}
	
	
}