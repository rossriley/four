<template>
  <div>
      <select class="custom-select" :id="id" v-model="val">
        <option 
          v-for="(option, index) in selectOptions" 
          :key="index" 
          :value="option.key"
        >{{option.value}}</option>  
      </select>
  </div>
</template>

<script>
import field from '../../helpers/mixins/fieldValue';

export default {
  name: "editor-multi-seclect",
  props: ['value', 'label', 'name', 'id', 'options'],
  mixins: [field],
  computed:{
    selectOptions(){
      return JSON.parse(this.options);
    }
  }
};
</script>