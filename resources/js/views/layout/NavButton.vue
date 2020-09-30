<template>
  <button v-if="type === 'back'" class="btn-nav c-primary" @click="goBack">
    <i class="fas fa-chevron-circle-left"></i> Back
  </button>
</template>

<script>
export default {
  props: {
    type: {
      type: String
    }
  },
  methods: {
    goBack() {
      window.history.length > 1 ? this.$router.go(-1) : this.$router.push("/");
    }
  }
};
</script>
