<template>
  <home-layout>
    <h2>Example Component</h2>
    <example></example>
    <h3>Sample Component</h3>
    <sample></sample>
  </home-layout>
</template>

<script>
import HomeLayout from "Layouts/Home.vue";
import Example from "Components/ExampleComponent.vue";
import Sample from "Components/SampleComponent.vue"

export default {
     components: {
        HomeLayout,
        Example,
        Sample
    }
};
</script>