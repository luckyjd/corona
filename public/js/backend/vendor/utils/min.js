// object
var objectEmpty = {};
Object.defineProperty(Object.prototype, '_s', {
    value: function (key, data) {
        if (typeof  key == 'object') {
            Object.defineProperty(this, data, {
                value: data,
                writable: true,
                enumerable: true,
                configurable: true
            });
        } else {
            Object.defineProperty(this, key, {
                value: key,
                writable: true,
                enumerable: true,
                configurable: true
            });
            this[key] = data;
        }
        return this;
    },
    enumerable: false
});

Object.defineProperty(Object.prototype, '_g', {
    value: function (keyData, defaultValue) {
        defaultValue = typeof defaultValue == 'undefined' ? objectEmpty : defaultValue;
        var obj = this;
        for (var key in obj) {
            if (keyData != key) {
                continue
            }
            return this[key] ? this[key] : defaultValue;

        }
        return defaultValue;
    },
    enumerable: false
});

Object.defineProperty(Object.prototype, '_gF', {
    value: function (keyData) {
        var obj = this;
        for (var key in obj) {
            return this[key];
        }
        return undefined;
    },
    enumerable: false
});

Object.defineProperty(Object.prototype, '_tA', {
    value: function (getKey) {
        var data = this;
        var result = [];

        for (idx in data) {
            if (typeof data[idx] != 'undefined') {
                result.push(getKey ? idx + '=' + data[idx] : data[idx]);
            }
        }
        return result;
    },
    enumerable: false
});
Object.defineProperty(Array.prototype, '_g', {
    value: function (keyData, defaultValue) {
        defaultValue = typeof defaultValue == 'undefined' ? [] : defaultValue;
        var val = this;
        return typeof val[keyData] != 'undefined' ? val[keyData] : defaultValue;
    },
    enumerable: false
});

// array
Object.defineProperty(Array.prototype, "_tO", {
    enumerable: false,
    writable: true,
    value: function (v) {
        return $.extend({}, this);
    }
});

Object.defineProperty(Array.prototype, "_f", {
    enumerable: false,
    writable: true,
    value: function (defaultValue) {
        return this._g(0, defaultValue);
    }
});

Object.defineProperty(Array.prototype, "_l", {
    enumerable: false,
    writable: true,
    value: function (defaultValue) {
        return this._g(this.length - 1, defaultValue);
    }
});
// string

String.prototype.url_tO = function (prefix, operator) {
    var str = this;
    str = str.split(prefix);
    var result = {};
    var l = str.length;
    for (var i = 0; i < l; i++) {
        var r = str[i].split(operator);
        if (r[0] == '') {
            continue;
        }
        result._s(r[0], r[1]);
    }
    return result;
};
String.prototype.addParams = function (key, value) {
    var str = this.toString();
    if (typeof key === 'string') {
        str = setParam(str, key, value);
        return str;
    }
    for (idx in key) {
        str = setParam(str, idx, key[idx]);
    }
    return str;
};

String.prototype.ec = function () {
    var str = this;
    str = str.rpAll('\\n', newline);
    str = str.rpAll('<br />', '');
    return str;
};


String.prototype.rA = function (find, replace) {
    var result = this;
    do {
        var split = result.split(find);
        result = split.join(replace);
    } while (split.length > 1);
    return result;
};

if (!String.prototype.startsWith) {
    String.prototype.startsWith = function(searchString, position) {
        position = position || 0;
        return this.indexOf(searchString, position) === position;
    };
}

// function
function getL(key, defaultValue) {
    try {
        var val = localStorage.getItem(key);
        return typeof val != 'undefined' ? val : typeof defaultValue != 'undefined' ? defaultValue : '';
    } catch (e) {

    }
    return defaultValue;
}

function getLO(key, defaultValue) {
    try {
        var r = getL(key, '{}');
        if (r == 'undefined') {
            return defaultValue;
        }
        r = JSON.parse(r);
        return r ? r : defaultValue;
    } catch (e) {

    }
    return defaultValue;
}


function setLO(key, defaultValue) {
    defaultValue = defaultValue == undefined ? {} : defaultValue;
    setL(key, JSON.stringify(defaultValue));
}

function setL(key, defaultValue) {
    defaultValue = defaultValue == undefined ? {} : defaultValue;
    localStorage.setItem(key, defaultValue);
}

function getLKey(key) {
    return getTabId() + '_' + key;
}

function getRandData(data) {
    data = resetObject(data);
    var r = random(0, count(data) - 1);
    delete data[r];
    data = resetObject(data);
    return data;
}

function count(object) {
    return Object.keys(object).length;
}

function random(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function getYMD() {
    var d = new Date();
    return d.getFullYear() + '' + d.getMonth() + '' + d.getDate();
}

function dateDiff(date1, date2) {
    var timeDiff = Math.abs(date2.getTime() - date1.getTime());
    return timeDiff;
}

function getDayDateDiff(date1, date2) {
    var timeDiff = dateDiff(date1, date2);
    return Math.ceil(timeDiff / (1000 * 3600 * 24));
}

function getMinDateDiff(date1, date2) {
    var timeDiff = dateDiff(date1, date2);
    return Math.ceil(timeDiff / (1000 * 60));
}

function scrollToBottom() {
    window.scrollTo(0, document.body.scrollHeight);
}

function scrollToTop() {
    window.scrollTo(0, 0);
}

function scrollToX(e) {
    try {
        jQuery('html, body').animate({
            scrollTop: jQuery(e).offset().top
        }, getSec(random(1, 2)));
    } catch (e) {

    }

}

var extend = function e(c) {
    c = cloneObject(c);
    for (var d = 1; d < arguments.length; ++d) {
        var a = arguments[d];
        if ("object" === typeof a) for (var b in a) a.hasOwnProperty(b) && (c[b] = "object" === typeof a[b] ? e({}, c[b], a[b]) : a[b])
    }
    return c
}
var arrayMerge = function e(c) {
    c = cloneObject(c);
    for (var d = 1; d < arguments.length; ++d) {
        var a = arguments[d];
        if ("object" === typeof a) for (var b in a) a.hasOwnProperty(b) && (c[b] = "object" === typeof a[b] ? e({}, c[b], a[b]) : a[b])
    }
    return c
}

function _toString(str) {
    return typeof str == 'undefined' ? '' : str + '';
}

function getParam(url, name, defaultValue) {
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return defaultValue;
    if (!results[2]) return defaultValue;
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function cloneObject(obj) {
    return $.extend(true, {}, obj);
}

function resetObject(obj) {
    var i = 0;
    var newO = {};
    for (var b in obj) {
        obj.hasOwnProperty(b);
        newO[i] = obj[b];
        i++;
    }
    return newO;
}

function inObject(need, obj) {
    if (Object.values(obj).indexOf(need) > -1) {
        return true;
    }
    return false;
}

function inArray(need, array) {
    if (array.indexOf(need) > -1) {
        return true;
    }
    return false;
}

function getCurrentUrl() {
    return document.URL;
}

function redirect(url) {
    return window.location.href = url;
}

function empty(object) {
    try {
        return !count(object)
    } catch (e) {
        return true;
    }
}

function has(element) {
    return $(element).length > 0;
}

function hasVerticalScroll(node) {
    node = document.getElementById(node);
    return node.scrollTop > 20;
}

function ljust(string, width, padding) {
    padding = padding || " ";
    padding = padding.substr(0, 1);
    if (string.length < width)
        return string + padding.repeat(width - string.length);
    else
        return string;
}

function rjust(string, width, padding) {
    string = '' + string;
    padding = padding + '';
    padding = padding || " ";
    padding = padding.substr(0, 1);
    if (string.length < width)
        return padding.repeat(width - string.length) + string;
    else
        return string;
}

function center(string, width, padding) {
    padding = padding || " ";
    padding = padding.substr(0, 1);
    if (string.length < width) {
        var len = width - string.length;
        var remain = ( len % 2 == 0 ) ? "" : padding;
        var pads = padding.repeat(parseInt(len / 2));
        return pads + string + pads + remain;
    }
    else
        return string;
}

function changeUrl(params) {
    if (typeof params == 'undefined') {
        return;
    }
    if (typeof params == 'object') {
        params = params._tA(true).join('&');
    }
    params = encodeURIComponent(params);
    setL('old_params', document.location.search);
    window.history.pushState('', 'Title', '?' + params);
}

function getCurrentParams() {
    return decodeURIComponent(document.location.search.replace('?', '')).url_tO('&', '=');
}

function share_fb(url) {
    window.open('https://www.facebook.com/sharer/sharer.php?u=' + url, 'facebook-share-dialog', "width=626,height=436")
}

function now(format) {
    if (typeof format === 'undefined') {
        format = 'DD/MM/YYYY H:mm:ss'
    }
    return moment().format(format);
}

function getMin(time) {
    return time * 10000;
}

function getSec(time) {
    return time * 1000;
}

function setParam(uri, key, val) {
    return uri
        .replace(new RegExp("([?&]" + key + "(?=[=&#]|$)[^#&]*|(?=#|$))"), "&" + key + "=" + encodeURIComponent(val))
        .replace(/^([^?&]+)&/, "$1?");
}

window.isMobile = function() {
    var check = false;
    (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
    return check;
};