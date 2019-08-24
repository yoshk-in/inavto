var Agent = {
    ua : navigator.userAgent.toLowerCase()
};

Agent.isIE = (Agent.ua.indexOf("msie") != -1 && Agent.ua.indexOf("opera") == -1 && Agent.ua.indexOf("webtv") == -1);
Agent.isIE8 = (Agent.ua.indexOf("msie 8.") != -1);
Agent.isIE7 = (Agent.ua.indexOf("msie 7.") != -1);
Agent.isIE6 = (Agent.ua.indexOf("msie 6.") != -1);
Agent.isOpera = (Agent.ua.indexOf("opera") != -1);
Agent.isGecko = (Agent.ua.indexOf("gecko") != -1);
Agent.isSafari = (Agent.ua.indexOf("safari") != -1);
Agent.isKonqueror = (Agent.ua.indexOf("konqueror") != -1);
Agent.isChrome = (Agent.ua.indexOf("chrome") != -1);
Agent.isIPad2 = (Agent.ua.indexOf("ipad;") != -1);


function getFlashObject(id) {
    return (isIE ? window : document)[id];
}


//  userAgent       
var ua = navigator.userAgent.toLowerCase();
//  Internet Explorer
var isIE = (ua.indexOf("msie") != -1 && ua.indexOf("opera") == -1 && ua.indexOf("webtv") == -1);
// Opera
var isOpera = (ua.indexOf("opera") != -1);
// Gecko = Mozilla + Firefox + Netscape
var isGecko = (ua.indexOf("gecko") != -1);
// Safari,   MAC OS
var isSafari = (ua.indexOf("safari") != -1);
// Konqueror,   UNIX-
var isKonqueror = (ua.indexOf("konqueror") != -1);

if(isGecko) {
    HTMLElement.prototype.removeNode = function(removeChildren) {
        if (Boolean(removeChildren)) return this.parentNode.removeChild(this);
        else {
            var r=document.createRange();
            r.selectNodeContents(this);
            return this.parentNode.replaceChild(r.extractContents(),this);
        }
    }
}


function textLog(t) {
    var d = new Date();
    $('.log_text').html($('.log_text').html()+"<span style='color:#aaa'>"+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds()+"."+d.getMilliseconds()+"</span> "+t+"<br />");
}


function round_dec(on, dec) {
    var r1=on*Math.pow(10,dec);
    var r2=Math.round(r1);
    var r3=r2/Math.pow(10,dec);
    return r3;
}

function setOpacity(obj,opc) {
    if (obj.filters) {
        obj.style.filter = "alpha(opacity="+(opc*100)+")";
    } else obj.style.opacity=opc;
}

function setClass(obj, class_name) {

    if(Agent.isIE6 || Agent.isIE7) {
        obj.setAttribute("className",class_name);
    }
    else if(Agent.isGecko || Agent.isIE8) obj.setAttribute("class",class_name);
    else if(Agent.isOpera) obj.className = class_name;
}


function getElementComputedStyle(elem, prop) {
    if (typeof elem!="object") elem = document.getElementById(elem);

    // external stylesheet for Mozilla, Opera 7+ and Safari 1.3+
    if (document.defaultView && document.defaultView.getComputedStyle) {
        if (prop.match(/[A-Z]/)) prop = prop.replace(/([A-Z])/g, "-$1").toLowerCase();
        return document.defaultView.getComputedStyle(elem, "").getPropertyValue(prop);
    }

    // external stylesheet for Explorer and Opera 9
    if (elem.currentStyle) {
        var i;
        while ((i=prop.indexOf("-"))!=-1) prop = prop.substr(0, i) + prop.substr(i+1,1).toUpperCase() + prop.substr(i+2);
        return elem.currentStyle[prop];
    }

    return "";
}

function createHttpRequest() {
    var xmlHttp = false;

    /*@cc_on @*/
    /*@if (@_jscript_version >= 5)
     try {
     xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
     } catch (e) {
     try {
     xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
     } catch (e2) {
     xmlHttp = false;
     }
     }
     @end @*/

    if (!xmlHttp && typeof XMLHttpRequest != 'undefined') {
        xmlHttp = new XMLHttpRequest();
    }

    return xmlHttp;
}

function file_get_contents(url) {
    var req = createHttpRequest();

    if (!req) throw new Error('XMLHttpRequest not supported');

    req.open("GET", url, false);
    req.send(null);

    return req.responseText;
}

function trim( str, charlist ) {
    charlist = !charlist ? ' \s\xA0' : charlist.replace(/([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '\$1');
    var re = new RegExp('^[' + charlist + ']+|[' + charlist + ']+$', 'g');
    return str.replace(re, '');
}

function implode( glue, pieces ) {
    return ( ( pieces instanceof Array ) ? pieces.join ( glue ) : pieces );
}

function getElementPosition(elem) {

    var w = elem.offsetWidth;
    var h = elem.offsetHeight;

    var l = 0;
    var t = 0;

    while (elem) {
        l += elem.offsetLeft;
        t += elem.offsetTop;
        elem = elem.offsetParent;
    }

    return {"left":l, "top":t, "width": w, "height":h};
}

function includeCSS(filename, media) {
    if (!media) {
        media = 'All';
    }
    var css = document.createElement('link');
    css.setAttribute('type', 'text/css');
    css.setAttribute('href', filename);
    css.setAttribute('rel', 'stylesheet');
    css.setAttribute('media', media);
    document.getElementsByTagName('HEAD')[0].appendChild(css);

    return true;
}

function include( filename ) {
    var js = document.createElement('script');
    js.setAttribute('type', 'text/javascript');
    js.setAttribute('src', filename);
    document.getElementsByTagName('HEAD')[0].appendChild(js);

    // save include state for reference by include_once
    var cur_file = {};
    cur_file[window.location.href] = 1;

    if (!window.php_js) window.php_js = {};
    if (!window.php_js.includes) window.php_js.includes = cur_file;
    if (!window.php_js.includes[filename]) {
        window.php_js.includes[filename] = 1;
    } else {
        window.php_js.includes[filename]++;
    }

    return window.php_js.includes[filename];
}

function include_once( filename ) {

    var cur_file = {};
    cur_file[window.location.href] = 1;

    if (!window.php_js) window.php_js = {};
    if (!window.php_js.includes) window.php_js.includes = cur_file;
    if (!window.php_js.includes[filename]) {
        return this.include(filename);
    } else{
        return window.php_js.includes[filename];
    }
}

function http_build_query( formdata, numeric_prefix, arg_separator ) {
    var key, use_val, use_key, i = 0, tmp_arr = [];

    if(!arg_separator){
        arg_separator = '&';
    }

    for(key in formdata){
        use_key = escape(key);
        use_val = escape((formdata[key].toString()));
        use_val = use_val.replace(/%20/g, '+');

        if(numeric_prefix && !isNaN(key)){
            use_key = numeric_prefix + i;
        }
        tmp_arr[i] = use_key + '=' + use_val;
        i++;
    }

    return tmp_arr.join(arg_separator);
}

function removeEvent(obj, type, fn){
    if(obj.removeEventListener) {
        obj.removeEventListener(type, fn, false);
    } else if(obj.detachEvent) {
        obj.detachEvent("on"+type, fn);
    } else {
        obj[type]=null;
    }
}


function addEvent(elm, evType, fn, useCapture) {
    if (elm.addEventListener) {
        elm.addEventListener(evType, fn, useCapture);
        return true;
    }
    else if (elm.attachEvent) {
        var r = elm.attachEvent('on' + evType, fn);
        return r;
    }
    else {
        elm['on' + evType] = fn;
    }
}


function getYear() {
    var objDate=new Date();
    var tmp_y=objDate.getYear();
    if(isGecko || isOpera) {
        tmp_y+=1900;
    } else if(isIE) {
        if(tmp_y < 100) tmp_y+=1900;
    }
    return tmp_y;
}


function addHandler(object, event, handler)
{
    if (typeof object.addEventListener != 'undefined')
        object.addEventListener(event, handler, false);
    else if (typeof object.attachEvent != 'undefined')
        object.attachEvent('on' + event, handler);
    else
        throw "Incompatible browser";
}


function removeHandler(object, event, handler)
{
    if (typeof object.removeEventListener != 'undefined')
        object.removeEventListener(event, handler, false);
    else if (typeof object.detachEvent != 'undefined')
        object.detachEvent('on' + event, handler);
    else
        throw "Incompatible browser";
}

function getClientWidth() {
    return document.compatMode=='CSS1Compat' && !window.opera?document.documentElement.clientWidth:document.body.clientWidth;
}

function getClientHeight() {
    return document.compatMode=='CSS1Compat' && !window.opera?document.documentElement.clientHeight:document.body.clientHeight;
}

function getDocumentHeight()
{
    var documentHeight = document.documentElement.clientHeight; // FF, Safari, IE
    if(documentHeight < document.documentElement.scrollHeight) documentHeight=document.documentElement.scrollHeight;

    if(documentHeight < document.body.scrollHeight) documentHeight = document.body.scrollHeight;
    return documentHeight;
}


function getDocumentWidth()
{
    return (document.body.scrollWidth > document.body.offsetWidth)?document.body.scrollWidth:document.body.offsetWidth;
}


function getBodyScrollTop()
{
    return self.pageYOffset || (document.documentElement && document.documentElement.scrollTop) || (document.body && document.body.scrollTop);
}


function getBodyScrollLeft()
{
    return self.pageXOffset || (document.documentElement && document.documentElement.scrollLeft) || (document.body && document.body.scrollLeft);
}


function isstr(param) {
    return typeof(param) == 'string';
}

function getElement(param) {
    var obj = isstr(param) ? document.getElementById(param) : param;
    if(!obj) return false;
    obj.child = function(tagName) {
        return this.getElementsByTagName(tagName);
    }
    obj.append = function(param) {
        return this.appendChild(isstr(param) ? document.createElement(param) : param);
    }
    obj.parent = function() {
        return this.parentNode;
    }
    return obj;
}


function clearSelection() {
    if(document.selection && document.selection.empty) {
        document.selection.empty();
    } else if(window.getSelection) {
        var sel = window.getSelection();
        if(sel && sel.removeAllRanges) {
            sel.removeAllRanges();
        }
    }
}

function fixPNG(element)
{
    //Р•СЃР»Рё Р±СЂР°СѓР·РµСЂ IE РІРµСЂСЃРёРё 5.5-6
    if (/MSIE (5\.5|6).+Win/.test(navigator.userAgent))
    {
        var src;

        if (element.tagName=='IMG') //Р•СЃР»Рё С‚РµРєСѓС‰РёР№ СЌР»РµРјРµРЅС‚ РєР°СЂС‚РёРЅРєР° (С‚СЌРі IMG)
        {
            if (/\.png$/.test(element.src)) //Р•СЃР»Рё С„Р°Р№Р» РєР°СЂС‚РёРЅРєРё РёРјРµРµС‚ СЂР°СЃС€РёСЂРµРЅРёРµ PNG
            {
                src = element.src;
                element.src = "/content/images/e.gif"; //Р·Р°РјРµРЅСЏРµРј РёР·РѕР±СЂР°Р¶РµРЅРёРµ РїСЂРѕР·СЂР°С‡РЅС‹Рј gif-РѕРј
            }
        }
        else //РёРЅР°С‡Рµ, РµСЃР»Рё СЌС‚Рѕ РЅРµ РєР°СЂС‚РёРЅРєР° Р° РґСЂСѓРіРѕР№ СЌР»РµРјРµРЅС‚
        {
            //РµСЃР»Рё Сѓ СЌР»РµРјРµРЅС‚Р° Р·Р°РґР°РЅР° С„РѕРЅРѕРІР°СЏ РєР°СЂС‚РёРЅРєР°, С‚Рѕ РїСЂРёСЃРІР°РµРІР°РµРј Р·РЅР°С‡РµРЅРёРµ СЃРІРѕР№СЃС‚РІР° background-С€mage РїРµСЂРµРјРµРЅРЅРѕР№ src
            src = element.currentStyle.backgroundImage.match(/url\("(.+\.png)"\)/i);
            if (src)
            {
                src = src[1]; //Р±РµСЂРµРј РёР· Р·РЅР°С‡РµРЅРёСЏ СЃРІРѕР№СЃС‚РІР° background-С€mage С‚РѕР»СЊРєРѕ Р°РґСЂРµСЃ РєР°СЂС‚РёРЅРєРё
                element.runtimeStyle.backgroundImage="none"; //СѓР±РёСЂР°РµРј С„РѕРЅРѕРІРѕРµ РёР·РѕР±СЂР°Р¶РµРЅРёРµ
            }
        }
        //РµСЃР»Рё, src РЅРµ РїСѓСЃС‚, С‚Рѕ РЅСѓР¶РЅРѕ Р·Р°РіСЂСѓР·РёС‚СЊ РёР·РѕР±СЂР°Р¶РµРЅРёРµ СЃ РїРѕРјРѕС‰СЊСЋ С„РёР»СЊС‚СЂР° AlphaImageLoader
        if (src) element.runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + src + "',sizingMethod='scale')";
    }
}

Date.prototype.clone = function () {
    return new Date(this.getTime());
}

Date.prototype.getHoursBetween = function(d) {
    d = d.clone();

    var diff = d.getTime() - this.getTime();
    return diff / (1000 * 60 * 60);
};

Date.prototype.MONTHNAMES = ["РЇРЅРІР°СЂСЊ", "Р¤РµРІСЂР°Р»СЊ", "РњР°СЂС‚", "РђРїСЂРµР»СЊ", "РњР°Р№", "РСЋРЅСЊ", "РСЋР»СЊ", "РђРІРіСѓСЃС‚", "РЎРµРЅС‚СЏР±СЂСЊ", "РћРєС‚СЏР±СЂСЊ", "РќРѕСЏР±СЂСЊ", "Р”РµРєР°Р±СЂСЊ"];

Date.prototype.getFullMonth = function() {
    return this.MONTHNAMES[this.getMonth()];
};

Date.prototype.getStringDateTime = function() {
    return this.getFullYear() + '-' + (this.getMonth() + 1).leadZero(2) + '-' + this.getDate().leadZero(2) + ' ' + this.getHours().leadZero(2) + ':' + this.getMinutes().leadZero(2) + ':' + this.getSeconds().leadZero(2);
};

Date.prototype.getStringDate = function() {
    return this.getFullYear() + '-' + (this.getMonth() + 1).leadZero(2) + '-' + this.getDate().leadZero(2);
};

Number.prototype.leadZero = function(length){
    var sign = this < 0 ? '-' : '';
    var result = Math.abs(this).toString();
    length -= result.length;
    for (var i = 0; i < length; i++) {
        result = '0' + result;
    }
    return sign + result;
}

function getElementsByName(tag, name) {
    var elem = document.getElementsByTagName(tag);
    var arr = new Array();
    for(i = 0, iarr = 0; i < elem.length; i++) {
        att = elem[i].getAttribute("name");
        if(att == name) {
            arr[iarr] = elem[i];
            iarr++;
        }
    }
    return arr;
}

jQuery.preloadImages = function () {
    if (typeof arguments[arguments.length - 1] == 'function') {
        var callback = arguments[arguments.length - 1];
    } else {
        var callback = false;
    }
    if (typeof arguments[0] == 'object') {
        var images = arguments[0];
        var n = images.length;
    } else {
        var images = arguments;
        var n = images.length - 1;
    }
    var not_loaded = n;
    for (var i = 0; i < n; i++) {
        jQuery(new Image()).attr('src', images[i]).load(function() {
            if (--not_loaded < 1 && typeof callback == 'function') {
                callback();
            }
        });
    }
}


function urlLit(w,v) {
    var tr='a b v g d e ["zh"] z i y k l m n o p r s t u f h c ch sh ["sha"] [""] y [""] e yu ya ~ ["jo"]'.split(' ');
    var ww=''; w=w.toLowerCase();

    for(i=0; i<w.length; ++i) {
        cc=w.charCodeAt(i); ch=(cc>=1072?tr[cc-1072]:w[i]);
        if(ch.length<3) ww+=ch; else ww+=eval(ch)[0];

    }
    return(ww.replace(/[^a-zA-Z0-9\-]/g,'-').replace(/[-]{2,}/gim, '-').replace( /^\-+/g, '').replace( /\-+$/g, ''));
}

Number.prototype.formatMoney = function(d) {
    if(d<2 || d==false) {
        return this.toLocaleString().replace(/(\d)(?=(\d{3})+\.)/g, "$1 ");
    } else if(d>=2) {
        d=2;
        return this.toFixed(d).replace(/(\d)(?=(\d{3})+\.)/g, "$1 ");
    }
}


$.fn.selectRange = function(start, end) {
    if(!end) end = start;
    return this.each(function() {
        if (this.setSelectionRange) {
            this.focus();
            this.setSelectionRange(start, end);
        } else if (this.createTextRange) {
            var range = this.createTextRange();
            range.collapse(true);
            range.moveEnd('character', end);
            range.moveStart('character', start);
            range.select();
        }
    });
};

var range = function(start, end, step) {
    var range = [];
    var typeofStart = typeof start;
    var typeofEnd = typeof end;

    if (step === 0) {
        throw TypeError("Step cannot be zero.");
    }

    if (typeofStart == "undefined" || typeofEnd == "undefined") {
        throw TypeError("Must pass start and end arguments.");
    } else if (typeofStart != typeofEnd) {
        throw TypeError("Start and end arguments must be of same type.");
    }

    typeof step == "undefined" && (step = 1);

    if (end < start) {
        step = -step;
    }

    if (typeofStart == "number") {

        while (step > 0 ? end >= start : end <= start) {
            range.push(start);
            start += step;
        }

    } else if (typeofStart == "string") {

        if (start.length != 1 || end.length != 1) {
            throw TypeError("Only strings with one character are supported.");
        }

        start = start.charCodeAt(0);
        end = end.charCodeAt(0);

        while (step > 0 ? end >= start : end <= start) {
            range.push(String.fromCharCode(start));
            start += step;
        }

    } else {
        throw TypeError("Only string and number types are supported");
    }

    return range;

}

function Pager(totalElements, elementsWin, page, navWin) {
    this.totalElements=totalElements;
    this.totalPages = Math.ceil(totalElements/elementsWin);
    this.win=elementsWin;

    if(navWin) {
        this.navWin=navWin;
    }

    if(page) {
        this.page = page;
    }

    this.offset = (this.page-1)*this.getWin();

    this.getEdges();

    var begin = this.getLeftEdge();
    var end = this.getRightEdge();

    var rowPages = range(begin, end);
    this.pages = rowPages;
}

Pager.prototype = {
    totalElements: false,
    totalPages: false,
    pages: false,
    page: 1,
    offset: 0,

    win: false,
    navWin: false,
    leftEdge: false,
    rightEdge: false,

    getWin: function() {
        return this.win;
    },
    getNavWin: function() {
        return this.navWin;
    },
    getEdges: function() {
        this.leftEdge = 1;
        this.rightEdge = this.totalPages;

        if(this.totalPages == 0) {
            this.rightEdge=1;
        }

        if(this.getNavWin() != false && this.totalPages != 0) {
            this.leftEdge = this.page - Math.floor(this.getNavWin()/2);
            if(this.leftEdge <= 0) {
                this.leftEdge=1;
            }
            this.rightEdge = this.leftEdge+this.navWin-1;
            if(this.rightEdge > this.totalPages) {

                $diff=this.rightEdge-this.totalPages;
                this.rightEdge=this.totalPages;

                if(this.totalPages > this.navWin) {
                    this.leftEdge-=$diff;
                }
            }
        }
    },
    getLeftEdge: function() {
        return this.leftEdge;
    },
    getRightEdge: function() {
        return this.rightEdge;
    },
    getPagination: function() {
        return this.pages;
    }
};


function scrollTape(id) {
    this.state=false;
    this.id=id;
    console.log(this.id);
    // scroll parameters
    this.tapeWidth=false;
    this.maskWidth=false;
    this.scrollDelta=false;
    // current image
    this.active=false;
    // settings
    this.padd={'top':0,'right':0,'bottom':40,'left':0};
    this.marg={'top':10,'right':10,'bottom':10,'left':10};
    this.def={'mWidth':false,'mHeight':false};
    var t=this;
    $(document).ready(function(){
        t.init();
    });
}

scrollTape.prototype = {
    init: function() {

        var t=this;
        t.parent=$('#'+t.id);
        if(t.parent.length != 1) {
            console.log('Can\'not find scrollPhotos node with id = '+t.id+' .');
            return;
        }
        t.tape=t.parent.find('.tape');
        t.mask=t.parent.find('.mask');
        t.bigImg=t.parent.find('.bigImg');
        t.btn={
            'left':t.parent.find('.arrow.left'),
            'right':t.parent.find('.arrow.right'),
            'prev':t.bigImg.find('.nav.prev'),
            'next':t.bigImg.find('.nav.next')
        };
        t.images=t.tape.find('a.img');
        t.backdrop=$('.backdrop');

        // calculate tape length
        t.tapeWidth = t.tape.width();
        t.maskWidth = t.mask.width();
        t.def.mWidth=t.bigImg.width();
        t.def.mHeight=t.bigImg.height();
        //console.log('tapeWidth = '+t.tapeWidth);

        if(t.images.length > 0) {

            var max={'w':false,'h':false};

            // preload small images
            var preloader={loaded:0,images:[]};

            for(var j=0;j<t.images.length;j++) {

                var a=$(t.images[j]);
                a.data('imageid',j);

                a.click((function(j){ return function() { t.showImage(j); return false; } })(j));

                preloader.images[j]=new Image();
                preloader.images[j].src=$(a).find('>img').attr('src');
                preloader.count++;
                preloader.images[j].onload=function(){
                    preloader.loaded++;
                    if(false==max.w || (max.w<this.width)) {
                        max.w=this.width;
                    }
                    if(false==max.h || (max.h<this.height)) {
                        max.h=this.height;
                    }
                    if(preloader.loaded == preloader.images.length) {
                        // load all images
                        t.scrollDelta=max.w;
                        // initializing position
                        t.scroll();
                    }
                }
            }
        }

        // bind scrolling events
        t.btn.left.click(function(){t.scroll('left')});
        t.btn.right.click(function(){t.scroll('right')});
        // bind closing events
        t.backdrop.click(function(){t.hideImage()});
        t.bigImg.find('.close').click(function(){t.hideImage()});
        // bind switСЃh image buttons
        t.btn.prev.click(function(){t.switchImage(0)});
        t.btn.next.click(function(){t.switchImage(1)});

    },
    switchImage: function(dir) {
        // get current image
        var t=this;
        var imageid=parseInt(t.bigImg.find('.dst').data('imageid'));
        var nextid=imageid;
        if(dir==1) {
            // next
            nextid++;
        } else if(dir==0) {
            // prev
            nextid--;
        }
        if(nextid>=t.images.length) {
            nextid=0;
        } else if(nextid < 0) {
            nextid=t.images.length-1;
        }
        t.showImage(nextid);

    },
    hideImage: function() {
        var t=this;
        t.state=false;
        t.backdrop.toggleClass('show',false);
        var mLeft=(-1)*(t.def.mWidth/2);
        var mTop=(-1)*(t.def.mHeight/2);
        t.bigImg.find('.dst').html('');
        t.bigImg.toggleClass('show',false).css('width',t.def.mWidth).css('height',t.def.mHeight).css('margin-left',mLeft).css('margin-top',mTop);
        t.tape.find('.img.loading').toggleClass('loading',false);
    },
    showImage: function(id) {

        var t=this;
        var a=$(t.images[id]);

        console.log('imageid = '+id);

        var lnk=a.attr('href');

        console.log('State: '+t.state);

        if(t.state=='loading') {
            return false;
        }
        t.state='loading';

        t.bigImg.toggleClass('show',true).toggleClass('loading',true);
        t.backdrop.toggleClass('show',true);

        // preload image
        var bImg=new Image();
        bImg.src=lnk;

        // show preloader
        a.toggleClass('loading',true);

        bImg.onload=function(){

            a.toggleClass('loading',false);

            var img={'w':this.width,'h':this.height};
            // modal size
            var mSize={'w':false,'h':false};
            // image resize
            var iSize={'w':false,'h':false};
            // limit sizes
            var max={'modal':{'w':false,'h':false},'img':{'w':false,'h':false}};

            max.modal.w=$(window).width()-t.marg.left-t.marg.right;
            max.modal.h=$(window).height()-t.marg.top-t.marg.bottom;

            max.img.w=max.modal.w-t.padd.left-t.padd.right;
            max.img.h=max.modal.h-t.padd.top-t.padd.bottom;

            var iRatio={'w':false,'h':false};
            iRatio.w=img.w/max.img.w;
            iRatio.h=img.h/max.img.h;

            var ratio=1;
            if(iRatio.w > 1 || iRatio.h > 1) {
                if(iRatio.w > iRatio.h) {
                    // resize image by width
                    ratio=iRatio.w;
                } else {
                    // resize image by height
                    ratio=iRatio.h;
                }
            }

            iSize.w=img.w/ratio;
            iSize.h=img.h/ratio;

            mSize.w=iSize.w+t.padd.left+t.padd.right;
            mSize.h=iSize.h+t.padd.top+t.padd.bottom;

            // get modal margin left
            var mLeft=parseInt((-1)*(mSize.w/2));
            var mTop=parseInt((-1)*(mSize.h/2));

            t.bigImg.find('.dst').data('imageid',id);

            // new big image is already loading
            // check exists old image
            var oldImg=t.bigImg.find('.dst>img');
            var nodeImg=$('<img src="'+lnk+'" alt="" style="width:'+iSize.w+'px;height:'+iSize.h+'px" />');

            var needResize=true;

            if(oldImg.length) {
                // old big image is already showing
                // check old and new image sizes
                var old = {w:parseInt(oldImg.css('width')),h:parseInt(oldImg.css('height'))};
                if(old.w == iSize.w && old.h == iSize.h) {
                    needResize=false;
                }
            }

            if(needResize==true) {
                t.bigImg.animate({
                        width:mSize.w+'px',
                        height:mSize.h+'px',
                        marginLeft:mLeft+'px',
                        marginTop:mTop+'px'
                    }, 300, function() {
                        t.bigImg.toggleClass('loading',false);
                        t.bigImg.find('.dst').html(nodeImg);
                    }
                );
            } else {
                t.bigImg.toggleClass('loading',false);
                t.bigImg.find('.dst').html(nodeImg);
            }

            /*
            console.log('Image '+lnk+' is loaded successfully.');
            console.log('Modal size: '+mSize.w+', '+mSize.h);
            console.log('Image real size: '+img.w+', '+img.h);
            console.log('Image result size: '+iSize.w+', '+iSize.h);
            */
            t.state=false;
        }

        return false;
    },
    scroll: function(dir) {

        var t=this;
        var nl=parseInt(t.tape.css('left'));
        console.log('left = '+nl);
        if(t.tapeWidth < t.maskWidth) {
            // reinit
            t.tapeWidth=t.tape.width();
        }

        if(dir=='left') {
            nl+=t.scrollDelta;
        } else if(dir=='right') {
            nl-=t.scrollDelta;
        }

        t.mask.toggleClass('leftmost',false);
        t.mask.toggleClass('rightmost',false);
        t.btn.left.toggleClass('disabled',false);
        t.btn.right.toggleClass('disabled',false);

        console.log(t.tapeWidth+' - '+t.maskWidth+' *(-1) = '+((t.tapeWidth-t.maskWidth)*(-1)));

        if(nl < ((t.tapeWidth-t.maskWidth)*(-1))) {
            nl=(t.tapeWidth-t.maskWidth)*(-1);
            // disabled right button and hide right gradient
            t.mask.toggleClass('rightmost',true);
            t.btn.right.toggleClass('disabled',true);
        } else if(nl >= 0) {
            nl=0;
            // disabled left button and hide left gradient
            t.mask.toggleClass('leftmost',true);
            t.btn.left.toggleClass('disabled',true);
        }
        if(dir!=undefined) {
            t.tape.css('left',nl);
        }
    }
};


function popupFrame(id, url, cls, select, cookieName, cookieDomain) {
    this.state=false;
    this.btn=$('#'+id);
    this.id=id;
    this.url=url;
    this.body=$('body');
    this.cls=cls;
    this.content=false;
    this.cookieName=cookieName;
    if(cookieDomain==undefined) {
        cookieDomain=COOKIE_HOST;
    }
    console.log(cookieDomain);
    this.cookieDomain=cookieDomain;
    this.popup=false;
    this.arrow=false;

    if(select==undefined || (select!=true && select!=false)) {
        this.select=true;
    } else {
        this.select=select;
    }


    if(this.btn.data('align')) {
        this.align=this.btn.data('align');
    } else {
        this.align='center';
    }


    this.init();
}


popupFrame.prototype = {

    showPopup: function() {

        var popupId=this.id+'_popup';
        var popup=$('#'+popupId);

        var pos=this.btn.offset();

        if(popup.length) {
            // toggle class show
            popup.toggleClass('show');
            this.btn.toggleClass('opened');

            // update position popup
            console.log('update position');
            var top=pos.top+this.btn.outerHeight()+12;
            top=parseInt(top);
            popup.css('top',top+'px');

            this.setLeftPosition();

        } else {
            // create popup
            this.popup=$('<div class="popupFrame" id="'+popupId+'"></div>');

            if(this.cls != undefined) {
                this.popup.toggleClass(this.cls, true);
            }
            var t=this;

            t.content=$('<div class="popupContent"></div>');
            this.popup.append(t.content);


            this.body.append(this.popup);

            if(t.select==true) {
                t.arrow=$('<span class="arrow"></span>');
                t.popup.append(t.arrow);
                top=top+(t.arrow.outerHeight()/2);
                t.popup.append('<div class="close"></div>');
                t.popup.find('.close').click(function(){
                    t.hidePopup();
                });
            }

            var top=pos.top+this.btn.outerHeight()+12;
            top=parseInt(top);
            t.popup.css('top',top+'px');

            t.setLeftPosition();

            t.btn.toggleClass('opened',true);
            t.popup.toggleClass('show',true);

            t.content.toggleClass('loading',true).html('<span class="im loading"></span>');

            // load content
            $.ajax({
                type: "GET",
                dataType : "text",
                url: t.url,
                success: function(code) {
                    t.content.toggleClass('loading',false).html(code);
                    // bind events
                    t.bindFormEvents();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status+' '+thrownError);
                }
            });

        }
    },
    setLeftPosition: function() {
        var t=this;
        console.log('popup width = '+t.popup.outerWidth());
        var pos=t.btn.offset();
        var left=0;
        if(t.align=='right') {
            left=parseInt((pos.left-(t.popup.outerWidth()-t.btn.outerWidth())));
            if(t.select==true) {
                var aLeft = parseInt(t.popup.outerWidth()-((t.arrow.outerWidth()/2)+5+t.btn.width()/2));
                t.arrow.css('left', aLeft);
            }
        } else if(this.align=='center') {
            left=parseInt((pos.left+(t.btn.outerWidth()/2)-(t.popup.outerWidth()/2)));
        }
        t.popup.css('left',left+'px');
    },
    bindFormEvents: function() {
        var t=this;
        this.content.find('button[type=reset]').click(function(){
            if(t.cookieName) {
                console.log(t.cookieName);
                $.cookie(t.cookieName, null, { path: PATH, domain: t.cookieDomain});
                window.location.assign(document.URL);
            }
        });
    },
    hidePopup: function() {
        var popup=$('#'+this.id+'_popup');
        popup.toggleClass('show',false);
        this.btn.toggleClass('opened',false);
    },
    init: function() {
        var t=this;
        this.btn.click(function(){
            t.showPopup();
        });
    }
};

function copy (str, mimetype) {
    document.oncopy = function(event) {
        event.clipboardData.setData(mimetype, str);
        event.preventDefault();
    };
    document.execCommand("Copy", false, null);
}


function copyToClipboard(text){
    // works only if user do action

    var id = "mycustom-clipboard-textarea-hidden-id";
    var existsTextarea = document.getElementById(id);

    if(!existsTextarea){
        var textarea = document.createElement("textarea");
        textarea.id = id;
        // Place in top-left corner of screen regardless of scroll position.
        textarea.style.position = 'fixed';
        textarea.style.top = 0;
        textarea.style.left = 0;

        // Ensure it has a small width and height. Setting to 1px / 1em
        // doesn't work as this gives a negative w/h on some browsers.
        textarea.style.width = '1px';
        textarea.style.height = '1px';

        // We don't need padding, reducing the size if it does flash render.
        textarea.style.padding = 0;

        // Clean up any borders.
        textarea.style.border = 'none';
        textarea.style.outline = 'none';
        textarea.style.boxShadow = 'none';

        // Avoid flash of white box if rendered for any reason.
        textarea.style.background = 'transparent';
        document.querySelector("body").appendChild(textarea);

        existsTextarea = document.getElementById(id);
    }

    existsTextarea.value = text;
    existsTextarea.select();

    try {
        var status = document.execCommand('copy', true);
        if(!status){
            console.error("Cannot copy text status = "+status);
        }
    } catch (err) {
        console.log('Unable to copy.');
    }
}


