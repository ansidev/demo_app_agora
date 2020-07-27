<template>
  <div class="wrapper index">
    <div class="ag-header"></div>
    <div class="ag-main">
      <section class="login-wrapper">
        <div class="login-header">
          <img
            :src="require('../assets/images/twice_icon.png')"
            alt=""
          />
          <p class="login-subtitle">Login</p>
        </div>
        <ValidationObserver ref="form">
          <form @submit.prevent="onSubmit">
            <div class="login-body">
              <div class="columns">
                <div class="column is-12">
                  <ValidationProvider
                    v-slot="{ valid, invalid, changed, errors }"
                    rules="required|email"
                    name="email"
                  >
                    <div class="input-container control has-icons-left">
                      <input
                        v-model="email"
                        class="ag-rounded input"
                        :class="errors.length < 1 ? 'is-success' : 'is-danger'"
                        type="text"
                        placeholder="Email"
                      />
                      <span class="validate-icon">
                        <i
                          v-if="changed"
                          class="ag-icon"
                          :class="{'ag-icon-valid': valid, 'ag-icon-invalid': invalid }"
                        />
                      </span>
                      <div
                        class="validate-msg has-text-black"
                        v-if="invalid"
                      >
                        {{ errors[0] }}
                      </div>
                    </div>
                  </ValidationProvider>
                </div>
              </div>
              <div class="columns">
                <div class="column is-12">
                  <ValidationProvider
                    v-slot="{ valid, invalid, changed, errors }"
                    rules="required"
                    name="password"
                  >
                    <div class="input-container control has-icons-left">
                      <input
                        v-model="password"
                        class="ag-rounded input"
                        :class="errors.length < 1 ? 'is-success' : 'is-danger'"
                        type="password"
                        placeholder="Password"
                      />
                      <span class="validate-icon">
                        <i
                          v-if="changed"
                          class="ag-icon"
                          :class="{'ag-icon-valid': valid, 'ag-icon-invalid': invalid }"
                        />
                      </span>
                      <div
                        class="validate-msg has-text-black"
                        v-if="invalid"
                      >
                        {{ errors[0] }}
                      </div>
                    </div>
                  </ValidationProvider>
                </div>
              </div>
            </div>
            <div class="login-footer">
              <button
                id="btn-login"
                class="ag-rounded button is-primary"
                type="submit"
              >Login
              </button>
            </div>
          </form>
        </ValidationObserver>
      </section>
    </div>
    <div class="ag-footer">
      <a
        class="ag-href"
        href="https://www.agora.io"
      >
        <span>Twice app demo</span>
      </a>
      <div>
        <span> 開発環境</span>
        <span class="ag-contact">localhost:8080</span>
      </div>
    </div>
  </div>
</template>

<script>
import * as Cookies from "js-cookie";

export default {
  data() {
    return {
      email: "",
      password: ""
      // form: {
      //   email: {
      //     id: "email",
      //     placeholder: "Email",
      //     rules: {
      //       required: true,
      //       email: true
      //     },
      //     immediate: true
      //   },
      //   password: {
      //     id: "password",
      //     placeholder: "Password",
      //     password: true,
      //     rules: {
      //       required: true
      //     },
      //     immediate: true
      //   }
      // }
    };
  },

  methods: {
    async onSubmit() {
      const $ = this;

      // Wait until the models are updated in the UI
      $.$nextTick(() => {
        $.$refs.form.reset();
      });

      const data = await $.login($.email, $.password);
      const roles = data.roles
      $.gotoPageBasedOnRole(roles)
    },
    async login(email, password) {
      const response = await this.$http.post("/login", { email, password })
      return response.data
    },
    gotoPageBasedOnRole(roles) {
      if (!Array.isArray(roles)) {
        console.log("Invalid role data")
      }
      let screenMode = "unknown"
      if (roles.includes("Admin")) {
        screenMode = "user_list"
      }
      else if (roles.includes("Artist")) {
        screenMode = "artist"
      }
      else if (roles.includes("User")) {
        screenMode = "wait"
      }
      Cookies.set("screenMode", screenMode);
      this.$router.push("/screen");
    }
  },

  mounted() {
    this.$nextTick(() => {
      window.addEventListener("keypress", e => {
        e.keyCode === 13 && this.login();
      });
    });
  }
};
</script>

<style scoped>
.index.wrapper {
  background: url("../assets/images/background.png") center no-repeat;
  background-size: cover;
  min-height: 100%;
  height: auto;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-flow: column;
}

.index .ag-footer {
  display: flex;
  padding: 0 30px;
  justify-content: space-between;
  align-items: center;
}

.index .ag-main {
  flex-grow: 1;
}

.ag-contact {
  color: rgb(0, 182, 237);
  cursor: pointer;
}

.login-wrapper {
  color: rgb(216, 216, 216);
  width: 284px;
  font-size: 14px;
}

.login-header,
.login-footer {
  text-align: center;
  margin: 30px 0;
}

.login-header p {
  margin: 10px 0;
}

.login-header img {
  width: 50%;
}

.login-title {
  font-size: 16px;
  color: #fff;
}

.login-subtitle {
  color: #0a0a0a;
}

#btn-login {
  width: 100%;
  font-size: 18px;
  padding: 10px 10px;

}

.input-container {
  padding-bottom: 25px;
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
  bottom: -10px;
  color: #ff3860;
  text-align: left;
  font-size: 12px;
  height: 30px;
  padding-left: 2rem;
}
</style>
