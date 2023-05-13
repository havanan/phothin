<template>
  <div class="d-flex flex-column align-center">
    <img src="~/assets/image/logo.png" class="mb-5 nav-logo" width="150px" />
    <h4 class="text-h5">
      Chào mừng:<strong class="ml-2">{{ $auth.user.name }} !</strong>
    </h4>
  </div>
</template>

<script>
export default {
  name: "IndexPage",
};
</script>
