<template>
    <div>
        <header-component></header-component>
        <router-view></router-view>
    </div>
</template>

<script>
import AdminHeaderComponent from './AdminHeaderComponent';
export default {
    components: {
        'header-component': AdminHeaderComponent
    }
}
</script>

<style lang="css" scoped>
</style>
