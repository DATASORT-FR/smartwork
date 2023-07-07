/**
* administrator application : javascript
*
* @package    app_administrator
* @subpackage controller
* @version    1.0
* @date       15 September 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*!
 * swiped-events.js - v@version@
 * Pure JavaScript swipe events
 * https://github.com/john-doherty/swiped-events
 * @inspiration https://stackoverflow.com/questions/16348031/disable-scrolling-when-touch-moving-certain-element
 * @author John Doherty <www.johndoherty.info>
 * @license MIT
 */
(function (window, document) {

    'use strict';

    // patch CustomEvent to allow constructor creation (IE/Chrome)
    if (typeof window.CustomEvent !== 'function') {

        window.CustomEvent = function (event, params) {

            params = params || { bubbles: false, cancelable: false, detail: undefined };

            var evt = document.createEvent('CustomEvent');
            evt.initCustomEvent(event, params.bubbles, params.cancelable, params.detail);
            return evt;
        };

        window.CustomEvent.prototype = window.Event.prototype;
    }

    document.addEventListener('touchstart', handleTouchStart, false);
    document.addEventListener('touchmove', handleTouchMove, false);
    document.addEventListener('touchend', handleTouchEnd, false);

    var xDown = null;
    var yDown = null;
    var xDiff = null;
    var yDiff = null;
    var timeDown = null;
    var startEl = null;

    /**
     * Fires swiped event if swipe detected on touchend
     * @param {object} e - browser event object
     * @returns {void}
     */
    function handleTouchEnd(e) {

        // if the user released on a different target, cancel!
        if (startEl !== e.target) return;

        var swipeThreshold = parseInt(getNearestAttribute(startEl, 'data-swipe-threshold', '20'), 10); // default 20px
        var swipeTimeout = parseInt(getNearestAttribute(startEl, 'data-swipe-timeout', '500'), 10);    // default 500ms
        var timeDiff = Date.now() - timeDown;
        var eventType = '';
        var changedTouches = e.changedTouches || e.touches || [];

        if (Math.abs(xDiff) > Math.abs(yDiff)) { // most significant
            if (Math.abs(xDiff) > swipeThreshold && timeDiff < swipeTimeout) {
                if (xDiff > 0) {
                    eventType = 'swiped-left';
                }
                else {
                    eventType = 'swiped-right';
                }
            }
        }
        else if (Math.abs(yDiff) > swipeThreshold && timeDiff < swipeTimeout) {
            if (yDiff > 0) {
                eventType = 'swiped-up';
            }
            else {
                eventType = 'swiped-down';
            }
        }

        if (eventType !== '') {

            var eventData = {
                dir: eventType.replace(/swiped-/, ''),
                xStart: parseInt(xDown, 10),
                xEnd: parseInt((changedTouches[0] || {}).clientX || -1, 10),
                yStart: parseInt(yDown, 10),
                yEnd: parseInt((changedTouches[0] || {}).clientY || -1, 10)
            };

            // fire `swiped` event event on the element that started the swipe
            startEl.dispatchEvent(new CustomEvent('swiped', { bubbles: true, cancelable: true, detail: eventData }));

            // fire `swiped-dir` event on the element that started the swipe
            startEl.dispatchEvent(new CustomEvent(eventType, { bubbles: true, cancelable: true, detail: eventData }));
        }

        // reset values
        xDown = null;
        yDown = null;
        timeDown = null;
    }

    /**
     * Records current location on touchstart event
     * @param {object} e - browser event object
     * @returns {void}
     */
    function handleTouchStart(e) {

        // if the element has data-swipe-ignore="true" we stop listening for swipe events
        if (e.target.getAttribute('data-swipe-ignore') === 'true') return;

        startEl = e.target;

        timeDown = Date.now();
        xDown = e.touches[0].clientX;
        yDown = e.touches[0].clientY;
        xDiff = 0;
        yDiff = 0;
    }

    /**
     * Records location diff in px on touchmove event
     * @param {object} e - browser event object
     * @returns {void}
     */
    function handleTouchMove(e) {

        if (!xDown || !yDown) return;

        var xUp = e.touches[0].clientX;
        var yUp = e.touches[0].clientY;

        xDiff = xDown - xUp;
        yDiff = yDown - yUp;
    }

    /**
     * Gets attribute off HTML element or nearest parent
     * @param {object} el - HTML element to retrieve attribute from
     * @param {string} attributeName - name of the attribute
     * @param {any} defaultValue - default value to return if no match found
     * @returns {any} attribute value or defaultValue
     */
    function getNearestAttribute(el, attributeName, defaultValue) {

        // walk up the dom tree looking for data-action and data-trigger
        while (el && el !== document.documentElement) {

            var attributeValue = el.getAttribute(attributeName);

            if (attributeValue) {
                return attributeValue;
            }

            el = el.parentNode;
        }

        return defaultValue;
    }

}(window, document));

/*glissé vers la gauche */
/*
document.addEventListener('swiped-left', function(e) {
    console.log(e.target); // the element that was swiped
});
*/

/*glissé vers la droite */
/*
document.addEventListener('swiped-right', function(e) {
    console.log(e.target); // the element that was swiped
});
*/

/*balayé */
/*
document.addEventListener('swiped-up', function(e) {
    console.log(e.target); // the element that was swiped
});
*/

/*glissé vers le bas */
/*
document.addEventListener('swiped-down', function(e) {
    console.log(e.target); // the element that was swiped
});
*/

/* Vous pouvez également attacher directement à un élément: */
/*
document.getElementById('myBox').addEventListener('swiped-down', function(e) {
    console.log(e.target); // the element that was swiped
});
*/

var loginReturnBlock = $(".undefined:first");
var inscriptionReturnBlock = $(".undefined:first");
var loginDefaultTab = 1;

$(document).ready(
	function() {

		initDisplay = function() {
			var box1;
			var contentHeight;
			var windowHeight = window.innerHeight;
		
			$("body.outil").css("overflow-y","hidden");
			box1 = $(".espace-block>.header:first");
			contentHeight = windowHeight - 4*box1.height() - 56;
			$(".espace-block.article>.content").css('height', contentHeight +'px');
			contentHeight = windowHeight - 4*box1.height();
			$(".espace-block.situation>.content").css('height', contentHeight +'px');
			$(".espace-block.variable>.content").css('height', contentHeight +'px');
			$(".espace-block.result>.content").css('height', contentHeight +'px');
			$(".espace-block.procedure>.content").css('height', contentHeight +'px');

			contentHeight = windowHeight  - $(".footer:first").height() - 40;
			$("#content-page").css('min-height', contentHeight +'px');
		}
		
		loginDisplay  = function() {
			var theHREF = $("#content:first").attr("loginRef");
			ws_loginDisplay(theHREF);
		}
 
		$(document).on("mouseover", ".header-link",
			function(e) {
				$(".bar-link").removeClass("display-none");
			}
		);

		$(document).on("mouseout", ".header-link",
			function(e) {
				$(".bar-link").addClass("display-none"); ; 
			}
		);

		$(document).on("click", ".tab-link [class^=link]",
			function(e) {
				e.stopPropagation();
				var id = $(this).attr("href");
				var blockLink = $(this).parents(".tab-link:first");
				blockLink.children("[class^=link]").removeClass("up");
				blockLink.children("[class^=link]").addClass("down");
				$(this).removeClass("down");
				$(this).addClass("up");
				
				var blockTab = $(id).parents(".tab-content:first");
				blockTab.children(".tab").removeClass("up");
				blockTab.children(".tab").addClass("down");
				$(id).removeClass("down");
				$(id).addClass("up");
			}
		);
				

		$(document).on("click", ".link-login",
			function(e) {
				e.stopPropagation();
				loginDisplay();
			}
		);
		
							
		$(window).on('resize', 
			function(e) {
				initDisplay();
			}
		);
		initDisplay();

		/* contact control */
		ctrl_contact_name  = function() {
			var return_value = false;
			if ($(".contact-block .contact_name").val() != '') {
				return_value = true; 
			}
			else {
				$(".contact-block .msg-name:first").removeClass("display-none");
			}
			return return_value;
		}

		ctrl_contact_mail  = function() {
			var return_value = false;
			var pattern = /^[a-z0-9.-]{2,}@+[a-z0-9.-]{2,}$/i;
			var email = $(".contact-block .contact_email").val();
 
			if ((email != '') && pattern.test(email))
			{
				return_value = true; 
			}
			else {
				$(".contact-block .msg-email:first").removeClass("display-none");
			}
			return return_value;
		}

		ctrl_contact_phone  = function() {
			var return_value = false;
			if ($(".contact-block .contact_phone").val() != '') {
				return_value = true; 
			}
			else {
				$(".contact-block .msg-phone:first").removeClass("display-none");
			}
			return return_value;
		}

		ctrl_contact_message  = function() {
			var return_value = false;
			if ($(".contact-block .contact_message").val() != '') {
				return_value = true; 
			}
			else {
				$(".contact-block .msg-message:first").removeClass("display-none");
			}
			return return_value;
		}

		$(document).on("blur", ".contact-block .contact_name",
			function(e) {
				$(".contact-block .message").addClass("display-none");
				ctrl_contact_name();
			}
		)

		$(document).on("blur", ".contact-block .contact_email",
			function(e) {
				$(".contact-block .message").addClass("display-none");
				ctrl_contact_mail();
			}
		)

		$(document).on("click", ".contact-block .contact_button",
			function(e) {
				e.preventDefault();
				var formValidate = true;
				var theHREF = $(this).attr("event");
				var form = $(this).parents("form:first");
				var postData = form.serialize();
				var buttonThis = $(this);

				$(".contact-block .message").addClass("display-none");
				if (!ctrl_contact_name()) {
					formValidate = false;
				}
				if (!ctrl_contact_mail()) {
					formValidate = false;
				}
				if (!ctrl_contact_phone()) {
					formValidate = false;
				}
				if (!ctrl_contact_message()) {
					formValidate = false;
				}

				if (formValidate) {
					$(".contact-block").addClass("wait");
					buttonThis.addClass("wait");
					$.ajax({
						url: theHREF,
						type : 'POST',
						data : postData,
						success: function(result) {
 							$(".contact-block").removeClass("wait");
							buttonThis.removeClass("wait");
							var email = $(".contact-block .contact_email:first").val();
 							switch (result) {
								case 'Ok':
									$(".contact-block .form-contact").addClass("display-none");
									$(".contact-block .validation").removeClass("display-none");
									$(".contact-block .validation .email:first").html(email);
									break;
								default:
									$(".contact-block .msg-error:first").removeClass("display-none");
							}
						}
					});
				}
			}
		);

		$(document).on("click", "a[href]",
			function(e) {
				e.preventDefault();
				var url = $(this).attr("href");
				var target = $(this).attr("target");
				var position1 = url.indexOf(".");
				var position2 = url.indexOf("#");
				var linkFlag = true;
				if (typeof(target) === "undefined") {
					if ((linkFlag) && ($(this).hasClass("link-btn"))) {
						linkFlag = false;
					}
					if (linkFlag) {
						if ((position1 != 0) && (position2 != 0)) {
							window.open (url, '_newtab');
						}
						else {
							if (position2 != 0) {
								window.open (url, '_self');
							}
						}
					}
					else {
						if ((typeof(target) === "undefined") || (target == null) || (target == ''))  {
							target = '_self';
						}
						window.open (url, target);
					}
				}
				else {
					window.open (url, target);
				}
			}
		);
		
		function playVideo(iframeSelector, nb) {
			if (nb > 0) {
				try {
					var src = $(iframeSelector).attr('src');
					$(iframeSelector).attr('src', src + '&autoplay=1');
				} 
				catch(err) {
					setTimeout(function() {
						playVideo(iframe, nb - 1)
					}, 500);
				}
			}
		}
		
		$(document).on("click", ".home .video-top figure img",
			function(e) {
				e.preventDefault();
				$(".home .video-top .text").addClass('display-none');
				var html = '<iframe src="https://www.youtube.com/embed/f9n6h_xG5Is?mute=1&version=3&loop=1&playlist=f9n6h_xG5Is&controls=2&showinfo=0&rel=0&enablejsapi=1"'
						+ 'frameborder="0" allowfullscreen>'
						+ '</iframe>';
				$(".home .video-top figure").html(html);
				playVideo('.home .video-top figure iframe', 10);
			}
		);

		$(document).on("click", ".cookie-choice .cookie-accept",
			function(e) {
				e.preventDefault();
				$(".cookie-choice").addClass('display-none');
				var theHREF = $(this).attr("event");
				$.ajax({
					url: theHREF,
					async : true,
					success : function(code_html, status){
					}
				});
			}
		);

		$(document).on("click", ".cookie-container .cookie-accept, .cookie-dismiss",
			function(e) {
				e.preventDefault();
				$(".cookie-choice").addClass('display-none');
				var theHREF = $(this).attr("event");
				$.ajax({
					url: theHREF,
					success : function(result){
						location.reload();
					}
				});
			}
		);

		$(document).on('keypress', ".login-block .form-login .user_login, .login-block .form-login .user_password", 
			function (e) {
				if(e.which === 13) {
					$(".login-block .user_login_button").click();
				}
			}
		);
		
		$(document).on("click", ".phone-ask",
			function(e) {
				e.stopPropagation();
				$(".phone-ask").addClass('display-none');
				$(".phone-nb").removeClass('display-none');
			}
		);

		$(document).on("click", ".phone-nb",
			function(e) {
				e.stopPropagation();
				$(".phone-nb").addClass('display-none');
				$(".phone-ask").removeClass('display-none');
			}
		);

		$(".phone-nb").on("mouseleave",
			function(e) {
				e.stopPropagation();
				$(".phone-nb").addClass('display-none');
				$(".phone-ask").removeClass('display-none');
			}
		);

		$(document).on("click", "body",
			function(e) {
				$(".init-display-none").addClass('display-none');
				$(".init-display").removeClass('display-none');
			}
		);
	}
);
