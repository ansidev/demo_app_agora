<template>
  <div id="ag-canvas" v-if="screenMode !== 'user_list'">
    <CallScreen v-bind="screenModeConfig[screenMode].left" />
    <CallScreen v-bind="screenModeConfig[screenMode].right" />
    <RemainingTimeToCall v-if="screenMode === 'wait'" v-bind="screenModeConfig[screenMode].remaining_time">Remaining time to call: {{ remainingTimeToCall }}</RemainingTimeToCall>
    <div class="ag-btn-group">
      <span
        @click="handleExit"
        class="ag-btn exitBtn"
        title="Exit"
      >
        <i class="ag-icon ag-icon-leave"></i>
      </span>
    </div>
  </div>
  <UserList v-else />
</template>

<script>
import CallScreen from "@/components/CallScreen.vue";
import RemainingTimeToCall from "@/components/RemainingTimeToCall.vue";
import UserList from "@/components/UserList.vue";

export default {
  components: {
    CallScreen,
    RemainingTimeToCall,
    UserList,
  },
  props: {
    screenMode: {
      type: String,
      default: "artist"
    }
  },
  data() {
    return {
      remainingTimeToCall: '5 mins',
      screenModeConfig: {
        artist: {
          left: {
            "row-start": "span 10",
            "col-start": "span 10",
            "row-end": 12,
            "col-end": 12
          },
          right: {
            "row-start": "span 10",
            "col-start": "span 10",
            "row-end": 12,
            "col-end": 24
          }
        },
        user: {
          left: {
            "row-start": "span 10",
            "col-start": "span 10",
            "row-end": 12,
            "col-end": 12
          },
          right: {
            "row-start": "span 4",
            "col-start": "span 4",
            "row-end": 12,
            "col-end": 17
          }
        },
        wait: {
          left: {
            "row-start": "span 10",
            "col-start": "span 12",
            "row-end": 12,
            "col-end": 14
          },
          right: {
            "row-start": "span 4",
            "col-start": "span 4",
            "row-end": 12,
            "col-end": 19
          },
          remaining_time: {
            "row-start": "span 1",
            "col-start": "span 9",
            "row-end": 5,
            "col-end": 24
          }
        },
      }
    };
  },
  methods: {
    /* eslint-disable no-unused-vars */
    handleExit(e) {
      // Return to home
      this.$router.push ("/")
    }
  },
};
</script>

<style>
#ag-canvas {
  height: 100%;
  display: grid;
  grid-gap: 10px;
  align-items: center;
  justify-items: center;
  grid-template-rows: repeat(12, auto);
  grid-template-columns: repeat(24, auto);
}

.ag-item :first-child {
  border-radius: 6px;
}
.ag-item {
  border-radius: 6px;
  border: 2px #00b6ed solid;
  background: url("../assets/images/avatar.png") center no-repeat;
  height: 100%;
  width: 100%;
}

.ag-item.text {
  background: none;
  border: none;
  color: #fff;
  font-size: 1.5rem;
  text-align: left;
  vertical-align: middle;
}

#ag-resize-container {
  background-image: none !important;
  background-color: black;
  display: flex;
  justify-content: center;
  height: center;
}

#ag-resize-container .ag-item {
  border: none !important;
}

/* button group */
.ag-btn-group {
  height: 70px;
  width: calc(100% - 60px);
  margin: 0 auto;
  position: absolute;
  bottom: 0;
  background: transparent;
  z-index: 11;
  display: flex;
  justify-content: space-around;
  align-items: center;
}

.ag-btn {
  z-index: 12;
  color: white;
  /* width: 35px;
    height: 35px; */
  cursor: pointer;
  font-size: 60px;
  display: inline-flex;
  justify-content: center;
  align-items: center;
}
.ag-btn:hover {
  background: rgba(18, 74, 99, 0.8);
}

.ag-btn.disabled,
.ag-btn.disabled:hover {
  color: #637c8e;
  cursor: not-allowed;
}

.ag-btn-group:hover .ag-btn,
.ag-btn-group.active .ag-btn {
  opacity: 1;
}
.ag-btn.off.videoControlBtn .ag-icon-camera {
  display: none;
}
.ag-btn.videoControlBtn .ag-icon-camera-off {
  display: none;
}
.ag-btn.videoControlBtn .ag-icon-camera {
  display: inline-block;
}
.ag-btn.off.videoControlBtn .ag-icon-camera-off {
  display: inline-block;
}
.ag-btn.off.audioControlBtn .ag-icon-mic {
  display: none;
}
.ag-btn.audioControlBtn .ag-icon-mic-off {
  display: none;
}
.ag-btn.audioControlBtn .ag-icon-mic {
  display: inline-block;
}
.ag-btn.off.audioControlBtn .ag-icon-mic-off {
  display: inline-block;
}

video {
  max-width: unset !important;
}
</style>

