"use strict";
var base_url = APP_URL+'/';

// Class definition
var KTAppChat = function () {
	var _chatAsideEl;
	var _chatAsideOffcanvasObj;
	var _chatContentEl;

	// Private functions
	var _initAside = function () {
		// Mobile offcanvas for mobile mode
		_chatAsideOffcanvasObj = new KTOffcanvas(_chatAsideEl, {
			overlay: true,
            baseClass: 'offcanvas-mobile',
            //closeBy: 'kt_chat_aside_close',
            toggleBy: 'kt_app_chat_toggle'
        });

		// User listing
		var cardScrollEl = KTUtil.find(_chatAsideEl, '.scroll');
		var cardBodyEl = KTUtil.find(_chatAsideEl, '.card-body');
		var searchEl = KTUtil.find(_chatAsideEl, '.input-group');

		if (cardScrollEl) {
			// Initialize perfect scrollbar(see:  https://github.com/utatti/perfect-scrollbar)
			KTUtil.scrollInit(cardScrollEl, {
				mobileNativeScroll: true,  // Enable native scroll for mobile
				desktopNativeScroll: false, // Disable native scroll and use custom scroll for desktop
				resetHeightOnDestroy: true,  // Reset css height on scroll feature destroyed
				handleWindowResize: true, // Recalculate hight on window resize
				rememberPosition: true, // Remember scroll position in cookie
				height: function() {  // Calculate height
					var height;

					if (KTUtil.isBreakpointUp('lg')) {
						height = KTLayoutContent.getHeight();
					} else {
						height = KTUtil.getViewPort().height;
					}

					if (_chatAsideEl) {
						height = height - parseInt(KTUtil.css(_chatAsideEl, 'margin-top')) - parseInt(KTUtil.css(_chatAsideEl, 'margin-bottom'));
						height = height - parseInt(KTUtil.css(_chatAsideEl, 'padding-top')) - parseInt(KTUtil.css(_chatAsideEl, 'padding-bottom'));
					}

					if (cardScrollEl) {
						height = height - parseInt(KTUtil.css(cardScrollEl, 'margin-top')) - parseInt(KTUtil.css(cardScrollEl, 'margin-bottom'));
					}

					if (cardBodyEl) {
						height = height - parseInt(KTUtil.css(cardBodyEl, 'padding-top')) - parseInt(KTUtil.css(cardBodyEl, 'padding-bottom'));
					}

					if (searchEl) {
						height = height - parseInt(KTUtil.css(searchEl, 'height'));
						height = height - parseInt(KTUtil.css(searchEl, 'margin-top')) - parseInt(KTUtil.css(searchEl, 'margin-bottom'));
					}

					// Remove additional space
					height = height - 2;

					return height;
				}
			});
		}
	}

	return {
		// Public functions
		init: function() {
			// Elements
			_chatAsideEl = KTUtil.getById('kt_chat_aside');
			_chatContentEl = KTUtil.getById('kt_chat_content');

			// Init aside and user list
			_initAside();

			// Init inline chat example
			KTLayoutChat.setup(KTUtil.getById('kt_chat_content'));

			// Trigger click to show popup modal chat on page load
			if (KTUtil.getById('kt_app_chat_toggle')) {
				setTimeout(function() {
					KTUtil.getById('kt_app_chat_toggle').click();
				}, 1000);
			}
		}
	};
}();

jQuery(document).ready(function() {
	KTAppChat.init();
});


// Class definition
var KTLayoutChat = function () {

	// Private functions
	var _init = function (element) {
		var scrollEl = KTUtil.find(element, '.scroll');
		var cardBodyEl = KTUtil.find(element, '.card-body');
		var cardHeaderEl = KTUtil.find(element, '.card-header');
		var cardFooterEl = KTUtil.find(element, '.card-footer');

		if (!scrollEl) {
			return;
		}

		// initialize perfect scrollbar(see:  https://github.com/utatti/perfect-scrollbar)
		KTUtil.scrollInit(scrollEl, {
			windowScroll: false, // allow browser scroll when the scroll reaches the end of the side
			mobileNativeScroll: true,  // enable native scroll for mobile
			desktopNativeScroll: false, // disable native scroll and use custom scroll for desktop
			resetHeightOnDestroy: true,  // reset css height on scroll feature destroyed
			handleWindowResize: true, // recalculate hight on window resize
			rememberPosition: true, // remember scroll position in cookie
			height: function() {  // calculate height
				var height;

				if (KTUtil.isBreakpointDown('lg')) { // Mobile mode
					return KTUtil.hasAttr(scrollEl, 'data-mobile-height') ? parseInt(KTUtil.attr(scrollEl, 'data-mobile-height')) : 400;
				} else if (KTUtil.isBreakpointUp('lg') && KTUtil.hasAttr(scrollEl, 'data-height')) { // Desktop Mode
					return parseInt(KTUtil.attr(scrollEl, 'data-height'));
				} else {
					height = KTLayoutContent.getHeight();

					if (scrollEl) {
						height = height - parseInt(KTUtil.css(scrollEl, 'margin-top')) - parseInt(KTUtil.css(scrollEl, 'margin-bottom'));
					}

					if (cardHeaderEl) {
						height = height - parseInt(KTUtil.css(cardHeaderEl, 'height'));
						height = height - parseInt(KTUtil.css(cardHeaderEl, 'margin-top')) - parseInt(KTUtil.css(cardHeaderEl, 'margin-bottom'));
					}

					if (cardBodyEl) {
						height = height - parseInt(KTUtil.css(cardBodyEl, 'padding-top')) - parseInt(KTUtil.css(cardBodyEl, 'padding-bottom'));
					}

					if (cardFooterEl) {
						height = height - parseInt(KTUtil.css(cardFooterEl, 'height'));
						height = height - parseInt(KTUtil.css(cardFooterEl, 'margin-top')) - parseInt(KTUtil.css(cardFooterEl, 'margin-bottom'));
					}
				}

				// Remove additional space
				height = height - 2;

				return height;
			}
		});

		KTUtil.on(element, '#btn_chat_send', 'click', function(e) {
			_sendMessageFromOrg(element);
            getChats();
		});

	}

    var _sendMessageFromOrg = function(element){
        var messagesEl = KTUtil.find(element, '.messages');
		var scrollEl = KTUtil.find(element, '.scroll');
        var textarea = KTUtil.find(element, 'textarea');

        if (textarea.value.length === 0 ) {
            return;
        }

        $.ajax({
            type: 'post',
            url: base_url+'organization/sent_message_from_org',
            data: {
                'complain_id': $('#complain_id').val(),
                'body': $('#message_body').val(),
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                var message = JSON.parse(data);
                var html = '';
                html += '<div class="d-flex flex-column mb-5 align-items-end">';
                html += '<div class="d-flex align-items-center">';
                html += '	<div>';
                html += '		<span class="text-muted font-size-sm">'+message.created_at.substring(0,10)+'</span>';
                html += '	</div>';
                html += '</div>';
                html += '<div class="mt-2 rounded p-3 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">' + message.body;
                html += '	<div>';

                if(message.seen_status == 0){
                    html += '<span id="'+message.id+'" class="text-muted font-size-sm"><i class="fa fa-check-circle font-size-sm"></i></span>';
                }else{
                    html += '<span id="'+message.id+'" class="text-muted font-size-sm"><i class="fa fa-check-circle font-size-sm text-primary"></i></span>';
                }
                html += '	</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';


                $('#messages_div').append(html);
                $('#message_body').val('');

                scrollEl.scrollTop = parseInt(KTUtil.css(messagesEl, 'height'));

                var ps;
                if (ps = KTUtil.data(scrollEl).get('ps')) {
                    ps.update();
                }
            }
        });


    }

	// Public methods
	return {
		init: function() {
			// init modal chat example
			_init(KTUtil.getById('kt_chat_modal'));

			// trigger click to show popup modal chat on page load
			if (encodeURI(window.location.hostname) == 'keenthemes.com' || encodeURI(window.location.hostname) == 'www.keenthemes.com') {
				setTimeout(function() {
		            if (!KTCookie.getCookie('kt_app_chat_shown')) {
		                var expires = new Date(new Date().getTime() + 60 * 60 * 1000); // expire in 60 minutes from now

						KTCookie.setCookie('kt_app_chat_shown', 1, { expires: expires });

						if (KTUtil.getById('kt_app_chat_launch_btn')) {
							KTUtil.getById('kt_app_chat_launch_btn').click();
						}
		            }
		        }, 2000);
	        }
        },

        setup: function(element) {
            _init(element);
        }
	};
}();

function getComplainChat(complain_id){
    $.ajax({
        type: 'get',
        url: base_url+'organization/complain_messages',
        data: {
            'complain_id': complain_id,
        },
        success: function(data) {
            fillDivByMessages(data);
            var objDiv = document.getElementById("scrollable_div");
            objDiv.scrollTop = objDiv.scrollHeight;
        }
    });
}

function fillDivByMessages(data){
    var jsonData = JSON.parse(data);
    var messages = jsonData.messages;
    var complain = jsonData.complain;
    var html = '';

    for(var row in messages){
        if( messages[row].sender_is_admin == 0){
            html += '<div class="d-flex flex-column mb-5 align-items-end">';
            html += '<div class="d-flex align-items-center">';
            html += '	<div>';
            html += '		<span class="text-muted font-size-sm">' +messages[row].created_at.substring(0,10)+'</span>';
            html += '	</div>';
            html += '</div>';
            html += '<div class="mt-2 rounded p-3 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">' + messages[row].body ;

            html += '	<div>';
            if(messages[row].seen_status == 0){
                html += '<span id="'+messages[row].id+'" class="text-muted font-size-sm"><i class="fa fa-check-circle font-size-sm"></i></span>';
            }else{
                html += '<span id="'+messages[row].id+'" class="text-muted font-size-sm"><i class="fa fa-check-circle font-size-sm text-primary"></i></span>';
            }

            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
        }else{
            html += '<div class="d-flex flex-column mb-5 align-items-start">';
            html += '<div class="d-flex align-items-center">';
            html += '	<div>';
            html += '		<span class="text-muted font-size-sm">' +messages[row].created_at.substring(0,10)+'</span>';
            html += '	</div>';
            html += '</div>';
            html += '<div class="mt-2 rounded p-3 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">' + messages[row].body + '</div>';
            html += '</div>';
        }
    }

    $('#complain_image').css('background-image', 'url(' +base_url+'assets/images/'+complain.attachments.split("|")[0]+ ')');
    $('#complain_title').html(complain.title);
    $('#complain_body').html(complain.content);
    $('#complain_id').val(complain.id);
    $('#messages_div').html(html);
}

function getIncomingMessagesToOrg(){
    $.ajax({
        type: 'get',
        url: base_url+'organization/get_incoming_messages_to_org',
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            var complain_id = $('#complain_id').val();
            var messages = JSON.parse(data);
            var html = '';

            if(messages.length > 0){
                for(var row in messages){
                    if( messages[row].complain_id == complain_id){
                        // update to seen
                        updateToSeen(messages[row].id);
                        html += '<div class="d-flex flex-column mb-5 align-items-start">';
                        html += '<div class="d-flex align-items-center">';
                        html += '	<div>';
                        html += '		<span class="text-muted font-size-sm">' +messages[row].created_at.substring(0,10)+'</span>';
                        html += '	</div>';
                        html += '</div>';
                        html += '<div class="mt-2 rounded p-3 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">' + messages[row].body + '</div>';
                        html += '</div>';

                        $('#messages_div').append(html);
                        var objDiv = document.getElementById("scrollable_div");
                        objDiv.scrollTop = objDiv.scrollHeight;
                    }

                }
            }
        }
    });
}

function getIncomingMessagescount(){
    $.ajax({
        type: 'get',
        url: base_url+'organization/get_un_messages_count_to_org',
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            $('#unseen_msg_count').html(data);
        }
    });
}

function updateToSeen(id){
    $.ajax({
        type: 'post',
        url: base_url+'organization/update_message_status_to_seen',
        data: {
            'id': id,
            '_token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            console.log(data);
        }
    });
}

function getUpdatedSeenMessagesToOrg(){
    $.ajax({
        type: 'get',
        url: base_url+'organization/get_updated_seen_messages_to_org',
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {

            var messages = JSON.parse(data);

            for(var row in messages){
                if(messages[row].seen_status == 1){
                    document.getElementById(messages[row].id).innerHTML = '<i class="fa fa-check-circle font-size-sm text-primary"></i>';
                    updateToSeenOnSender(messages[row].id);
                }
            }

        }
    });
}

function updateToSeenOnSender(id){
    $.ajax({
        type: 'post',
        url: base_url+'organization/update_to_seen_on_sender',
        data: {
            'id': id,
            '_token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            console.log(data);
        }
    });
}

setInterval(function() {
    getUpdatedSeenMessagesToOrg();
    getIncomingMessagesToOrg();
}, 1000);
