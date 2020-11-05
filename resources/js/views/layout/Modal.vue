<template>
  <div id="modal">
    <div class="modal-background">
      <div class="modal-body">
        <div class="close-modal">
          <button @click="closeModal()" class="close btn-none cu-point p-1">
            <i class="fas fa-times "></i>
          </button>
        </div>
        <slot></slot>
      </div>
    </div>
  </div>
</template>

<script>
import { mapMutations } from "vuex";

export default {
  methods: {
    ...mapMutations({ closeModal: "TOGGLE_MODAL" })
  }
};
</script>
