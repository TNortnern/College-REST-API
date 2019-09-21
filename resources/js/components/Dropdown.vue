<template>
    <div class="dropdown-shell" 
        @mouseover="dropdownOpen = true" 
        @mouseleave="dropdownOpen = false">
        <div :class="dropdownObject.mainButtonClass">
            {{ dropdownObject.mainButtonName }}
        </div>
        <div class="dropdown-buttons" v-if="dropdownOpen">
            <div v-for="btn in dropdownObject.buttonNames">
                <div :class="dropdownObject.subButtonClass">
                    {{ btn.name }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import './../../sass/dropdown.scss'
export default {
  name: 'dropdown',
  data: function() {
      return {
          dropdownOpen: false,
      }
  },
  props: {
      dropdownObject: {
        mainButtonClass: String,
        subButtonClass: String,
        mainButtonName: String,
        buttonNames: [
            Object,
            Object,
            Object,
            Object
        ],
      }
  },
  created() {}
};
</script>