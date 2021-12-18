// UPDATE HTTP URL
function httpupd(word) {
    var rand = Math.random() * Math.random();
    return word + "?u=" + rand;
}

function balance_get(balance_list_server_id = false) {
	$.ajax({
        type: "POST",
        url: "/balance/get",
        data: {
        	_token: csrf_token,
        	balance_list_server_id: (!balance_list_server_id) ? '' : balance_list_server_id
        },
        success: function(data) {
            $('#balance_real').html(data.balance_real);
            if(data.balance_game) {
            	$('#balance_game').html(data.balance_game);
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}

$(document).ready(function () {

	var user_dashboard = "/";
	var click_auth_start = false;
	var click_regs_start = false;

	// AUTHORIZATION
	$(document).on('click', '#button_auth', function(e) {
	    e.preventDefault();
	    if (!click_auth_start) {
	        click_auth_start = true;
	        var click_auth_times = 10;
	        $('#button_auth').html(click_auth_times + " сек...");
	        var click_auth_timer = setInterval(function() {
	            click_auth_times--;
	            $('#button_auth').html(click_auth_times + " сек...");
	            if (click_auth_times <= 0) {
	                click_auth_start = false;
	                $('#button_auth').html('Войти').attr('disabled', false);
	                clearInterval(click_auth_timer);
	            }
	        }, 1000);
	        var formData = new FormData(document.getElementById("form_auth"));
	        $.ajax({
	            type: "POST",
	            url: "/login",
	            data: formData,
	            cache: false,
	            contentType: false,
	            processData: false,
	            success: function(data) {
	                if (data.type == 'warning') {
	                    notify(data.message, 8000, data.type);
	                } else {
	                    $('#preloader').fadeIn();
	                    notify(data.message, 8000, data.type);
	                    setTimeout(function() {
	                        window.location.href = user_dashboard;
	                    }, 1000);
	                }
	            },
	            error: function(data) {
	                if (data.status === 422) {
	                    $('.captcha-image').attr('src', '/captcha/image?u=' + str_random(30));
	                    $('[name="captcha"]').val('');
	                    var errors = $.parseJSON(data.responseText);
	                    $.each(errors, function(key, value) {
	                        if ($.isPlainObject(value)) {
	                            $.each(value, function(key, value) {
	                                notify(value, 8000, "warning");
	                            });
	                        }
	                    });
	                }
	            }
	        });
	    }
	});

	// REGISTRATION
	$(document).on('click', '#button_regs', function(e) {
	    e.preventDefault();
	    if (!click_regs_start) {
	        click_regs_start = true;
	        var click_regs_times = 10;
	        $('#button_regs').html("Подождите " + click_regs_times + " сек...");
	        var click_regs_timer = setInterval(function() {
	            click_regs_times--;
	            $('#button_regs').html("Подождите " + click_regs_times + " сек...");
	            if (click_regs_times <= 0) {
	                click_regs_start = false;
	                $('#button_regs').html('Зарегистрироваться').attr('disabled', false);
	                clearInterval(click_regs_timer);
	            }
	        }, 1000);
	        var formData = new FormData(document.getElementById("form_regs"));
	        $.ajax({
	            type: "POST",
	            url: "/register",
	            data: formData,
	            cache: false,
	            contentType: false,
	            processData: false,
	            success: function(data) {
	                if (data.type == 'warning') {
	                    notify(data.message, 8000, data.type);
	                    if (data.codes_verify) {
	                        $("#regs_step_1").slideUp(200);
	                        $("#regs_step_2").slideDown(200);
	                    }
	                } else {
	                    // $('.captcha-main').slideUp(500);
	                    $('#preloader').fadeIn();
	                    notify(data.message, 8000, data.type);
	                    setTimeout(function() {
	                        window.location.href = user_dashboard;
	                    }, 1000);
	                }
	            },
	            error: function(data) {
	                if (data.status === 422) {
	                    $('.captcha-image').attr('src', '/captcha/image?u=' + str_random(30));
	                    $('[name="captcha"]').val('');
	                    var errors = $.parseJSON(data.responseText);
	                    $.each(errors, function(key, value) {
	                        if ($.isPlainObject(value)) {
	                            $.each(value, function(key, value) {
	                                notify(value, 8000, "warning");
	                            });
	                        }
	                    });
	                }
	            }
	        });
	    }
	});

	// MONITORING
	$(".monitoring > .graphy > .servers").knob({
        'fgColorStart' : '#89cfeb',
        'fgColorEnd' : '#ff5252',
        'format' : function (value) {
           return value;
        },
        'draw': function () {
            var v=parseInt($(this.i).val(),10);
            var cs=colorParse(this.o.fgColorStart); //Start color
            var ce=colorParse(this.o.fgColorEnd); //End color
            var ends = new Array(new Color(cs[0],cs[1],cs[2]),new Color(ce[0],ce[1],ce[2]));
            var steps = (this.o.max - this.o.min) / this.o.step;
            var step = new Array(3);
            var color = mixPalette();

            this.o.fgColor=color;
            this.$.css({'color':color});
            function Color(r,g,b) {
                this.r = r;
                this.g = g;
                this.b = b;
                this.coll = new Array(r,g,b);
                this.text = cText(this.coll);
            }

            function colorParse(c) {
                c = c.toUpperCase();
                col = c.replace(/[\#\(\)]*/i,'');
                var num = new Array(col.substr(0,2),col.substr(2,2),col.substr(4,2));
                var ret = new Array(parseInt(num[0],16),parseInt(num[1],16),parseInt(num[2],16));
                return(ret);
            }

            function stepCalc() {
                step[0] = (ends[1].r - ends[0].r) / steps;
                step[1] = (ends[1].g - ends[0].g) / steps;
                step[2] = (ends[1].b - ends[0].b) / steps;
            }

            function mixPalette() {
                stepCalc();
                var r = (ends[0].r + (step[0] * v));
                var g = (ends[0].g + (step[1] * v));
                var b = (ends[0].b + (step[2] * v));
                var color = new Color(r,g,b);
                return color.text;
                //console.log(palette[i]);
            }

            function cText(c) {
                var result = '';
                for (k = 0; k < 3; k++) {
                  val = Math.round(c[k]/1);
                  piece = val.toString(16);
                  if (piece.length < 2) {piece = '0' + piece;}
                  result = result + piece;
                }
                result = '#' + result.toUpperCase();
                return result;
            }
        }
    });

    // MOUSE POSITION
    function mousemove(x, y) {
        let wh = $("#skin-data-mouse").width(),
            ww = $("#skin-data-mouse").height();
        document.body.style.setProperty("--mouseX", (x - ww) / 35 + "deg");
        document.body.style.setProperty("--mouseY", (wh - y) / 25 + "deg");
    }
    document.addEventListener("mousemove", function(e) {
        mousemove(e.clientX, e.clientY);
    });

	// INITIALIZE TOOLTIPS
    $(function () {
		$('[data-toggle="tooltip"]').tooltip();
	})

});