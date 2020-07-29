<template>
  <ValidationProvider
    v-slot="{ valid, invalid, changed, errors }"
    :immediate="immediate"
    :rules="rules"
    :name="id"
  >
    <div class="input-container control has-icons-left">
      <slot v-bind="{ type, placeholder, errors }" />
      <!--
      <input
        class="ag-rounded input"
        :class="errors.length < 1 ? 'is-success' : 'is-danger'"
        :type="password ? 'password' : 'text'"
        :placeholder="placeholder"
      /> -->
      <span
        v-if="icon"
        class="icon is-small is-left"
      >
        <img
          :src="icon"
          alt=""
        />
      </span>
      <span class="validate-icon">
        <i
          v-if="changed"
          class="ag-icon"
          :class="{'ag-icon-valid': valid, 'ag-icon-invalid': invalid }"
        />
      </span>
      <div class="validate-msg" v-if="invalid">
        {{ errors[0] }}
      </div>
    </div>
  </ValidationProvider>
</template>

<script>
export default {
  props: {
    id: { type: String, required: true },
    icon: { type: String, required: false, default: null },
    placeholder: { type: String, required: false, default: "" },
    rules: { type: [Object], required: false, default: () => ({}) },
    immediate: { type: Boolean, required: false, default: false },
    password: { type: Boolean, required: false, default: false },
    value: { type: String, required: true, default: '' }
  },
  computed: {
    type() {
      return this.password ? 'password' : 'text'
    }
  }
};
</script>

<style scoped>
.input-container {
  padding-bottom: 30px;
}

.input {
  background: transparent;
  color: #000;
  padding: 8px 50px;
  height: 35px;
}

.input:focus:not(.is-success):not(.is-danger) {
  border-color: #00b6ed;
}

.input::-webkit-input-placeholder {
  color: #000;
  opacity: 0.5;
}

.input-container.has-icons-left .icon.is-left {
  left: 15px;
}

.validate-icon {
  position: absolute;
  right: -36px;
  top: 0px;
  color: red;
  font-size: 2rem;
  display: inline-flex;
  justify-content: center;
  align-items: center;
}

.validate-icon > .ag-icon-invalid {
  color: #d0021b;
}

.validate-icon > .ag-icon-valid {
  color: rgb(178, 206, 149);
}

.validate-msg {
  width: 100%;
  position: absolute;
  left: 5px;
  bottom: -10px;
  color: #ff3860;
  text-align: left;
  font-size: 12px;
  height: 30px;
  padding-left: 2rem;
}
</style>
