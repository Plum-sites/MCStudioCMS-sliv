var audio = new Audio();

function str_random(length = 12) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}

function notify(message, timeout = 7000, type) {
    toastr.options.timeOut = timeout;
    toastr.options.progressBar = true;
    toastr.options.closeButton = true;
    toastr.options.positionClass = 'toast-bottom-left';

    if(type == "info") toastr.info(message).attr('style', 'width:490px !important;max-width:490px !important;');
    if(type == "error") toastr.error(message).attr('style', 'width:490px !important;max-width:490px !important;');
    if(type == "success") toastr.success(message).attr('style', 'width:490px !important;max-width:490px !important;');
    if(type == "warning") toastr.warning(message).attr('style', 'width:490px !important;max-width:490px !important;');

    
    audio.src = '/assets/others/sounds/notify.mp3';
    audio.volume = 0.3;
    audio.play();

    message = "";
    timeout = "";
    type = "";
}

function numDeclensions(n, text_forms) {
    n = Math.abs(n) % 100;
    var n1 = n % 10;
    if(n > 10 && n < 20) {
        return text_forms[2];
    }
    if(n1 > 1 && n1 < 5) {
        return text_forms[1];
    }
    if(n1 == 1) {
        return text_forms[0]; 
    }
    return text_forms[2];
}

function decodeHTMLEntities(text) {
    var entities = [
        ['amp', '&'],
        ['apos', '\''],
        ['#x27', '\''],
        ['#x2F', '/'],
        ['#39', '\''],
        ['#47', '/'],
        ['lt', '<'],
        ['gt', '>'],
        ['nbsp', ' '],
        ['quot', '"']
    ];

    for (var i = 0, max = entities.length; i < max; ++i) 
        text = text.replace(new RegExp('&'+entities[i][0]+';', 'g'), entities[i][1]);

    return text;
}

function discountTimer(endTime) {
    var now = new Date();
    now = (Date.parse(now) / 1000);
    var timeLeft = endTime - now;
    var days = Math.floor(timeLeft / 86400); 
    var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
    var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
    var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));
    // if(hours < '10') {
    //     hours = '0' + hours;
    // }
    // if(minutes < '10') {
    //     minutes = '0' + minutes;
    // }
    // if(seconds < '10') {
    //     seconds = '0' + seconds;
    // }
    if(days >= 1) {
        days = ' '+days;
    } else {
        days = '0';
    }
    if(hours >= 1) {
        hours = ' '+hours;
    } else {
        hours = '0';
    }
    if(minutes >= 1) {
        minutes = ' '+minutes;
    } else {
        minutes = '0';
    }
    if(seconds >= 1) {
        seconds = ' '+seconds;
    } else {
        seconds = '0';
    }
    if(days != '0') {
        $('#discount_days').html(days + ' ' + numDeclensions(days, ['день', 'дня', 'дней'])).css('display', 'inline-block');
    } else {
        $('#discount_days').html('').css('display', 'none');
    }
    if(hours != '0') {
        $('#discount_hour').html(hours + ' ' + numDeclensions(hours, ['час', 'часа', 'часов'])).css('display', 'inline-block');
    } else {
        $('#discount_hour').html('').css('display', 'none');
    }
    if(minutes != '0') {
        $('#discount_mins').html(minutes + ' ' + numDeclensions(minutes, ['минута', 'минуты', 'минут'])).css('display', 'inline-block');
    } else {
        $('#discount_mins').html('').css('display', 'none');
    }
    if(seconds != '0') {
        $('#discount_secs').html(seconds + ' ' + numDeclensions(seconds, ['секунда', 'секунды', 'секунд'])).css('display', 'inline-block');
    } else {
        $('#discount_secs').html('').css('display', 'none');
    }
}