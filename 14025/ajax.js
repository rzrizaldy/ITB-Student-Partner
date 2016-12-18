
function ajax_send(method,url,param,ret){
	var req = new XMLHttpRequest();

	req.onreadystatechange=function(e){
		if(req.readyState==4){
			ret(req.responseText);
		}
	}
	
	if(method.toLowerCase()=='get'){
		req.open("GET",url+"?"+param);
		req.send();
	}else
	if(method.toLowerCase()=='post'){
		req.open("POST",url);
		req.setRequestHeader('Content-Type',"application/x-www-form-urlencoded");
		req.send(param);
	}
}