// NOTIFICATION
function notify(message, timeout = 7000, type) {
    toastr.options.timeOut = timeout;
    toastr.options.progressBar = true;
    toastr.options.closeButton = false;
    toastr.options.positionClass = 'toast-bottom-left';

    if(type == "info") toastr.info(message);
    if(type == "error") toastr.error(message);
    if(type == "success") toastr.success(message);
    if(type == "warning") toastr.warning(message);

    var audio = new Audio();
    audio.src = '/assets/others/sounds/notify.mp3';
    audio.volume = 0.3;
    audio.play();

    message = "";
    timeout = "";
    type = "";
}

// STR RANDOM
function str_random(length = 12) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}

// Getter GET params
var _GET = window.location.search.replace('?','').split('&').reduce(function(p, e) {
    var a = e.split('=');
    p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
    return p;
}, {});

(function () {
	"use strict";

	var treeviewMenu = $('.app-menu');

	// Toggle Sidebar
  
  if($(window).width() <= '500') {
    $('.app').removeClass('sidenav-toggled');
  } else {
    $('.app').addClass('sidenav-toggled');
  }
	$('[data-toggle="sidebar"]').click(function(event) {
		event.preventDefault();
		$('.app').toggleClass('sidenav-toggled');
	});

	// Activate sidebar treeview toggle
	$("[data-toggle='treeview']").click(function(event) {
		event.preventDefault();
		if(!$(this).parent().hasClass('is-expanded')) {
			treeviewMenu.find("[data-toggle='treeview']").parent().removeClass('is-expanded');
		}
		$(this).parent().toggleClass('is-expanded');
	});

	// Set initial active toggle
	$("[data-toggle='treeview.'].is-expanded").parent().toggleClass('is-expanded');

	//Activate bootstrip tooltips
	$('[data-toggle="tooltips"]').tooltip();

  // Show or hide input
  $('[data-hover-view="password"]').focus(function(){
      $(this).attr('type', 'text');
  }).focusout(function() {
      $(this).attr('type', 'password');
  });

	// setInterval(function() {
 //        console.clear();
 //    }, 1000);

})();
