function init() {
		$('.align_justify').scrollbars();
		$('.autohide').scrollbars({scrollbarAutohide:true});
		$('.dragheight').scrollbars({draggerSize:100});
		versions = $.parseJSON(getVersions());
		downloads = $('#download').next();

		$.each(versions, function(i, version) {
			con = $(document.createElement('li'));
			if (i > 1) {
				if (i == 2) {
					a = $(document.createElement('a'));
					a.attr('href', 'download.html');
					a.html('More Versions...');
					con.append(a);
					downloads.append(con);
				}
				return;
			}
			title = $(document.createElement('strong'));
			name = "Version " + version.name.substr(1);
			title.html(name);
			con.append(title);

			links = $(document.createElement('ul'));

			if (version.change_url !== undefined) {
				changeC = $(document.createElement('li'));
				changeA = $(document.createElement('a'));
				changeA.attr('href', version.change_url);
				changeA.html('Changelog');
				changeC.append(changeA);
				links.append(changeC);
			}

			zipC = $(document.createElement('li'));
			zipA = $(document.createElement('a'));
			zipA.attr('href', version.zipball_url);
			zipA.html('Zip');
			zipC.append(zipA);
			links.append(zipC);

			tarC = $(document.createElement('li'));
			tarA = $(document.createElement('a'));
			tarA.attr('href', version.tarball_url);
			tarA.html('Tarball');
			tarC.append(tarA);
			links.append(tarC);

			con.append(links);
			downloads.append(con);
		});
	}

	function getHead() {
		if (typeof document.h == 'undefined') {
			document.h = document.getElementsByTagName('head')[0];
		}
		return document.h;
	}

	function loadScript(src, callback) {
		var script = document.createElement('script'),
			scope = this;
		script.src = src;
		script.type = 'text/javascript';

		if (callback) {
			script.onload = function() {
				callback.call(scope);
			}
			script.onreadystatechange = function() {
				if ((this.readyState == 'complete' || this.readyState == 'loaded') && !$(this).data('loaded')) {
					$(this).data('loaded', true);
					callback.call(scope);
				}
			}
		}


		getHead().appendChild(script);
		return script;
	}

	function loadStyle(src, callback) {
		var style = document.createElement('link'),
			scope = this;
		style.rel = 'stylesheet';
		style.type = 'text/css';
		style.href = src;

		var sheet, cssRules;
		if ( 'sheet' in style) {
			sheet = 'sheet'; cssRules = 'cssRules';
		}
		else {
			sheet = 'styleSheet'; cssRules = 'rules';
		}

		var interval_id = setInterval(function() {
			if (style[sheet]) {
				clearInterval(interval_id);

				if (callback) {
					callback.call(scope);
				}
			}
		}, 10);
		

		getHead().appendChild(style);
		return style;
	}

	$(init);