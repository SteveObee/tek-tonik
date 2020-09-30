<template>
  <div id="contact">
    <h2 class="section-title mb-2">Contact Us</h2>
    <p class="text-center mb-2">
      Please use the form below to contact us with any queries you have.
      <br />
      We will be in touch as soon as we can.
    </p>

    <div class="contact-form-wrapper">
      <form @submit.prevent="onSubmit" class="form contact-form">
        <input hidden type="text" name="name" v-model="honeyPot" />
        <div class="form-control text-left form-id">
          <label class="">Name</label>
          <input type="text" v-model="name" />
          <div v-if="errors && errors.name" class="required">
            <small v-for="error in errors.name">{{ error }}</small>
          </div>
        </div>
        <div class="form-control text-left form-email">
          <label class="">Email Address</label>
          <input type="text" v-model="email" />
          <div v-if="errors && errors.email" class="required">
            <small v-for="error in errors.email">{{ error }}</small>
          </div>
        </div>
        <div class="form-control text-left form-subject">
          <label class="">Subject</label>
          <input type="text" v-model="subject" />
          <div v-if="errors && errors.subject" class="required">
            <small v-for="error in errors.subject">{{ error }}</small>
          </div>
        </div>
        <div class="form-control text-left form-message">
          <label class="">Message</label>
          <textarea
            type="text"
            v-model="message"
            placeholder="Enter Message..."
          />
          <div v-if="errors && errors.message" class="required">
            <small v-for="error in errors.message">{{ error }}</small>
          </div>
        </div>
        <div v-if="saving" class="form-submit">
          <Spinner />
        </div>
        <button v-else type="submit" class="btn-submit form-submit">
          Submit
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
import Spinner from "../Spinner";

export default {
  components: {
    Spinner
  },
  data() {
    return {
      saving: false,
      name: "",
      honeyPot: null,
      email: "",
      subject: "",
      message: "",
      honeyCount: 3
    };
  },
  async mounted() {
    await this.countdown();
  },
  computed: {
    ...mapState({
      errors: state => state.logging.errors
    })
  },
  methods: {
    ...mapActions(["contactAdmin"]),
    async onSubmit() {
      const {
        name,
        honeyPot,
        email,
        subject,
        message,
        honeyCount,
        errors
      } = this;

      const enquiry = {
        name,
        honeyPot,
        email,
        subject,
        message,
        honeyCount
      };

      this.saving = true;

      await this.contactAdmin(enquiry);

      this.saving = false;

      if (!this.errors) {
        this.name = "";
        this.email = "";
        this.subject = "";
        this.message = "";
      }
    },
    countdown() {
      let countdown = setInterval(() => {
        this.honeyCount > 0
          ? (this.honeyCount = this.honeyCount - 1)
          : (this.honeyCount = null && clearInterval(countdown));
      }, 1000);
    }
  }
};
</script>
