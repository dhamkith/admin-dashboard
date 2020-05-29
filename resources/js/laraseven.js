import * as func from  './func.js'; 

(function IIFE() { 
    "use strict";
 
    var windowHeight = window.innerHeight
              || document.documentElement.clientHeight
              || document.body.clientHeight;

    var windowWidth = window.innerWidth
              || document.documentElement.clientWidth
              || document.body.clientWidth;
 

    /**
    * 
    * helper functions
    */
    function removeIsFrozenActive() {
        const $removeIsFrozen = func.htmlcToArray(document.getElementsByClassName('is-frozen'));
        const asideToggleMobile = document.getElementsByClassName('aside-toggle-mobile')[0];
        const menuToggle = document.getElementsByClassName('menu-toggle')[0]; 
        const isFrozenOverlay = document.getElementsByClassName('is-frozen-overlay')[0];  
        if (asideToggleMobile.classList.contains('is-active') || menuToggle.classList.contains('is-active')) { 
            if (  $removeIsFrozen.length > 0 ) {
                $removeIsFrozen.forEach( el => {
                    el.classList.add('is-frozen--active');
                });
            }
            isFrozenOverlay.classList.add('overlay--active');
        } else {
            if (  $removeIsFrozen.length > 0 ) {
                $removeIsFrozen.forEach( el => {
                    el.classList.remove('is-frozen--active');
                });
            } 
            isFrozenOverlay.classList.remove('overlay--active');
        }
    }
    // if left menu open hide it
    function hideLeftMobileMenu() {
        const $isActiveAside = func.htmlcToArray(document.getElementsByClassName('aside-toggle-mobile'));          
                
        if (  $isActiveAside.length > 0 ) {
            $isActiveAside.forEach( el => {
                el.classList.remove('is-active');
                document.getElementsByClassName(el.dataset.target)[0].classList.remove('aside-open-mobile');
            });
        }
    }

    // if right menu open hide it
    function hideRightMobileMenu() {
        const $menuToggle = func.htmlcToArray(document.getElementsByClassName('menu-toggle'));          
                
        if (  $menuToggle.length > 0 ) {
            $menuToggle.forEach( el => {
                el.classList.remove('is-active');
                document.getElementById(el.dataset.target).classList.remove('is-active');
            });
        }
    }

    // Get all "menu-toggle" elements
    const $navbarBurgers = func.htmlcToArray(document.querySelectorAll('.menu-toggle'));

    // Check if there are any menu-toggle
    if ($navbarBurgers.length > 0) {
  
      // Add a click event on each of them
      $navbarBurgers.forEach( el => {
            el.addEventListener('click', () => {

                // is Left Mobile Menu open 
                hideLeftMobileMenu();

                // Get the target from the "data-target" attribute
                const target = el.dataset.target;
                const $target = document.getElementById(target);
                
                // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
                el.classList.toggle('is-active');
                $target.classList.toggle('is-active');

                // is-frozen
                removeIsFrozenActive();
 
            });
        });
    }

    // is-mobile  "aside-toggle-mobile" aside toggle
    const $asideToggleMobile = func.htmlcToArray(document.querySelectorAll('.aside-toggle-mobile'));

    if ($asideToggleMobile.length > 0) {
  
        // Add a click event on each of them
        $asideToggleMobile.forEach( el => {
            el.addEventListener('click', () => {

                // is Right Mobile Menu open 
                hideRightMobileMenu();

                // Get the target from the "data-target" attribute
                const target = el.dataset.target;
                const $target = document.getElementsByClassName(target)[0]; 

                el.classList.toggle('is-active');
                $target.classList.toggle('aside-open-mobile');

                // is-frozen
                removeIsFrozenActive();

            });
        });
    } 


    
    // Get all "has-dropdown-mobile" elements
    const $hasDropdownMobile =  func.htmlcToArray(document.querySelectorAll('.has-dropdown-mobile'));

    // Check if there are any hasDropdownMobile
    if ($hasDropdownMobile.length > 0) { 
        $hasDropdownMobile.forEach( el => {
            el.addEventListener('click', () => {
                el.nextElementSibling.classList.toggle('is-clickeble');
            });
        });
    }

    
    // Get all "has-submenu" elements
    const $asideHasSubmenu = func.htmlcToArray(document.querySelectorAll('.has-submenu'));

    // Check if there are any has-submenu
    if ($asideHasSubmenu.length > 0) {
        // Add a click event on each of them
        $asideHasSubmenu.forEach( el => {
            el.addEventListener('click', () => {
                // Toggle the " " class
                el.classList.toggle('open'); 
                // Get  "<i>" element
                const hasFa = el.lastElementChild;
                // Check if there are any 'fa-compress' class
                if ( hasFa.classList.contains('fa-compress')) {
                    hasFa.classList.remove('fa-compress');
                    hasFa.classList.add('fa-expand'); 
                } else {
                    hasFa.classList.remove('fa-expand'); 
                    hasFa.classList.add('fa-compress');
                }

                el.nextElementSibling.classList.toggle('toggle--on');
                // Get all Sibling element
                const isSibling = func.getSiblings(el.parentElement);
                isSibling.forEach( el => { 
                    el.lastElementChild.classList.remove('toggle--on'); 
                    el.firstElementChild.classList.remove('open');
                    // Get  "<i>" element
                    const fa = el.firstElementChild.lastElementChild;
                    // Check if there are any 'fa-expand' class
                    if (fa.classList.contains('fa-expand')) { 
                        fa.classList.remove('fa-expand');
                        fa.classList.add('fa-compress'); 
                    }

                    
                });
            });
        });
    }

    /**
    * 
    * dashboad content
    */

    // Get all "action-header-icon" elements action box dropdown
    const $actionHeaderIcon =  func.htmlcToArray(document.querySelectorAll('.action-header-icon'));
    // Check if there are any actionHeaderIcon
    if ($actionHeaderIcon.length > 0) { 
        $actionHeaderIcon.forEach( el => {
            el.addEventListener('click', () => {
                
                el.offsetParent.lastElementChild.classList.toggle('action-active');

                const isSibling = func.getSiblings(el.offsetParent);
                isSibling.forEach( el => { el.lastElementChild.classList.remove('action-active');  });

                const parentSibling = func.getSiblings(el.offsetParent.parentElement);
                
                parentSibling.forEach( el => { 
                    for (var i = 0; i < el.children.length; i++) {
                        if ( el.classList) {
                            for ( var j = 0; j < el.childElementCount; j++) {
                                el.firstElementChild.lastElementChild.classList.remove('action-active');
                                const removeActionActiveClass = func.getSiblings(el.firstElementChild);
                                removeActionActiveClass.forEach( el => {
                                    el.lastElementChild.classList.remove('action-active');  
                                });
                            }
                        }  
                    } 
                });

                // if has action-active class 
                setTimeout(() => { 
                    const $actionDropdown =  func.htmlcToArray(document.querySelectorAll('.action-dropdown'));
                    if($actionDropdown.length > 0) {
                        $actionDropdown.forEach(el => {
                            if( el.classList.contains('action-active')) {
                                el.classList.remove('action-active');
                            } 
                        });
                    } 
                }, 10000); 
            });
        });
    }

    // Get all "setting-toggle" elements
    const $adminSettingToggle =  func.htmlcToArray(document.querySelectorAll('.setting-toggle'));
    // Check if there are any adminSettingToggle
    if ($adminSettingToggle.length > 0) { 
        $adminSettingToggle.forEach( el => {
            el.addEventListener('click', () => {
                el.nextElementSibling.classList.toggle('toggle-open'); 
                var siblings = func.getSiblings(el.parentNode);
                
                siblings.forEach( sibling => {
                    if (sibling.classList.contains('admin-setting-wrap')) { 
                        if(sibling.lastElementChild.classList.contains('toggle-open')) {
                            sibling.lastElementChild.classList.remove('toggle-open');
                        }
                    }
                }); 
            }, false);
        });
    }

    /*  
    *  get user login ips (import function)   
    */ 
   const loginIpsmodel = document.getElementById('get-userlogin-ips');
   if(loginIpsmodel) { 
       loginIpsmodel.addEventListener('click', () => {
           func.getUserLoginIps(loginIpsmodel);
       },false);
   }

    /*  
    * login form center
    */
    const $loginCutomize =  func.htmlcToArray(document.querySelectorAll('.login-cutomize'));
    if ($loginCutomize.length > 0) { 
        $loginCutomize.forEach( el => {
            if (windowHeight > el.clientHeight) { 
                var marginTop = (windowHeight - el.clientHeight)/2;
                el.style = `margin-top: ${marginTop + 16}px !important;`;
            }
        });
    } 


  })();