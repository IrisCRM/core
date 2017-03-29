/**
 * k.Growler 1.0.0
 * modified my miv 30.03.2011 (remove scriptaculous effects and some class remake)
 *
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Written by Kevin Armstrong <kevin@kevinandre.com>
 * Last updated: 2008.10.14
 *
 * Growler is a PrototypeJS based class that displays unobtrusive notices on a page. 
 * It functions much like the Growl (http://growl.info) available on the Mac OS X. 
 *
 * Changes in 1.0.1:
 * - 
 *
 * @todo
 */
 
Growler = Class.create({
	initialize: function(options){
		// internal variables
		this.noticeOptions = {
			header			: '&nbsp;',
			//speedin			: 0.3,
			//speedout		: 0.5,
			//outDirection	: { y: -20 },
			life			: 5,
			sticky			: false,
			className		: ""
		};
		this.growlerOptions = {
			location		: "tr",
			width			: "250px"
		};
		//this.IE = (Prototype.Browser.IE) ? parseFloat(navigator.appVersion.split("MSIE ")[1]) || 0 : 0;
		this.IE = Prototype.Browser.IE;
	
		var opt = Object.clone(this.growlerOptions);
		options = options || {};
		Object.extend(opt, options);
		this.growler = new Element("div", { "class": "Growler", "id": "Growler" });
		//this.growler.setStyle({ position: ((this.IE==6)?"absolute":"fixed"), padding: "10px", "width": opt.width, "z-index": "50000" });
		this.growler.setStyle({ position: ((this.IE == true)?"absolute":"fixed"), "width": opt.width});
		//if(this.IE==6){
		if(false){
			var offset = { w: parseInt(this.growler.style.width)+parseInt(this.growler.style.padding)*3, h: parseInt(this.growler.style.height)+parseInt(this.growler.style.padding)*3 };
			switch(opt.location){
				case "br":
					this.growler.style.setExpression("left", "( 0 - Growler.offsetWidth + ( document.documentElement.clientWidth ? document.documentElement.clientWidth : document.body.clientWidth ) + ( ignoreMe2 = document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft ) ) + 'px'");
				  	this.growler.style.setExpression("top", "( 0 - Growler.offsetHeight + ( document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight ) + ( ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop ) ) + 'px'");
					break;
				case "tl":
					this.growler.style.setExpression("left", "( 0 + ( ignoreMe2 = document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft ) ) + 'px'");
				  	this.growler.style.setExpression("top", "( 0 + ( ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop ) ) + 'px'");
					break;
				case "bl":
					this.growler.style.setExpression("left", "( 0 + ( ignoreMe2 = document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft ) ) + 'px'");
				  	this.growler.style.setExpression("top", "( 0 - Growler.offsetHeight + ( document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight ) + ( ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop ) ) + 'px'");
					break;
				default:
					this.growler.setStyle({right: "auto", bottom: "auto"});
					this.growler.style.setExpression("left", "( 0 - Growler.offsetWidth + ( document.documentElement.clientWidth ? document.documentElement.clientWidth : document.body.clientWidth ) + ( ignoreMe2 = document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft ) ) + 'px'");
				  	this.growler.style.setExpression("top", "( 0 + ( ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop ) ) + 'px'");
					break;
			}
		} else {
			switch(opt.location){
				case "br":
					this.growler.setStyle({bottom: 0, right: 0});
					break;
				case "tl":
					this.growler.setStyle({top: 0, left: 0});
					break;
				case "bl":
					this.growler.setStyle({top: 0, right: 0});
					break;
				case "tc":
					this.growler.setStyle({top: 0, left: "25%", width: "50%"});
					break;
				case "bc":
					this.growler.setStyle({bottom: 0, left: "25%", width: "50%"});
					break;
				default:
					this.growler.setStyle({top: 0, right: 0});
					break;
			}
		}
		//this.growler.wrap( document.body );		
		$($$('body')[0]).insert({bottom: this.growler});
	},

	removeNotice: function(n, o){
		o = o || this.noticeOptions;
		try {
			var ne = n.down("div.notice-exit");
			if(ne != undefined){
				ne.stopObserving("click", this.removeNotice);
			}
			if(o.created && Object.isFunction(o.created)){
				n.stopObserving("notice:created", o.created);
			}
			if(o.destroyed && Object.isFunction(o.destroyed)){
				n.fire("notice:destroyed");
				n.stopObserving("notice:destroyed", o.destroyed);
			}
		} catch(e){}
		try {
			n.remove();
		} catch(e){}
	},

	createNotice: function(growler, msg, options){
		var opt = Object.clone(this.noticeOptions);
		options = options || {};
		Object.extend(opt, options);
		var notice = new Element("div", {"class": ((opt.className != "") ? opt.className : "Growler-notice")}).setStyle({display: "block", opacity: 0});

		if(opt.created && Object.isFunction(opt.created)){
			notice.observe("notice:created", opt.created);
		}
		if(opt.destroyed && Object.isFunction(opt.destroyed)){
			notice.observe("notice:destroyed", opt.destroyed);
		}
		if (opt.sticky){
			var noticeExit = new Element("div", {"class": "Growler-notice-exit"}).update("&times;");
			noticeExit.observe("click", function(){ this.removeNotice(notice, opt); }.bindAsEventListener(this));
			notice.insert(noticeExit);
		}
		notice.insert(new Element("div", {"class": "Growler-notice-head"}).update(opt.header));
		notice.insert(new Element("div", {"class": "Growler-notice-body"}).update(msg));
		growler.insert(notice);
		//new Effect.Opacity(notice, { to: 0.85, duration: opt.speedin });
		notice.setOpacity(0.95);
		if (!opt.sticky){
			this.removeNotice.delay(opt.life, notice, opt);
		}
		notice.fire("notice:created");
		return notice;
	},

	specialNotice: function(g, m, o, t, b, c){
		o.header = o.header || t;
		var n = this.createNotice(g, m, o);
		if (b != null)
			n.setStyle({backgroundColor: b});
		if (c != null)
			n.setStyle({color: c });
		return n;
	},
	
	growl: function(msg, options) {
		return this.createNotice(this.growler, msg, options);
	},
	warn: function(msg, options){
		return this.specialNotice(this.growler, msg, options, "Warning!", "#F6BD6F", "#000");
	},
	error: function(msg, options){
		return this.specialNotice(this.growler, msg, options, "Critical!", "#F66F82", "#000");
	},
	info: function(msg, options){
		return this.specialNotice(this.growler, msg, options, "Information!", "#BBF66F", "#000");
	},
	special: function(msg, options, headerPrefix, bgColor, textColor){
		return this.specialNotice(this.growler, msg, options, headerPrefix, bgColor, textColor);
	},	
	ungrowl: function(n, o){
		this.removeNotice(n, o);
	}
});
