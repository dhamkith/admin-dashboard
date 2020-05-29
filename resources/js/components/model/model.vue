<template>
  <div class="modal is-active">
    <div class="modal-background"></div>
    <div class="modal-card  slide-down">
        <header class="modal-card-head">
          <slot name="title"></slot>
          <button class="delete is-danger" v-on:click="modelCloce" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
          <slot></slot>
        </section>

        <footer class="modal-card-foot">
          <slot name="submit"></slot>
          <button class="button cancel is-danger is-outlined" v-on:click="modelCloce">Cancel</button>
        </footer>
    </div>
  </div>
</template>

<script>
export default {
    methods: {
        modelCloce () {
          this.$emit('emit-cloce');
        }
    }
}
</script>
<style lang="scss" scoped>
 .modal-card-head,.modal-card-foot {
   background-color: #fff;
   border: none;
     button.cancel {
     position: absolute;
     right: 20px;
   } 
 } 
 .modal-card-body {
   background-color: rgba(255, 255, 255, .96);
   .field {
     .control {
       input {
         background-color: #fff!important;
         border: 1px solid rgba(0, 0, 0, .09)!important;
       }
     }
   }
 } 

</style>
