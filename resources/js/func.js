const baseUrl =  location.protocol + '//' + location.host; 

var windowHeight = window.innerHeight
|| document.documentElement.clientHeight
|| document.body.clientHeight;

var windowWidth = window.innerWidth
|| document.documentElement.clientWidth
|| document.body.clientWidth;

var publicFunc = {

    /* -----------------------------------------------
    * helper function 
    * ------------------------------------------------
    */    
        getChildren: function(n, skipMe) {
            var r = [];
            for ( ; n; n = n.nextSibling ) 
            if ( n.nodeType == 1 && n != skipMe)
                r.push( n );        
            return r;
        },

        getSiblings: function(n) {
            return this.getChildren(n.parentNode.firstChild, n);
        },

        htmlcToArray: function(htmlCollection) {
            return Array.prototype.slice.call(htmlCollection, 0);
        },
        
        /* 
        * 
        * get user login ids, helper function
        *
        */ 
       getUserLoginIps: function(el) { 
            var userId = el.dataset.userid;
            var frag = document.createDocumentFragment(); 
            var appendElem = document.getElementById('append-modal');
            appendElem.innerHTML = '';
            axios.post(`${baseUrl}/manage/api/user-id=${userId}/ips`).then( response => { 
                var arrayData = response.data;
                this.appendModel(frag, arrayData);
                appendElem.appendChild(frag);
                const $modalClose =  this.htmlcToArray(document.querySelectorAll('.m-close'));
                if ($modalClose.length > 0) { 
                    $modalClose.forEach( el => { 
                        this.modelCloseEvent(el);
                    });
                } 
            }).catch(({ response }) => {
                console.log(response);
            }); 
        },

        /* 
        * 
        * append model fragment
        *
        */ 
       appendModel: function(frag, arrayData) { 
        var fragLi = document.createDocumentFragment();
        arrayData.forEach( el => { 
            var li = document.createElement('li');
                li.className = 'ip-list';
            var loginData = document.createTextNode( `${el.time} --- Ip: ${el.ip}`);
            li.appendChild(loginData);
            fragLi.appendChild(li);
        });  
        var div1 = document.createElement('div');
            div1.id = 'is-active';
            div1.className = 'modal is-active';
            div1.style = "z-index: 9999;"
        var div2 = document.createElement('div');
            div2.className = 'modal-background';
        var div3 = document.createElement('div');
            div3.className = 'modal-card slide-down';
        var header = document.createElement('header');
            header.className = 'modal-card-head';
        var button1 = document.createElement('a');
            button1.className = 'delete is-danger m-close';
            button1.setAttribute('aria-label', `close`);
            header.appendChild(button1);
        var section = document.createElement('section');
            section.className = 'modal-card-body';
            section.appendChild(fragLi);
        var footer = document.createElement('footer');
            footer.className = 'modal-card-foot'; 
        var cancel = document.createTextNode( 'close' );
        var button2 = document.createElement('a');
            button2.className = 'button cancel is-danger is-outlined m-close';
            button2.appendChild(cancel);
            footer.appendChild(button2);

            div3.appendChild(footer);
            div3.insertBefore(section, footer);
            div3.insertBefore(header, section);

            div1.appendChild(div3);
            div1.insertBefore(div2, div3);

            frag.appendChild(div1);
 
    },

    /*
    *
    * modelCloseEvent function
    * 
    */
    modelCloseEvent: function (elem) {  
        elem.addEventListener( 'click',() => { 
            var isActive = document.getElementById('is-active');
            if(isActive.classList.contains('is-active')){
                isActive.classList.remove('is-active'); 
            } 
        }, false) 
    }

}; 

export function getSiblings(el) {
  return publicFunc.getSiblings(el);
};

export function htmlcToArray(htmlCollection) {
  return publicFunc.htmlcToArray(htmlCollection);
};

export function getUserLoginIps(el) {
    return publicFunc.getUserLoginIps(el);
};
 