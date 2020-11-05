<template>
  <div v-if="messages" class="message-container">
    <div class="fixed-container">
      <div class="absolute-container">
        <transition-group name="fade">
          <div
            v-for="message in messages"
            v-bind:key="message.id"
            :class="'message-' + [[message.type]]"
          >
            <div class="message-body">
              <p>
                <i v-if="message.type === 'success'" class="fas fa-check"></i
                ><i
                  v-if="message.type === 'warning'"
                  class="fas fa-exclamation"
                ></i>
                {{ message.text }}
              </p>
              <p @click="removeMessage({ id: message.id })" class="close">
                <i class="fas fa-times "></i>
              </p>
            </div>

            <div v-if="message.confirm" class="confirmation">
              <button
                @click="
                  processTasks({ id: message.id, tasks: message.confirm })
                "
                class="btn-warn-clear"
              >
                Yes
              </button>
              <button
                @click="removeMessage({ id: message.id })"
                class="btn-warn-clear"
              >
                No
              </button>
            </div>
          </div>
        </transition-group>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
import store from "../../store/index";

export default {
  computed: {
    ...mapState({
      messages: state => state.logging.messages,
      errors: state => state.logging.errors
    })
  },
  methods: {
    removeMessage(e) {
      store.commit({ type: "DELETE_MESSAGE", id: e.id });
    },
    async processTasks(e) {
      for await (let task of e.tasks) {
        await store.dispatch(task.action, task.payload);
      }

      store.commit({ type: "DELETE_MESSAGE", id: e.id });
    }
  }
};
</script>
