<script>
  var app = new Vue({
      el: '#app',
      data: {
        search: '',
        action: 'default',
        usercheckall: false,
        userids: []
      },
      computed: {
        disabled: function () {
          return !this.search
        },
        disabledDelete: function () {
          return this.action === 'default'
        },
        checkall: function () {
          if (this.usercheckall) {
            this.userids = {!! $users->pluck('id') !!}
          } else {
            this.userids = []
          }
        }
      },
      watch: {
        checkall: () => { 
          //watch 
        }
      }
  })
</script>