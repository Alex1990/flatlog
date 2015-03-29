<?php
/**
 * @package WordPress
 * @subpackage Flatlog
 */
?>

    <footer class="footer">
        <div class="wrap">
            <p class="copyright">&copy; <?php echo date('Y'); ?> Alex Chao. All Rights Reserved. 
                Powered by <a href="http://www.wordpress.org" target="_blank">WordPress</a>.
                Theme designed by <a href="http://www.xiaocaoge.com">Alex Chao</a>.</p>
        </div>
    </footer>
    <?php versioned_javascript($GLOBALS["TEMPLATE_RELATIVE_URL"] . "js/script.js") ?>
    <?php versioned_javascript($GLOBALS["TEMPLATE_RELATIVE_URL"] . "js/headroom.min.js") ?>
    
    <script>
        // Remove the outline of anchor in ie
        (function() {
            var i,
                len,
                anchors = tag('*');
            for (i = 0, len = anchors.length; i < len; i++) {
                anchors[i].hideFocus = true;
            }
        })();

        // Responsive nav
        (function(win) {
            function pullNav(navCls, opts) {
                var defaults = {
                    nav: '.nav',
                    navContainer: document.body,
                    navToggle: '.pullnav-toggle'
                };

                opts = merge(defaults, opts);

                // Copy the nav
                var navCls = navCls.slice(1),
                    reg = new RegExp('(^|\\s+)' + navCls + '(\\s+|$)'),
                    nav = cls(navCls)[0],
                    navShadow = nav.cloneNode(true);

                // Remove the original classname and add the new classname
                navShadow.className = navShadow.className.replace(reg, '') + ' pullnav';

                // Append the shadow nav to the top of nav container
                opts.navContainer.insertBefore(navShadow, opts.navContainer.firstChild);

                // Determine whether the shadow nav is shown or not
                var navToggle = cls(opts.navToggle.slice(1))[0];
                if (navToggle.addEventListener) {
                    navToggle.addEventListener('click', function(e) {
                        toggleClass(navShadow, 'pullnav-show');
                    });
                } else if (navToggle.attachEvent) {
                    navToggle.attachEvent('onclick', function() {
                        toggleClass(navShadow, 'pullnav-show');
                    });
                }

                // Hide the nav when scroll the document
                if (win.addEventListener) {
                    win.addEventListener('scroll', function() {
                        removeClass(navShadow, 'pullnav-show');
                    });
                } else if (win.attachEvent) {
                    win.attachEvent('onscroll', function() {
                        removeClass(navShadow, 'pullnav-show');
                    });
                }
            }

            win.pullNav = pullNav;

            function cls(cls, parent) {
                parent = parent || document;
                if (parent.getElementsByClassName) {
                    return parent.getElementsByClassName(cls);
                } else {
                    var i,
                        len,
                        nodeList = [],
                        nodeAll = parent.getElementsByTagName('*'),
                        reg = new RegExp('(^|\\s+)' + cls + '(\\s+|$)');

                    for (i = 0, len = nodeAll.length; i < len; i++) {
                        if (reg.test(nodeAll[i].className)) {
                            nodeList.push(nodeAll[i]);
                        }
                    }

                    return nodeList;
                }
            }

            function hasClass(elem, cls) {
                if (elem.classList) {
                    return elem.classList.contains(cls);
                } else {
                    var reg = new RegExp('(^|\\s+)' + cls + '(\\s+|$)');
                    return elem.className && reg.test(elem.className);
                }
            }

            function addClass(elem, cls) {
                if (!hasClass(elem, cls)) {
                    if (elem.classList) {
                        elem.classList.add(cls);
                    } else {
                        elem.className += ' ' + cls;
                    }
                }
                return elem;
            }     

            function removeClass(elem, cls) {
                if (hasClass(elem, cls)) {
                    if (elem.classList) {
                        elem.classList.remove(cls);
                    } else {
                        var reg = new RegExp('(^|\\s+)' + cls + '(\\s+|$)');
                        elem.className = elem.className.replace(reg, '');
                    }
                }
                return elem;
            }

            function toggleClass(elem, cls) {
                if (elem.classList) {
                    elem.classList.toggle(cls);
                } else {
                    if (!hasClass(elem, cls)) {
                        addClass(elem, cls);
                    } else {
                        removeClass(elem, cls);
                    }
                }
                return elem;
            }

            function merge(obj1, obj2) {
                for (var prop in obj2) {
                    obj1[prop] = obj2[prop];
                }
                return obj1;
            }
        })(window);

        // headroom
        var header = document.getElementById('header'),
            headroom = new Headroom(header, {
                'offset': 300,
                'tolerance': 5,
                'onPin': function() {},
                'onUnpin': function() {}
            });
        headroom.init();

        // pullNav setting
        pullNav('.nav', {
            navContainer: header
        });

        // Remove the width and height attributes of images
        function fixedImgRatio() {
            var i,
                len,
                imgs = document.getElementsByTagName('img');
            len = imgs.length;
            for (i = 0; i < len; i++) {
                imgs[i].removeAttribute('width');
                imgs[i].removeAttribute('height');
            }
        }
        fixedImgRatio();

        // Focus on search input
        function searchFocus() {
            var searchSubmit = cls('search-submit')[0],
                searchTrigger = cls('search-trigger')[0],
                keywords = document.getElementById('keywords');

            function handle(e) {
                if (keywords.value === '') {
                    e.preventDefault();
                    keywords.focus();
                }
            }

            addEvent(searchSubmit, 'click', handle);
            addEvent(searchTrigger, 'click', handle);
        }
        searchFocus();

        // Responsive search
        function searchDisplay() {
            var searchTrigger = cls('search-trigger')[0],
                searchForm = cls('search-form')[0];
            addEvent(searchTrigger, 'click', function() {
                toggleClass(searchForm, 'search-form-show');
            });

            addEvent(window, 'scroll', function() {
                removeClass(searchForm, 'search-form-show');
            });
        }
        searchDisplay();

    </script>
</body>
</html>
