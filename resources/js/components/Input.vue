<template>
  <div class="form-group">
    <label :for="inputname">{{ label }}</label>
    <input
      :type="inptype"
      v-bind:value="value"
      v-on:input="$emit('input', $event.target.value)"
      class="form-control"
      :name="inputname"
      id
      :placeholder="placeholder"
    />
    <div :class="errorclass">{{ error }}</div>
  </div>
</template>
<script>
export default {
  props: [
    "label",
    "inputname",
    "placeholder",
    "error",
    "errorclass",
    "value",
    "inptype"
  ]
};
</script>