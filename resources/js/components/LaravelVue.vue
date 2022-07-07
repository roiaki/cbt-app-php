<template>
  <div>
    <h1>LaravelでVueを実装できました。</h1>
    <p>Good!!Year!!</p>
    <p>{{ message }}</p>
  </div>
</template>

<script>
   export default {
        mounted() {
            console.log('Component mounted.')
        }
   }
</script>