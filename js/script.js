/**
 * Name: Flatlog WP
 * Author: Alex Chao
 * Date: 2014-3-9
 * URL: http://www.xiaocaoge.com
 */

// Base
var id,
    tag,
    cls,
    addEvent,
    removeEvent,
    domReady,
    hasClass,
    addClass,
    removeClass,
    toggleClass;

function id(id) {
    return document.getElementById(id);
}

function tag(tag, parent) {
    parent = parent || document;
    return parent.getElementsByTagName(tag);
}

// Get elements by class name
if (document.getElementsByClassName) {
    cls = function(cls, parent) {
        parent = parent || document;
        return parent.getElementsByClassName(cls);
    };
} else {
    cls = function(cls, parent) {
        parent = parent || document;
        var i,
            len,
            els = [],
            re = new RegExp('(^|\\s+)' + cls + '(\\s+|$)'),
            tags = parent.getElementsByTagName('*');

        len = tags.length;
        for (i = 0; i < len; i++) {
            if (re.test(tags[i].className)) {
                els.push(tags[i]);
            }
        }
        return els;
    };
}

// Attach listener on element
if (document.addEventListener) {
    addEvent = function(el, type, listener, useCapture) {
        return el.addEventListener(type, listener, useCapture);
    };
} else if (document.attachEvent) {
    addEvent = function(el, type, listener) {
        el[type+listener] = function(e) {
            e = window.event;
            e.target = e.srcElement;
            e.preventDefault = function() { e.returnValue = false; };
            e.stopPropagation = function() { e.cancelBubble = true; };
            listener.call(el, e);
        };
        el.attachEvent('on'+type, el[type+listener]);
    };
}

// Detach listener on element
if (document.removeEventListener) {
    removeEvent = function(el, type, listener) {
        return el.removeEventListener(type, listener);
    };
} else if (document.detachEvent) {
    removeEvent = function(el, type, listener) {
        el.detachEvent('on'+type, el[type+listener]);
    };
}

// DOM ready function
if (document.addEventListener) {
    domReady = function(fn) {
        document.addEventListener('DOMContentLoaded', fn);
    };
} else if ('onreadystatechange' in document) {
    domReady = function(fn) {
        document.attachEvent('onreadystatechange', function() {
            if (document.readyState === 'complete') {
                fn();
            }
        });
    };
} else {
    domReady = function(fn) {
        var prevFn = window.onload;
        window.onload = function() {
            prevFn();
            fn();
        };
    };
}

// Check if the element has some one class
// Add class
// Remove class
if (document.documentElement.classList) {
    hasClass = function(el, cls) {
        return el.classList.contains(cls);
    };
    addClass = function(el, cls) {
        if (!hasClass(el, cls)) {
            el.classList.add(cls);
        }
    };
    removeClass = function(el, cls) {
        if (hasClass(el, cls)) {
            el.classList.remove(cls);
        }
    };
} else {
    hasClass = function(el, cls) {
        var re = new RegExp('(^|\\s+)' + cls + '(\\s+|$)');
        return re.test(el.className);
    };
    addClass = function(el, cls) {
        if (!hasClass(el, cls)) {
            el.className += ' ' + cls;
        }
    };
    removeClass = function(el, cls) {
        var re = new RegExp('(^|\\s+)' + cls + '(\\s+|$)');
        if (hasClass(el, cls)) {
            el.className = el.className.replace(re, '');
        }
    };
}

// Toggle class
toggleClass = function(el, cls) {
    if (hasClass(el, cls)) {
        removeClass(el, cls);
    } else {
        addClass(el, cls);
    }
};