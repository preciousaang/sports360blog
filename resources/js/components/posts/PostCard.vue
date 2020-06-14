<template>
    <div>
        <v-card  :to="{name: 'single-post', params: {id: post.id}}" class="mb-5">
            <v-img :src="post.image"></v-img>
            <v-card-title>
                {{post.title}}
            </v-card-title>
            <v-divider></v-divider>
            <div class="d-flex">
                <v-card-subtitle>by {{post.user.name}}</v-card-subtitle>
                <v-spacer>
                </v-spacer>
                <v-card-subtitle>{{post.created_at | moment('from', 'now')}}</v-card-subtitle>
            </div>
        </v-card>
    </div>
</template>

<script>
export default {
    props: {
        post: Object,
    },
    methods: {

    }
}
</script>

<style lang="css" scoped>
</style>
