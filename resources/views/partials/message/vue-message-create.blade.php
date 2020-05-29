<script>
  var app = new Vue({
      el: '#app',
      data: {
          name: '', 
          subject: '',
          message: '',
          loding: false
      },
      methods: {
          isLoginSubmited() {
              if ( this.name && this.message && this.subject ) {
                  this.loding = true;
              }
          } 
      },
      computed: {
          isLodingClass: function () {
              return {
                  'is-loading': this.loding
              }
          },
          disabledLogin: function () {
              return !this.name || !this.message || !this.subject
          }

      }
  })
</script>