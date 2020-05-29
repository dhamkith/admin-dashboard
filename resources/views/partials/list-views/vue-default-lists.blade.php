<script>
  var app = new Vue({
      el: '#app',
      data: {
        action: 'default',
        checkall: false,
        dataIds: []
      },
      computed: {
        inboxCheckall: function () {
          if (this.checkall) {
             this.dataIds = {!! $datas->pluck('id') !!} 
          } else {
            this.dataIds = []
          }
        },
        disabledDelete: function () {
          return this.action === 'default'
        }
      }
  })
</script>