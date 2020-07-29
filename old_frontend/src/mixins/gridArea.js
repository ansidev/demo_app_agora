export default {
  props: {
    rowStart: {
      type: String,
      required: true
    },
    colStart: {
      type: String,
      required: true
    },
    rowEnd: {
      type: Number,
      required: true
    },
    colEnd: {
      type: Number,
      required: true
    },
  },
  computed: {
    style() {
      return {
      'grid-row-start': this.rowStart,
      'grid-column-start': this.colStart,
      'grid-row-end': this.rowEnd,
      'grid-column-end': this.colEnd,
    }
    }
  }
}
