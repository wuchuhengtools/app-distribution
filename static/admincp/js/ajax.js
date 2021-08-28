function createXMLHttpRequest() {
	try {
		XMLHttpReq = new ActiveXObject("Msxml2.XMLHTTP");
	} catch(e) {
		try {
			XMLHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
		} catch(e) {
			XMLHttpReq = new XMLHttpRequest();
		}
	}
}
function CheckBuild() {
        createXMLHttpRequest();
        XMLHttpReq.open("GET", "?iframe=ajax&ac=build", true);
        XMLHttpReq.onreadystatechange = function() {
                if (XMLHttpReq.readyState == 4) {
                        if (XMLHttpReq.status == 200) {
                                var data = XMLHttpReq.responseText;
                                if (data.match(/^\d+/)) {
                                        document.getElementById("build").innerHTML = data;
                                        document.getElementById("notice").style.display = "block";
                                }
                        }
                }
        };
        XMLHttpReq.send(null);
}