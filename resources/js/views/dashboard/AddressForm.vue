<template>
  <div class="card-body">
    <form @submit.prevent="onSubmit($event)" class="form address-form">
      <div v-if="dashboard">
        <p
          v-if="!address"
          class="c-primary cu-point"
          v-on:click="toggleEditing()"
        >
          <i class="fas fa-arrow-circle-left mb-2 c-primary cu-pointer"></i>
          Discard changes
        </p>
        <p v-else class="c-primary cu-point" v-on:click="toggleEditing()">
          <i class="fas fa-arrow-circle-left mb-2 c-primary cu-pointer"></i>
          Discard changes
        </p>
      </div>
      <div class="form-control">
        <label class="">Address line 1</label>
        <input type="text" v-model="address_line_1" />
        <div v-if="errors && errors.address_line_1" class="required">
          <small>{{ errors.address_line_1[0] }}</small>
        </div>
      </div>
      <div class="form-control">
        <label class="">Address line 2</label>
        <input type="text" v-model="address_line_2" />
        <div v-if="errors && errors.address_line_2" class="required">
          <small>{{ errors.address_line_2[0] }}</small>
        </div>
      </div>
      <div class="form-control">
        <label class="">County</label>
        <input type="text" v-model="county" />
        <div v-if="errors && errors.county" class="required">
          <small>{{ errors.county[0] }}</small>
        </div>
      </div>
      <div class="form-control">
        <label class="">City</label>
        <input type="text" v-model="city" />
        <div v-if="errors && errors.city" class="required">
          <small>{{ errors.city[0] }}</small>
        </div>
      </div>
      <div class="form-control">
        <label class="">Postcode</label>
        <input type="text" v-model="postcode" />
        <div v-if="errors && errors.postcode" class="required">
          <small>{{ errors.postcode[0] }}</small>
        </div>
      </div>

      <div v-if="dashboard" class="form-control-chkbox">
        <div class="chkbox-group">
          <label for="shipping">Shipping</label>
          <input type="checkbox" v-model="is_shipping" />
        </div>
        <div class="chkbox-group">
          <label for="billing">Billing</label>
          <input type="checkbox" v-model="is_billing" />
        </div>
      </div>

      <button
        v-if="creating"
        type="submit"
        class="btn-primary"
        :disabled="saving"
      >
        Save
      </button>
      <button v-else type="submit" class="btn-primary" :disabled="saving">
        {{ dashboard ? "Update" : "Save" }}
      </button>
    </form>
  </div>
</template>
<script>
import store from "../../store/index";
import { mapState, mapActions } from "vuex";

export default {
  props: {
    creating: Boolean,
    address: Object,
    editing: Boolean,
    editingId: Number,
    dashboard: {
      type: Boolean,
      default: true
    },
    shipping: {
      type: Boolean,
      default: false
    },
    billing: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      address_line_1: this.address ? this.address.address_line_1 : "",
      address_line_2: this.address ? this.address.address_line_2 : "",
      county: this.address ? this.address.county : "",
      city: this.address ? this.address.city : "",
      postcode: this.address ? this.address.postcode : "",
      is_shipping: this.address ? this.address.is_shipping : "",
      is_billing: this.address ? this.address.is_billing : "",
      saving: false
    };
  },
  computed: {
    ...mapState({
      errors: state => state.logging.errors
    })
  },
  methods: {
    async onSubmit(event) {
      this.saving = true;

      const {
        address_line_1,
        address_line_2,
        county,
        city,
        postcode,
        is_shipping,
        is_billing
      } = this;

      const newAddress = {
        address_line_1,
        address_line_2,
        county,
        city,
        postcode,
        is_shipping,
        is_billing
      };

      if (this.shipping) {
        newAddress.is_shipping = true;
        newAddress.is_billing = false;
      } else if (this.billing) {
        newAddress.is_shipping = false;
        newAddress.is_billing = true;
      }

      if (this.creating) {
        await store.dispatch("addAddress", newAddress);
      } else {
        newAddress.id = this.address.id;

        await store.dispatch("updateAddress", newAddress);
      }

      this.saving = false;

      if (!this.errors && this.dashboard) {
        this.toggleEditing();
        await store.dispatch("getUserAddresses");
      } else if (!this.errors) {
        await store.dispatch("getAllUserAddresses");
      }
    },

    toggleEditing() {
      this.$emit("update:creating", false);
      this.$emit("update:editing", false);
      this.$emit("update:editingId", null);
      store.dispatch("resetErrors");
    },

    ...mapActions(["getUserAddresses", "resetErrors"])
  }
};
</script>
