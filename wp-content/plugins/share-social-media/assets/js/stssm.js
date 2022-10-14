(function() {
	'use strict';

	if ( 'undefined' === typeof stssm ) {
		return;
	}

	if ( ! Element.prototype.matches ) {
		Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector;
	}

	if ( '1' === stssm.sticky ) {
		var html = '' +
		'<div id="stssm-popup" class="stssm-overlay stssm-light">' +
			'<div class="stssm-popup">' +
				'<a class="stssm-popup-cancel" href="#"></a>' +
				'<div class="stssm-popup-content">' +
					'<ul class="stssm-social-icons stssm-content-social-icons">' +
						' <li><i class="fab fa-facebook-f"></i></li>' +
						' <li><i class="fab fa-twitter"></i></li>' +
						' <li><i class="fab fa-linkedin"></i></li>' +
						' <li><i class="fab fa-pinterest"></i></li>' +
						' <li><i class="fab fa-reddit"></i></li>' +
						' <li><i class="fab fa-tumblr"></i></li>' +
						' <li><i class="fab fa-blogger"></i></li>' +
						' <li><i class="fab fa-wordpress-simple"></i></li>' +
						' <li><i class="fab fa-line"></i></li>' +
						' <li><i class="fab fa-buffer"></i></li>' +
						' <li><i class="fab fa-whatsapp"></i></li>' +
						' <li><i class="fas fa-envelope"></i></li>' +
					'</ul>' +
				'</div>' +
			'</div>' +
		'</div>' +
		'<ul class="stssm-social-icons stssm-sticky-social-icons">' +
			'<li><i class="fab fa-facebook-f"></i></li>' +
			'<li><i class="fab fa-twitter"></i></li>' +
			'<li><i class="fab fa-linkedin"></i></li>' +
			'<li><i class="fab fa-pinterest"></i></li>' +
			'<li><i class="fab fa-reddit"></i></li>' +
			'<li><i class="fab fa-whatsapp"></i></li>' +
			'<li><i class="fas fa-envelope"></i></li>' +
			'<li>' +
				'<a class="stssm-more" href="#stssm-popup"></a>' +
			'</li>' +
			'<li class="stssm-toggle-icons">' +
				'<div class="stssm-toggle"></div>' +
			'</li>' +
		'</ul>' +
		'';

		document.body.innerHTML += html;

		var hidden = localStorage.getItem('stssm-sticky-hidden');
		if(('1' === hidden)) {
			var icons = document.querySelectorAll('.stssm-sticky-social-icons li:not(:last-child)');
			for(var i = 0; i < icons.length; i++) {
				icons[i].className = 'stssm-hide';
			}
		}

		document.addEventListener('click', function (event) {
			if(event.target.matches('.stssm-social-icons .stssm-toggle')) {
				var hidden = localStorage.getItem('stssm-sticky-hidden');
				if(('0' === hidden) || !hidden) {
					var icons = document.querySelectorAll('.stssm-sticky-social-icons li:not(:last-child)');
					for(var i = 0; i < icons.length; i++) {
						icons[i].className = 'stssm-hide';
					}
					localStorage.setItem('stssm-sticky-hidden', '1');
				} else {
					var icons = document.querySelectorAll('.stssm-sticky-social-icons li:not(:last-child)');
					for(var i = 0; i < icons.length; i++) {
						icons[i].className = '';
					}
					localStorage.setItem('stssm-sticky-hidden', '0');
				}
			}
		});
	}

	function stssmSocialWindow(url) {
		var left = (screen.width - 570) / 2;
		var top = (screen.height - 570) / 2;
		var params = 'menubar=no,toolbar=no,status=no,width=570,height=570,top=' + top + ',left=' + left;
		window.open(url, 'NewWindow', params);
	}

	function stssmSetShareLinks() {
		var url = document.URL;
		var lastCharacter = url[url.length - 1];
		if('#' === lastCharacter) {
			url = url.substring(0, url.length - 1);
		}
		var pageUrl = encodeURIComponent(url);
		var title = document.title;
		var desc = document.querySelector("meta[name='description']");
		var text = document.querySelector("meta[property='og:description']");
		var media = document.querySelector("meta[property='og:image']");

		if ( desc ) {
			desc = desc.getAttribute('content');
		}
		if ( text ) {
			text = text.getAttribute('content');
		}
		if ( media ) {
			media = media.getAttribute('content');
		}

		if ( ! title ) {
			title = stssm.title;
		}
		if ( ! desc ) {
			desc = stssm.desc;
		}
		if ( ! text ) {
			text = desc;
		}
		if ( ! media ) {
			media = stssm.image;
		}

		if ( title ) {
			title = encodeURIComponent(title);
		} else {
			title = '';
		}

		if ( desc ) {
			desc = encodeURIComponent(desc);
		} else {
			desc = '';
		}

		if ( text ) {
			text = encodeURIComponent(text);
		} else {
			text = '';
		}

		if ( media ) {
			media = encodeURIComponent(media);
		} else {
			media = '';
		}

		document.addEventListener('click', function (event) {
			if(event.target.matches('.stssm-social-icons .fa-facebook-f')) {
				var url = 'https://www.facebook.com/sharer.php?u=' + pageUrl;
				stssmSocialWindow(url);
			} else if(event.target.matches('.stssm-social-icons .fa-twitter')) {
				var url = 'https://twitter.com/intent/tweet?url=' + pageUrl + "&text=" + text;
				stssmSocialWindow(url);
			} else if(event.target.matches('.stssm-social-icons .fa-linkedin')) {
				var url = 'https://www.linkedin.com/shareArticle?mini=true&url=' + pageUrl;
				stssmSocialWindow(url);
			} else if(event.target.matches('.stssm-social-icons .fa-pinterest')) {
				var url = 'https://www.pinterest.com/pin/create/link/?url=' + pageUrl + '&media=' + media + '&description=' + desc;
				stssmSocialWindow(url);
			} else if(event.target.matches('.stssm-social-icons .fa-reddit')) {
				var url = 'https://reddit.com/submit?url=' + pageUrl + '&title=' + title;
				stssmSocialWindow(url);
			} else if(event.target.matches('.stssm-social-icons .fa-tumblr')) {
				var url = 'https://www.tumblr.com/widgets/share/tool?canonicalUrl=' + pageUrl + '&title=' + title + '&caption=' + desc;
				stssmSocialWindow(url);
			} else if(event.target.matches('.stssm-social-icons .fa-blogger')) {
				var url = 'https://www.blogger.com/blog-this.g?u=' + pageUrl + '&n=' + title + '&t=' + desc;
				stssmSocialWindow(url);
			} else if(event.target.matches('.stssm-social-icons .fa-wordpress-simple')) {
				var url = 'https://wordpress.com/press-this.php?u=' + pageUrl + '&t=' + title + '&s=' + desc;
				stssmSocialWindow(url);
			} else if(event.target.matches('.stssm-social-icons .fa-line')) {
				var url = 'https://lineit.line.me/share/ui?url=' + pageUrl + '&text=' + desc;
				stssmSocialWindow(url);
			} else if(event.target.matches('.stssm-social-icons .fa-buffer')) {
				var url = 'https://bufferapp.com/add?text=' + title + '&url=' + pageUrl;
				stssmSocialWindow(url);
			} else if(event.target.matches('.stssm-social-icons .fa-whatsapp')) {
				var url = 'https://wa.me/?text=' + title + '%20' + pageUrl;
				stssmSocialWindow(url);
			} else if(event.target.matches('.stssm-social-icons .fa-envelope')) {
				var url = 'mailto:?subject=' + title + '&body=' + desc;
				stssmSocialWindow(url);
			}
		});
	}

	try {
		stssmSetShareLinks();
	} catch(e) {}
})();
