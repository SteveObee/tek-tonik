<template>
  <div v-if="loading">
    <Spinner />
  </div>
  <div v-else-if="addressesExist">
    <div class="dash-addresses" :class="[addressesClass]">
      <div class="card" v-bind:class="{ 'cu-point': !creating }">
        <div v-if="creating && !editing">
          <AddressForm
            v-bind:creating.sync="creating"
            v-bind:editing.sync="editing"
          />
        </div>
        <div
          v-else
          class="address-flip"
          v-on:click="!editing && (creating = !creating)"
        >
          <h2 class="text-muted">Add<br />Address</h2>
          <h2><i class="fas fa-plus text-muted"></i></h2>
        </div>
      </div>
      <div
        v-for="{
          id,
          address_line_1,
          address_line_2,
          county,
          city,
          postcode,
          is_shipping,
          is_billing
        } in addresses.data"
        class="card"
      >
        <div v-if="id == editing_id && editing && !creating">
          <AddressForm
            :address="{
              id,
              address_line_1,
              address_line_2,
              county,
              city,
              postcode,
              is_shipping,
              is_billing
            }"
            v-bind:editing.sync="editing"
            v-bind:editingId.sync="editing_id"
            v-bind:creating.sync="creating"
          />
        </div>

        <div v-else class="card-body-address my-2">
          <div class="address-line">
            <strong class="">Address line 1</strong>
            <p>{{ address_line_1 }}</p>
          </div>
          <div class="address-line">
            <strong class="">Address line 2</strong>
            <p v-if="!address_line_2" class="text-muted">None</p>
            <p>{{ address_line_2 }}</p>
          </div>
          <div class="address-line">
            <strong class="">County</strong>
            <p>{{ county }}</p>
          </div>
          <div class="address-line">
            <strong class="">City</strong>
            <p>{{ city }}</p>
          </div>
          <div class="address-line">
            <strong class="">Postcode</strong>
            <p>{{ postcode }}</p>
          </div>
          <div class="address-line">
            <div v-if="is_shipping">
              <strong>Shipping </strong>
              <strong><i class="fas fa-check"></i></strong>
            </div>
            <div v-else>
              <strong>Shipping </strong>
              <strong><i class="fas fa-times"></i></strong>
            </div>
          </div>
          <div class="address-line">
            <div v-if="is_billing">
              <strong>Billing </strong>
              <strong><i class="fas fa-check"></i></strong>
            </div>
            <div v-else>
              <strong>Billing </strong>
              <strong><i class="fas fa-times"></i></strong>
            </div>
          </div>
          <div class="button-row mt-3">
            <button v-on:click="onDeleteClick({ id })" class="btn-danger">
              <i class="fas fa-times"></i>
            </button>
            <button v-on:click="onEditClick({ id })" class="btn-light">
              <i class="fas fa-pencil-alt"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div v-if="displayPagination" class="pagination my-2">
        <button
          class="btn-light"
          :disabled="!prevPage"
          @click.prevent="goToPrev"
        >
          Previous
        </button>
        {{ paginatonCount }}
        <button
          class="btn-light"
          :disabled="!nextPage"
          @click.prevent="goToNext"
        >
          Next
        </button>
      </div>
    </div>
  </div>
  <div v-else>
    <div class="dash-addresses" :class="[addressesClass]">
      <div class="card" v-bind:class="{ 'cu-point': !creating }">
        <div v-if="creating">
          <AddressForm v-bind:creating.sync="creating" />
        </div>
        <div v-else class="address-flip" v-on:click="creating = !creating">
          <h2 class="text-muted">Add<br />Address</h2>
          <h2><i class="fas fa-plus text-muted"></i></h2>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
import Spinner from "../Spinner";
import AddressForm from "./AddressForm";
import store from "../../store/index";
import { messageHandler } from "../../utils/helpers";

export default {
  async beforeRouteEnter(to, from, next) {
    try {
      await store.dispatch("getUserAddresses", { page: to.query.page });
      next();
    } catch (e) {
      next({
        name: "dashboard.profile"
      });
    }
  },
  async beforeRouteUpdate(to, from, next) {
    try {
      await store.dispatch("getUserAddresses", { page: to.query.page });
      next();
    } catch (e) {
      next({
        name: "dashboard.profile"
      });
    }
  },
  components: {
    Spinner,
    AddressForm
  },
  data: function() {
    return { creating: false, editing_id: null, editing: false};
  },
  computed: {
    ...mapState({
      addresses: state => state.address.addresses,
      loading: state => state.address.loading,
      meta: state => state.address.addresses.meta
    }),
    addressesExist() {
      return this.addresses && this.addresses.data.length > 0;
    },
    addressesClass() {
      return this.addresses && this.addresses.data.length > 0 ? "auto-columns-2" : "auto-columns-1";
    },
    nextPage() {
      if (this.meta) {
        const { current_page, last_page } = this.meta;

        return current_page !== last_page && current_page + 1;
      }
    },
    prevPage() {
      if (this.meta) {
        const { current_page } = this.meta;

        return current_page !== 1 && current_page - 1;
      }
    },
    paginatonCount() {
      if (!this.meta) {
        return;
      }

      const { current_page, last_page } = this.meta;

      return `${current_page} of ${last_page}`;
    },
    displayPagination() {
      return this.meta && this.meta.total > 3 ? true : false; 
    }
  },
  methods: {
    onDeleteClick(event) {
      messageHandler("Really delete Address?", "warning", [{
          action: "deleteAddress",
        payload: { id: event.id }
      }]);
    },
    async onEditClick(event) {
      if (!this.creating) {
        this.editing = true;
        this.editing_id = event.id;
      }
    },
    goToNext() {
      this.$router.push({
        query: {
          page: this.nextPage
        }
      });
    },
    goToPrev() {
      this.$router.push({
        name: "dashboard.addresses",
        query: {
          page: this.prevPage
        }
      });
    }
  }
};
</script>
