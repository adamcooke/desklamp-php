function getXMLHTTPRequest() {
	var request = false;
	
	try { 
		request = new XMLHttpRequest();
		// Firefox
	}
	catch(err1) { 
		try {
			request = new ActiveXObject("MSxml2.XMLHTTP");
		}
		catch(err2) { 
			try { 
				request = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(err3) { 
				alert("Fail AJAX init");
				request = false;
			}
		}
	}
	return request;
}


var loadingOutput = "<img src=\"/images/load.gif\" alt=\"Loading\"> ";

var AJAXRequest = getXMLHTTPRequest();


function checkDomainExists(dn) { 
	var domain = dn.value;
	var randomNumber = parseInt(Math.random()*999999999);

	var url = "/domains/checkdomain/" + domain + "&rand=" + randomNumber;
	AJAXRequest.open("GET", url, true);
	AJAXRequest.onreadystatechange = returnDomainExists;
	AJAXRequest.send(null);
}

function returnDomainExists() { 
	if(AJAXRequest.readyState == 4) { 
		if (AJAXRequest.status == 200) { 
			var resp = AJAXRequest.responseText;
				if (resp == "Exists") { 
					alert("The domain name entered already exists in the database - please choose another.");
				}
			
			
		}
		else { 
			alert("An error has occured: " + myRequest.statusText);
		}
	}
	else { 

	}
}


function getHostingPackages(client) { 
	var clientid = client.value;
	var randomNumber = parseInt(Math.random()*999999999);

	var url = "/domains/hostinglist/" + clientid + "&rand=" + randomNumber;
	AJAXRequest.open("GET", url, true);
	AJAXRequest.onreadystatechange = returnHostingPackages;
	AJAXRequest.send(null);
	
}
		
function returnHostingPackages() { 
	if(AJAXRequest.readyState == 4) { 
		if (AJAXRequest.status == 200) { 
			document.getElementById("ajax-output").innerHTML = AJAXRequest.responseText;
		}
		else { 
			alert("An error has occured: " + myRequest.statusText);
		}
	}
	else { 

	}
}

function deleteItem(module, data) { 
	var randomNumber = parseInt(Math.random()*999999999);
	
	if (module == "domains") { 
		var url = "/domains/delete_domain/" + data + "&rand=" + randomNumber;

	}
	else if (module == "clients") { 
		var url = "/clients/delete_client/" + data + "&rand=" + randomNumber;
	}
	else if (module == "users") { 
		var url = "/users/delete_user/" + data + "&rand=" + randomNumber;
	}
	else if (module == "servers") { 
		var url = "/settings/save_settings/hosting&delserver=" + data + "&rand=" + randomNumber;
	}
	else if (module == "hosting") {
		var url = "/hosting/delete_hosting/" + data + "&rand=" + randomNumber;
	}
	
		AJAXRequest.open("GET", url, true);
		AJAXRequest.onreadystatechange = returnDeleteItem;
		AJAXRequest.send(null);	
	
}
		
function returnDeleteItem() { 
	if(AJAXRequest.readyState == 4) { 
		if (AJAXRequest.status == 200) { 
		
		}
		else { 
			alert("An error has occured: " + myRequest.statusText);
		}
	}
	else { 

	}
}

function getDomainList(client) { 
	var clientid = client.value;
	var randomNumber = parseInt(Math.random()*999999999);

	var url = "/hosting/domainlist/" + clientid + "&rand=" + randomNumber;
	AJAXRequest.open("GET", url, true);
	AJAXRequest.onreadystatechange = returnHostingPackages;
	AJAXRequest.send(null);
	
}
		
function returnDomainList() { 
	if(AJAXRequest.readyState == 4) { 
		if (AJAXRequest.status == 200) { 
			document.getElementById("ajax-output").innerHTML = AJAXRequest.responseText;
		}
		else { 
			alert("An error has occured: " + myRequest.statusText);
		}
	}
	else { 

	}
}

function getServerDetails(server) { 
	var serverid = server.value;
	var randomNumber = parseInt(Math.random()*999999999);
	
	var url = "/hosting/serverdetails/" + serverid + "&rand=" + randomNumber;
	AJAXRequest.open("GET", url, true);
	AJAXRequest.onreadystatechange = returnServerDetails;
	AJAXRequest.send(null);
	
}
		
function returnServerDetails() { 
	if(AJAXRequest.readyState == 4) { 
		if (AJAXRequest.status == 200) { 
			document.getElementById("ftp_host").value = '';
			document.getElementById("cp_url").value = '';
			
			var ftpValue = AJAXRequest.responseXML.getElementsByTagName("ftp_host")[0];
			var ftp_host = ftpValue.childNodes[0].nodeValue;
			document.getElementById("ftp_host").value = ftp_host;
			
			var cpValue = AJAXRequest.responseXML.getElementsByTagName("cp_url")[0];
			var cp_url = cpValue.childNodes[0].nodeValue;
			document.getElementById("cp_url").value = cp_url;			
		}
		else { 
			alert("An error has occured: " + myRequest.statusText);
		}
	}
	else { 

	}
}


