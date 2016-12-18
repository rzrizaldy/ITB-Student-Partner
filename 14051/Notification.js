//Fanni Ulfani/18214051
//Notification

function getPermission() {
  Notification.requestPermission().then(function(result) {
  console.log(result);
  });
}

function titleNotification(title) {
	getPermission();
	var n = new Notification(title);
}

function titleNotificationTimeout(tite, timeout){
	getPermission();
	var n = new Notification(title);
	setTimeout(n.close.bind(n), timeout);
}

function textIconNotification(text, icon, title){
	var options = {
    body: text,
    icon: icon
  }
  var n = new Notification(title, options);
}

function textIconNotificationTimeout(text, icon, title, timeout){
	var options = {
    body: text,
    icon: icon
  }
  var n = new Notification(title, options);
  setTimeout(n.close.bind(n), timeout);
}

function titleTextNotification(title, text){
	var options = {
    body: text,
    icon: icon
  }
  var n = new Notification(title, options);
}

function titleTextNotificationTimeout(title, text, timeout){
	var options = {
    body: text,
    icon: icon
  }
  var n = new Notification(title, options);
  setTimeout(n.close.bind(n), timeout);
}

//Create notification from user input
function formNotification(){
	var title=document.getElementById('notiftitle').value;
	var text=document.getElementById('notiftext').value;
	var icon=document.getElementById('notificon').value;
	var timeout=document.getElementById('notiftimeout').value;
	
	if(title!==null && text !==null && icon!==null && timeout!==null){
		textIconNotificationTimeout(text, icon, title, timeout);
	} else if(title!==null && text !==null && icon!==null){
		textIconNotification(text, icon,title);
	} else if (title!==null && timeout!==null){
		titleNotificationTimeout(text, timeout);
	} else if (title!==null) {
		titleNotification(title);
	} else if (title!==null && text!==null) {
		titleTextNotification(title,text);
	} else if (title!==null && text!==null && timeout!==null) {
		titleTextNotificationTimeout(title,text,timeout);
	}
}
