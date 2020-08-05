<template>
  <div>
    <Child @my-vehicle="myVehicle" />
    <!--optionally we can listen to custom events by using v-on directive
          <Child v-on:my-vehicle="myVehicle" />
    -->
    <hr />
    The value emitted from child is: {{ vehicleFromChild }}
  </div>
</template>

<script>
import Child from "./Child";
export default {
  components: {
    Child
  },
  data() {
    return {
      vehicleFromChild
    };
  },
  methods: {
    myVehicle(value) {
      this.vehicleFromChild = value;
      //the emitted value from child is passed to this function as a parameter
    }
  }
};
</script>
