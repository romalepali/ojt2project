$(document).ready(function() {
	setInterval(function(){ checknotif(); }, 5000);
	setInterval(function(){ updatenotif(); }, 10000);
});

function checknotif() {
	if (!Notification) {
		$('body').append('<h4 style="color:red">*Browser does not support Web Notification</h4>');
		return;
	}
	if (Notification.permission !== "granted"){
		Notification.requestPermission();
	}else {
		$.ajax({
			url : "notifications.php",
			type: "POST",
			success: function(data, textStatus, jqXHR){
				var data = jQuery.parseJSON(data);
				var data_notif = data.notif;
					
				for (var i = data_notif.length - 1; i >= 0; i--) {
					var theurl = data_notif[i]['url'];
					var notifikasi = new Notification(data_notif[i]['title'], {
						icon: data_notif[i]['icon'],
						body: data_notif[i]['msg'],
					});
					notifikasi.onclick = function () {
						window.open(theurl); 
						notifikasi.close();     
					};
					setTimeout(function(){
						notifikasi.close();
					}, 5000);
				};
			},
		});	
	}
};

function updatenotif() {
	$.ajax({
		url : "notifications_update.php",
		type: "POST"
	});	
};