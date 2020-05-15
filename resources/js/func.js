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
        }

}; 
export function getSiblings(el) {
  return publicFunc.getSiblings(el);
};

export function htmlcToArray(htmlCollection) {
  return publicFunc.htmlcToArray(htmlCollection);
};